@extends('layouts.app')
@section('title', 'Sold Cars')
@section('content')

<section class="flex-center">
    <div class="structure">
        <h2>Car Sales Overview</h2>
        <canvas id="mixedSalesChart"></canvas>
        
        
        
        <h2 class="mt-4">Sold Cars Table</h2>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead style="background-color: #f5f5f5;">
                <tr>
                    <th style="padding: 10px; border: 1px solid #ccc;">Car</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Year</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Sold Price (£)</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Client</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Contact</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soldCars as $sold)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            {{ $sold->car->make ?? '-' }} {{ $sold->car->model ?? '-' }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            {{ $sold->car->year ?? '-' }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            £{{ number_format($sold->sold_price, 2) }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            {{ $sold->name }} {{ $sold->surname }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            {{ $sold->email }}<br>
                            {{ $sold->phone }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <a href="{{ url('/car/' . $sold->car_id) }}">View Car</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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