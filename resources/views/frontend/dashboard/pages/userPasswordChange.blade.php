@extends('frontend.dashboard.layout.master')
@section('body')
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">Password Change</h3>
    </div>


    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
            <div class="setting-body">
                <h3 class="fs-17 font-weight-semi-bold pb-4">Change password</h3>

                <form method="post" class="row pt-40px MultiFile-intercepted" action="{{ route('update.password') }}">
                    @csrf

                    <div class="row">
                        <div class="input-box col-lg-6">
                            <label class="label-text">Old password</label>
                            <div class="form-group">
                                <input class="form-control form--control @error('old_password') is-invalid
                                @enderror" type="password" name="old_password">

                                @error('old_password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
                        </div><!-- end input-box -->
                        <div class="input-box col-lg-6">
                            <label class="label-text">New password</label>
                            <div class="form-group">
                                <input class="form-control form--control @error('new_password') is-invalid
                                @enderror" type="password" name="new_password">

                                @error('new_password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="input-box col-lg-6">
                            <label class="label-text">Confirm password</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="password" name="new_password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="input-box col-lg-12 py-2">
                        <button class="btn theme-btn" type="submit">Changes Password</button>
                    </div><!-- end input-box -->
                </form>
            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->


    </div>
@endsection
