<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div>
                <h1>Laporan Case List</h1>
            </div>
        </div>
        <br>
        <form action="{{ route('caselist.excel') }}" method="post">
            @csrf
            <div class="card">
                <div class="btn-group">
                    <a href="{{ route('case-list.index') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">Excel</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="from">from</label>
                                <input type="date" id="from" name="from" class="form-control" readonly value="{{ $from }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="to">to</label>
                                <input type="date" id="to" name="to" value="{{ $to }}" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">status</label>
                                <input type="text" id="status" name="status" value="{{ $status }}" readonly class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="table">
                    <thead>
                        <th>id</th>
                        <th>file no</th>
                        <th>insurance id</th>
                        <th>adjuster id</th>
                        <th>broker id</th>
                        <th>incident id</th>
                        <th>policy id</th>
                        <th>category</th>
                        <th>insured</th>
                        <th>risk location</th>
                        <th>currency</th>
                        <th>leader</th>
                        <th>begin</th>
                        <th>end</th>
                        <th>dol</th>
                        <th>no leader policy</th>
                        <th>leader claim no</th>
                        <th>instruction date</th>
                        <th>survey date</th>
                        <th>now update</th>
                        <th>ia date</th>
                        <th>ia amount</th>
                        <th>ia status</th>
                        <th>pr date</th>
                        <th>pr amount</th>
                        <th>pr status</th>
                        <th>ir status</th>
                        <th>ir st date</th>
                        <th>ir st amount</th>
                        <th>ir st status</th>
                        <th>ir nd date</th>
                        <th>ir nd amount</th>
                        <th>ir nd status</th>
                        <th>pa date</th>
                        <th>pa amount</th>
                        <th>pa status</th>
                        <th>fr date</th>
                        <th>fr amount</th>
                        <th>fr status</th>
                        <th>claim amount</th>
                        <th>fee idr</th>
                        <th>fee usd</th>
                        <th>wip idr</th>
                        <th>wip usd</th>
                        <th>remark</th>
                        <th>file status id</th>
                    </thead>
                    <tbody>
                        @foreach($case as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->file_no }}</td>
                            <td>{{ $data->insurance_id }}</td>
                            <td>{{ $data->adjuster_id }}</td>
                            <td>{{ $data->broker_id }}</td>
                            <td>{{ $data->incident_id }}</td>
                            <td>{{ $data->policy_id }}</td>
                            <td>{{ $data->category }}</td>
                            <td>{{ $data->insured }}</td>
                            <td>{{ $data->risk_location }}</td>
                            <td>{{ $data->currency }}</td>
                            <td>{{ $data->leader }}</td>
                            <td>{{ $data->begin }}</td>
                            <td>{{ $data->end }}</td>
                            <td>{{ $data->dol }}</td>
                            <td>{{ $data->no_leader_policy }}</td>
                            <td>{{ $data->leader_claim_no }}</td>
                            <td>{{ $data->instruction_date }}</td>
                            <td>{{ $data->survey_date }}</td>
                            <td>{{ $data->now_update }}</td>
                            <td>{{ $data->ia_date }}</td>
                            <td>{{ $data->ia_amount }}</td>
                            <td>{{ $data->ia_status }}</td>
                            <td>{{ $data->pr_date }}</td>
                            <td>{{ $data->pr_amount }}</td>
                            <td>{{ $data->pr_status }}</td>
                            <td>{{ $data->ir_status }}</td>
                            <td>{{ $data->ir_st_date }}</td>
                            <td>{{ $data->ir_st_amount }}</td>
                            <td>{{ $data->ir_st_status }}</td>
                            <td>{{ $data->ir_nd_date }}</td>
                            <td>{{ $data->ir_nd_amount }}</td>
                            <td>{{ $data->ir_nd_status }}</td>
                            <td>{{ $data->pa_date }}</td>
                            <td>{{ $data->pa_amount }}</td>
                            <td>{{ $data->pa_status }}</td>
                            <td>{{ $data->fr_date }}</td>
                            <td>{{ $data->fr_amount }}</td>
                            <td>{{ $data->fr_status }}</td>
                            <td>{{ $data->claim_amount }}</td>
                            <td>{{ $data->fee_idr }}</td>
                            <td>{{ $data->fee_usd }}</td>
                            <td>{{ $data->wip_idr }}</td>
                            <td>{{ $data->wip_usd }}</td>
                            <td>{{ $data->remark }}</td>
                            <td>{{ $data->file_status_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script>
        $('#table').DataTable({
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
            orderable: false,
            searchable: false,
            searching: false,
            paginate: false
        })
    </script>
</body>

</html>