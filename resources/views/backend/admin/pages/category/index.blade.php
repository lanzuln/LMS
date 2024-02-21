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
            <a href="{{ route('category.create') }}"><button type="button" class="btn btn-primary">Create New</button></a>
        </div>
    </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table id="dataTable" class="table table-striped table-bordered dataTable" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($item->image ?? 'no_image.png') }}" alt=""
                                            style="width: 100px; height:70px; border-radius:5px; object-fit:cover"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{route('category.edit', $item->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('category.delete', $item->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    @endsection
