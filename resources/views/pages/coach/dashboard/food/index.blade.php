@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.food_system')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.food_system')}}
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

                            <a href="{{route('coach.food.create','test')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{trans('main_sidebar.add_food_system')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('food_trans.name')}}</th>
                                        <th>{{trans('food_trans.number')}}</th>
                                        <th>{{trans('food_trans.start_time')}}</th>
                                        <th>{{trans('food_trans.end_time')}}</th>
                                        <th>{{trans('food_trans.description')}}</th>
                                        <th>{{trans('food_trans.foodsystem_id')}}</th>
                                        <th>{{trans('player_trans.Processes')}}</th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($foods as $food)
                                        <tr>
                                            <td>{{$loop->index+1 }}</td>
                                            <td>{{$food->name}}</td>
                                            <td>{{$food->number}}</td>
                                            <td>{{$food->start_time}}</td>
                                            <td>{{$food->end_time}}</td>
                                            <td>{{$food->description}}</td>
                                            <td>{{$food->foodsystem->name}}</td>


                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        العمليات
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{route('coach.food.edit',[$food->id,'coach'])}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" data-target="#Delete_Student{{ $food->id }}" data-toggle="modal" href="#Delete_Student{{ $food->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @include('pages.coach.dashboard.food.Delete')
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
