@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.accounting')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.accounting')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                @include('sessions')

                                <a href="{{route('accounting.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_accounting')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('accounting_trans.number')}}</th>
                                            <th>{{trans('accounting_trans.draws')}}</th>
                                            <th>{{trans('accounting_trans.discounts')}}</th>
                                            <th>{{trans('accounting_trans.coach_id')}}</th>
                                            <th>{{trans('accounting_trans.player_id')}}</th>
                                            <th>{{trans('accounting_trans.Payment_trainee_id')}}</th>
                                            <th>{{trans('accounting_trans.subtype_id')}}</th>
                                            <th>{{trans('accounting_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($accountings as $accounting)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$accounting->number}}</td>
                                                <td>{{$accounting->draws}}</td>
                                                <td>{{$accounting->discounts}}</td>
                                                <td>{{$accounting->coach->name}}</td>
                                                <td>{{$accounting->player->name}}</td>
                                                <td>{{$accounting->Payments_trainees->name}}</td>
                                                <td>{{$accounting->subtype->name}}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('accounting.edit',$accounting->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                            <a class="dropdown-item" data-target="#Delete{{ $accounting->id }}" data-toggle="modal" href="#Delete{{ $accounting->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @include('pages.accounting.Delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
