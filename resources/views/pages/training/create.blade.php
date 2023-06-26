@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.training')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_training')}}
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

                    <form method="post" action="{{ route('training.store') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.number')}} :</label>
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.description')}} :</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.link_website')}} :</label>
                                    <input  type="url" name="link_website" class="form-control" >
                                </div>
                            </div>




                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('training_trans.duration_of_training')}}:</label>
                                    <input class="form-control" type="text" name="duration_of_training"  >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('training_trans.training_number')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="training_number" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('training_trans.number_of_iterations')}}:</label>
                                    <input class="form-control" type="text"  name="number_of_iterations" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="image_path">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="trainingsystem_id">{{trans('training_trans.group_exercises')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="training_group_id">
                                        <option selected disabled>{{trans('training_trans.Choose')}}...</option>
                                        @foreach($training_group as $p)
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
                                type="submit">{{trans('training_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
