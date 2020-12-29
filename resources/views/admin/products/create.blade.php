@extends('admin.layouts.app')
@section('pagespecificstyles')
@stop
@section('content')
<div class="row">
   <div class="col-sm-12">
      @include('admin.errors.errors')
      <!--      Wizard container        -->
      <div class="wizard-container">
         <div class="card wizard-card" data-color="rose" id="wizardProfile">
            <form enctype="multipart/form-data" id="product-form" action="{{ route('products.store') }}" method="post">
               @csrf
               <!--  You can switch " data-color="purple"   with one of the next bright colors: "green", "orange", "red", "blue"       -->
               <div class="wizard-header">
                  <h3 class="wizard-title">
                     Upload Product
                  </h3>
               </div>
               <div class="wizard-navigation">
                  <ul>
                     <li><a href="wizard.html#ProductData" data-toggle="tab">Product Data</a></li>
                     <li><a href="wizard.html#RelatedProducts" data-toggle="tab">Related Products</a></li>
                     <li><a href="wizard.html#ProductVariations" data-toggle="tab">Product Variation</a></li>
                  </ul>
               </div>
               <div class="tab-content">
                  <div class="tab-pane" id="ProductData">
                     @include('admin.products.product_data')
                  </div>

                  <div class="tab-pane" id="RelatedProducts">
                     @include('admin.products.product_related')
                  </div>
                  <div class="tab-pane" id="ProductVariations">
                     <h4 class="info-text">Product Variation</h4>
                     <div class="col-md-12">
                        <h4>Product Type </h4>
                        <div class="form-group">
                           <label class="control-label">Product Type</label>
                           <select name="type" id="product-type" class="form-control"  required="true" title="Please select product type"  title="" data-size="7">
                              <option  value="" selected>Choose One</option>
                              <option  value="simple">Simple</option>
                              <option  value="variable">Variable</option>
                           </select>
                        </div>
                     </div>
                     <div class="simple-product hide">
                        @include('admin.products.product_images') 
                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Price</label>
                                 <input name="price"  required="true" type="text" value="{{ old('price') }}" class="form-control">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Quantity</label>
                                 <input name="quantity"  type="number" required="true"  value="{{ old('quantity') }}"  class="form-control">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Sale Price</label>
                                 <input name="sale_price"   value=""  class="form-control" type="text">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Extra Percent Off</label>
                                 <input name="extra_percent_off"   value=""  class="form-control" type="number">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group label-floating">
                                 <label class="control-label">End Date</label>
                                 <input class="form-control  pull-right" name="sale_price_expires" id="datepicker" type="date">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Weight</label>
                                 <input name="weight"   type="text" value="{{ old('weight') }}" class="form-control">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Length</label>
                                 <input name="length"   type="text" value="{{ old('length') }}" class="form-control" >
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Width</label>
                                 <input name="width"      value="{{ old('width') }}"  class="form-control" type="text">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Height</label>
                                 <input name="height"      value="{{ old('height') }}"  class="form-control" type="text">
                                 <span class="material-input"></span>
                              </div>
                           </div>
                        </div>
                     </div>
               
                     <div class="clearfix"></div>
                     
                     <div class="row p-attr  variable-product hide">
                        @if($product_attributes->count())
            
                        <div class="col-sm-9">
                           @foreach($product_attributes as $product_attribute)
                              <div class="col-md-3 col-sm-6 col-xs-6">
                                 <div class="form-group label-floating">
                                    <label class="control-label">{{ $product_attribute->name }}</label>
                                    <select name="" class="form-control product-attributes"  title="Choose {{ $product_attribute->name }}" data-style="select-with-transition"  data-size="7">
                                          <option  value="" selected>Select</option>
                                          <option   value="{{ $product_attribute->id }}">&nbsp;&nbsp;&nbsp;{{ $product_attribute->name }} </option>
                                    </select>
                                 </div>
                              </div>
                           @endforeach
                        </div>
                        <label class="col-md-3  col-xs-12 col-xs-12">
                           <button type="button"  id="product-attribute-add" class="btn btn-round btn-primary">
                              Add Variation
                              <span class="btn-label btn-label-right">
                                 <i class="fa fa-plus"></i>
                              </span>
                           </button>
                        </label>
                        @else
                           <div class="col-sm-7">
                              No attributes set. Go Products > attributes and set your attributes.
                           </div>
                        @endif
                     </div>

                  </div>
               <div class="wizard-footer">
                  <div class="pull-right">
                     <input type='button' class='btn btn-next btn-fill btn-rose btn-round btn-wd' name='next' value='Next' />
                     <input type='submit' class='btn btn-finish btn-fill btn-rose   btn-round  btn-wd' name='finish' value='Finish' />
                  </div>
                  <div class="pull-left">
                     <input type='button' class='btn btn-previous btn-fill btn-primary  btn-round  btn-wd' name='previous' value='Previous' />
                  </div>
                  <div class="clearfix"></div>
               </div>
            </form>
         </div>
      </div>
      <!-- wizard container -->
   </div>
</div>
@endsection
@section('page-scripts')
   <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
   <script src="{{ asset('backend/js/products.js') }}"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
   CKEDITOR.replace('description',{
      height: '400px'
   })       
});
@stop

