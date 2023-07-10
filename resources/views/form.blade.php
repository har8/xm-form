@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           
            <div class="col-md-6"> 
                <div class="flex justify-content-center">
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>xm.com PHP Exercise - v21.0.5</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
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

    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
		    <img src="https://logosdownload.com/logo/XM-com-logo-512.png" />
                </div>

                <div class="mt-16">
		    @if(session('status'))
		    <div class="alert alert-success">
    			{{ session('status') }}
		    </div>
		    @endif
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-12 lg:gap-12">
			<form class="scale-100 p-12 bg-white dark:bg-gradient-to-bl form-gray-700/50">
<!--                        <a href="https://laravel.com/docs" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
-->                           <div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Exercise</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">

                                </p>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>
