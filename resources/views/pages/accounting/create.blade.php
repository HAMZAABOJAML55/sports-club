
@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.accounting')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_accounting')}}
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

                    <form method="post" action="{{ route('accounting.store') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('accounting_trans.draws')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="draws" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('accounting_trans.discounts')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="discounts" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('accounting_trans.number')}} :</label>
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="coachs">{{trans('accounting_trans.employee')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="employee_id">
                                        <option selected disabled>{{trans('accounting_trans.Choose')}}...</option>
                                        @foreach($employee as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="coachs">{{trans('accounting_trans.coachs')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="coach_id">
                                        <option selected disabled>{{trans('accounting_trans.Choose')}}...</option>
                                        @foreach($coachs as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="players">{{trans('accounting_trans.players')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="player_id">
                                        <option selected disabled>{{trans('accounting_trans.Choose')}}...</option>
                                        @foreach($players as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subtype">{{trans('accounting_trans.subtype_id')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="subtype_id">
                                        <option selected disabled>{{trans('accounting_trans.Choose')}}...</option>
                                        @foreach($subtype as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Payment_trainee">{{trans('accounting_trans.Payment_trainee_id')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Payment_trainee_id">
                                        <option selected disabled>{{trans('accounting_trans.Choose')}}...</option>
                                        @foreach($Payment_trainee as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">


                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('player_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
