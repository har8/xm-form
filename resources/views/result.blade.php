@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>{{ $companyName }}</h2>
                <p>From: {{ $startDate }}</p>
                <p>To: {{ $endDate }}</p>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Open</th>
                            <th>High</th>
                            <th>Low</th>
                            <th>Close</th>
                            <th>Volume</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historicalData as $data)
                            <tr>
                                <td>{{ $data['date'] }}</td>
                                <td>{{ $data['open'] }}</td>
                                <td>{{ $data['high'] }}</td>
                                <td>{{ $data['low'] }}</td>
                                <td>{{ $data['close'] }}</td>
                                <td>{{ $data['volume'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for chart
        var labels = [];
        var openPrices = [];
        var closePrices = [];
        @foreach ($historicalData as $data)
            labels.push('{{ $data['date'] }}');
            openPrices.push('{{ $data['open'] }}');
            closePrices.push('{{ $data['close'] }}');
        @endforeach

        // Create chart
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Open Price',
                    data: openPrices,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }, {
                    label: 'Close Price',
                    data: closePrices,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                }]
            },
            options: {}
        });
    </script>
@endsection
