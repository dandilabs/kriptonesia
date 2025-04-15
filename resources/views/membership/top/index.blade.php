@extends('layouts.member')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Top Holdings - {{ ucfirst($coin_id) }}</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            @include('sweetalert::alert')

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Top 10 Public Company Holdings</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="holdingsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Holdings Details</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="holdings-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company</th>
                                <th>Country</th>
                                <th>Total Holdings</th>
                                <th>Entry Value</th>
                                <th>Profit/Loss</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($holdings as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $item['name'] }}</strong></td>
                                    <td>
                                        <span class="badge badge-light">
                                            <i class="fas fa-globe mr-1"></i>{{ $item['country'] }}
                                        </span>
                                    </td>
                                    <td class="text-primary font-weight-bold">
                                        {{ number_format($item['total_holdings'], 2) }} BTC
                                    </td>
                                    <td>${{ number_format($item['total_entry_value_usd'], 2) }}</td>
                                    <td>
                                        @if (isset($item['profit_or_loss_usd']) && $item['profit_or_loss_usd'] >= 0)
                                            <span class="badge badge-success">
                                                <i
                                                    class="fas fa-caret-up mr-1"></i>${{ number_format($item['profit_or_loss_usd'], 2) }}
                                            </span>
                                        @elseif(isset($item['profit_or_loss_usd']))
                                            <span class="badge badge-danger">
                                                <i
                                                    class="fas fa-caret-down mr-1"></i>${{ number_format(abs($item['profit_or_loss_usd']), 2) }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .chart-container {
            position: relative;
            min-height: 300px;
        }

        #holdings-table tbody tr:hover {
            background-color: rgba(0, 0, 0, .02);
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(function() {
            // Initialize DataTable
            $('#holdings-table').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'asc']
                ]
            });

            // Initialize Chart
            const ctx = document.getElementById('holdingsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($holdings->pluck('name')) !!},
                    datasets: [{
                        label: 'Total Holdings (BTC)',
                        data: {!! json_encode($holdings->pluck('total_holdings')) !!},
                        backgroundColor: '#007bff',
                        borderColor: '#0056b3',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw.toLocaleString()} BTC`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
