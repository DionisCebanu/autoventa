@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<canvas id="salesChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesByMonth = @json($salesByMonth);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(salesByMonth),
            datasets: [{
                label: 'Cars Sold By Month',
                data: Object.values(salesByMonth),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection