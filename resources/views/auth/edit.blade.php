@extends('layouts/game')

@section('header')

    <link type="text/css" rel="stylesheet" href="/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="/css/material-design-iconic-font.css">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="/css/animate.css">
    <link type="text/css" rel="stylesheet" href="/css/layout.css">
    <link type="text/css" rel="stylesheet" href="/css/components.css">
    <link type="text/css" rel="stylesheet" href="/css/widgets.css">
    <link type="text/css" rel="stylesheet" href="/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="/css/pages.css">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap-extend.css">
    <link type="text/css" rel="stylesheet" href="/css/common.css">
    <link type="text/css" rel="stylesheet" href="/css/responsive.css">
    <link type="text/css" id="themes" rel="stylesheet" href="#">

    

   <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

@endsection

@section('content')
<div class="page-header filled full-block light">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <!-- <h2>Dashboard</h2> -->
           
        </div>
        <div class="col-md-6 col-sm-6">
            <ul class="list-page-breadcrumb">
                <li class="active-page"></li>
                <li><a href="{{ URL::to('admin') }}">Dashboard <i class="zmdi zmdi-chevron-right"></i></a></li>
                <li class="active-page"><a href="{{ URL::to('admin/code') }}">PromoCode <i class="zmdi zmdi-chevron-right"></i></a></li>
                <li class="active-page"><a href="{{ URL::to('admin/code/'.$code->id.'/edit') }}">{{ $code->code }}</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-12">
<div class="widget-wrap">
    <div class="widget-header block-header clearfix">
        <div class="pull-left">
            <h3>Edit Promo Code</h3>
        </div>
    </div>
    <div class="widget-container">
        <div class="widget-content">
            <div class="row">
                <div class="col-md-12">
                    
                    {!! Form::model($code, array('url' => URL::to('admin/register') . '/' . $code->id .'/edit', 'method' => 'post', 'class' => 'j-forms',  'files'=> true)) !!}
                       
 <script>
                function getState(val) {
                   if(val == 3){
                         
                            $.ajax({
                            
                            success: function(){
                                
                                $("#interval-list").html('<div class="col-md-12 unit"><div class="input"><label class="col-md-3" align="right">User id</label><div class="col-md-5"><input type="text" name="user_id" class="form-control"/></div></div></div>');
                                                                   
                                                 }
                              }); 
                     }else{
                                       
                            $.ajax({
                                  success: function(){
                                    
                                $("#interval-list").html('');
                                           
                                     }
                              }); 
                     }
                }
        </script>

                        <div class="col-md-12 unit form-group {{ $errors->first('title', 'has-error') }}">
                                <div class="input">
                                    <label for="title" align="right" class="col-md-3 control-label">
                                        First Name*
                                    </label>
                                    <div class="col-md-5">
                                       
                        {!! Form::text('first_name', null, array('class' => 'form-control',  'required'=>'true')) !!}
                                    </div>
                                  
                                </div>
                                </div>

                                   <div class="col-md-12 unit form-group {{ $errors->first('title', 'has-error') }}">
                                <div class="input">
                                    <label for="title" align="right" class="col-md-3 control-label">
                                       
                                       Last Name *

                                    </label>
                                    <div class="col-md-5">
                                       
                       {!! Form::text('last_name', null, array('class' => 'form-control',  'required'=>'true')) !!}
                                    </div>
                                   
                                   
                                </div>
                                </div>

                                 <div class="col-md-12 unit form-group {{ $errors->first('title', 'has-error') }}">
                                <div class="input">
                                    <label for="title" align="right" class="col-md-3 control-label">
                                        Email *
                                    </label>
                                    <div class="col-md-5">
                        {!! Form::text('email', null, array('class' => 'form-control',  'required'=>'true')) !!}
                                    </div>
                                   
                                </div>
                                </div>

                                   


                                <div class="col-md-12 unit">
                                                <label class="col-md-3 control-label">Types *</label>
                                                <div class="col-md-5">
                    {!! Form::select('role', [ 'Admin' => 'Admin', 'Vendor' => 'Vendor'],  null, ['class' => 'form-control']); !!}
                                                </div>
                                            </div> 


                                <div class="col-md-12" style="border-top:1px solid #ddd; padding-top:30px;">
                                    <div class="col-md-5 col-md-offset-3 unit">
                                        <button type="submit" class="btn btn-primary">Update</button> <a href="{{ URL::to('admin/code') }}" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end /.content -->
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
    
@endsection

@section('script')

<script src="/js/lib/jquery.js"></script>
<script src="/js/lib/jquery-migrate.js"></script>
<script src="/js/lib/bootstrap.js"></script>
<script src="/js/lib/jquery.ui.js"></script>
<script src="/js/lib/jRespond.js"></script>
<script src="/js/lib/nav.accordion.js"></script>
<script src="/js/lib/hover.intent.js"></script>
<script src="/js/lib/hammerjs.js"></script>
<script src="/js/lib/jquery.hammer.js"></script>
<script src="/js/lib/jquery.fitvids.js"></script>
<script src="/js/lib/scrollup.js"></script>
<script src="/js/lib/smoothscroll.js"></script>
<script src="/js/lib/jquery.slimscroll.js"></script>
<script src="/js/lib/jquery.syntaxhighlighter.js"></script>
<script src="/js/lib/velocity.js"></script>
<script src="/js/lib/smart-resize.js"></script>
<!--Forms-->
<script src="/js/lib/jquery.maskedinput.js"></script>
<script src="/js/lib/jquery.validate.js"></script>
<script src="/js/lib/jquery.form.js"></script>
<script src="/js/lib/additional-methods.js"></script>
<script src="/js/lib/jquery-cloneya.js"></script>
<script src="/js/lib/jquery.ui.timepicker.js"></script>
<script src="/js/lib/jquery.ui.touch-punch.js"></script>
<script src="/js/lib/j-forms.js"></script>
<script src="/js/lib/select2.full.js"></script>
<script src="/js/apps.js"></script>

<script src="/js/lib/jquery.bootstrap-touchspin.js"></script>

@endsection
                          
