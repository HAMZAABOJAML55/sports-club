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

                    <form method="post" action="{{ route('coach.training.update',['test','coach']) }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input value="{{$trainings->id}}" type="hidden" name="id"  class="form-control">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$trainings->getTranslation('name','ar')}}" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$trainings->getTranslation('name','en')}}" name="name_en" type="text" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.number')}} :</label>
                                    <input type="number" value="{{$trainings->number}}" name="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.description')}} :</label>
                                    <input type="text" value="{{$trainings->description}}" name="description" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('training_trans.link_website')}} :</label>
                                    <input  type="url" value="{{$trainings->link_website}}" name="link_website" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('training_trans.duration_of_training')}}:</label>
                                    <input class="form-control" type="text"   value="{{$trainings->duration_of_training}}" name="duration_of_training"  >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('training_trans.training_number')}}:</label>
                                    <input class="form-control" type="text"   value="{{$trainings->training_number}}" name="training_number" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('training_trans.number_of_iterations')}}:</label>
                                    <input class="form-control" type="text"   value="{{$trainings->number_of_iterations}}" name="number_of_iterations" >
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="trainingsystem_id">{{trans('training_trans.group_exercises')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="training_group_id">
                                        <option selected disabled>{{trans('training_trans.Choose')}}...</option>
                                        @foreach($training_group as $p)
                                            <option value="{{ $p->id }}" {{$p->id == $trainings->training_group_id ? 'selected' : ""}}>{{ $p->name }}</option>
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


