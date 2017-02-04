<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Raipur plus</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap
/3.3.4/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "yyyy-mm-dd "
                });  

             


                 $('#example2').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>

        


  




</head>
<body>
    <div class="container">

         <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                        
        @yield('content')
    </div>
</body>
</html>