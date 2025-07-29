@extends('admin.layouts.app')

@section('content')
    <div class="col mt-5">
        <div class="row">
            <div class="col-4 ">
                <form action="{{ route('admin#createPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div">
                        Title: <input type="text" name="title" value="{{ old('title') }}"
                            class="form-control @error('title')
                            is-invalid
                        @enderror"
                            id="" placeholder="Enter post title">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        Description:
                        <textarea name="description"
                            class="form-control @error('description')
                            is-invalid
                        @enderror"
                            cols="30" rows="5" id="" placeholder="Enter post description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        Image:
                        <input type="file" name="image" class="form-control">

                        <select name="categoryID" id=""
                            class="form-control mt-2 @error('categoryID')
                            is-invalid
                        @enderror">
                            <option value="">Choose Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item['category_id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                        @error('categoryID')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <input type="submit" value="Create Post" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Post Table</h3>

                        <div class="card-tools">
                            <form action="{{ route('admin#searchpost') }}" method="POST">
                                @csrf
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="postSearch" class="form-control float-right"
                                        placeholder="Search by Title">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item)
                                    <tr>
                                        <td>{{ $item['post_id'] }}</td>
                                        <td>{{ $item['title'] }}</td>
                                        {{-- <td>{{ $item['description'] }}</td> --}}
                                        <td><img class="rounded shadow-sm" width="100px"
                                                @if ($item['image'] == null) src="{{ asset('defaultImage/defaultImage.png') }}"
                                                @else
                                                    src="{{ asset('postImage/' . $item['image']) }}" @endif
                                                alt=""></td>
                                        <td><a href="{{ route('admin#editPost', $item['post_id']) }}"
                                                class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin#deletePost', $item['post_id']) }}"
                                                class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
