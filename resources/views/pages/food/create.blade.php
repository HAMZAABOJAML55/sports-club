@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.food_system')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_food_system')}}
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

                    <form method="post" action="{{ route('food.store') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="name_en" type="text">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.number')}} :</label>
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.description')}} :</label>
                                    <input type="text" name="description" class="form-control">
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
                                    <label for="foodsystem_id">{{trans('food_trans.food_type')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="foodsystem_id">
                                        <option selected disabled>{{trans('food_trans.Choose')}}...</option>
                                        @foreach($foodsystems as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="image_path">
                                </div>
                            </div>
                            <div class="row">


                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('food_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
