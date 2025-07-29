@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Update Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert start --}}
                            @if (Session::has('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('updateSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <form class="form-horizontal" action="{{ route('profile#update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('adminName')
                                                is-invalid
                                            @enderror"
                                            name="adminName" value="{{ old('adminName', $userInfo->name) }}"
                                            placeholder="Name">
                                        @error('adminName')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email"
                                            class="form-control @error('adminEmail')
                                                is-invalid
                                            @enderror"
                                            name="adminEmail" value="{{ old('adminEmail', $userInfo->email) }}"
                                            placeholder="Email">
                                        @error('adminEmail')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('adminPhone')
                                                is-invalid
                                            @enderror"
                                            name="adminPhone" value="{{ old('adminPhone', $userInfo->phone) }}"
                                            placeholder="Phone...">
                                        @error('adminPhone')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('adminAddress')
                                                is-invalid
                                            @enderror"
                                            name="adminAddress" value="{{ old('adminAddress', $userInfo->address) }}"
                                            placeholder="Address..">
                                        @error('adminAddress')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="adminGender"
                                            class="form-control @error('adminGender')
                                                is-invalid
                                            @enderror">
                                            <option value="empty">
                                                Choose option
                                            </option>
                                            <option value="male"
                                                {{ old('adminGender', $userInfo->gender) == 'male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="female"
                                                {{ old('adminGender', $userInfo->gender) == 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>

                                        </select>
                                        @error('adminGender')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn bg-dark text-white">Save</button>
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
