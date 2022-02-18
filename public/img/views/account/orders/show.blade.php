@extends('layouts.app')
 
@section('content')
<section class="sec-padding--account bg--gray">
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                @include('account.nav')
            </div>
            <div class="col-md-9 bg--light mt-3 pb-3">
                <h2 class="page-title">Your Order</h2>
                <section class="top mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <h3>Shipping Address</h3>
                                <span id="">{{ optional($order->address)->first_name }} {{ optional($order->address)->last_name }}</span>
                                    <br />{{ optional($order->address)->address }}
                                    <br /> {{ optional($order->address)->city }} &nbsp;
                                    <br /> {{ optional(optional($order->address)->address_state)->name }},
                                    {{ optional(optional($order->address)->address_country)->name }}
                                </span>
                            </div>
                            <div class="col-4">
                                <h3>Payment Method</h3>
                                {{ $order->payment_type }}
                            </div>
                           
                            <div class="col-4">
                                <h3>Cart Total</h3>
                                <span><span class="bold" id="subtotal">Subtotal:</span> {{ $order->currency }}{{ $order->total }}</span></span>  </br>
                                <span><span class="bold" id="subtotal">Shipping:</span> {{ $order->currency }}{{  $order->ship_price }}</span></span>  </br> 
                                <span><span class="bold" id="subtotal">Coupon:</span>   {{  $order->coupon ?  $order->coupon.'  -%'.$order->voucher()->amount .'  off' : '---' }}</span></span>  </br> 

                                <span><span class="bold" id="total">Total:</span>  {{ $order->currency }}{{ $order->get_total() }} </span> 
                            </div>
                        </div>
                    </div>
                   
            </section>
            <!--Breadcrumb-->

                <div class="card card-plain mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th  class="text-left" scope="col">Order Date: {{ $order->created_at->format('m/d/Y') }}</th>
                                        <th colspan="1" class="text-right" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ( $order->ordered_products as $order_product )
                                        <tr>
                                            <th scope="row"><span class="bold">Status:</span> {{ $order_product->status }}</th>
                                            <td colspan="3">
                                                <div class="media">
                                                    <div class="img-container">
                                                        <img class="align-self-start mr-3"  src="{{ optional($order_product->product_variation)->image_tn  }} " alt="{{ optional($order_product->product_variation)->product_name  }}">
                                                    </div>
                                                    <div class="media-body ml-3 ">
                                                        <h5 class="mt-0">{{ optional(optional($order_product->product_variation)->product)->product_name }}</h5>
                                                        <div class="font-weight-bolder">
                                                            @if (!empty(optional($order_product->product_variation)->product_variation_values))
                                                            <span class="bold">Variation: </span> 
                                                                    @foreach( $order_product->product_variation->product_variation_values  as $v)
                                                                        {{ $v->attribute->name .',' }}
                                                                    @endforeach
                                                            </span>
                                                            @endif

                                                            <br/>
                                                            <p class="font-weight-bolder"><span class="bold">Quantity: </span> {{ $order_product->quantity }}</span>
                                                            <p class="font-weight-bolder"><span class="bold">Price: &nbsp;</span> {{ $order->currency }}{{  $order_product->order_price }}</p>

                                                        </div>

                                                    </div>
                                                </div>
                                            
                                            </td>
                                        </tr>
                                        @endforeach                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!--End & Info-->

@endsection
