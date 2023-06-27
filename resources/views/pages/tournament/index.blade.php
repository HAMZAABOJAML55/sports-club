@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.tournament')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.tournament')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                @include('sessions')

                                <a href="{{route('tournament.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_tournament')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('tournament_trans.name')}}</th>
                                            <th>{{trans('tournament_trans.number')}}</th>
                                            <th>{{trans('tournament_trans.description')}}</th>
                                            <th>{{trans('tournament_trans.start_time')}}</th>
                                            <th>{{trans('tournament_trans.end_time')}}</th>
                                            <th>{{trans('tournament_trans.tournament_type_id')}}</th>
                                            <th>{{trans('tournament_trans.prize_type_id')}}</th>
                                            <th>{{trans('tournament_trans.championship_levels_id')}}</th>
{{--                                            <th>{{trans('tournament_trans.coachs')}}</th>--}}
{{--                                            <th>{{trans('tournament_trans.players')}}</th>--}}
                                            <th>{{trans('tournament_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tournaments as $tournament)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$tournament->name}}</td>
                                                <td>{{$tournament->number}}</td>
                                                <td>{{$tournament->description}}</td>
                                                <td>{{$tournament->start_time}}</td>
                                                <td>{{$tournament->end_time}}</td>
                                                <td>{{$tournament->tournamentType->name}}</td>
                                                <td>{{$tournament->Prize->name}}</td>
                                                <td>{{$tournament->ChampionshipLevel->name}}</td>
{{--                                                <td>{{$tournament->coach->name}}</td>--}}
{{--                                                <td>{{$tournament->player->name}}</td>--}}
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('tournament.edit',$tournament->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;Edit</a>
                                                            <a class="dropdown-item" data-target="#Delete_Student{{ $tournament->id }}" data-toggle="modal" href="##Delete_Student{{ $tournament->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;Delete</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @include('pages.tournament.Delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
