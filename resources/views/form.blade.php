@extends('layouts.app')

@section('content')
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
<form action="{{ route('form.store') }}" method="POST">
    @csrf
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3">
        <label for="company_symbol">Company Symbol</label>
        <select name="company_symbol" id="company_symbol" class="form-control" required>
            <option value="">Select a symbol</option>
            @if (!empty($symbolData))
                @foreach ($symbolData as $symbol)
                <option value="{{ $symbol['Symbol'] }}" {{ old('company_symbol') == $symbol['Symbol'] ? 'selected' : '' }}>
                    {{ $symbol['Symbol'] }} - {{ $symbol['Company Name'] }}
                </option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@section('js')
    <script>
        // Initialize datepicker
        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            
            $('form').validate();
        });
    </script>
@endsection