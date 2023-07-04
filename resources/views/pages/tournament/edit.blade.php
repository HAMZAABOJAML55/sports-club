@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.tournament')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_tournament')}}
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

                    <form method="post" action="{{ route('tournament.update','test') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input value="{{$tournaments->id}}" type="hidden" name="id"  class="form-control">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$tournaments->getTranslation('name','ar')}}" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$tournaments->getTranslation('name','en')}}"  name="name_en" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.tournament_description')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$tournaments->description}}" name="description" type="text">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.number')}} :</label>
                                    <input type="number" value="{{$tournaments->number}}" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.start_time')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" value="{{$tournaments->start_time}}" name="start_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.end_time')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" value="{{$tournaments->end_time}}" name="end_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tournament_type_id">{{trans('tournament_trans.tournament_type_id')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="tournament_type_id">
                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>
                                        @foreach($tournament_types as $p)
                                            <option value="{{ $p->id }}" {{$p->id == $tournaments->tournament_type_id ? 'selected' : ""}}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="prize_type_id">{{trans('tournament_trans.prize_type_id')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="prize_type_id">
                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>
                                        @foreach($prizes as $p)
                                            <option value="{{ $p->id }}" {{$p->id == $tournaments->prize_type_id ? 'selected' : ""}}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="championship_levels_id">{{trans('tournament_trans.championship_levels_id')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="championship_levels_id">
                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>
                                        @foreach($championship_levels as $p)
                                            <option value="{{ $p->id }}" {{$p->id == $tournaments->championship_levels_id ? 'selected' : ""}}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="coachs">{{trans('tournament_trans.coach')}} : <span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <select class="custom-select mr-sm-2" name="coach_id">--}}
{{--                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>--}}
{{--                                        @foreach($coachs as $p)--}}
{{--                                            <option value="{{ $p->id }}" {{$p->id == $tournaments->coach_id ? 'selected' : ""}}>{{ $p->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}




{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="players">{{trans('tournament_trans.players')}} : <span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <select class="custom-select mr-sm-2" name="player_id">--}}
{{--                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>--}}
{{--                                        @foreach($players as $p)--}}
{{--                                            <option value="{{ $p->id }}" {{$p->id == $tournaments->player_id ? 'selected' : ""}}>{{ $p->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="form-group">
                                <label for="exampleFormControlSelect2">{{trans('tournament_trans.players')}} : </label>
                                <select multiple class="form-control"  name="player_id[]"  style="overflow: auto" id="exampleFormControlSelect2">
                                    @foreach($tournaments->player as $c)
                                        <option selected disabled >{{$c->name}}</option>
                                    @endforeach

                                    @foreach($players as $p)
                                        <option   value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">{{trans('tournament_trans.coach')}} : </label>
                                <select multiple class="form-control" name="coach_id[]" style="overflow: auto" id="exampleFormControlSelect2">
                                    @foreach($tournaments->coach as $c)
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
                                type="submit">{{trans('player_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection


