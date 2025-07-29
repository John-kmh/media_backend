@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Password Change</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert start --}}
                            @if (Session::has('fail'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ Session::get('fail') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <form class="form-horizontal" action="{{ route('profile#updatePassword') }}" method="POST">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-12">
                                        Old Password:<input type="password"
                                            class="form-control @error('oldPassword')
                                            is-invalid
                                        @enderror"
                                            name="oldPassword" value=""placeholder="Old Password...">
                                        @error('oldPassword')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-12">
                                        NewPassword:<input type="password"
                                            class="form-control @error('newPassword')
                                            is-invalid
                                        @enderror"
                                            name="newPassword" value=""placeholder="New Password">
                                        @error('newPassword')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-12">
                                        Confirm Password:<input type="password"
                                            class="form-control @error('confirmPassword')
                                            is-invalid
                                        @enderror"
                                            name="confirmPassword" value=""placeholder="Confirm Password">
                                        @error('confirmPassword')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
