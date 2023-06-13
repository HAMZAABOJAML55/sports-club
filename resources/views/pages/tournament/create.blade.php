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

                    <form method="post" action="{{ route('tournament.store') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="name_en" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.description')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="description" type="text">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('tournament_trans.number')}} :</label>
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('food_trans.start_time')}}:</label>
                                    <label>***y-m-d</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="start_time" data-date-format="yyyy-mm-dd" >
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('food_trans.end_time')}} :</label>
                                    <label>***y-m-d</label>
                                    <input class="form-control" type="text"  id="datepicker-bottom-right" name="end_time" data-date-format="yyyy-mm-dd" >
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tournament_type_id">{{trans('tournament_trans.tournament_type_id')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="tournament_type_id">
                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>
                                        @foreach($tournament_types as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
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
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
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
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="coachs">{{trans('tournament_trans.coachs')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="coach_id">
                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>
                                        @foreach($coachs as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="players">{{trans('tournament_trans.players')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="player_id">
                                        <option selected disabled>{{trans('tournament_trans.Choose')}}...</option>
                                        @foreach($players as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">


                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('tournament_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
