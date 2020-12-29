@extends('admin.layouts.app')
@section('pagespecificstyles')
<link href="{{ asset('store/css/slick.css') }}" rel="stylesheet"/>
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
            <form enctype="multipart/form-data" action="{{ route('create_product') }}" method="post">
               {{ csrf_field() }}
               <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
               <div class="wizard-header">
                  <h3 class="wizard-title">
                     Upload Product
                  </h3>
               </div>
               <div class="wizard-navigation">
                  <ul>
                     <li><a href="wizard.html#Image" data-toggle="tab">Image</a></li>
                     <li><a href="wizard.html#ProductData" data-toggle="tab">Product Data</a></li>
 
                  </ul>
               </div>
               <div class="tab-content">
                  <div class="tab-pane" id="Image">
               
                     <div class="row">
                        <h4 class="info-text">Upload Image Here</h4>
                        <div class="col-sm-8 col-sm-offset-2">
                           <div id="m_image"  class="uploadloaded_image text-center mb-3">
                              <div class="upload-text"> 
                                    <a class="activate-file" href="#">
                                       <img src="{{ asset('store/img/upload_icon.png') }}">
                                       <b>Add Image </b> 
                                    </a>
                              </div>
                              <div id="remove_image" class="remove_image hide">
                                    <a  class="activate-file"  href="#">Change</a> 
                              </div>

                              <input accept="image/*"  class="upload_input  " data-msg="Upload  your image" type="file" id="file_upload_input" name="file"  />
                              <input type="hidden" data-msg="Uplaod  your art work" class="file_upload_input" id="stored_image" name="image">
                           </div>

                           
                           <div class="slick-div">
                            
                              @for($i = 1; $i <= 4; $i++)
                                 <div class="items-ad uploadloaded_image">
                                    <div class="upload-text">
                                       <a class="activate-file additional-image" href="#">
                                       <img src="{{ asset('store/img/upload_icon.png') }}">
                                          <b>Add Image </b>        
                                       </a>
                                       
                                    </div>
                                    <div id="remove_image" class="remove_image hide">
                                       <a class="delete_image" href="#">Remove</a> |  <a  class="activate-file  additional-image"  href="#">Change</a> 
                                    </div>
                                       <input type="hidden" id="stored_image" class="file_upload_input" name="images[]">  
                                 </div>
                              @endfor
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="tab-pane" id="ProductData">
                     <h4 class="info-text">Enter Products Details</h4>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="row">
                              <div class="col-md-7">
                                 <div class="form-group label-floating is-empty">
                                    <label class="control-label">Product Name</label>
                                    <input  required="true" name="product_name" data-msg="" value="{{ old('product_name') }}" class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>

                              <div class="col-md-5">
                                 <div class="form-group label-floating">
                                    <label class="control-label">Brands</label>
                                    <select name="brand_id" class="form-control">
                                       <option disabled="" selected="selected"></option>
                                       @foreach($brands as $brand) 
                                       <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                             
                           <div class="col-md-4">
                                 <div class="form-group label-floating is-empty">
                                    <label class="control-label">Price</label>
                                    <input name="price"  required="true" number="true" type="number" value="{{ old('price') }}" class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>

                               <div class="col-md-4">
                                 <div class="form-group label-floating is-empty">
                                    <label class="control-label">Sale Price</label>
                                    <input name="sale_price"    type="number"  value="{{ old('sale_price') }}"  class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                            
                           </div>


                          <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group ">
                                       <label class="control-label"> Enter description here</label>
                                       <textarea name="description" 
                                       id="description" class="form-control" rows="50">{{ old('description') }}</textarea>
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
                                    <input name="allow"  value="1" type="checkbox" checked>
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
                                        <input name="featured_product"  value="1" type="checkbox" >
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
                                                <input name="category_id[]" value="{{ $category->id }}
                                                   " type="checkbox">
                                                {{ $category->category_name }}
                                          </div>
                                       </li>
                                       @if($category->children->count())
                                          @foreach($category->children  as $children)  
                                          <li data-caption="Projects">
                                             <ul>
                                                <li data-caption="Web">
                                                   <div class="checkbox">
                                                   <label> 
                                                   <input name="category_id[]" value="{{  $children->id }}" type="checkbox">
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
<script src="{{ asset('store/js/jquery.bootstrap-wizard.js') }}"></script>
<script src="{{ asset('store/js/slick.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
@stop
@section('inline-scripts')    

$(document).ready(function(){
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


  setTimeout(function(){
  $('.card.wizard-card').addClass('active');
  },600);
});
@stop

