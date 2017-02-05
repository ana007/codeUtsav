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

     <style>
        .pagination > .active > span {
        background-color: #01b0f1;
        border-color: #01b0f1;
    }
        .pagination > .page-item > a {
            color: #01b0f1;
    }
    </style>

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
                <li class="active-page"><a href="{{ URL::to('admin/disease') }}">Modify Disease</a></li>
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
                                        <h3>Diseases List</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="data-align-right">
                                        <!-- <a href="#clear" class="clear-filter btn btn-link" title="clear filter">Clear Filter</a> -->
                                        <a href="{{ URL::to('admin/diseases/create') }}" class="btn add-row btn-primary">Add Disease</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-filter-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                           
                                           {!! Form::open(['method'=>'GET','url'=>URL::to('admin/diseases/search'),'role'=>'search'])  !!}
 
                                    <input class="form-control" type="text" id="search" name="search" placeholder="Search here">
                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <!-- <div class="col-md-4 col-sm-4 col-md-offset-8 col-sm-offset-8">
                                            <span class="tfh-label">Data: </span>
                                            <select id="change-page-size" class=" form-control">
                                                <option>Filter</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table foo-data-table-filterable" data-filter="#filter" data-filter-text-only="true" data-page-size="5" data-limit-navigation="3">
                            <thead>
                            <tr>
                                <th data-sort-ignore="true">
                                    S.No
                                </th>
                                <th data-sort-ignore="true">
                                    Disease Name
                                </th>
                                <th data-sort-ignore="true">
                                    Description
                                </th>
                              
                                <th  data-sort-ignore="true" >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($codes as $code)
                                <tr>
                                    <td>{{ $code->id }}</td>
                                    <td>{{ $code->code }}</td>
                                    
                                    <td>{{ $code->description }}</td>                                    
                                    
                                    <td class="td"><a class="row-edit" href="{{{ URL::to('admin/diseases/' . $code->id . '/edit' ) }}}"><span class="zmdi zmdi-edit"></span></a> <a href="{{{ URL::to('admin/diseases/' . $code->id . '/delete' ) }}}" onclick="return confirm('Are you sure you want to delete this code?');"><span class="zmdi zmdi-hc-lg zmdi-delete"></span></a></td>
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
                        {{ $codes->links('vendor.pagination.bootstrap-4') }}
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
<script src="/js/lib/select2.full.js"></script>
<!--Tables-->
<script src="js/lib/footable.all.js"></script>

<!--Exportable Data Tables-->
<script src="/js/lib/tableExport.js"></script>
<script src="/js/lib/jquery.base64.js"></script>
<script src="/js/lib/sprintf.js"></script>
<script src="/js/lib/jspdf.js"></script>
<script src="/js/lib/base64.js"></script>

<!--Forms-->
<script src="/js/lib/jquery.maskedinput.js"></script>
<script src="/js/lib/jquery.validate.js"></script>
<script src="/js/lib/jquery.form.js"></script>
<script src="/js/lib/j-forms.js"></script>
<script src="/js/apps.js"></script>

@endsection
 
 
               
               
