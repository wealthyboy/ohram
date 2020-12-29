@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Settings</h4>
                
                <div class="material-datatables">
                <form action="" method="post" enctype="multipart/form-data" id="form-category">
            
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

                                <th>Store Name</th>
                                <th>Store Url</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                
                            </th>
                                <th>Store Name</th>
                                <th>Store Url</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="" name="selected[]" >
                                        </label>
                                    </div>
                                </td>
                                <td>{{ Config('app.name') }}</td>
                                <td>{{ Config('app.url') }}</td>
                                
                                <td class="text-right">
                                    <a href="{{ route('settings.edit',['setting'=>$setting->id]) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-simple btn-xs">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                            </tr>

                            
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

@stop





