@extends('layouts.app')
@section('title', 'Sold Cars')
@section('content')

<section class="flex-center">
    <div class="structure">
        <div class="page-title">
            <h2>Car Sales Overview</h2>
        </div>
        <canvas id="mixedSalesChart"></canvas>
        
        
        
        <div class="page-title">
            <h2 class="mt-4">Sold Cars Table</h2>
        </div>
        
        <div class="sold-cars-grid">
            @foreach ($soldCars as $sold)
                <div class="sold-car-card">
                    <div class="card-header">
                        <strong>{{ $sold->car->make ?? '-' }} {{ $sold->car->model ?? '-' }}</strong>
                        <span>{{ $sold->car->year ?? '-' }}</span>
                    </div>

                    <div class="card-body">
                        <p><strong>Sold Price:</strong> £{{ number_format($sold->sold_price, 2) }}</p>

                        <div class="client-info">
                            <p><strong>Client:</strong> {{ $sold->name }} {{ $sold->surname }}</p>
                            <p><strong>Contact:</strong><br>{{ $sold->email }}<br>{{ $sold->phone }}</p>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('/car/' . $sold->car_id) }}" class="view-car-btn">View Car</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('mixedSalesChart').getContext('2d');

    const labels = @json($months);
    const carCounts = @json($carCounts);
    const totalPrices = @json($totalPrices);

    new Chart(ctx, {
        data: {
            labels: labels,
            datasets: [
                {
                    type: 'bar',
                    label: 'Number of Cars Sold',
                    data: carCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    yAxisID: 'y'
                },
                {
                    type: 'line',
                    label: 'Total Sales Price (£)',
                    data: totalPrices,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.4,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Car Sales and Revenue'
                },
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Number of Cars'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false
                    },
                    title: {
                        display: true,
                        text: 'Total Price (£)'
                    }
                }
            }
        }
    });
</script>


@endsection