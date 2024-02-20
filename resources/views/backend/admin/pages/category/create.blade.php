@extends('backend.admin.layout.master')
@section('body')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All category</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{route('category.index')}}"><button type="button" class="btn btn-primary">View All</button></a>
        </div>
    </div>


    <div class="card">
        <div class="card-body p-4">
            <form method="POST" class="row g-3" action="{{route('category.store')}}" enctype="multipart/form-data" id="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12 pb-3 form-group">
                            <label for="input1" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="input1" name="name" placeholder="Category name">
                        </div>
                        <div class="col-md-12">
                            <label for="input1" class="form-label">Upload image</label>
                            <input name="image" oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                class="form-control">
                        </div>

                        <img class="mt-3" style="width:200px;height:auto" id="newImg" src="{{ asset('no_image.png') }}"
                            alt="profile">


                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                name: {
                    name: {
                        required: 'Please Enter category name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
