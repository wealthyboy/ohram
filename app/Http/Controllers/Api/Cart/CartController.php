<?php

namespace App\Http\Controllers\Api\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Product;
use App\Cart;
use App\User;
use Storage;
use App\ProductVariation;
use App\Http\Resources\CartIndexResource;
use App\Http\Resources\CartResource;
use App\SystemSetting;
use App\Http\Helper;



class CartController  extends Controller
{

	protected $settings;

	public function __construct()
	{
		$this->settings = SystemSetting::first();
	}


	public function store(Request $request)
	{


		$this->validate($request, [
			'product_variation_id' => 'required|exists:product_variations,id',
			'quantity' => 'required|min:1',
		]);

		$product_variation = ProductVariation::find($request->product_variation_id);
		if ($product_variation->quantity < 1) {
			return response()->json([
				'message' => [
					'errors' => "Product out of stock"
				]
			], 422);
		}

		$cart = new Cart;
		if (\Auth::check()) {
			$cart->user_id    = $request->user()->id;
		}
		$price = $this->getDiscountedPrice($product_variation) ?? $product_variation->price;
		$rate = Helper::rate();
		$currency = $rate->symbol ?? optional(optional($this->settings)->currency)->symbol;


		if (\Cookie::get('cart') !== null) {
			$remember_token  = \Cookie::get('cart');
			$result = $cart->updateOrCreate(
				['product_variation_id' => $request->product_variation_id, 'remember_token' => $remember_token],
				[
					'product_variation_id' => $request->product_variation_id,
					'quantity'   => $request->quantity,
					'price'      => $product_variation->price,
					'rate'      => optional($rate)->rate ?? 1,
					'sale_price' => $this->getDiscountedPrice($product_variation),
					'total'      => $price * $request->quantity,
					'status'     => 'Pending',
					'currency' => $currency
				]
			);

			return $this->loadCart($request);
		} else {
			$value = bcrypt('^%&#*$((j1a2c3o4b5@+-40');
			session()->put('cart', $value);
			$cookie = cookie('cart', session()->get('cart'), 60 * 60 * 7);
			$cart->product_variation_id = $request->product_variation_id;
			$cart->quantity   = $request->quantity;
			$cart->price      = $product_variation->price;
			$cart->rate      = optional($rate)->rate ?? 1;
			$cart->currency      = $currency;
			$cart->sale_price = $this->getDiscountedPrice($product_variation);
			$cart->total      = $price * $request->quantity;
			$cart->status     = 'Pending';
			$cart->remember_token = $cookie->getValue();
			$cart->save();
			$carts = Cart::all_items_in_cart();
			$total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('remember_token', $cookie->getValue())->get();
			$sub_total =  Cart::ConvertCurrencyRate($total[0]->items_total);

			return response()->json([
				'data' => [

					0 => [
						'cart_id' => $cart->id,
						'product_variation_id' => $cart->product_variation_id,
						'image' => optional($cart->product_variation)->image_to_show,
						'quantity' => $cart->quantity,
						'price' => $cart->converted_price,
						'sale_price' => $cart->converted_sale_price,
						'product_name' => optional($cart->product_variation)->product->product_name,
						'variations' => optional($cart->product_variation)->product_variation_values->pluck('name')->toArray(),
					]
				],
				'meta' => [
					'sub_total' => $sub_total,
					'currency' => Helper::rate()->symbol ?? optional(optional($this->settings)->currency)->symbol,
					'currency_code' => Helper::rate()->iso_code3 ?? optional(optional($this->settings)->currency)->iso_code3,
					'user' => $request->user()
				],
			])->withCookie($cookie);
		}
	}


	public function getDiscountedPrice($prod)
	{
		if (null !== $prod->sale_price &&  optional($prod->sale_price_expires)->isFuture()) {
			return $prod->sale_price;
		}
		return null;
	}


	public function loadCart(Request $request)
	{
		$cc =  Helper::rate()->iso_code3 ?? optional(optional($this->settings)->currency)->iso_code3;

		$carts = Cart::all_items_in_cart();
		$sub_total =  Cart::sum_items_in_cart();
		$rate = \Cookie::get('rate');
		return  CartIndexResource::collection($carts)->additional([
			'meta' => [
				'sub_total' => $sub_total,
				'currency' => Helper::rate()->symbol ?? optional(optional($this->settings)->currency)->symbol,
				'currency_code' => Helper::rate()->iso_code3 ?? optional(optional($this->settings)->currency)->iso_code3,
				'user' => $request->user(),
				'isAdmin' => null !== $request->user() ? $cc : false,
				'isCC' => null !== $request->user() ? $cc : false,
				'cc' => Helper::rate()->iso_code3 ?? optional(optional($this->settings)->currency)->iso_code3,

			],
		]);
	}

	public function destroy(Request $request, $cart_id)
	{

		if ($request->ajax()) {
			$cart =  Cart::find($cart_id);
			if ($cart && $cart->quantity > 1) {
				$cart->update([
					'quantity' => ($cart->quantity - 1),
					'total' => ($cart->quantity - 1) * $cart->price
				]);
			} else {
				$cart->delete();
			}
			return $this->loadCart($request);
		}
	}
}
