@extends('admin.layouts.app')
@section('content')
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin List Table</h3>
                <div class="row">
                    <div class="offset-9 col-3">
                        {{-- alert start --}}
                        @if (Session::has('deleteSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('deleteSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{-- alert end --}}
                    </div>
                </div>

                <div class="card-tools">
                    <form action="{{ route('admin#search') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="adminSearchKey" value="{{ old('adminSearchKey') }}"
                                class="form-control float-right" placeholder="Search">

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
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['phone'] }}</td>
                                <td>{{ $item['address'] }}</td>
                                <td>{{ $item['gender'] }}</td>
                                <td>
                                    {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                                    @if (auth()->user()->id != $item['id'])
                                        <a
                                            @if (count($userData) == 1) href="#"
                                        @else
                                            href="{{ route('admin#deleteList', $item['id']) }}" @endif><button
                                                type="submit" class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button></a>
                                    @endif
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
@endsection
