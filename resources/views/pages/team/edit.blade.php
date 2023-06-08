
@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.team')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_team')}}
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

                    <form method="post" action="{{ route('team.update','test') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input value="{{$teams->id}}" type="hidden" name="id"  class="form-control">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$teams->getTranslation('name','ar')}}" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$teams->getTranslation('name','en')}}"  name="name_en" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.team_description')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$teams->description}}" name="description" type="text">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.number')}} :</label>
                                    <input type="number" value="{{$teams->number}}" name="number" class="form-control">
                                </div>
                            </div>


                            {{--                            <div class="col-md-3">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label for="coachs">{{trans('team_trans.coach')}} : <span--}}
                            {{--                                            class="text-danger">*</span></label>--}}
                            {{--                                    <select class="custom-select mr-sm-2" name="coach_id">--}}
                            {{--                                        <option selected disabled>{{trans('team_trans.Choose')}}...</option>--}}
                            {{--                                        @foreach($coachs as $p)--}}
                            {{--                                            <option value="{{ $p->id }}" {{$p->id == $teams->coach_id ? 'selected' : ""}}>{{ $p->name }}</option>--}}
                            {{--                                        @endforeach--}}
                            {{--                                    </select>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}




                            {{--                            <div class="col-md-3">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label for="players">{{trans('team_trans.players')}} : <span--}}
                            {{--                                            class="text-danger">*</span></label>--}}
                            {{--                                    <select class="custom-select mr-sm-2" name="player_id">--}}
                            {{--                                        <option selected disabled>{{trans('team_trans.Choose')}}...</option>--}}
                            {{--                                        @foreach($players as $p)--}}
                            {{--                                            <option value="{{ $p->id }}" {{$p->id == $teams->player_id ? 'selected' : ""}}>{{ $p->name }}</option>--}}
                            {{--                                        @endforeach--}}
                            {{--                                    </select>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}


                            <div class="form-group">
                                <label for="exampleFormControlSelect2">{{trans('team_trans.players')}} : </label>
                                <select multiple class="form-control"  name="player_id[]"  style="overflow: auto" id="exampleFormControlSelect2">
                                    @foreach($teams->player as $c)
                                        <option selected disabled >{{$c->name}}</option>
                                    @endforeach

                                    @foreach($players as $p)
                                        <option   value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">{{trans('team_trans.coach')}} : </label>
                                <select multiple class="form-control" name="coach_id[]" style="overflow: auto" id="exampleFormControlSelect2">
                                    @foreach($teams->coach as $c)
                                        <option selected disabled value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach

                                    @foreach($coachs as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">


                            </div>
                        </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('team_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection


