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
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-success text-white">
                    <h2 class="mb-0"><i class="fas fa-plus-circle mr-2"></i>Create New Hiring Position</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('hirings.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position"><i class="fas fa-briefcase mr-2"></i>Position</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location"><i class="fas fa-map-marker-alt mr-2"></i>Location</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description"><i class="fas fa-align-left mr-2"></i>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="requirements"><i class="fas fa-list-ul mr-2"></i>Requirements</label>
                            <textarea class="form-control" id="requirements" name="requirements" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="benefits"><i class="fas fa-gift mr-2"></i>Benefits</label>
                            <textarea class="form-control" id="benefits" name="benefits" rows="4" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="fas fa-plus mr-2"></i>Create Position
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card-header {
        border-bottom: 0;
    }
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: all 0.3s ease;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
