@extends('admin.layouts.app')
@section('pagespecificstyles')
@stop
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="" rel="tooltip" title="Back" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">reply</i>
         </a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Ambassador {{ $amb->full_name  }}</h4>
         </div>
         <div class="card-content">
            <ul class="nav nav-pills nav-pills-warning">
               <li class="active"><a href="panels.html#pill1" data-toggle="tab">General</a></li>

            </ul>
            <div class="tab-content">
              
                  <div class="col-md-12 col-sm-12">
                     <div class="table-responsive">
                         
                        <table class="table">
                           <tbody>

                              <tr>
                                 <td colspan="4"><b>Instagram Handle</b></td>
                                 <td class="text-right"> {{ $amb->instagram_handle }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Fullname </b></td>
                                 <td class="text-right">{{  $amb->full_name  }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Email </b></td>
                                 <td class="text-right">{{  $amb->email }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Phone </b></td>
                                 <td class="text-right">{{  $amb->phone_number  }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4" ><b> Bank Name</b></td>
                                 <td class="text-right">{{ $amb->bank_name }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Account Number</b></td>
                                 <td class="text-right">{{ $amb->account_number }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4" ><b>Account Name </b></td>
                                 <td class="text-right">{{  $amb->account_name }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Coupon Unique</b></td>
                                 <td class="text-right">{{  $amb->unique_code }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Coupon</b></td>
                                 <td class="text-right"> {{ '' }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Discount</b></td>
                                 <td class="text-right">{{ '' }} </td>
                              </tr>
                        
                           </tbody>
                        </table>
                     </div>
                  </div>
                  @if ($message = \Session::get('success'))
                     <div class="alert alert-success color--light alert-block">
                     <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                     </div>
                  @endif
                 <form action="/admin/ambassador/mail/{{ $amb->id }}" method="post">
                     @csrf

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group label-floating is-empty">
                                <label class="control-label">Subject</label>
                                <input  required="true" name="subject" data-msg="" class="form-control" type="text">
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
                                    id="description" class="form-control" cols="20" rows="10"></textarea>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="footer text-center">
                           <button type="submit" name="admin"  value="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Submit</button>
                        </div>
                     </div>
                  </div> 
                 </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
@endsection
@section('page-scripts')
   <script src="{{ asset('asset/js/sweetalert2.js') }}"></script>
@stop

@section('inline-scripts')   
@stop
