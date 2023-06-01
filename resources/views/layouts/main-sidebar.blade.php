<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">

            @if (auth('web')->check())
                @include('layouts.main-sidebar.admin-main-sidebar')
            @endif

            @if (auth('player')->check())
{{--                @include('layouts.main-sidebar.student-main-sidebar')--}}
            @endif

            @if (auth('coach')->check())
{{--                @include('layouts.main-sidebar.teacher-main-sidebar')--}}
            @endif

            @if (auth('employee')->check())
{{--                @include('layouts.main-sidebar.parent-main-sidebar')--}}
            @endif
        </div>

