<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{route('store.club')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 border-right-2 border-right-blue-400">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Club Name<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="name"  required type="text" class="form-control" placeholder="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">User Name</label>
                                <div class="col-lg-9">
                                    <input name="user_name" type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Email</label>
                                <div class="col-lg-9">
                                    <input name="email"  type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Password</label>
                                <div class="col-lg-9">
                                    <input name="password" type="password" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">Phone<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required name="phone"  type="text" class="form-control" >
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{trans('product_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="image_path">
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('player_trans.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
