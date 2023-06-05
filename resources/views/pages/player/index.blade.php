@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.player')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.player')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')


<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            @include('sessions')

                            <a href="{{route('player.create')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{trans('main_sidebar.add_player')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('player_trans.name')}}</th>
                                        <th>{{trans('player_trans.email')}}</th>
                                        <th>{{trans('player_trans.phone')}}</th>
                                        <th>{{trans('player_trans.gender')}}</th>
                                        <th>{{trans('player_trans.Nationality')}}</th>
                                        <th>{{trans('player_trans.Date_of_Birth')}}</th>
                                        <th>{{trans('player_trans.subscription_number')}}</th>
                                        <th>{{trans('player_trans.player_description')}}</th>
                                        <th>{{trans('player_trans.location')}}</th>
                                        <th>{{trans('player_trans.sub_location')}}</th>
                                        <th>{{trans('player_trans.link_website')}}</th>
                                        <th>{{trans('player_trans.link_facebook')}}</th>
                                        <th>{{trans('player_trans.link_twitter')}}</th>
                                        <th>{{trans('player_trans.link_youtupe')}}</th>
                                        <th>{{trans('player_trans.subtype')}}</th>
                                        <th>{{trans('player_trans.profs_degree')}}</th>
                                        <th>{{trans('player_trans.salary')}}</th>
                                        <th>{{trans('player_trans.coach')}}</th>
                                        <th>{{trans('player_trans.weight')}}</th>
                                        <th>{{trans('player_trans.height')}}</th>
                                        <th>{{trans('player_trans.Processes')}}</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($players as $player)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$player->name}}</td>
                                            <td>{{$player->email}}</td>
                                            <td>{{$player->phone}}</td>
                                            <td>{{$player->gender->name}}</td>
                                            <td>{{$player->nationality->name}}</td>
                                            <td>{{$player->date_of_birth}}</td>
                                            <td>{{$player->subscription_number}}</td>
                                            <td>{{$player->player_description}}</td>
                                            <td>{{$player->location->name}}</td>
                                            <td>{{$player->sub_location->name}}</td>
                                            <td>{{$player->link_website}}</td>
                                            <td>{{$player->link_facebook}}</td>
                                            <td>{{$player->link_twitter}}</td>
                                            <td>{{$player->link_youtupe}}</td>
                                            <td>{{$player->subtype->name}}</td>
                                            <td>{{$player->profs_degree->name}}</td>
                                            <td>{{$player->salary_month}}</td>
                                            <td>{{$player->coach->name}}</td>
                                            <td>{{$player->weight}}</td>
                                            <td>{{$player->height}}</td>

                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        العمليات
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{route('player.edit',$player->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                        <a class="dropdown-item" data-target="#Delete_Student{{ $player->id }}" data-toggle="modal" href="##Delete_Student{{ $player->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @include('pages.player.Delete')
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

@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
