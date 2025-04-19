<?php

namespace App\Http\Controllers\Checkout;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\ProductVariation;
use App\User;
use App\Voucher;
use App\Order;
use App\OrderedProduct;
use App\Cart;
use App\SystemSetting;
use App\Http\Controllers\Controller;
use App\Mail\OrderReceipt;
use App\Location;
use App\Http\Helper;
use App\Shipping;
use App\Address;
use App\Jobs\AbandonCart;
use App\Currency;




class CheckoutController extends Controller
{


	public  $cart;

	public  $settings;

	public function __construct(Request $request)
	{

		if ($request->token) {
			$verify = Cart::where(['remember_token' => $request->token])->first();
			if (!$verify) {
				return redirect()->to('/404');
			}
			\Auth::loginUsingId($request->token_id, $remember = true);
		}

		$this->middleware('auth');
		$this->settings =  SystemSetting::first();
	}


	public function  index(Request $request)
	{

		$carts =  Cart::all_items_in_cart($request->token);
		if (!$carts->count()) {
			return redirect()->to('/cart');
		}
		$csrf = json_encode(['csrf' => csrf_token()]);
		if ($request->token) {
			\Cookie::queue('cart', $request->token, 60 * 60 * 7);
		}

		$user = $request->user();

		//AbandonCart::dispatch($carts, $user)->delay(now()->addMinutes(10));
		return view('checkout.index', ['csrf' => $csrf]);
	}


	public function stripe(Request $request)
	{
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

		$data = $request->all();

		$input = $data['payLoad']['custom_fields'][0];
		$user = User::findOrFail($input['customer_id']);
		$stripe = $data['payLoad']['payment'];



		try {
			$paymentIntent = \Stripe\PaymentIntent::create([
				'amount' => $input['total'], // kobo or cents
				'currency' => $input['currency'],
				'payment_method' => $stripe['id'],
				'confirm' => true,
				'receipt_email' => $user->email,
				'automatic_payment_methods' => [
					'enabled' => true,
					'allow_redirects' => 'never'
				]
			]);


			if ($paymentIntent->status === 'succeeded') {

				$order = new Order;
				$carts = Cart::find($input['cart']);
				$order->user_id = $user->id;
				$order->address_id = optional($user->active_address)->id;
				$order->coupon = $input['coupon'] !== 0  ? $input['coupon'] : null;
				$order->status = 'Processing';
				$order->shipping_id = $input['shipping_id'];
				$order->shipping_price = optional(Shipping::find($input['shipping_id']))->converted_price;
				$order->currency = $input['meta']['currency'];
				$order->invoice = "INV-" . date('Y') . "-" . rand(10000, 39999);
				$order->payment_type = 'card';
				$order->total = $input['total'];
				$order->ip = $request->ip();
				$order->save();

				foreach ($carts   as $cart) {

					$OrderedProduct = new OrderedProduct;
					$price = $cart->sale_price ?? $cart->price;
					$quantity = $cart->quantity * $price;
					$OrderedProduct->order_id = $order->id;
					$OrderedProduct->product_variation_id = $cart->product_variation_id;
					$OrderedProduct->quantity = $cart->quantity;
					$OrderedProduct->status = "Processing";
					$OrderedProduct->price = $cart->ConvertCurrencyRate($price, $cart->rate);
					$OrderedProduct->total = $cart->ConvertCurrencyRate($quantity, $cart->rate);
					$OrderedProduct->created_at = \Carbon\Carbon::now();
					$OrderedProduct->save();
					$product_variation = ProductVariation::find($cart->product_variation_id);
					$qty  = $product_variation->quantity - $cart->quantity;
					$product_variation->quantity =  $qty < 1 ? 0 : $qty;
					$product_variation->save();
					//Delete all the cart
					$cart->delete();
				}
				$admin_emails = explode(',', $this->settings->alert_email);
				$symbol = $input['meta']['currency'];

				try {
					$when = now()->addMinutes(5);
					\Mail::to($user->email)
						->bcc($admin_emails[0])
						->cc("jacob.atam@gmail.com")
						->send(new OrderReceipt($order, $this->settings, $symbol));
				} catch (\Throwable $th) {
					\Log::info("Mail error :" . $th);
				}

				if ($input['coupon']) {
					$code = trim($input['coupon']);
					$coupon =  Voucher::where('code', $input['coupon'])->first();
					if (null !== $coupon && $coupon->type == 'specific') {
						$coupon->update(['valid' => false]);
					}
				}

				return response()->json([
					'success' => true,
					'message' => 'Payment successful!',
					'payment_intent' => $paymentIntent,
				]);
			} elseif ($paymentIntent->status === 'requires_action') {
				return response()->json([
					'requires_action' => true,
					'client_secret' => $paymentIntent->client_secret,
					'message' => 'Additional authentication is required.',
				]);
			} else {
				return response()->json([
					'success' => false,
					'message' => 'Payment failed or incomplete.',
					'status' => $paymentIntent->status,
				]);
			}


			$inter = $request->all();


			//\Log::info($carts);




			return response()->json(['success' => true]);
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'error' => $e->getMessage()]);
		}
	}



	public function confirm(Request $request, OrderedProduct $ordered_product, Order $order)
	{

		\Log::info($request->all());

		$rate  =  Helper::rate();
		$user  =  \Auth::user();
		$carts =  Cart::all_items_in_cart();
		$cart  =  new Cart();

		$order->user_id = $user->id;
		$order->address_id     =  $user->active_address->id;
		$order->coupon         =  session('coupon');
		$order->status         = 'Processing';
		$order->shipping_id    =  $request->shipping_id;
		$order->shipping_price =  $request->shipping_price;
		$order->currency       =  Helper::getCurrency();
		$order->invoice        =  "INV-" . date('Y') . "-" . rand(10000, 39999);
		$order->payment_type   = $request->payment_method;
		$order->order_type     = $request->type;
		$order->total          = $request->total;
		$order->ip             = $request->ip();
		$order->user_agent     = $request->server('HTTP_USER_AGENT');
		$order->save();
		foreach ($carts   as $cart) {
			$price = $cart->sale_price ?? $cart->price;
			$insert = [
				'order_id' => $order->id,
				'product_variation_id' => $cart->product_variation_id,
				'quantity' => $cart->quantity,
				'status' => "Processing",
				'price' => $cart->ConvertCurrencyRate($price),
				'total' => $cart->ConvertCurrencyRate($cart->quantity * $price),
				'created_at' => \Carbon\Carbon::now()
			];
			OrderedProduct::Insert($insert);
			$product_variation = ProductVariation::find($cart->product_variation_id);
			$qty  = $product_variation->quantity - $cart->quantity;
			$product_variation->quantity =  $qty < 1 ? 0 : $qty;
			$product_variation->save();
			$cart->status = 'paid';
			$cart->save();
		}
		$admin_emails = explode(',', $this->settings->alert_email);
		$symbol = Helper::getCurrency();
		try {
			$when = now()->addMinutes(5);
			\Mail::to($user->email)
				->bcc($admin_emails[0])
				->send(new OrderReceipt($order, $this->settings, $symbol));
		} catch (\Throwable $th) {
			//throw $th;
		}

		//delete cart
		//$affectedRows = Cart::delete_items_in_cart_purchased();
		if ($request->session()->has('coupon')) {
			$code = trim(session('coupon'));
			$coupon =  Voucher::where('code', $code)->first();
			if (null !== $coupon && $coupon->type == 'specific') {
				$coupon->update(['valid' => false]);
			}
		}
		//unset the coupon
		$request->session()->forget('coupon');
		$request->session()->forget('coupon_total');
		\Cookie::queue(\Cookie::forget('cart'));
		return 3;
	}


	protected function coupon(Request $request)
	{

		$cart_total  = Cart::sum_items_in_cart();
		if (!$cart_total) {
			$error['error'] = 'We cannot process your voucher';
			return response()->json($error, 422);
		}

		$user  =  \Auth::user();
		// Build the input for validation
		$coupon = array('coupon' => $request->coupon);
		// Tell the validator that this file should be an image
		$rules = array(
			'coupon' => 'required'
		);

		// Now pass the input and rules into the validator
		$validator = \Validator::make($coupon, $rules);

		if ($validator->fails()) {
			return response()->json($validator->messages(), 422);
		}

		$coupon =  Voucher::where('code', $request->coupon)
			->where('status', 1)
			->first();

		$error = array();

		if (empty($coupon)) {
			$error['error'] = 'Coupon is invalid ';
			return response()->json($error, 422);
		}

		if ($coupon->is_coupon_expired()) {
			$error['error'] = 'Coupon has expired';
			return response()->json($error, 422);
		}


		if ($cart_total < $coupon->from_value) {
			$error['error'] = 'You can only use this coupon when your purchase is above  ' . $this->settings->currency->symbol . $coupon->from_value;
			return response()->json($error, 422);
		}


		if (!$coupon->is_valid()) {
			$error['error'] = 'Coupon is invalid ';
			return response()->json($error, 422);
		}
		//get all the infomation 
		$total = [];
		$total['currency'] = $this->settings->currency->symbol;

		if (!empty($coupon->from_value) && $cart_total >= $coupon->from_value) {
			$new_total = ($coupon->amount * $cart_total) / 100;
			$new_total = $cart_total - $new_total;
			$total['sub_total'] = round($new_total, 0);
			$request->session()->put(['new_total' => $new_total]);
			$request->session()->put(['coupon_total' => $new_total]);
			$request->session()->put(['coupon' => $request->coupon]);
			$total['percent'] = $coupon->amount . '%  percent off';
			return response()->json($total, 200);
		} else if (!empty($coupon->from_value) && $cart_total < $coupon->from_value) {
			$error['error'] = 'Coupon is invalid ';
			return response()->json($error, 422);
		} else {
			$new_total = ($coupon->amount * $cart_total) / 100;
			$new_total = $cart_total - $new_total;
			$total['sub_total'] =   $new_total;
			$request->session()->put(['new_total' => $new_total]);
			$request->session()->put(['coupon_total' => $new_total]);
			$request->session()->put(['coupon' => $request->coupon]);
			$total['percent'] = $coupon->amount . '%  percent off';
			return response()->json($total, 200);
		}
	}
}
