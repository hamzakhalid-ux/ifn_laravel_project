<nav>
    <div class="nav-bar">
        <i class='bx bx-menu sidebarOpen' ></i>
        <span class="logo navLogo"><a href="#"><img src="{{asset('img/ifn-logo.png')}}"></a></span>

        <div class="menu">
            <div class="logo-toggle">
                <span class="logo"><a href="#"><img src="{{asset('img/ifn-logo.png')}}"></a></span>
                <i class='bx bx-x siderbarClose'></i>
            </div>
            <ul class="nav-links">
                @if(!empty($setting['topmenu2'][0]['menu_objects']))
                    @foreach ($setting['topmenu2'][0]['menu_objects'] as $menu_object)
                        @if ($menu_object['object_type'] == 'category')
                                    <li><a href="{{ route('category', ['slug' =>  $menu_object['categorydata']['breadcrumb'] ?? '']) }}"  class="left">
                                        {{ $menu_object['object_title'] ?? '' }}
                                    </a></li>
                                @elseif($menu_object['object_type'] == 'custom_links')
                                    <li><a href="{{$menu_object['url'] ?? ''}}" class="left">
                                        {{ $menu_object['object_title'] ?? '' }}
                                    </a></li>
                                @else
                                    <li><a href="#" class="left">
                                        {{ $menu_object['object_title'] ?? '' }}
                                    </a></li>
                                @endif
                    @endforeach
                @endif
            </ul>
        </div>


        <div class="darkLight-searchBox">
          <div class="dark-light">

          </div>


      </div>

        </div>
    </div>
  </nav>
