@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="{{ route('payemts.index') }}" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">refresh</i>
           Refresh
         </a>
         <a href="{{ route('payemts.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">add</i>
           Add payemt
         </a>
         <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-payemts').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
         <i class="material-icons">close</i>
           Remove Vocher
         </a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-content">
            <h4 class="card-title">payemts</h4>
            <div class="toolbar">
               <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
               <form action="{{ route('payemts.destroy',['payemt'=>1]) }}" method="post" enctype="multipart/form-data" id="form-payemts">
                  @method('DELETE')
                  @csrf
                  <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                     <thead>
                        <tr>
                           <td >
                              <div class="checkbox">
                                 <label>
                                 <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                           </td>
                           </label>
                           </div>
                           <td class="text-left"> Code</td>
                           <td class="text-left"> Amount Percent</td>
                           <td class="text-left"> Rule From Amount</td>
                           <td class="text-left"> Status</td>
                           <td class="text-left"> Valid</td>
                           <td class="text-left"> Type</td> 
                           <td class="text-left"> Expires</td>
                           <td class="text-left"> Date Added</td>
                           <td class="text-right">Action</td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($payemts as $payemt )
                           <tr>
                              <td class="">
                                 <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="selected[]" value="{{ $payemt->id }}" />
                                    </label>
                                 </div>
                              </td>
                              <td class="text-left">{{ $payemt->code }}</</td>
                              <td class="text-left">%{{ $payemt->amount  }}</td>
                              <td class="text-left">{{ $payemt->from_value }}</td>
                              <td style=" {{ $payemt->status == 1  ? 'background:green;' : ' background:red;' }} color: #fff; text-transform:uppercase;">{{ $payemt->status == 1 ? 'Approved': 'Not Approved' }}        
                              </td>
                              <td style="{{ $payemt->valid == 0  ? 'background:red;' : ' background:green;' }} color: #fff; text-transform:uppercase;">{{ $payemt->valid == 0 ? 'USED': 'YES' }}        
                              </td>
                              <td class="text-left">{{ ucfirst($payemt->type) }}</td>

                              <td class="text-left">{{ $payemt->expire() }}</td>
                              <td class="text-left">{{ $payemt->created_at->diffForHumans() }}</td>
                              <td class="td-actions text-right">
                                 <a href="{{ route('payemts.edit',['payemt'=> $payemt->id])  }} " rel="tooltip" class="btn btn-success btn-simple" data-original-title="" title="Edit">
                                    <i class="material-icons">edit</i>
                                 </a>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </form>
            </div>
         </div>
         <!-- end content-->
      </div>
      <!--  end card  -->
   </div>
   <!-- end col-md-12 -->
</div>
<!-- end row -->
@endsection
@section('pagespecificscripts')
<script src="/asset/js/jquery.datatables.js"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
$('#datatables').DataTable({
"pagingType": "full_numbers",
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
responsive: true,
language: {
search: "_INPUT_",
searchPlaceholder: "Search records",
}
});
});
@stop
