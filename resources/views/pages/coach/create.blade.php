@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.coach')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_coach')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @include('sessions')

                    <form method="post"  action="{{ route('coach.store') }}" autocomplete="off" enctype="multipart/form-data">
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
                                    <label>{{trans('coach_trans.Date_of_Birth')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.start_time')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="start_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.end_time')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="end_time" data-date-format="yyyy-mm-dd">
                                </div>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.employment_type')}} :</label>
                                <input  type="text" name="employment_type" class="form-control" >
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

    <!-- row closed -->
@endsection
@section('js')

@endsection
