<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.coaches') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <!-- food-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#food-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('main_sidebar.food_system')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="food-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('coach.food.index','test')}}">{{trans('main_sidebar.food_system')}}</a></li>
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
                <li><a href="{{ route('coach.training.index','test') }}">{{trans('main_sidebar.training')}}</a></li>
            </ul>
        </li>
        <!-- player-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#player-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{trans('main_sidebar.player')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="player-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('coach.player.index','test') }}">{{trans('main_sidebar.player')}}</a></li>
            </ul>
        </li>
    </ul>
</div>
