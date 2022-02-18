@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="{{ route('rates.index') }}" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">refresh</i>
           Refresh
         </a>
         <a href="{{ route('rates.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">add</i>
           Add rate
         </a>
         <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-rates').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
         <i class="material-icons">close</i>
           Remove Rate
         </a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-content">
            <h4 class="card-title">Rates</h4>
            <div class="toolbar">
               <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
               <form action="{{ route('rates.destroy',['rate'=>1]) }}" method="post" enctype="multipart/form-data" id="form-rates">
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
                           <td class="text-left"> Default</td>
                           <td class="text-left"> Currency 2</td>
                           <td class="text-left"> Rate</td>
                           <td class="text-left"></td>

                          
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($rates as $rate )
                           <tr>
                              <td class="">
                                 <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="selected[]" value="{{ $rate->id }}" />
                                    </label>
                                 </div>
                              </td>
                              <td class="text-left">{{ optional($default->currency)->symbol }}{{ optional($default->currency)->country }}</</td>
                              <td class="text-left">{{ $rate->currency->country  }}{{ $rate->currency->symbol  }}</td>
                              <td class="text-left">{{ $rate->rate }}</td>
                            
                              <td class="td-actions text-right">
                                 <a href="{{ route('rates.edit',['rate'=> $rate->id])  }} " rel="tooltip" class="btn btn-success btn-simple" data-original-title="" title="Edit">
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
