<!-- resources/views/leaves/report.blade.php -->

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
<div class="container">
    <h1>All Leaves Report</h1>

    <form method="GET" action="{{ route('leaves.report') }}">
        <div class="form-group">
            <label for="department_id">Filter by Department:</label>
            <select name="department_id" id="department_id" class="form-control">
                <option value="">All Departments</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $departmentId == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('leaves.report', ['download' => 'pdf']) }}" class="btn btn-success">Download PDF</a>
    </form>
<br>
    <table id="report-table" class="table table-bordered table-hover table-striped mt-4">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Department</th>
                <th>Date From</th>
                <th>Date To</th>
                <th>Type</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee->last_name }} {{ $leave->employee->first_name }} {{ $leave->employee->middle_name }}</td>
                    <td>{{ $leave->employee->department->name }}</td>
                    <td>{{ $leave->date_from }}</td>
                    <td>{{ $leave->date_to }}</td>
                    <td>{{ $leave->type->name }}</td>
                    <td>{{ $leave->reason_to_leave }}</td>
                    <td>{{ $leave->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No Employee Leaves Data Here</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#report-table').DataTable();
        });
    </script>
@endsection
