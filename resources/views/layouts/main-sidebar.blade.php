<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">

            @if (auth('web')->check())
                @include('layouts.main-sidebar.admin-main-sidebar')
            @endif

            @if (auth('player')->check())
                @include('layouts.main-sidebar.player-main-sidebar')
            @endif

            @if (auth('coach')->check())
                @include('layouts.main-sidebar.coach-main-sidebar')

            @endif

            @if (auth('employe')->check())
                @include('layouts.main-sidebar.employe-main-sidebar')
            @endif
        </div>

