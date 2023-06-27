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

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                @include('sessions')

                                <a href="{{route('product.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_product')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('product_trans.name')}}</th>
                                            <th>{{trans('product_trans.price')}}</th>
                                            <th>{{trans('product_trans.description')}}</th>
                                            <th>{{trans('product_trans.product_types_id')}}</th>
                                            <th>{{trans('product_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->description}}</td>
                                                <td>{{$product->productType->name}}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('product.show',$product->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp; show all images</a>
                                                            <a class="dropdown-item" href="{{route('product.edit',$product->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;Edit</a>
                                                            <a class="dropdown-item" data-target="#Delete_Student{{ $product->id }}" data-toggle="modal" href="##Delete_Student{{ $product->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;Delete</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @include('pages.product.Delete')
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
