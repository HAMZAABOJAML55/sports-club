@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.player')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.player')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
