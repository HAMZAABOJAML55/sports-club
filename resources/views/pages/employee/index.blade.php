@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.employees')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.employees')}}
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
                                                            
                                                            
    <a href="{{route('employee.create')}}" class="btn btn-success btn-sm" role="button"
    aria-pressed="true">{{trans('main_sidebar.add_employees')}}</a><br><br>

                                                            
                                                            <div class="table-responsive">
                                                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                                                       data-page-length="50"
                                                                       style="text-align: center">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>{{trans('employee_trans.name')}}</th>
                                                                        <th>{{trans('employee_trans.email')}}</th>
                                                                        <th>{{trans('employee_trans.number')}}</th>
                                                                        <th>{{trans('employee_trans.emp_id')}}</th>
                                                                        <th>{{trans('employee_trans.description')}}</th>
                                                                        <th>{{trans('employee_trans.full_description')}}</th>
                                                                        <th>{{trans('employee_trans.date_of_birth')}}</th>
                                                                        <th>{{trans('employee_trans.Processes')}}</th>
                                
                                                                        
                                
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($employees as $employee)
                                                                        <tr>
                                                                            <td>{{$loop->index+1 }}</td>
                                                                            <td>{{$employee->name}}</td>
                                                                            <td>{{$employee->email}}</td>
                                                                            <td>{{$employee->number}}</td>
                                                                            <td>{{$employee->emp_id}}</td>
                                                                            <td>{{$employee->date_of_birth}}</td>
                                                                            <td>{{$employee->description}}</td>
                                                                            <td>{{$employee->full_description}}</td>

                                
                                                                            <td>
                                                                                <div class="dropdown show">
                                                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        العمليات
                                                                                    </a>
                                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                                        <a class="dropdown-item" href="{{route('employee.edit',$employee->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                                                        <a class="dropdown-item" data-target="#Delete_Student{{ $employee->id }}" data-toggle="modal" href="##Delete_Student{{ $employee->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                
                                                                        </tr>
                                                                    @include('pages.employee.Delete')
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
