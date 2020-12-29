@extends('admin.layouts.app')

@section('content')

<div class="row">
   <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">Emails Sent This Month</p>
            <h3 class="card-title">{{ $sent_this_month[0]->s }}</h3>
         </div>
      </div>
   </div>
   
   <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">Total Emails Sent</p>
            <h3 class="card-title">{{ $all_sent[0]->a }}</h3>
         </div>
      </div>
   </div>
</div>

<div class="row">
   
    <div class="clearfix"></div>
       <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible ">
                <button type="button" aria-hidden="true"  data-dismiss="alert" style="margin-right: 20px;" class="close">
                            <i class="material-icons">close</i>
                        </button> 
                    {{ session('success') }}
                </div>
            @endif
           <div class="text-right">
                <a href="" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">refresh</i>
                    Refresh
                </a>
                <a href="{{ route('campaigns.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">add</i>
                    Add Campaign
                </a>
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-posts').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i>
                    Remove
                </a> 
            </div> 
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Campaign</h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar-->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('campaigns.destroy',['campaign' => 1]) }}" method="post" id="form-posts">
                        @method('DELETE')
                        @csrf
                        <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                  <th>
                                    <div class="checkbox">
                                        <label>
                                            <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                        </label>
                                    </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Email List</th>
                                    <th>Template</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($campaigns as $campaign) 
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $campaign->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <!-- cart-sidebar-btn active -->
                                    <td>{{ $campaign->name }}</td>
                                    <td>{{ $campaign->subject }}</td>
                                    <td>{{ optional($campaign->email_list)->name }}</td>
                                    <td>{{ $campaign->subject }}</td>
                                    <td>
                                        <a href="/admin/campaigns/{{ $campaign->id }}/{{ $campaign->email_list_id }}/{{ $campaign->template_id }}" rel="tooltip" title="Resend" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">refresh</i>
                                            Resend
                                        </a>
                                        <a href="{{ route('campaigns.edit',['campaign'=>$campaign->id] ) }}" rel="tooltip" title="EDIT " class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                               @endforeach  
                            </tbody>
                         </table>
                        </form>
                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
@endsection
@section('inline-scripts')
$(document).ready(function() {
  
});
@stop







