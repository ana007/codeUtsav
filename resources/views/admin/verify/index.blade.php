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
        <div class="col-md-6 col-sm-8">
            <!-- <h2>Dashboard</h2> -->
            
        <h4>Select location in which you want to view rumours</h4>
                                    
        </div>
        <div class="col-md-6 col-sm-6">
            <ul class="list-page-breadcrumb">
                <li class="active-page"></li>
                <li><a href="{{ URL::to('admin') }}">Dashboard <i class="zmdi zmdi-chevron-right"></i></a></li>
                <li class="active-page"><a href="{{ URL::to('admin/disease') }}">Verify Rumour</a></li>
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
                                <div class="col-md-3 ">
                                    <div class="widget-header">
                                        <h3>Choose Region</h3>
                                    </div>
                                </div>
                                <div class="dropdown col-md-2   ">
                                     <select id="state" class="form-control" onchange="getState(this)">
                                        
                                        
                                        @if(isset($statename))  
                                            <option value = {{$statename[0]->id}}><?php echo $statename[0]->name ?></option>
                                        @else
                                            <option >Select State</option>
                                            @foreach ($var as $value) 
                                                <option value = {{$value->id}}>{{$value->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                       </div>  
                                      <div class="dropdown col-md-2">
                                      <select id="city" class="form-control">
                                        <option >Select City</option>
                                        @if(isset($statename))  
                                        @foreach ($city_name as $value) 
                                                <option value = {{$value->id}}>{{$value->name}}</option>
                                            @endforeach
                                        @endif
                                       </select>     
                                    </div>
                                <div class="col-md-2">
                                    <div class="data-align">
                                        <!-- <a href="#clear" class="clear-filter btn btn-link" title="clear filter">Clear Filter</a> -->
                                        <div class="btn add-row btn-primary" onclick="search()">Search</div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="table-filter-header">
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
                                        <div class="col-md-4 col-sm-4 col-md-offset-8 col-sm-offset-8">
                                            <span class="tfh-label">Data: </span>
                                            <select id="change-page-size" class=" form-control">
                                                <option>Filter</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    
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
 
 
<script type="text/javascript">
    function getState(state)
    {
        var url = 'verify/'+ state.value;
        window.location=url;
    }
    function search()
    {
        var e = document.getElementById("state");
        var strstate = e.options[e.selectedIndex].value;
        if(strstate=='Select State')
            alert('Please choose region ');
        else 
            {
            var e = document.getElementById("city");
            var strcity = e.options[e.selectedIndex].value;
            if(strcity=='Select City')
                {
                    var url = 'state/'+ strstate;
                    window.location=url;
                }
            else
                {
                    var url = 'city/'+ strcity;
                window.location=url;
                }
            }
    }
</script>        
               
