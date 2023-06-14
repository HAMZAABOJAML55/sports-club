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

<div class="wrapper" style="font-family: 'Cairo', sans-serif">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="{{ URL::asset('assets/images/pre-loader/loader-0133.svg') }}" alt="">
    </div>

    <!--=================================
preloader -->

    <!--=================================
 Main content -->
    <!-- main-content -->
    <!-- main content wrapper end-->
</div>
</div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100"style=" font-family: 'Cairo', sans-serif; color: #f8f2f2;background-image: url('{{ asset('assets/images/red-light-round-podium-black-background-mock-up.jpg')}}'); ">

        <div class="card-body">

                @include('sessions')

                <form method="post"  action="{{ route('SignUpCoach.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                <input  type="text" name="name_ar"   class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.name_en')}} : <span class="text-danger">*</span></label>
                                <input  class="form-control" name="name_en" type="text" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.user_name')}} : <span class="text-danger">*</span></label>
                                <input  class="form-control" name="user_name" type="text" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.phone')}} : <span class="text-danger">*</span></label>
                                <input  class="form-control" name="phone" type="text" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.email')}} : </label>
                                <input type="email"  name="email" class="form-control" >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.password')}} :</label>
                                <input  type="password" name="password" class="form-control" >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.subscription_number')}} :</label>
                                <input  type="text" name="subscription_number" class="form-control" >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.salary')}} :</label>
                                <input  type="text" name="salary" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.coach_description')}} :</label>
                                <input  type="text" name="coach_description" class="form-control" >
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{trans('coach_trans.gender')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="genders_id">
                                    <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                    @foreach($Genders as $Gender)
                                        <option  value="{{ $Gender->id }}">{{ $Gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{trans('coach_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="nationality_id">
                                    <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                    @foreach($nationals as $nal)
                                        <option  value="{{ $nal->id }}">{{ $nal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="location">{{trans('coach_trans.location')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="location_id">
                                    <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                    @foreach($locations as $loc)
                                        <option  value="{{ $loc->id }}">{{ $loc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--#ajax--}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sub_location">{{trans('coach_trans.sub_location')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="sub_location_id">
                                    <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                    @foreach($sub_locations as $sub_loc)
                                        <option  value="{{ $sub_loc->id }}">{{ $sub_loc->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="employment">{{trans('coach_trans.Employment_Type')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="employment_type_id">
                                    <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                    @foreach($Employment_Types as $E)
                                        <option  value="{{ $E->id }}">{{ $E->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="profs">{{trans('coach_trans.profs_degree')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="profs_id">
                                    <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                    @foreach($profs_degrees as $E)
                                        <option  value="{{ $E->id }}">{{ $E->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('coach_trans.Date_of_Birth')}}:</label>
                                <input class="form-control" type="text"  id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('food_trans.start_time')}}:</label>
                                <label>***y-m-d</label>
                                <input class="form-control" type="text"  id="datepicker-bottom-left" name="start_time" data-date-format="yyyy-mm-dd" >
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('food_trans.end_time')}} :</label>
                                <label>***y-m-d</label>
                                <input class="form-control" type="text"  id="datepicker-bottom-right" name="end_time" data-date-format="yyyy-mm-dd" >
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="academic_year">Image : <span class="text-danger">*</span></label>
                            <input type="file" accept="image/*" name="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('coach_trans.link_website')}} :</label>
                            <input  type="url" name="link_website" class="form-control" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('coach_trans.link_facebook')}} :</label>
                            <input  type="url" name="link_facebook" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('coach_trans.link_twitter')}} :</label>
                            <input  type="url" name="link_twitter" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('coach_trans.link_youtupe')}} :</label>
                            <input  type="url" name="link_youtupe" class="form-control" >
                        </div>
                    </div>


                    <div class="row">


                    </div><br>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('coach_trans.submit')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>

@include('layouts.footer-scripts')
@stack('scripts')

</body>

</html>







