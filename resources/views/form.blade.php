@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           
            <div class="col-md-6 p-3"> 
                <div class="flex justify-content-center mb-5">
		            <img src="https://logosdownload.com/logo/XM-com-logo-512.png" />
                </div>
                <form action="{{ route('form.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="symbol" class="form-label">Company Symbol</label>
                        <input type="text" class="form-control" id="symbol" name="symbol" value="{{ old('symbol') }}">
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="{{ old('end_date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Initialize datepicker
        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
@endsection