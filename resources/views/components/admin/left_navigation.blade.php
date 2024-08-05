<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @foreach($config_navigations as $name => $navigations)
            @switch($navigations['nav_level'])
                @case(1)
                    @if (!empty(array_intersect($user_privs, $navigations['privs'])))
                        <li>
                           <a href="{{url($navigations['url'])}}"><i class="{{$navigations['icon']}}"></i> {{$navigations['title']}}</a>
                        </li>
                    @endif
                @break
                @case(2)             
                    @if (!empty(array_intersect($user_privs, $navigations['privs'])))
                        <li class="{{(!empty($navigations['links'][$segments]) ? 'active' : '')}} treeview">
                            <a href="#">
                                <i class="{{!empty($navigations['icon']) ? $navigations['icon'] : ''}}"></i>
                                <span>{{ucwords($name)}}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @foreach($navigations['links'] as $url => $navigation)
                                    @if (!empty(array_intersect($user_privs, $navigation['privs'])))
                                        <li class="{{($segments == $url) ? 'active' : ''}}">
                                            <a href="{{url($url)}}">
                                                <i class="{{$navigation['icon']}}"></i> {{$navigation['title']}}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @break
            @endswitch
        @endforeach
    </ul>
</section>
<!-- /.sidebar -->