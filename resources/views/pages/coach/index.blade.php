@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('main_sidebar.coach')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_sidebar.coach')}}
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

                                <a href="{{route('coach.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('main_sidebar.add_coach')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('coach_trans.photo')}}</th>
                                            <th>{{trans('coach_trans.name')}}</th>
                                            <th>{{trans('coach_trans.email')}}</th>
                                            <th>{{trans('coach_trans.phone')}}</th>
                                            <th>{{trans('coach_trans.gender')}}</th>
                                            <th>{{trans('coach_trans.Nationality')}}</th>
                                            <th>{{trans('coach_trans.Date_of_Birth')}}</th>
                                            <th>{{trans('coach_trans.coach_description')}}</th>
                                            <th>{{trans('coach_trans.location')}}</th>
                                            <th>{{trans('coach_trans.sub_location')}}</th>
                                            <th>{{trans('employee_trans.status')}}</th>
                                            <th>{{trans('coach_trans.link_website')}}</th>
                                            <th>{{trans('coach_trans.link_facebook')}}</th>
                                            <th>{{trans('coach_trans.link_twitter')}}</th>
                                            <th>{{trans('coach_trans.link_youtupe')}}</th>
                                            <th>{{trans('coach_trans.Employment_Type')}}</th>
                                            <th>{{trans('coach_trans.profs_degree')}}</th>
                                            <th>{{trans('coach_trans.salary')}}</th>
                                            <th>{{trans('coach_trans.start_time')}}</th>
                                            <th>{{trans('coach_trans.end_time')}}</th>
                                            <th>{{trans('coach_trans.Processes')}}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coachs as $coach)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td><img width="180px" height="180px" class="rounded avatar-lg" src="{{(! empty($coach->image_path)) ? asset('/attachments/coachs/'.\Illuminate\Support\Facades\Auth::user()->id.'/'.$coach->id.'/'.$coach->image_path) : asset('backend/assets/images/users/no_image.jpg') }}"  alt="not loading image"></td>
                                                <td>{{$coach->name}}</td>
                                                <td>{{$coach->email}}</td>
                                                <td>{{$coach->phone}}</td>
                                                <td>{{$coach->gender->name}}</td>
                                                <td>{{$coach->nationality->name}}</td>
                                                <td>{{$coach->date_of_birth}}</td>
                                                <td>{{$coach->coach_description}}</td>
                                                <td>{{$coach->location->name}}</td>
                                                <td>{{$coach->sub_location->name}}</td>
                                                <td>
                                                    @if ($coach->coach_status == 1)
                                                        <span class='badge badge-success' >Active</span>
                                                    @else
                                                        <span class='badge badge-danger'>InActive</span>
                                                    @endif

                                                </td>
                                                <td>{{$coach->link_website}}</td>
                                                <td>{{$coach->link_facebook}}</td>
                                                <td>{{$coach->link_twitter}}</td>
                                                <td>{{$coach->link_youtupe}}</td>
                                                <td>{{$coach->employment_type->name}}</td>
                                                <td>{{$coach->profs_degree->name}}</td>
                                                <td>{{$coach->salary}}</td>
                                                <td>{{$coach->start_time}}</td>
                                                <td>{{$coach->end_time}}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('coach.edit',$coach->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;Edit</a>
                                                            <a class="dropdown-item" data-target="#Delete_Student{{ $coach->id }}" data-toggle="modal" href="#Delete_Student{{ $coach->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;Delete</a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @include('pages.coach.Delete')
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
