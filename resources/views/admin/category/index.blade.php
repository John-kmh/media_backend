@extends('admin.layouts.app')

@section('content')
    <div class="col mt-5">
        <div class="row">
            <div class="col-4 ">
                <form action="{{ route('admin#createCategory') }}" method="POST">
                    @csrf
                    <div class="div">
                        Title: <input type="text" name="title" value="{{ old('title') }}"
                            class="form-control @error('title')
                            is-invalid
                        @enderror"
                            id="">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        Description
                        <textarea name="description"
                            class="form-control @error('description')
                            is-invalid
                        @enderror"
                            cols="30" rows="5" id="">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="submit" value="Create" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-6 mt-2">
                {{-- alert start --}}
                @if (Session::has('successDelete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('successDelete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- alert end --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category Table</h3>

                        <div class="card-tools">
                            <form action="{{ route('admin#searchCategory') }}" method="POST">
                                @csrf
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="categorySearch" class="form-control float-right"
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
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    <tr>
                                        <td>{{ $item['category_id'] }}</td>
                                        <td>{{ $item['title'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        <td>
                                            <a href="{{ route('admin#editCategory', $item['category_id']) }}"
                                                class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin#categoryDelete', $item['category_id']) }}"
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
