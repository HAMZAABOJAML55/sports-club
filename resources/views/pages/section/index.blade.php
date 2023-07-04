@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.section')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.section')}}
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

                            <a href="{{route('section.create')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{trans('main_sidebar.add_section')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('section_trans.name')}}</th>
                                        <th>{{trans('section_trans.number')}}</th>
                                        <th>{{trans('section_trans.section_description')}}</th>
                                        <th>{{trans('section_trans.department_address')}}</th>
                                        <th>{{trans('section_trans.Processes')}}</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $section)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$section->name}}</td>
                                            <td>{{$section->number}}</td>
                                            <td>{{$section->section_description}}</td>
                                            <td>{{$section->department_address}}</td>


                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        العمليات
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{route('section.edit',$section->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;Edit</a>
                                                        <a class="dropdown-item" data-target="#Delete_Student{{ $section->id }}" data-toggle="modal" href="##Delete_Student{{ $section->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @include('pages.section.Delete')
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
