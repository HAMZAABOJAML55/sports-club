@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.employee')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_employee')}}
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

                    <form method="post"  action="{{ route('employee.update','test') }}" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" value="{{$employees->getTranslation('name','ar')}}" name="name_ar"   class="form-control">
                                </div>
                            </div>
                            <input value="{{$employees->id}}" type="hidden" name="id"  class="form-control">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$employees->getTranslation('name','en')}}" name="name_en" type="text" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('employee_trans.email')}} : </label>
                                        <input type="email" value="{{$employees->email}}" name="email" class="form-control" >
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('employee_trans.password')}} :</label>
                                        <input  type="password" value="{{$employees->password}}" name="password" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Status : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="emp_status">
                                            <option selected disabled value="{{$employees->emp_status}}">
                                                                                                         @if ($employees->emp_status == 1)
                                                                                                             <span class='badge badge-success' >Active</span>
                                                                                                         @else
                                                                                                             <span class='badge badge-danger'>InActive</span>
                                                                                                          @endif</option>
                                            <option  value="1">Active</option>
                                            <option  value="0">In Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('employee_trans.national_id')}} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" value="{{$employees->national_id}}" name="national_id" type="number" >
                                    </div>
                                </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.description')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control"  value="{{$employees->description}}" name="description" type="text" >
                                </div>
                            </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">{{trans('player_trans.section')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                            <option selected disabled>{{trans('player_trans.Choose')}}...</option>
                                            @foreach($sections as $G)
                                                <option  value="{{ $G->id }}" {{$G->id == $employees->section_id ? 'selected' : ""}}>{{ $G->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.full_description')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$employees->full_description}}" name="full_description" type="text" >
                                </div>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{trans('employee_trans.emp_id')}} : <span class="text-danger">*</span></label>--}}
{{--                                    <input  class="form-control"  value="{{$employees->emp_id}}" name="emp_id" type="number" >--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

{{--#ajax--}}

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.Date_of_Birth')}}:</label>
                                    <input class="form-control" type="text" value="{{$employees->date_of_birth}}" id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.start_time_shift')}}:</label>
                                    <input class="form-control" type="text" value="{{$employees->start_time_shift}}"  id="datepicker-bottom-right" name="start_time_shift" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.end_time_shift')}}:</label>
                                    <input class="form-control" type="text" value="{{$employees->end_time_shift}}" id="datepicker-bottom-left" name="end_time_shift" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.total_salary')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$employees->total_salary}}" name="total_salary" type="number" >
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                <input type="file" accept="image/*" name="image_path">
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

