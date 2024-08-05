<header>
    <div class="top-section background red">
        <div class="container">
            <img class="left" src="./assets/images/top-bar-logo.png" alt>
            <nav class="right">
                <ul>
                    @if(!empty($setting['topmenu1'][0]['menu_objects']))
                        @foreach ($setting['topmenu1'][0]['menu_objects'] as $menu_object)
                        <li>
                            <a href="#" >{{$menu_object['object_title'] ?? ''}}</a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <div class="logo-section mt-30">
        <div class="container">
            <img src="./assets/images/main-logo.png" alt="Main Logo" class="main-logo left">
            <img src="./assets/images/company-logo.png" alt="Main Logo" class="company-logo">
            <div class="login-btns right">
                <span  onclick="window.location.href = '{{ route('loginwelcome') }}';" class="login">LOG IN  |</span>
                <span class="subscribe button d-1"  onclick="window.open('{{ route('signup') }}', '_blank');">SUBSCRIBE</span>
            </div>
        </div>
    </div>
    <div class="nav-section mt-20">
        <div class="container">
            <nav>
                <ul>
                    @if(!empty($setting['topmenu2'][0]['menu_objects']))
                        @foreach ($setting['topmenu2'][0]['menu_objects'] as $menu_object)
                            <li><a href="#" class="left">{{$menu_object['object_title'] ?? ''}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
