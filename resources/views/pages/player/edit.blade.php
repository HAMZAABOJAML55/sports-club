@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.player')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_player')}}
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

                    <form method="post"  action="{{ route('player.update','test') }}" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" value="{{$player->getTranslation('name','ar')}}" name="name_ar"   class="form-control">
                                </div>
                            </div>
                            <input value="{{$player->id}}" type="hidden" name="id"  class="form-control">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$player->getTranslation('name','en')}}" name="name_en" type="text" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.user_name')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$player->user_name}}" name="user_name" type="text" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.phone')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$player->phone}}" name="phone" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.email')}} : </label>
                                    <input type="email" value="{{$player->email}}" name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.password')}} :</label>
                                    <input  type="password" value="{{$player->password}}" name="password" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.subscription_number')}} :</label>
                                    <input  type="text" value="{{$player->subscription_number}}" name="subscription_number" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.postal_code')}} :</label>
                                    <input  type="text" value="{{$player->postal_code}}" name="postal_code" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.salary_month')}} :</label>
                                    <input  type="text" value="{{$player->salary_month}}" name="salary_month" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.total')}} :</label>
                                    <input  type="text" value="{{$player->total}}" name="total" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('player_trans.player_description')}} :</label>
                                    <input  type="text" value="{{$player->player_description}}" name="player_description" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('player_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="genders_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($Genders as $Gender)
                                            <option  value="{{ $Gender->id }}" {{$Gender->id == $player->genders_id ? 'selected' : ""}}>{{ $Gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('player_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationality_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($nationals as $nal)
                                            <option  value="{{ $nal->id }}" {{$nal->id == $player->nationality_id ? 'selected' : ""}}>{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="location">{{trans('player_trans.location')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="location_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($locations as $loc)
                                            <option  value="{{ $loc->id }}" {{$loc->id == $player->location_id ? 'selected' : ""}}>{{ $loc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--#ajax--}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sub_location">{{trans('player_trans.sub_location')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="sub_location_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($sub_locations as $sub_loc)
                                            <option  value="{{ $sub_loc->id }}" {{$sub_loc->id == $player->sub_location_id ? 'selected' : ""}}>{{ $sub_loc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subtypes">{{trans('player_trans.subtypes')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="subtype_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($subtypes as $E)
                                            <option  value="{{ $E->id }}" {{$E->id == $player->subtype_id ? 'selected' : ""}}>{{ $E->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="coachs">{{trans('player_trans.coach')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="coachs_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($coachs as $E)
                                            <option  value="{{ $E->id }}" {{$E->id == $player->coachs_id ? 'selected' : ""}}>{{ $E->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="profs">{{trans('player_trans.profs_degree')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="profs_id">
                                        <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                        @foreach($profs_degrees as $E)
                                            <option  value="{{ $E->id }}" {{$E->id == $player->profs_id ? 'selected' : ""}}>{{ $E->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('player_trans.Date_of_Birth')}}:</label>
                                    <input class="form-control" type="text"  value="{{$player->date_of_birth}}" id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>



                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.weight')}} :</label>
                                <input  type="text" value="{{$player->weight}}" name="weight" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.height')}} :</label>
                                <input  type="text" value="{{$player->height}}" name="height" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.link_website')}} :</label>
                                <input  type="url" value="{{$player->link_website}}" name="link_website" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.link_facebook')}} :</label>
                                <input  type="url" value="{{$player->link_facebook}}" name="link_facebook" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.link_instagram')}} :</label>
                                <input  type="url" value="{{$player->link_instagram}}" name="link_instagram" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.link_twitter')}} :</label>
                                <input  type="url" value="{{$player->link_twitter}}" name="link_twitter" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('player_trans.link_youtupe')}} :</label>
                                <input  type="url" value="{{$player->link_youtupe}}" name="link_youtupe" class="form-control" >
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

