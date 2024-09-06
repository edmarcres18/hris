@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
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

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
</style>
@stop

@section('content')
<br>
<div class="container-fluid">
    <h1>Employee Timesheet</h1>

    <!-- Filter and Search Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filter and Search</h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <label for="filter">Filter by Department:</label>
                    <select id="filter" class="form-control">
                        <option value="all">All Employees</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="search">Search Employee:</label>
                    <input type="text" id="search" class="form-control" placeholder="Enter company ID, last name, or first name">
                </div>
            </div>
        </div>
    </div>

    <!-- List of Employees Card -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Company ID</th>
                        <th>Name</th>
                        <th>Timesheet</th>
                    </tr>
                </thead>
                <tbody id="employee-list">
                    @foreach ($employees as $employee)
                        <tr class="employee-row" data-department-id="{{ $employee->department_id }}" data-employee-name="{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}" data-company-id="{{ $employee->company_id }}">
                            <td>{{ $employee->company_id }}</td>
                            <td>{{ $employee->last_name }}, {{ $employee->first_name }} {{ $employee->middle_name }}</td>
                            <td>
                                @if (count($timesheets[$employee->id]) > 0)
                                    <a href="{{ route('employee.attendance', ['employee_id' => $employee->id]) }}" class="btn btn-primary toggle-attendance" data-employee-id="{{ $employee->id }}"><i class="fas fa-file-alt"></i> Timesheet</a>
                                @else
                                    No record
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="no-employees" class="text-center p-4" style="display: none;">
            No employees found.
        </div>
    </div>
</div>

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('select').select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        });
    </script>
@stop
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function filterAndSearch() {
            var departmentId = $('#filter').val();
            var searchQuery = $('#search').val().toLowerCase();

            $('.employee-row').show();

            if (departmentId !== 'all') {
                $('.employee-row').filter(function() {
                    return $(this).data('department-id') !== departmentId;
                }).hide();
            }

            if (searchQuery.length > 0) {
                $('.employee-row').filter(function() {
                    var employeeName = $(this).data('employee-name').toLowerCase();
                    var companyId = $(this).data('company-id').toString().toLowerCase();
                    return !(employeeName.includes(searchQuery) || companyId.includes(searchQuery));
                }).hide();
            }

            if ($('.employee-row:visible').length === 0) {
                $('#no-employees').show();
            } else {
                $('#no-employees').hide();
            }
        }

        $('#filter').change(filterAndSearch);
        $('#search').on('keyup', filterAndSearch);

        filterAndSearch();
    });
</script>
@endsection
