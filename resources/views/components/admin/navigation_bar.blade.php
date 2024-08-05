<!-- Logo -->

<a href="{{url('/admin/dashboard')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>I</b>INC</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><img src="{{asset('img/ifn.png')}}" alt="IFN text"></b><img src="{{asset('img/investor.png')}}" alt="IFN Investor"></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <a href="{{url('/')}}" class="fa fa-home fa-lg" style="float: left; padding: 18px 16px;color: #800000 !important" role="button">
        {{-- <span  > Back to the Homepage</span> --}}
    </a>
@php
            $session_user = session()->get('userData');
@endphp
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('user_profile/' . $session_user->profile_image) }}" class="user-image" alt="User Image">
                    <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{ asset('user_profile/' . $session_user->profile_image) }}" class="img-circle" alt="User Image">

                        <p>

                            <small>{{$session_user->first_name. ' '. $session_user->last_name}} </small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ url('/admin/users/edit-user/' . $session_user->user_id) }}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{url('/admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
        </ul>
    </div>
</nav>
