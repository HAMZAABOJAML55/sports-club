<!DOCTYPE html>
<html lang="en">
@section('title')
    {{trans('main_trans.Main_title')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')

</head>

<body style="font-family: 'Cairo', sans-serif">
{{--preloader -->--}}

<div id="pre-loader">
    <img src="{{ URL::asset('assets/images/pre-loader/loader-0122.svg') }}" alt="">
</div>

<!--=================================
preloader -->

<div class="wrapper" style="font-family: 'Cairo', sans-serif">



    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper" style="color: white;background-image: url('{{ asset('assets/images/red-light-round-podium-black-background-mock-up.jpg')}}'); " >
        <div class="page-title"  >
            <div class="row">
                <div class="col-sm-6" >
                    <h4 class="mb-0" style="font-family: 'Cairo', sans-serif; color: white">  Welcome {{\Illuminate\Support\Facades\Auth::user()->name}} </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>

        <br>
        <br>
        <!--=================================
wrapper -->
        <!-- widgets -->
        <div class="row" >
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Players Count</p>
                                <h4>{{\App\Models\Player::where('club_id',\Illuminate\Support\Facades\Auth::user()->club_id)->count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('player.index')}}" target="_blank"><span class="text-danger">Show details</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Coachs Count</p>
                                <h4>{{\App\Models\Coach::where('club_id',\Illuminate\Support\Facades\Auth::user()->club_id)->count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('coach.index')}}" target="_blank"><span class="text-danger">Show details</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Employee Count</p>
                                <h4>{{\App\Models\Employe::where('club_id',\Illuminate\Support\Facades\Auth::user()->club_id)->count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('employee.index')}}" target="_blank"><span class="text-danger">Show details</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Section Count</p>
                                <h4>{{\App\Models\Section::where('club_id',\Illuminate\Support\Facades\Auth::user()->club_id)->count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('section.index')}}" target="_blank"><span class="text-danger">Show details</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Orders Status widgets-->
        <br>
        <br>
        <!--=================================
footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')
@stack('scripts')

</body>

</html>
