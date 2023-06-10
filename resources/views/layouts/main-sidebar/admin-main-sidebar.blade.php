<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_sidebar.dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        {{-- <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_sidebar.product')}} </li> --}}

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('main_sidebar.product')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('product.index')}}">{{trans('main_sidebar.product')}}</a></li>

            </ul>
        </li>
        {{-- section --}}

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#section-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('main_sidebar.section')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="section-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('section.index')}}">{{trans('main_sidebar.section')}}</a></li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{trans('main_sidebar.player')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('player.index')}}">{{trans('main_sidebar.player')}}</a></li>
            </ul>
        </li>


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{trans('main_sidebar.coach')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('coach.index')}}">{{trans('main_sidebar.coach')}}</a></li>
            </ul>
        </li>

<!-- employees-->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#employees-menu">
        <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                class="right-nav-text">{{trans('main_sidebar.employees')}}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="employees-menu" class="collapse" data-parent="#sidebarnav">
        <li><a href="{{ route('employee.index') }}">{{trans('main_sidebar.employees')}}</a></li>
    </ul>
</li>



<!-- food_system-->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#food_system-menu">
        <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                class="right-nav-text">{{trans('main_sidebar.food_system')}}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="food_system-menu" class="collapse" data-parent="#sidebarnav">
        <li><a href="{{ route('food.index') }}">{{trans('main_sidebar.food_system')}}</a></li>
    </ul>
</li>


<!-- training-->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#training-menu">
        <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                class="right-nav-text">{{trans('main_sidebar.training')}}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="training-menu" class="collapse" data-parent="#sidebarnav">
        <li><a href="{{ route('training.index') }}">{{trans('main_sidebar.training')}}</a></li>
    </ul>
</li>




        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{trans('main_sidebar.subscribe')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('subscribe.index') }}">{{trans('main_sidebar.subscribe')}}</a> </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounting-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{trans('main_sidebar.accounting')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="accounting-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('accounting.index') }}">{{trans('main_sidebar.accounting')}}</a> </li>
            </ul>
        </li>

        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{trans('main_sidebar.tournament')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('tournament.index') }}">{{trans('main_sidebar.tournament')}}</a> </li>
            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('main_sidebar.team')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('team.index')}}">{{trans('main_sidebar.team')}}</a> </li>
            </ul>
        </li>




        <!-- Settings-->
        <li>
            <a href="#"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('main_sidebar.setting')}} </span></a>
        </li>





    </ul>
</div>
