
@extends('admin.layouts.app')

@section('content')
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Add Campaign</h4>
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar  -->
                </div>
                <div class="material-datatables">
                    <form id="" action="{{ route('campaigns.update',['campaign'=>$campaign->id])  }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Name
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                name="name"
                                type="text"
                                required="true"
                                value="{{ $campaign->name }}"
                            />
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Subject
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                name="subject"
                                type="text"
                                required="true"
                                value="{{ $campaign->subject }}"
                            />
                        </div>
                     

                        <div class="form-group">
                            <label class="control-label"></label>
                            <select name="email_list_id" class="form-control">
                            <option  value="" selected="">--Choose One--</option>
                                @foreach($email_lists as $email_list)
                                    @if($campaign->email_list_id == $email_list->id)
                                        <option class="" value="{{ $email_list->id }}" selected>{{ $email_list->name }} </option>
                                    @else
                                       <option class="" value="{{ $email_list->id }}" >{{ $email_list->name }} </option>
                                    @endif 
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <select name="template_id" class="form-control">
                            <option  value="" selected="">--Choose One--</option>
                                @foreach($templates as $template)
                                    @if($campaign->template_id == $template->id)
                                        <option class="" value="{{ $template->id }}" selected>{{ $template->name }} </option>
                                    @else
                                        <option class="" value="{{ $template->id }}" >{{ $template->name }} </option>
                                    @endif 
                                @endforeach
                            </select>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-6 -->

    </div>
@endsection

@section('inline-scripts')
$(document).ready(function() {

});
@stop






