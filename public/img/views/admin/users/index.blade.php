@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
        <div class="text-right">
            <a href="{{ route('admin.users.create') }}" rel="tooltip" title="Add  New" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">add</i>Add
                </a>
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-users').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i>Delete
                </a>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Users</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar  -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('admin.users.destroy',['user' => 1]) }}" method="post" enctype="multipart/form-data" id="form-users">
                       {{ csrf_field() }}
 
                        @method('DELETE')
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>

                                <tr>
                                  <th>
                                  <div class="checkbox">
                                            <label>
                                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                            </label>
                                        </div>
                                
                                  </th>

                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th class="text-right">Date Added</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                             @foreach($users as $user)
                                <tr>
                                   <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $user->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $user->fullname() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-right">{{ $user->created_at }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.users.edit',['user'=>$user->id]) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-simple btn-xs">
                                                <i class="material-icons">edit</i>
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
@section('pagespecificscripts')
<script src="/store/js/jquery.datatables.js"></script>
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
    $('.card .material-datatables label').addClass('form-group');
	});
@stop





