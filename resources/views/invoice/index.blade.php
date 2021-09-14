@extends('layouts.app')

@section('content')
<!-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between p-2">
                    <h5>Invoice Member List</h5>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Invoice
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-light">Id</th>
                                <th class="text-light">Insurance</th>
                                <th class="text-light">Case</th>
                                <th class="text-light">No Inovice</th>
                                <th class="text-light">Tanggal Inovice</th>
                                <th class="text-light">Tanggal Jatuh Invoice</th>
                                <th class="text-light">Amount</th>
                                <th class="text-light">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data}} - {{ $data }}</td>
                                <td>{{ $data->caselist->insured }}</td>
                                <td>{{ $data->caselist->file_no }}</td>
                                <td>{{ $data->caselist->dol }}</td>
                                <td>{{ $data->caselist->end }}</td>
                                <td>{{ $data->share }}</td>
                                <td>{{ $data->is_leader}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5" style="font-size: 18px;">
                    <div>
                        {{ __('Invoice List') }}
                    </div>
                    @can('invoice-access')
                    <a href="{{ route('invoice.create') }}" class="btn btn-primary"><i class="fas fa-pen"></i> Create</a>
                    @endcan
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Insurance</th>
                            <th>Case</th>
                            <th>No Inovice</th>
                            <th>Tanggal Inovice</th>
                            <th>Tanggal Jatuh Invoice</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice as $inv)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inv->caselist }}</td>
                            <td>{{ $inv->caselist }}</td>
                            <td>{{ $inv->caselist }}</td>
                            <td>{{ $inv->caselist }}</td>
                            <td>{{ $inv->caselist }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $(".table").DataTable()
</script>
@stop