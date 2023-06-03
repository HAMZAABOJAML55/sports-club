@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.coach')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.coach')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @include('sessions')
    <a href="{{route('coach.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_coach')}}</a><br><br>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
