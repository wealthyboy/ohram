

@extends('admin.layouts.app')
@section('pagespecificstyles')
<link href="{{ asset('asset/css/slick.css') }}" rel="stylesheet"/>
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@stop
@section('content')
<div class="row">
   <div class="col-sm-12">
      @include('admin.errors.errors')
      <!--      Wizard container        -->
      <div class="wizard-container">
         <div class="card wizard-card" data-color="rose" id="wizardProfile">
         <form enctype="multipart/form-data" action="{{ route('update_product',['id'=>$product->id])  }}" method="post">
               {{ csrf_field() }}
               <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
               <div class="wizard-header">
                  <h3 class="wizard-title">
                     Upload Product
                  </h3>
               </div>
               <div class="wizard-navigation">
                  <ul>
                     <li><a href="wizard.html#about" data-toggle="tab">Image</a></li>
                     <li><a href="wizard.html#account" data-toggle="tab">Data</a></li>
                     <li><a href="wizard.html#variations" data-toggle="tab">Product Variations</a></li>

                  </ul>
               </div>
               <div class="tab-content">
                  <div class="tab-pane" id="about">
                     <div class="row">
                        <h4 class="info-text">Upload Image Here</h4>
                        <div class="col-sm-8 col-sm-offset-2">
                        <div id="m_image"  class="uploadloaded_image ">
                                          <img id="stored_image" src="{{ $product->m_path() }}" class="">

                                          <div class="upload-text hide"> 
                                             <a class="activate-file-m" href="#">
                                             <img src="{{ asset('asset/img/upload_icon.png') }}">
                                                  <b>Add Image </b>          
                                             </a>
                                          </div>
                                          <div id="remove_image" class="remove_image">
                                           <a  class="activate-file-m"  href="#">Change</a> 
                                          </div>
                                          <input accept="image/*" data-msg="Uplaod  your art work" class="ignore upload_input" type="file" id="main_image" name="edit_image"  />
                                          <input type="hidden" data-msg="Uplaod  your art work"  class="stored_image" value="{{  $product->image }}" id="stored_image" name="image">     
                                          <input   type="hidden" value="{{ $product->product_image->id }}" name="product_image_id" class="form-control" >

                                        
                                        </div>

                                     <div class="slick-div">
                                    @if($product->product_image->add_image->count())
                                       @foreach ( $product->product_image->add_image as $image )
                                           <div class="items-ad uploadloaded_image">
                                                <img id="stored_image" src="{{ $image->image_path()  }}" class="">

                                                <div class="upload-text hide">
                                                   <a class="activate-file-a" href="#">
                                                   <img src="{{ asset('asset/img/upload_icon.png') }}">
                                                   <b>Add Image </b>        
                                                   </a>
                                                </div>
                                                <div id="remove_image" class="remove_image">
                                                   <a class="delete_image" href="#">Remove</a>
                                                </div>
                                                <input accept="image/*" class="upload_input additional_images" type="file" id="additional_images" name="additional_images[]"  />
                                                <input type="hidden" id="stored_image" name="images[]">  

                                                 <input type="hidden" class="stored_image_id" id="stored_image_id" value="{{ $image->id }}" name="{{ $image->id }}">  
 
                                             </div>

                                       @endforeach
                                    @endif
                                    <?php  $number = 10 - $product->product_image->add_image->count();?>
                                    <?php for($i=0; $i <= $number; $i++){ ?>
                                        <div class="items-ad uploadloaded_image">
                                             <div class="upload-text">
                                                <a class="activate-file-a" href="#">
                                                <img src="{{ asset('asset/img/upload_icon.png') }}">
                                                <b>Add Image </b>        
                                                </a>
                                             </div>
                                             <div id="remove_image" class="remove_image hide">
                                                <a class="delete_image" href="#">Remove</a> |  <a  class="activate-file-a"  href="#">Change</a> 
                                             </div>
                                             <input accept="image/*" class="upload_input additional_images" type="file" id="additional_images" name="additional_images[]"  />
                                             <input type="hidden" id="stored_image" name="images[]">  
                                          </div> 
                                    <?php  } ?>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="account">
                     <h4 class="info-text">Enter Products Details</h4>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Product Name</label>
                                    <input  required="true" type="text" value="{{ isset($product) ? $product->product_name : old('product_name') }}" name="product_name" class="form-control" >
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Price</label>
                                    <input  required="true" number="true " type="number" value="{{ isset($product) ? $product->price : old('price') }}"  name="price" class="form-control" >
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                               <div class="col-md-3">
                                 <div class="form-group label-floating is-empty">
                                    <label class="control-label">Sale Price</label>
                                    <input name="sale_price"  value="{{ isset($product) ? $product->sale_price : old('sale_price') }}"  type="number" class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                          
                              <div class="col-md-3">
                                 <div class="form-group label-floating">
                                    <label class="control-label">Brands</label>
                                    <select name="brand_id" class="form-control">
                                    <option disabled="" selected="selected"></option>
                                        @foreach($brands as $brand) 
                                        <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                        @if( $product->brand_id == $brand->id)
                                                <option value="{{ $brand->id }}" selected="selected"> {{ $brand->brand_name }} </option>
                                                @else
                                                <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                            @endif
                                        @endforeach
                              </select>
                                 </div>
                              </div>
                            
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group ">
                                       <label clasjjjs="control-label"> Enter description here</label>
                                       <textarea name="description" 
                                       id="description" class="form-control" rows="8">{{ isset($product) ? $product->description : old('description') }}"</textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <legend>  
                                    Enable/Disable
                                 </legend>
                                 <div class="togglebutton">
                                    <label>
                                    <input {{ $product->allow == 1 ? 'checked' : ''}} name="allow"  value="1" type="checkbox">
                                    Enable/Disable
                                    </label>
                                 </div>
                              </div>

                               <div class="col-md-6">
                                  <legend>  
                                    Featured Product
                                  </legend>
                                  <div class="togglebutton">
                                    <label>
                                        <input name="featured_product"  {{ $product->featured == 1 ? 'checked' : '' }} value="1"  type="checkbox" >
                                      Yes/No
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4">
                           <label>Catgeories</label>
                           <div class="well well-sm" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                              <ul class="treeview" data-role="treeview">
                                 <li data-icon="" data-caption="">
                                    <ul>
                                       @foreach($categories as $category)
                                       <li data-caption="Documents">
                                          <div class="checkbox">
                                             <label>
                                                <input data-id="{{ $category->check($product->categories , $category->id) }}" {{   $category->check($product->categories , $category->id) ? 'checked' : '' }} name="category_id[]" value="{{ trim($category->id) }}
                                                   " class="category_id" type="checkbox">
                                                {{ $category->category_name }}  <small class="cat"></small>
                                          </div>
                                       </li>
                                       @if($category->children->count())
                                       @foreach($category->children  as $children)  
                                          <li data-caption="Projects">
                                             <ul>
                                                <li data-caption="Web">
                                                   <div class="checkbox">
                                                      <label> 
                                                      <input  {{  $children->check($product->categories , $children->id) ? 'checked' : ''}} name="category_id[]" value="{{  trim($children->id) }}" type="checkbox">
                                                      {{$children->category_name}}
                                                   </div>
                                                </li>
                                             </ul>
                                          </li>
                                       @endforeach
                                       @endif 
                                       @endforeach
                                    </ul>
                                 </li>
                              </ul>
                           </div>
                        </div>
                       
                     </div>
                  </div>

                  <div class="tab-pane" id="variations">
                     <h4 class="info-text">Products Variation</h4>
                     <div class="row">
                     <div class="col-md-12">
                           <div class="row">
                             


                             <div class="col-md-3">
                                 <div class="form-group label-floating">
                                    <label class="control-label">Color</label>
                                    <select name="color_id" required="true" class="form-control">
                                        <option value="" disabled="" selected=""></option>
                                           @foreach($colors as $color) 
                                            @if( $product->product_image->color_id == $color->id)
                                                <option value="{{ $color->id }}" selected="selected"> {{ $color->color_name }} </option>
                                                    @else
                                                    <option value="{{ $color->id }}"> {{ $color->color_name }} </option>
                                                @endif
                                            @endforeach
                                 
                                     </select>
                                 </div>
                              </div>

                           </div>
                         @if( $product->product_image->product_sizes->count())
                         @foreach( $product->product_image->product_sizes as $product_size)

                           <div class="row">
                             
                              <div class="col-md-3">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Size</label>
                                    <input name="sizes[{{ $product_size->id }}]"   value="{{ $product_size->size }}"  type="text" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Price</label>
                                    <input name="variation_prices[{{ $product_size->id }}]"  value="{{ $product_size->price }}"    number="true" type="number" class="form-control" >
                                 </div>
                              </div>

                               <div class="col-md-3">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Sale Price</label>
                                    <input name="variation_sale_prices[{{ $product_size->id }}]"  value="{{ $product_size->sale_price }}"     type="number" class="form-control" >
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Qty</label>
                                    <input required  number="true" value="{{ $product_size->quantity }}"    name="variation_quantity[{{ $product_size->id }}]"  required="true" type="number"  class="form-control" >
                                 </div>
                              </div>

                            <div class="col-md-1">
                            <div style="margin-top:20px;" class=""><a href="{{  route('delete_product_size',['id'=>$product_size->id ]) }}"  data-toggle="tooltip" title="Remove" class=""><i class="fa fa-minus-circle"></i></a></div>
                               
                            </div>

                         
                             
                           </div>
                          @endforeach
                        @else

                           <div class="row">
                             
                             <div class="col-md-3">
                                <div class="form-group label-floating is-empty">
                                   <label class="control-label">Size</label>
                                   <input name="sizes[]"  type="text" class="form-control">
                                </div>
                             </div>
                             <div class="col-md-3">
                                <div class="form-group label-floating is-empty">
                                   <label class="control-label">Price</label>
                                   <input name="variation_prices[]"   number="true" type="number" class="form-control" >
                                </div>
                             </div>

                              <div class="col-md-3">
                                <div class="form-group label-floating is-empty">
                                   <label class="control-label">Sale Price</label>
                                   <input name="variation_sale_prices[]"    type="number" class="form-control" >
                                </div>
                             </div>
                             <div class="col-md-2">
                                <div class="form-group label-floating is-empty">
                                   <label class="control-label">Qty</label>
                                   <input required  number="true"  name="variation_quantity[]"  required="true" type="number"  class="form-control" >
                                </div>
                             </div>

                               <div class="col-md-1">
                              
                              </div>
                        
                            
                          </div>

                        @endif

                           

                          <div id="target"></div>

                          <button onclick="s.addMoreForm();" id="" type="button"  class="btn add-product-field btn-default btn-block"><i class="glyphicon glyphicon-plus"></i> Add  More</button>
                        
                           <div class="clearfix"></div>
                        </div>
                       
                        
                     </div>
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
@section('pagespecificscripts')
<script src="{{ asset('asset/js/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('asset/js/slick.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
@stop
@section('inline-scripts')    

$(document).ready(function(){

$(".category_id").on('click',function(){

if($(this).prop("checked") == true){

   // alert("Checkbox is checked.");

}

else if($(this).prop("checked") == false){

    //alert($(this).data('id')+"Checkbox is unchecked.");

}


});
$('#cat_sub_cat_id').on('change',function(){
    $name = $(this).find(':selected').data('name');
    $(this).attr('name', $name);
});
s.initMaterialWizard();
 $('#description').summernote({
      height: 300
  });
 $('.slick-div').slick({
    autoplaySpeed: 5e3,
    arrows: true,
    infinite: true,
    slidesToScroll: 4,
    slidesToShow: 3,
    touchMove: true,
});
  $('[href="wizard.html#about"]').on('shown.bs.tab', function (e) {
  $('.slick-div').resize();
});
$(".category_link").on('click',function(){
  var self = $(this);
  $.get("/load_products_form",
  {
  id: self.data('id'),
  },
  function(data, status){
  $("div#tab"+self.data('id')).html(data);
  });
  });
  setTimeout(function(){
  $('.card.wizard-card').addClass('active');
  },600);
});
@stop

