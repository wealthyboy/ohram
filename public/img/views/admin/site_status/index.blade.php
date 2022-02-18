@extends('admin.layouts.app')

@section('content')

<div class="row">
        
        <div class="col-md-12">
            <div class="card">
        
                <div class="card-content">
                    
                    
                    <h4 class="card-title">Settings</h4>
                    <div class="toolbar">
                        <!--Here you can write extra buttons/actions for the toolbar  -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ '' }}" method="post" enctype="multipart/form-data" id="form-category">
                        @csrf
                
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                            <tr>
                                    <th>Name</th>
                                    <th>Site Status</th>
                                    <th>Action</th>
                 
                            </tr>
                            </thead>
                          
                            <tbody>
  
                                    <tr>  
                            
                                    <td>{{ Config('app.url') }}</td>
                                    <td>{{ empty($st->make_live)  ? 'Site is Live' : 'Site  is Offline'}}</td>
                                    <td class="text-right">
                                    <a type="button" href='/admin/live?enable=true' class="btn btn-primary btn-simple btn-xs"><i class="fa fa-plus"></i> 
                                       {{ $st->make_live == 0  ? 'Disable ' : 'Enable' }}
                                    
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





