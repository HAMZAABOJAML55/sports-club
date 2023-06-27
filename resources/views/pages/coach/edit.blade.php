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

                    <form method="post"  action="{{ route('coach.update','test') }}" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" value="{{$coach->getTranslation('name','ar')}}" name="name_ar"   class="form-control">
                                </div>
                            </div>
                            <input value="{{$coach->id}}" type="hidden" name="id"  class="form-control">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$coach->getTranslation('name','en')}}" name="name_en" type="text" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.user_name')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$coach->user_name}}" name="user_name" type="text" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.phone')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$coach->phone}}" name="phone" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.email')}} : </label>
                                    <input type="email" value="{{$coach->email}}" name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.password')}} :</label>
                                    <input  type="password"  name="password" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>height :</label>
                                    <input  type="number" name="height" value="{{$coach->height}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>weight :</label>
                                    <input  type="number" name="weight" value="{{$coach->weight}}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>postal_code :</label>
                                    <input  type="text" name="postal_code" value="{{$coach->postal_code}}" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">Status : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="coach_status">
                                        <option selected disabled value="{{$coach->coach_status}}">
                                            @if ($coach->coach_status == 1)
                                                <span class='badge badge-success' >Active</span>
                                            @else
                                                <span class='badge badge-danger'>InActive</span>
                                            @endif
                                        </option>
                                        <option  value="1">Active</option>
                                        <option  value="0">InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.subscription_number')}} :</label>
                                    <input  type="text" value="{{$coach->subscription_number}}" name="subscription_number" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.salary')}} :</label>
                                    <input  type="text" value="{{$coach->salary}}" name="salary" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.coach_description')}} :</label>
                                    <input  type="text" value="{{$coach->coach_description}}" name="coach_description" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('coach_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="genders_id">
                                        <option selected disabled>{{trans('coach_trans.Choose')}}...</option>
                                        @foreach($Genders as $Gender)
                                            <option  value="{{$Gender->id}}" {{$Gender->id == $coach->genders_id ? 'selected' : ""}}>{{ $Gender->name }}</option>
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
                                            <option  value="{{ $nal->id }}" {{$nal->id == $coach->nationality_id ? 'selected' : ""}}>{{ $nal->name }}</option>
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
                                            <option  value="{{ $loc->id }}" {{$loc->id == $coach->location_id ? 'selected' : ""}}>{{ $loc->name }}</option>
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
                                            <option  value="{{ $sub_loc->id }}" {{$sub_loc->id == $coach->sub_location_id ? 'selected' : ""}}>{{ $sub_loc->name }}</option>
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
                                            <option  value="{{ $E->id }}" {{$E->id == $coach->employment_type_id ? 'selected' : ""}}>{{ $E->name }}</option>
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
                                            <option  value="{{ $E->id }}" {{$E->id == $coach->profs_id ? 'selected' : ""}}>{{ $E->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.Date_of_Birth')}}:</label>
                                    <input class="form-control" type="text" value="{{$coach->date_of_birth}}" id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.start_time')}}:</label>
                                    <input class="form-control" type="text" value="{{$coach->start_time}}" id="datepicker-action" name="start_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.end_time')}}:</label>
                                    <input class="form-control" type="text" value="{{$coach->end_time}}" id="datepicker-action" name="end_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                <input type="file" accept="image/*" name="image_path">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.link_website')}} :</label>
                                <input  type="url" name="link_website" value="{{$coach->link_website}}" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.link_facebook')}} :</label>
                                <input  type="url" name="link_facebook" value="{{$coach->link_facebook}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.link_twitter')}} :</label>
                                <input  type="url" name="link_twitter" value="{{$coach->link_twitter}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('coach_trans.link_youtupe')}} :</label>
                                <input  type="url" name="link_youtupe" value="{{$coach->link_youtupe}}" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instagram :</label>
                                <input  type="url" name="link_Instagram" value="{{$coach->link_Instagram}}" class="form-control" >
                            </div>
                        </div>
                        <div class="row">


                        </div><br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('player_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
