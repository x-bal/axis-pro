@extends('layouts.app')

@section('content')
<style>
    td {
        text-align: center;
        font-size: 10px;
        text-transform: uppercase;
    }
</style>
<div class="row justify-content-center">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5" style="font-size: 18px;">
                    <div>
                        {{ __('Case List') }}
                    </div>
                    <a href="{{ route('case-list.create') }}" class="btn btn-primary"><i class="fas fa-pen"></i> Create</a>
                </div>
                <div class="table-responsive">

                    <table class="table table-bordered table-striped custom-table" width="100%" id="table">
                        <thead style="font-weight: bold;">
                            <tr>
                                <td rowspan="2" class="border-0">Detail</td>
                                <td rowspan="2" class="border" style="text-align: center; align-items: center;">No</td>
                                <td rowspan="2" class="border">File No</td>
                                <td rowspan="2" class="border">Initial Adj</td>
                                <td colspan="3" class="text-center border-0">Insurance</td>
                                <td rowspan="2" class="border">Leader</td>
                                <td rowspan="2" class="border">Insured</td>
                                <td rowspan="2" class="border">DOL</td>
                                <td rowspan="2" class="border">Risk Location / Project</td>
                                <td rowspan="2" class="border">Cause of Lost</td>
                                <!-- <td rowspan="2" class="border">Claim of Amount</td>
                            <td rowspan="2" class="border">Instruction Date</td> -->
                                <td rowspan="2" class="border">Status</td>
                                <td rowspan="2" class="border">Action</td>
                            </tr>
                            <tr>
                                <td class="border">Name</td>
                                <td class="border">Share</td>
                                <td class="border">Leader / Member</td>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    let table = new DataTable('#table', {
        processing: true,
        serverSide: true,
        ajax: "{{ route('case-list.index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'fileno',
                name: 'fileno'
            },
            {
                data: 'initial',
                name: 'initial'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'share',
                name: 'share'
            },
            {
                data: 'is_leader',
                name: 'is_leader'
            },
            {
                data: 'leader',
                name: 'leader'
            },
            {
                data: 'insured',
                name: 'insured'
            },
            {
                data: 'dol',
                name: 'dol'
            },
            {
                data: 'risk_location',
                name: 'risk_location'
            },
            {
                data: 'cause',
                name: 'cause'
            },
            {
                data: 'status',
                name: 'status'
            },
            // {
            //     data: 'adjuster',
            //     name: 'adjuster'
            // },
            {
                data: 'action',
                name: 'action',

            },

        ],
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [{
            className: 'dtr-control',
            responsivePriority: 1,
            targets: 0
        }, {
            responsivePriority: 2,
            targets: 1
        }],
        orderable: true,
        searchable: true
    });
</script>
@stop