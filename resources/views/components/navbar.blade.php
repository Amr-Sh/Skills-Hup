<nav id="nav">
    <form id="logout-form" method="POST" action="{{url('logout')}}" style="display: none">
        @csrf
    </form>
    <ul class="main-menu nav navbar-nav navbar-right">
        <li><a href="{{url('/')}}">@lang('web.home')</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('web.cats') <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach($cats as $cat)


                <li><a href="{{url('categories/show',$cat->id)}}">
                    {{$cat->name()}}
                </a></li>
               @endforeach
            </ul>
        </li>
        <li><a href="{{url('/contact')}}">@lang('web.contact')</a></li>
        @guest
            <li><a href="{{url('/login')}}">@lang('web.signin')</a></li>
            <li><a href="{{url('/register')}}">@lang('web.signup')</a></li>
        @endguest

        @auth
            @if(Auth::user()->role->name == 'student')
                 <li><a  href=" {{url('/profile')}} ">{{__('web.profile')}}</a></li>
            @else
                 <li><a  href=" {{url('/dashboard')}} ">{{__('web.dashboard')}}</a></li>
            @endif
            <li><a id="logout-link" href="">@lang('web.signout')</a></li>
        @endauth



            {{-- <input type="submit" value=" {{__('web.signout')}} "> --}}


        @if(App::getlocale()== 'ar')
        <li><a href="{{url('lang/set/en')}}">EN</a></li>
        @else
        <li><a href="{{url('lang/set/ar')}}">ع</a></li>
        @endif


    </ul>
</nav>
