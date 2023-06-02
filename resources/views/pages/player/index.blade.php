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

<a href="{{route('player.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_player')}}</a><br><br>
    <!-- row -->

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection