@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.section')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_section')}}
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

                    <form method="post"  action="{{ route('section.update','test') }}" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('section_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input value="{{$section->getTranslation('name','ar')}}" type="text" name="name_ar" class="form-control">
                                </div>
                            </div>
                            <input value="{{$section->id}}" type="hidden" name="id">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('section_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input value="{{$section->getTranslation('name','en')}}" class="form-control" name="name_en" type="text" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('section_trans.number')}} :</label>
                                    <input value="{{$section->number}}" type="number" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('section_trans.section_description')}} :</label>
                                    <input value="{{$section->section_description}}" type="text" name="section_description" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('section_trans.department_address')}} :</label>
                                    <input value="{{$section->department_address}}" type="text" name="department_address" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('section_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="image_path">
                                </div>
                            </div>

                        <div class="row">


                        </div><br>
                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('section_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection

