<aside class="leftbar material-leftbar">
    <div class="left-aside-container">
        <div class="user-profile-container">
            <div class="user-profile clearfix">
                <div class="admin-user-thumb">
                    <img src="/images/icon.png" style="border-radius: 10px" alt="admin">
                </div>
                <div class="admin-user-info">
                    <ul>
                        <li><a href="#">Welcome</a></li>
                        @if(Auth::guard('roles')->check())
                        {{-- <li><a href="#">{{ Auth::guard('roles')->user()->email }}</a></li> --}}
                         <li><a href="#">{{ Auth::guard('roles')->user()->role }}</a></li>
                        
                         
                         @else
                             <script type="text/javascript">
                                 window.location = "{{ url('/login') }}";
                                 </script>
                         @endif
                    </ul>
                </div>
            </div>
            <div class="admin-bar">
                <ul>
                    <li>
                        
                                      <li><a href="{{ URL::to('/admin/logout') }}">
                                            <i class="zmdi zmdi-power"></i> Logout
                                        </a></li>
                    

                    </li>
                </ul>
            </div>
        </div>
        <ul class="list-accordion">
            <li class="list-title"><a ><i class="fa fa-tachometer"></i>DashBoard</a></li>
            <li>
                <a href="#"><i class="fa fa-bookmark"></i><span class="list-label">Diseases</span></a>
                <ul>
                   
                    <li><a href="{{ URL::to('admin/diseases') }}">Diseases List</a></li>
                </ul>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-gamepad"></i><span class="list-label">See Rumours</span></a>
                <ul>
                    <li><a href="{{ URL::to('admin/display') }}">Display</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ URL::to('admin/verify') }}"><i class="fa fa-gamepad"></i><span class="list-label">Verify</span></a>
            </li>
          
          


        </ul>
    </div>
</aside>