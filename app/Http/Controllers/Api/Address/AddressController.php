<?php

namespace App\Http\Controllers\Api\Address;


use App\Address;
use App\Cart;
use App\User;

use Illuminate\Support\Facades\Auth;

use Validator;
use App\State;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Location;
use App\Http\Resources\AddressResource;
use App\Http\Resources\LocationResource;

use Illuminate\Http\Request;
use App\Shipping;
use App\SystemSetting;

class AddressController extends Controller
{
    public $settings;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->settings =  SystemSetting::first();
    }


    public function index(Request $request)
    {
        //sleep(60);
        $user =  \Auth::user();


        return $this->allAddress();
    }


    public function allAddress()
    {
        $user =  \Auth::user();


        $addresses = optional($user)->addresses;
        $currency_code = Helper::rate()->iso_code3 ?? optional(optional($this->settings)->currency)->iso_code3;
        $sub_total = Cart::sum_items_in_cart();
        $defaultAddress = optional($user)->defaultAddress;
        $billing_address = optional($user)->sameAsbilling ?? optional($user)->billing_address;
        $same_as_billing = optional($user)->sameAsbilling;
        $locations = Location::parents()->orderBy('name', 'asc')->get();
        $shipping_parents = Shipping::parents()->get();
        $default_address = $user->activeAddress();
        $stateShipping = optional(optional(optional($default_address)->address_state)->shipping)->first();
        /// $total = $currency_code == 'NGR' ? optional($stateShipping)->converted_price + $sub_total = 400 : $sub_total = 400;

        $shippingPrice =  $currency_code == 'NGR' ? optional($stateShipping)->converted_price : null;
        $default_shipping = optional($default_address)->address_state  !== null ?
            optional($default_address)
            ->address_state
            ->shipping
            ->groupBy('parent.name')
            : null;
        $shipping = [];
        foreach ($locations as $location) {
            foreach ($location->children->sortBy('name') as $children) {
                $shipping[$children->id] = optional($children)->shipping->groupBy('parent.name');
            }
        }

        $total = $sub_total + optional($stateShipping)->converted_price;
        session('total', $total);
        return AddressResource::collection(
            $addresses
        )->additional([
            'meta' => [
                'countries' => LocationResource::collection(
                    $locations
                ),
                'shipping' => $shipping,
                'billing_address' => $billing_address,
                'default_shipping' => $default_shipping,
                'default_address' => $default_address,
                'same_as_billing' => $same_as_billing,
                'total' => $sub_total + optional($stateShipping)->converted_price,
                'stateShipping' => [
                    'id' => optional($stateShipping)->id,
                    'converted_price' =>  optional($stateShipping)->converted_price,
                ],

            ]
        ]);
    }


    public function store(Request $request)
    {
        $id = Auth::user()->id;

        $this->validate($request, [
            'first_name'   => 'required|max:30',
            'last_name'    => 'required|max:30',
            'address'      => 'required|max:200',
            'city'         => 'required|max:100',
            'state_id'        => 'required|numeric',
            'country_id'      => 'required'
        ]);

        $address  = new Address();
        $address->user_id = $id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->address = $request->address;
        $address->address_2 = $request->address_2;
        $address->city = $request->city;
        $address->country_id = $request->country_id;
        $address->postcode = $request->postal_code;
        $address->state_id = $request->state_id;
        $address->is_billing = $request->is_billing ? 1 : 0;
        $address->same_as_billing = $request->sameAsBilling ? 1 : 0;
        $address->save();

        $addresses =  Address::where(['user_id' => \Auth::id(), 'is_billing' => false])->get();
        if ($addresses->count()  == 1) {
            $address->is_active  = 1;
        } else {
            $address->is_active  = null;
        }
        $address->save();
        return $this->allAddress();
    }




    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $user =  \Auth::user();
        if ($address) {
            $address->delete();
            $addresses = User::find($user->id)->addresses;
            if ($addresses) {
                $default_address = $user->activeAddress();
                if (null == $default_address) {
                    $address = $addresses->first();
                    if ($address) {
                        $address->is_active = 1;
                        $address->save();
                    }
                }
            }
            return $this->allAddress();
        }
        return response()->json([], 419);
    }

    public function makeDefault(Request $request, $id)
    {
        $request->user()->addresses()
            ->where('is_active', true)
            ->update(['is_active' => false]);
        $address  = Address::find($id);
        $address->is_active = true;
        if ($address->save()) {
            return $this->allAddress();
        }
        return response()->json([], 419);
    }


    public function update(Request $request, $id)
    {

        $address = Address::find($id);

        $user = \Auth::user();

        $this->validate($request, [
            'first_name'   => 'required|max:30',
            'last_name'    => 'required|max:30',
            'address'      => 'required|max:200',
            'city'         => 'required|max:100',
            'state_id'        => 'required|numeric',
            'country_id'      => 'required'
        ]);

        $address->user_id = $user->id;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->address = $request->address;
        $address->address_2 = $request->address_2;
        $address->city = $request->city;
        $address->postcode = $request->postal_code;
        $address->state_id = $request->state_id;
        $address->country_id = $request->country_id;
        $address->is_billing = $request->is_billing ? 1 : 0;
        $address->same_as_billing = $request->sameAsBilling ? 1 : 0;

        $address->save();
        return $this->allAddress();
    }
}
