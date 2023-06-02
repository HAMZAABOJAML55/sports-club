@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.team')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.team')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <a href="{{route('team.create')}}" class="btn btn-success btn-sm" role="button"
    aria-pressed="true">{{trans('main_sidebar.add_team')}}</a><br><br>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

