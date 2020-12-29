@extends('layouts.app')

@section('content')

<div class="row">


        <div class="col-md-12">
        <div class="text-right">
            <a href="{{ route('products') }}" rel="tooltip" title="Back" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">reply</i>
                </a>
                
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $product->product_name }}</h4>
                </div>
                <div class="card-content">
                    <ul class="nav nav-pills nav-pills-warning">
                      <li class="active"><a href="panels.html#pill1" data-toggle="tab">General</a></li>
                      <li><a href="panels.html#pill2" data-toggle="tab">Applicable Cars</a></li>
                    </ul>
                	<div class="tab-content">
                	    <div class="tab-pane active" id="pill1">
                        <div class="col-md-4 col-sm-12">
                          <legend>Image</legend>
							<div class="fileinput fileinput-new text-center" data-provides="fileinput">
								<div class="fileinput-new thumbnail">
									<img src="{{ $product->image_path() }}" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail"></div>
								<div>
									
								</div>
							</div> 
                        </div>
                        <div class="col-md-8 col-sm-12">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td colspan="4"><b>Category</b></td>
                                    <td class="text-right">{{ null !== $product->category ? $product->category->name : ""  }}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4"><b>Sub Category</b></td>
                                    <td class="text-right">{{null !== $product->sub_category ? $product->sub_category->name : ""}}</td>
                                 </tr>
                            
                                <tr>
                                    <td colspan="4" ><b>Product Name</b></td>
                                    <td class="text-right">{{$product->product_name}}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4" ><b>Price</b></td>
                                    <td class="text-right">{{ number_format($product->price) }}</td>
                                 </tr>

                                 
                                 <tr>
                                    <td colspan="4"><b>Sku</b></td>
                                    <td class="text-right" >{{$product->sku}}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4"><b>Total</b></td>
                                    <td class="text-right">{{$product->total}}</td>
                                 </tr>

                                 
                                 
                                 <tr>
                                    <td colspan="4"><b>Weight</b></td>
                                    <td class="text-right">{{$product->weight}}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4"><b>Rim</b></td>
                                    <td class="text-right">{{$product->rim}}</td>
                                 </tr>

                                 <tr>
                                    <td colspan="4"><b>Height</b></td>
                                    <td class="text-right">{{$product->height}}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4"><b>Year of Manufacture</b></td>
                                    <td class="text-right">{{$product->year_of_manufacture}}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4"><b>Max Load</b></td>
                                    <td class="text-right">{{$product->max_load}}</td>
                                 </tr>
                                 <tr>
                                    <td colspan="4" ><b>Speed Rating</b></td>
                                    <td class="text-right">{{$product->speed_rating}}</td>
                                 </tr>

                                 <tr>
                                    <td colspan="4"><b>Load Index</b></td>
                                    <td class="text-right">{{$product->load_index}}</td>
                                 </tr>

                                 <tr>
                                    <td colspan="4"><b>Hub Size</b></td>
                                    <td class="text-right">{{$product->hub_size}}</td>
                                 </tr>

                                 <tr>
                                    <td><b>Litre</b></td>
                                    <td class="text-right">{{$product->litre}}</td>
                                 </tr>
                                 
                                 <tr>
                                    <td colspan="4"><b>Container Type</b></td>
                                    <td class="text-right">{{$product->container_type}}</td>
                                 </tr>
                                 
                                 <tr>
                                    <td colspan="4"><b>Product Brand</b></td>
                                    <td class="text-right">{{$product->product_brand}}</td>
                                 </tr>
                                 
                                 <tr>
                                    <td colspan="4"><b>Color</b></td>
                                    <td class="text-right">{{$product->color}}</td>
                                 </tr>
                                 
                                 <tr>
                                    <td colspan="4"><b>Amphere</b></td>
                                    <td class="text-right">{{$product->amphere}}</td>
                                 </tr>

                                 <tr>
                                    <td colspan="4"><b>Product Brand</b></td>
                                    <td class="text-right">{{$product->product_brand}}</td>
                                 </tr>
                                 
                                 <tr>
                                    <td colspan="4"><b>Color</b></td>
                                    <td class="text-right">{{$product->color}}</td>
                                 </tr>
                            </tbody>
                        </table>
                    </div>

                        
                        </div>
                            
						    
						

                	    </div>
                	    <div class="tab-pane" id="pill2">
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year Range</th>
                                <th>Engine/Trim</th>
                            </thead>
                            <tbody>
                                @foreach($product->applicable_cars()->get() as $ac)
                                  <tr>
                                    <td>{{ $ac->make }}</td>
                                    <td> {{ $ac->model }}</td>
                                    <td class="text-primary"> {{ $ac->year_begin .'-'. $ac->year_end }}</td>
                                    <td class="text-primary"> {{ $ac->engine }}</td>
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

    </div> <!-- end row -->




@endsection
@section('inline-scripts')
@stop







