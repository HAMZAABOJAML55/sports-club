
@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.team')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_team')}}
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

                    <form method="post" action="{{ route('team.store') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="name_en" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.description')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="description" type="text">
                                </div>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{trans('team_trans.team_member')}} : <span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input class="form-control" name="team_member" type="number">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('team_trans.number')}} :</label>
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="coachs">{{trans('team_trans.coachs')}} : <span
                                            class="text-danger">*</span></label>
                                    <select multiple class="custom-select mr-sm-2" name="coach_id[]">
                                        <option selected disabled>{{trans('team_trans.Choose')}}...</option>
                                        @foreach($coachs as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="players">{{trans('team_trans.players')}} : <span
                                            class="text-danger">*</span></label>
                                    <select multiple class="custom-select mr-sm-2" name="player_id[]">
                                        <option selected disabled>{{trans('team_trans.Choose')}}...</option>
                                        @foreach($players as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" name="image_path">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('team_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
