@extends('frontend.dashboard.layout.master')
@section('body')
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">Settings</h3>
    </div>


    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
            <div class="setting-body">
                <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
                <div class="media media-card align-items-center">
                    <div class="media-img media-img-lg mr-4 bg-gray">
                        <img class="mr-3 img-full width" style="width: 200px;height:200px:object-fit:cover" id="newImg"
                            src="{{ asset($profileData->photo ?? 'no_image.png') }}" alt="avatar image">
                    </div>
                    <form method="post" class="row pt-40px MultiFile-intercepted" action="{{route('profile.update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="media-body">
                            <div class="file-upload-wrap file-upload-wrap-2">
                                <div class="MultiFile-wrap" id="MultiFile2">
                                    <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                        name="photo" class="multi file-upload-input with-preview MultiFile-applied">
                                    <div class="MultiFile-list" id="MultiFile2_list"></div>
                                </div>
                                <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                            </div><!-- file-upload-wrap -->

                        </div>

                </div><!-- end media -->

                <div class="row">
                    <div class="input-box col-lg-6">
                        <label class="label-text">Name</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="name"
                                value="{{ $profileData->name ?? ' ' }}">
                            <span class="la la-user input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-6">
                        <label class="label-text">User Name</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="username"
                                value="{{ $profileData->username ?? ' ' }}">
                            <span class="la la-user input-icon"></span>
                        </div>
                    </div>
                    <div class="input-box col-lg-6">
                        <label class="label-text">Email Address</label>
                        <div class="form-group">
                            <input disabled class="form-control form--control" type="email" name="email"
                                value="{{ $profileData->email ?? ' ' }}">
                            <span class="la la-envelope input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-6">
                        <label class="label-text">Phone Number</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="phone"
                                value="{{ $profileData->phone ?? ' ' }}">
                            <span class="la la-phone input-icon"></span>
                        </div>
                    </div>
                    <div class="input-box col-lg-6">
                        <label class="label-text">Address</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="address"
                                value="{{ $profileData->address ?? ' ' }}">
                            <span class="la la-phone input-icon"></span>
                        </div>
                    </div>
                </div>

                <div class="input-box col-lg-12 py-2">
                    <button class="btn theme-btn" type="submit">Save Changes</button>
                </div><!-- end input-box -->
                </form>
            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->


    </div>
@endsection
