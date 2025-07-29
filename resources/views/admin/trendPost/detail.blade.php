@extends('admin.layouts.app')
@section('content')
    <div class="col-6 offset-3 mt-5">
        <div class="card">
            <div class="card-header">

                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>

                <div class="text-center">
                    <img width="400px" class="rounded shadow-sm"
                        @if ($post['image'] == null) src="{{ asset('defaultImage/defaultImage.png') }}"
                                @else
                                    src="{{ asset('postImage/' . $post['image']) }}" @endif
                        alt="">
                </div>

            </div>
            <div class="card-body">
                <div class="text-center">{{ $post['title '] }}</div>
                <div class="text-start">{{ $post['description'] }}</div>

            </div>
        </div>
    </div>
@endsection
