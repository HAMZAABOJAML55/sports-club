
@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.team')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_team')}}
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

                    <form method="post" action="{{ route('team.update','test') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input value="{{$teams->id}}" type="hidden" name="id"  class="form-control">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$teams->getTranslation('name','ar')}}" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$teams->getTranslation('name','en')}}"  name="name_en" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.team_description')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$teams->description}}" name="description" type="text">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.number')}} :</label>
                                    <input type="number" value="{{$teams->number}}" name="number" class="form-control">
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

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('team_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection


