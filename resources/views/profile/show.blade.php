@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .loader-content {
        text-align: center;
    }

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Profile Update</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div id="stepper" class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#personal-info">
                                <button type="button" class="step-trigger" role="tab" aria-controls="personal-info" id="personal-info-trigger" data-bs-toggle="tooltip" data-bs-placement="top" title="Personal Information">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Personal Info</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#account-info">
                                <button type="button" class="step-trigger" role="tab" aria-controls="account-info" id="account-info-trigger" data-bs-toggle="tooltip" data-bs-placement="top" title="Account Information">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Account Info</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#profile-image">
                                <button type="button" class="step-trigger" role="tab" aria-controls="profile-image" id="profile-image-trigger" data-bs-toggle="tooltip" data-bs-placement="top" title="Profile Image & Bio">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Profile Image & Bio</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company_id">Company ID</label>
                                                <input type="text" id="company_id" name="company_id" value="{{ old('company_id', $user->company_id) }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" placeholder="Enter first name" required>
                                                @error('first_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" id="middle_name" name="middle_name" placeholder="Enter middle name (optional)" value="{{ old('middle_name', $user->middle_name) }}" class="form-control">
                                                @error('middle_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" placeholder="Enter last name" required>
                                                @error('last_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="suffix">Suffix</label>
                                                <input type="text" id="suffix" name="suffix" placeholder="Enter suffix (optional)" value="{{ old('suffix', $user->suffix) }}" class="form-control">
                                                @error('suffix')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right" onclick="stepper.next()">Next</button>
                                </div>

                                <div id="account-info" class="content" role="tabpanel" aria-labelledby="account-info-trigger">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter email address" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="togglePasswordVisibility('password', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Enter confirm password (optional)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="togglePasswordVisibility('password_confirmation', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                                    <button type="button" class="btn btn-primary float-right" onclick="stepper.next()">Next</button>
                                </div>

                                <div id="profile-image" class="content" role="tabpanel" aria-labelledby="profile-image-trigger">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if (isset($user->profile_image))
                                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%;">
                                                @endif
                                                <br>
                                                <strong>Profile Image:</strong>
                                                <input type="file" name="profile_image" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bio">Bio</label>
                                                <textarea id="bio" name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                                                @error('bio')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                                    <button type="submit" class="btn btn-success float-right">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('#stepper'), {
            animation: true
        });

        function capitalizeInput(event) {
            event.target.value = event.target.value.toUpperCase();
        }

        const inputsToCapitalize = [
            'first_name',
            'middle_name',
            'last_name'
        ];

        inputsToCapitalize.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', capitalizeInput);
            }
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    function togglePasswordVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;

        // Toggle the icon class
        icon.querySelector('i').classList.toggle('fa-eye');
        icon.querySelector('i').classList.toggle('fa-eye-slash');
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@endsection
