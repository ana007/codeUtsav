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

@endsection

@section('content')

<div class="page-header filled full-block light">
    <div class="row">
        <div class="col-md-6 col-sm-6">
           <!--  <h2>Dashboard</h2> -->
        </div>
        <div class="col-md-6 col-sm-6">
            <ul class="list-page-breadcrumb">
                <li class="active-page"></li>
                <li><a href="{{ URL::to('admin') }}">Dashboard</a></li>
            </ul>
        </div>
    </div>
</div>


     <div class="row">
        <div class="col-md-12">
            <div class="widget-wrap material-table-widget">

                <div class="widget-container margin-top-0">
                    <div class="widget-content">
                        <div class="data-action-bar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget-header">
                                        <h3>Rumours Trending Today</h3>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <table class="table foo-data-table-filterable" data-filter="#filter" data-filter-text-only="true" data-page-size="5" data-limit-navigation="3">
                            <thead>
                            <tr>
                                <th data-sort-ignore="true">
                                    Disease
                                </th>
                                
                                <th data-sort-ignore="true">
                                    Location
                                </th>
                                <th data-sort-ignore="true">
                                    Disease Count
                                </th> 
                                <th data-sort-ignore="true">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($diseasedata as $data)
                                <tr>
                                    <td>{{ $data->code }}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{ $data->count}}</td>
                                    <td>
                                         @if($data->flag ==1 )
                                            <img src="../../images/verified.png" width="20px" height="20px">Verified
                                        @else
                                            <img src="../../images/unverified.png" width="18px" height="18px">

                                            Not Verified
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot class="hide-if-no-paging">
                            <tr>
                                <td colspan="6" class="footable-visible">
                                    <div class="pagination pagination-centered"></div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
           
            <div class="row">
        <div class="col-md-12">
            <div class="widget-wrap material-table-widget">

                <div class="widget-container margin-top-0">
                    <div class="widget-content">
                        <div class="data-action-bar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget-header">
                                        <h3>Assign task to another user</h3>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="widget-container">
        <div class="widget-content">
            <div class="row">
                <div class="col-md-12">
                    
                    
                        <div class="form-content">
                            <div class="row">


                                <div class="col-md-12 unit" style="float:left">
                                    <div class="input">
                                        <label class="col-md-4" align="right">
                                            Email*
                                        </label>
                                        <div class="col-md-5">
                                            {!! Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'EMail of Unicef User ', 'style'=>'text-transform:uppercase' , 'required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 unit">
                                    <div class="input">
                                        <label class="col-md-4" align="right">
                                            Disease Name*
                                        </label>
                                        <div class="col-md-5">
                                            {!! Form::text('description', null, array('class' => 'form-control', 'placeholder'=>'Disease Trending', 'style'=>'text-transform:uppercase' , 'required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 unit">
                                    <div class="input">
                                        <label class="col-md-4" align="right">
                                            Location*
                                        </label>
                                        <div class="col-md-5">
                                            {!! Form::text('location', null, array('class' => 'form-control', 'placeholder'=>'location name ', 'style'=>'text-transform:uppercase' , 'required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12" style="border-top:1px solid #ddd; padding-top:30px;">
                                    <div class="col-md-5 col-md-offset-3 unit">
                                        <button type="submit" onClick="assign()" class="btn btn-primary">Assign Task</button> <a href="{{ URL::to('admin/home') }}" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end /.content -->
                   
                </div>

            </div>
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
<script src="/js/lib/jquery-jvectormap.js"></script>
<script src="/js/lib/jquery-jvectormap-world-mill.js"></script>
<script src="/js/lib/jquery-jvectormap-us-aea.js"></script>
<script src="/js/lib/smart-resize.js"></script>
<!--iCheck-->
<script src="/js/lib/icheck.js"></script>
<script src="/js/lib/jquery.switch.button.js"></script>
<!--CHARTS-->
<script src="/js/lib/chart/sparkline/jquery.sparkline.js"></script>
<script src="/js/lib/chart/easypie/jquery.easypiechart.min.js"></script>
<script src="/js/lib/chart/flot/excanvas.min.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.min.js"></script>
<script src="/js/lib/chart/flot/curvedLines.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.time.min.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.stack.min.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.axislabels.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.resize.min.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.tooltip.min.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.spline.js"></script>
<script src="/js/lib/chart/flot/jquery.flot.pie.min.js"></script>
<!--Forms-->
<script src="/js/lib/jquery.maskedinput.js"></script>
<script src="/js/lib/jquery.validate.js"></script>
<script src="/js/lib/jquery.form.js"></script>
<script src="/js/lib/j-forms.js"></script>
<script src="/js/lib/jquery.loadmask.js"></script>
<script src="/js/lib/vmap.init.js"></script>
<script src="/js/lib/theme-switcher.js"></script>
<script src="/js/apps.js"></script>

@endsection
<script type="text/javascript">
    function assign()
    {
        alert('Task has been assigned !!.')
        window.location='';
    }
</script>>