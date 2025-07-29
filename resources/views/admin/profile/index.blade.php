@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $user->name }}" placeholder="Name" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" placeholder="Email" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $user->phone }}" placeholder="Phone..." disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" rows="5" cols="30" placeholder="Address.." disabled>{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="gender" class="form-control" disabled>
                                            <option value="empty">
                                                Choose option
                                            </option>
                                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <a href="{{ route('profile#edit') }}" class="btn bg-dark text-white">Edit
                                            Profile</a>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{ route('profile#changePassword') }}">Change Password</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
