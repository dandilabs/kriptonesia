@extends('layouts.member')

@section('content')
    <style>
        .index-container {
            max-width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .index-value {
            font-size: 5rem;
            font-weight: bold;
            line-height: 1;
        }

        .index-label {
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }

        .index-updated {
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        /* Styling Gauge Chart */
        #fearGreedGauge {
            max-width: 350px;
            margin: 30px auto 0 auto;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Fear & Greed Index</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Fear & Greed Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-2"></i>
                                Crypto Fear & Greed Index
                            </h3>
                        </div>

                        <div class="card-body text-center">
                            @if ($indices->count() > 0)
                                @php $latest = $indices->first(); @endphp

                                <div class="index-container">
                                    {{-- Speedometer Gauge --}}
                                    <div id="fearGreedGauge"></div>

                                    <div
                                        class="index-value
                                        @if ($latest->value <= 25) text-danger
                                        @elseif($latest->value <= 45) text-warning
                                        @elseif($latest->value <= 55) text-info
                                        @elseif($latest->value <= 75) text-success
                                        @else text-primary @endif">
                                        {{ $latest->value }}
                                    </div>

                                    <div class="index-label font-weight-bold">
                                        {{ $latest->label }}
                                    </div>

                                    <div class="index-updated">
                                        Updated: {{ $latest->timestamp->format('d M Y H:i') }}
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h4 class="font-weight-bold mb-3">Recent Data Points</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Value</th>
                                                    <th>Sentiment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($indices->take(5) as $index)
                                                    <tr>
                                                        <td>{{ $index->timestamp->format('d M H:i') }}</td>
                                                        <td class="font-weight-bold">{{ $index->value }}</td>
                                                        <td>
                                                            <span
                                                                class="badge
                                                                @if ($index->value <= 25) badge-danger
                                                                @elseif($index->value <= 45) badge-warning
                                                                @elseif($index->value <= 55) badge-info
                                                                @elseif($index->value <= 75) badge-success
                                                                @else badge-primary @endif">
                                                                {{ $index->label }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-chart-pie fa-3x mb-3 text-muted"></i>
                                    <p class="text-muted">No fear and greed index data available.</p>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer text-center">
                            <small class="text-muted">
                                Data source: Alternative.me
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ApexCharts Gauge Script --}}
    @if ($indices->count() > 0)
        <script>
            var options = {
                chart: {
                    type: 'radialBar',
                    height: 350,
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 135,
                        hollow: {
                            size: '70%',
                        },
                        dataLabels: {
                            name: {
                                offsetY: -10,
                                fontSize: '20px'
                            },
                            value: {
                                fontSize: '36px',
                                show: false
                            }
                        }
                    }
                },
                series: [{{ $latest->value }}],
                labels: ['{{ $latest->label }}'],
                colors: [
                    @if ($latest->value <= 25)
                        '#e53935'
                    @elseif ($latest->value <= 45)
                        '#fb8c00'
                    @elseif ($latest->value <= 55)
                        '#fdd835'
                    @elseif ($latest->value <= 75)
                        '#43a047'
                    @else
                        '#1e88e5'
                    @endif
                ],
            }

            var chart = new ApexCharts(document.querySelector("#fearGreedGauge"), options);
            chart.render();
        </script>
    @endif
@endsection
