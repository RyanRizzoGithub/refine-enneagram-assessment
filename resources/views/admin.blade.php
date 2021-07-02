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
        </div>
    </div>
</div>
@endsection
