<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @include('sessions')

                <form method="post"  action="{{ route('singnupemployee.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('employee_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                <input  type="text" name="name_ar"   class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('employee_trans.name_en')}} : <span class="text-danger">*</span></label>
                                <input  class="form-control" name="name_en" type="text" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.email')}} : </label>
                                    <input type="email"  name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.password')}} :</label>
                                    <input  type="password" name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.number')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="number" type="number" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.description')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="description" type="text" >
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('employee_trans.section')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        <option selected disabled>{{trans('employee_trans.Choose')}}...</option>
                                        @foreach($sections as $G)
                                            <option  value="{{ $G->id }}">{{ $G->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.full_description')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="full_description" type="text" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('employee_trans.emp_id')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="emp_id" type="number" >
                                </div>
                            </div>
                        </div>

                        {{--#ajax--}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('employee_trans.date_of_birth')}}:</label>
                                <input class="form-control" type="text"  id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>



                    </div>




                    <div class="row">


                    </div><br>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('employee_trans.submit')}}</button>
                </form>

            </div>
        </div>
    </div>
</div>
