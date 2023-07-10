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
            </div>
        </div>
    </div>
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