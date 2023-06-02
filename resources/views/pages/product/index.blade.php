@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.product')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.product')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <a href="{{route('product.create')}}" class="btn btn-success btn-sm" role="button"
    aria-pressed="true">{{trans('main_sidebar.add_product')}}</a><br><br>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
