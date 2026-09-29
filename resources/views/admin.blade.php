@extends('layouts.app')

@section('content')
<div id="admin" class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mb-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Create Access Codes</h1>
                    <p class="text-center">Create an access code users will use when taking the assessment.</p>
                    <hr>

                    <form id="create-access-code-form" method="POST" action="{{ route('create_access_code') }}">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-sm-6 align-self-end">
                                <div class="form-group">
                                    <label for="name">Access Code</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">How many times can this code be used?</label>
                                    <input type="number" class="form-control" name="uses" min="1" step="1" value="{{ old('uses') }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Owner email <small class="text-muted">(optional &mdash; who receives the results; defaults to you)</small></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ auth()->user()->email }}">
                                </div>
                            </div>

                            <div class="col-12">
                                @if ($errors->any())
                                    <div id="errors" class="alert alert-danger mt-4" role="alert">
                                        <ul class="alert-list">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12" v-show="paymentAccessCodeType">
                                <div class="d-flex justify-content-center" >
                                    <input type="submit" class="btn btn-primary" value="Generate Access Code">
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h1 class="text-center">Change Password</h1>
                    <hr>

                    @if (session('password_success'))
                        <div class="alert alert-success alert-dismissible mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('password_success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('change_password') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" name="new_password_confirmation" required>
                        </div>

                        @if ($errors->password->any())
                            <div class="alert alert-danger mt-3" role="alert">
                                <ul class="alert-list">
                                    @foreach ($errors->password->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex justify-content-center mt-3">
                            <input type="submit" class="btn btn-primary" value="Update Password">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
