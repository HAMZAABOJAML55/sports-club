@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.training')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.training')}}
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

                            <a href="{{route('training.create')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{trans('main_sidebar.add_training')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('training_trans.name')}}</th>
                                        <th>{{trans('training_trans.number')}}</th>
                                        <th>{{trans('training_trans.description')}}</th>
                                        <th>{{trans('training_trans.training_group_id')}}</th>
                                        <th>{{trans('training_trans.duration_of_training')}}</th>
                                        <th>{{trans('training_trans.training_number')}}</th>
                                        <th>{{trans('training_trans.number_of_iterations')}}</th>
                                        <th>{{trans('training_trans.link_website')}}</th>
                                        <th>{{trans('training_trans.Processes')}}</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trainings as $training)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$training->name}}</td>
                                            <td>{{$training->number}}</td>
                                            <td>{{$training->description}}</td>
                                            <td>{{$training->training_group_id}}</td>
                                            <td>{{$training->duration_of_training}}</td>
                                            <td>{{$training->training_number}}</td>
                                            <td>{{$training->number_of_iterations}}</td>
                                            <td>{{$training->link_website}}</td>

                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        العمليات
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{route('training.edit',$training->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" data-target="#Delete_Student{{ $training->id }}" data-toggle="modal" href="##Delete_Student{{ $training->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;Deleteب</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @include('pages.training.Delete')
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
