@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.food')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_food')}}
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

                    <form method="post"  action="{{ route('food.update','test') }}" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input  type="text" value="{{$food->getTranslation('name','ar')}}" name="name_ar"   class="form-control">

                                </div>
                            </div>
                            <input value="{{$food->id}}" type="hidden" name="id"  class="form-control">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input  type="text" value="{{$food->getTranslation('name','en')}}" name="name_en"   class="form-control">

                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.number')}} :</label>
                                    <input  type="text" value="{{$food->number}}" name="number"   class="form-control">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('food_trans.description')}} :</label>
                                    <input type="text" value="{{$food->description}}" name="description" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.start_time')}}:</label>
                                    <input class="form-control" type="text"  id="datepicker-action" value="{{$food->start_time}}" name="start_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('coach_trans.end_time')}}:</label>
                                    <input class="form-control" type="text" value="{{$food->end_time}}" id="datepicker-action" name="end_time" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="foodsystem_id">{{trans('food_trans.food_type')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="foodsystem_id">
                                        <option selected disabled>{{trans('food_trans.Choose')}}...</option>
                                        @foreach($foodsystems as $p)
                                            <option value="{{ $p->id }}"  {{$p->id == $food->foodsystem_id ? 'selected' : ""}}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">


                            </div>
                        </div>



                        <div class="row">


                        </div><br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('food_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection

