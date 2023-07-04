
@extends('layouts.master')
@section('css')

    @section('title')
        setting
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        setting
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')


    @include('sessions')


    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{route('update.club','test')}}">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6 border-right-2 border-right-blue-400">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label font-weight-semibold">Club Name<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{$club->name}}" required type="text" class="form-control" placeholder="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label font-weight-semibold">User Name</label>
                                    <div class="col-lg-9">
                                        <input name="user_name" value="{{$club->user_name}}" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label font-weight-semibold">Email</label>
                                    <div class="col-lg-9">
                                        <input name="email" value="{{$club->email}}" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label font-weight-semibold">Password</label>
                                    <div class="col-lg-9">
                                        <input name="password" type="password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label font-weight-semibold">Phone<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input required name="phone" value="{{$club->phone}}" type="text" class="form-control" >
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" name="image_path">
                                    </div>
                                </div>

{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-lg-2 col-form-label font-weight-semibold">Photo</label>--}}
{{--                                    <div class="col-lg-9">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <img style="width: 100px" height="100px" src="{{ URL::asset('attachments/images/logos/clubs) }}" alt="loading...">--}}
{{--                                        </div>--}}
{{--                                        <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('player_trans.submit')}}</button>
                    </form>
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
