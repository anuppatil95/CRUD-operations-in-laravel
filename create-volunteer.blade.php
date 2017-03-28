@extends(config("piplmodules.back-view-layout-location"))

@section("meta")

<title>Create Volunteer</title>

@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/volunteer/list')}}">Manage Volunteers</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="admin/volunteer/create;">Create Volunteer</a>
            </li>
        </ul>
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> Create Volunteer
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" action="" method="post" >
                    {!! csrf_field() !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">    
                                <div class="col-md-8">  

                                    <div class="form-group">
                                        <label class="col-md-6 control-label">First Name<sup>*</sup></label>
                                        <div class="col-md-6">     
                                            <input name="first_name" type="text" class="form-control" id="first_name" value="">
                                            @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-6 control-label">last Name<sup>*</sup></label>
                                        <div class="col-md-6">     
                                            <input name="last_name" type="text" class="form-control" id="last_name" value="">
                                            @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-6 control-label">Email<sup>*</sup></label>
                                        <div class="col-md-6">     
                                            <input name="email_id" type="email" class="form-control" id="email_id" value="">
                                            @if ($errors->has('email_id'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('email_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-6 control-label">Address<sup>*</sup></label>
                                        <div class="col-md-6">     
                                            <textarea id="address" name="address" value=""></textarea>
                                            
                                            @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">   
                                            <button type="submit" id="submit" class="btn btn-primary  pull-right">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .submit-btn{
        padding: 10px 0px 0px 18px;
    }
</style>
@endsection