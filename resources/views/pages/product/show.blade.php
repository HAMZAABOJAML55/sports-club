@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_trans.product')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.product')}}
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

                                <a href="{{route('product.index')}}" class="btn btn-success btn-sm nextBtn btn-lg pull-right" role="button"
                                   aria-pressed="true">back</a><br>


{{--                                  <form method="post" action="{{route('image.update',$id)}}">--}}
{{--                                        @csrf--}}
{{--                                        @method('PUT')--}}
{{--                                      <input type="hidden" name="id" value="{{$id}}">--}}
{{--                                      <input type="hidden" name="product_name" value="{{$product->name}}">--}}
{{--                                      <div class="col-md-3">--}}
{{--                                          <div class="form-group">--}}
{{--                                              <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>--}}
{{--                                              <input type="file" accept="image/*" name="photos[]" multiple>--}}
{{--                                          </div>--}}
{{--                                      </div>--}}
{{--                                      <button class="btn btn-success btn-sm nextBtn btn-lg pull-left" type="submit">Add Image</button>--}}
{{--                                  </form>--}}

                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>photo</th>
                                            <th>{{trans('product_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($img as $i)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img width="180px" height="180px" class="rounded avatar-lg" src="{{(! empty($i->imageable_id)) ? asset('/attachments/product/'.$i->imageable->name.'/'.$i->file_name) : asset('backend/assets/images/users/no_image.jpg') }}"  alt="not loading image"></td>
                                                <td>
{{--                                                    <a class="dropdown-item" href="{{route('image.edit',$i->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;{{trans('product_trans.edit')}}</a>--}}
                                                    <a class="dropdown-item" data-target="#Delete_img{{ $i->id }}" data-toggle="modal" href="#Delete_img{{ $i->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;{{trans('category_trans.delete')}}</a>
                                                </td>
                                            </tr>
                                           @include('pages.product.Delete_img')
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

@endsection
