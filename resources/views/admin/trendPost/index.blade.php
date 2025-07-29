@extends('admin.layouts.app')
@section('content')
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Post Table</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>View count</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item['post_id'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td><img width="100px" class="rounded shadow-sm"
                                        @if ($item['image'] == null) src="{{ asset('defaultImage/defaultImage.png') }}"
                                @else
                                    src="{{ asset('postImage/' . $item['image']) }}" @endif
                                        alt=""></td>
                                <td><i class="fas fa-eye mr-1"></i>{{ $item['post_count'] }}</td>
                                <td>
                                    <a href="{{ route('admin#trendPostDetails', $item['post_id']) }}"
                                        class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{-- <div class="d-flex justify-content-center"> {{ $posts->links()}}</div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        {{-- <div class="d-flex justify-content-end mr-4">
            {{ $post->links() }};
        </div> --}}
    </div>
@endsection
