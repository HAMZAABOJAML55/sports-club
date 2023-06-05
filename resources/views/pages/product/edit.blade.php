@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.product')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.add_product')}}
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

                    <form method="post" action="{{ route('product.update','test') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input value="{{$products->id}}" type="hidden" name="id"  class="form-control">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('product_trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$products->getTranslation('name','ar')}}" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('product_trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$products->getTranslation('name','en')}}" name="name_en" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('product_trans.product_description')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$products->description}}"  name="description" type="text">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('product_trans.price')}} :</label>
                                    <input type="number" value="{{$products->price}}" name="price" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_types_id">{{trans('product_trans.product_type')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="product_types_id">
                                        <option selected disabled>{{trans('product_trans.Choose')}}...</option>
                                        @foreach($types as $p)
                                            <option value="{{ $p->id }}" {{$p->id == $products->product_types_id ? 'selected' : ""}}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">


                            </div>
                        </div>
                        <br>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{trans('product_trans.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection


