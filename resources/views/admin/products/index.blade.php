@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content_header')
    <h1 class="m-0 text-dark">Kelola Produk Membership</h1>
@stop

@section('content')
<style>
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    #products-table thead th {
        vertical-align: middle;
    }

    #products-table tbody tr:hover {
        background-color: rgba(0, 0, 0, .02);
    }

    .btn-group-sm>.btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.765625rem;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Produk Membership</h3>
                    <div class="card-tools">
                        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Produk
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="products-table" class="table table-bordered table-hover table-striped">
                            <thead class="bg-primary">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Tipe</th>
                                    <th>Durasi (Hari)</th>
                                    <th>Harga (USD)</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $item->type == 'news' ? 'bg-info' : 'bg-primary' }}">
                                                {{ ucfirst($item->type) }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $item->duration }}</td>
                                        <td class="text-right">${{ number_format($item->price_usd, 2) }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning"
                                                    title="Edit" data-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                                    style="display:inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                                        title="Hapus" data-toggle="tooltip">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total:</th>
                                    <th class="text-right"></th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
<script>
    $(function() {
        // Initialize DataTable
        $('#products-table').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            "columnDefs": [{
                    "orderable": false,
                    "targets": [6]
                },
                {
                    "className": "text-center",
                    "targets": [0, 2, 3, 5, 6]
                },
                {
                    "className": "text-right",
                    "targets": [4]
                }
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                // Total over all pages
                var total = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return parseFloat(a) + parseFloat(b.replace(/[^\d.]/g, ''));
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(
                    '$' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                );
            }
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
