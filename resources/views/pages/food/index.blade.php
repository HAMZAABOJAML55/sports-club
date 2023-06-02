@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.food_system')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.food_system')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <a href="{{route('food.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_food_system')}}</a><br><br>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection