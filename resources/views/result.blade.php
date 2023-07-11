@extends('layouts.app')

@section('content')
<a href="{{ route('form.create') }}" class="btn btn-primary">Back to Form</a>
<h2>{{ $companyName }}</h2>
<p>From: {{ $startDate }}   To: {{ $endDate }}</p>
<div class="mb-5">
    <table id="historicalTable" class="display">
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
        @foreach ($historicalData as $key => $data) 
                <tr>
                    <td>{{ date('Y-m-d H:i:s', $data['date']) }}</td>
                    <td>{{ $data['open'] ?? '' }}</td>
                    <td>{{ $data['high'] ?? '' }}</td>
                    <td>{{ $data['low'] ?? '' }}</td>
                    <td>{{ $data['close'] ?? '' }}</td>
                    <td>{{ $data['volume'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<canvas id="chart"></canvas>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        // Prepare data for chart
        var labels = [];
        var openPrices = [];
        var closePrices = [];
        @foreach ($historicalData as $data)
			@if (isset($data['open']) && isset($data['close']))
				labels.push('{{ $data['date']}}');
				openPrices.push('{{ $data['open'] ?? '' }}');
				closePrices.push('{{ $data['close'] ?? '' }}');
			@endif
        @endforeach

        // Create chart
        @if (!empty($historicalData))
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
        @endif

        $(document).ready(function() {
            $('#historicalTable').DataTable();
        });
    </script>
@endsection
