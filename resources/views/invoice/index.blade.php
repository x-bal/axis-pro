@extends('layouts.app')

@section('content')
<div class="row">
    @if (count($errors) > 0)
    <div class="col-md-12">
        <div class="alert alert-danger">
            <h5 class="text-center">input validation error</h5>
            <ol>
                @foreach ($errors->all() as $error)
                <li><strong> {{ $error }} </strong></li>
                @endforeach
            </ol>
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5" style="font-size: 18px;">
                    <div>
                        {{ __('Invoice List') }}
                    </div>
                    @can('invoice-access')
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pen"> Create
                    </button> -->
                    <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable"><i class="fas fa-pen"></i> Create</button>
                    </div>

                    @endcan
                </div>

                <div class="table-responsive">
                    @if(auth()->user()->hasRole('admin'))
                    <form action="{{ route('invoice.laporan') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" name="from" id="from" class="form-control @error('from') is-invalid @enderror">
                                    @error('from')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" name="to" id="to" class="form-control @error('to') is-invalid @enderror">
                                    @error('to')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Laporan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif

                    <table class="table table-striped table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th>No</th>
                                <th>Insurance</th>
                                <th>Case</th>
                                <th>No Invoice</th>
                                <th>Tanggal Invoice</th>
                                <th>Tanggal Jatuh Invoice</th>
                                <th>Bank</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice as $inv)
                            <tr>
                                <td></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inv->member->name }}</td>
                                <td>{{ $inv->caselist->file_no }}</td>
                                <td>{{ $inv->no_invoice }}</td>
                                <td>{{ $inv->date_invoice }}</td>
                                <td>{{ $inv->due_date }}</td>
                                <td>{{ $inv->bank->bank_name ?? 'Kosong' }}</td>
                                <td>{{ number_format($inv->grand_total) }}</td>
                                <td>
                                    <span class="badge badge-{{ $inv->status_paid == 1 ? 'success' : 'danger' }} p-1">{{ $inv->status_paid == 1 ? 'Paid' : 'Unpaid' }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm text-white" data-toggle="modal" onclick="konfirmasi(this)" data-id="{{ $inv->id }}" data-target="#KonfirmasiModal">Konfirmasi</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="KonfirmasiModal" role="dialog" aria-labelledby="KonfirmasiModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" style="overflow: auto;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="KonfirmasiModalTitle">Confirm Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <form action="" id="TheFormConfirm" method="post"></form>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Id</label>
                                <input type="text" class="form-control" readonly name="id_invoice" id="id_invoice">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Type Bank">Type Bank</label>
                                <select class="form-control" name="bank" id="bank">
                                    @foreach($bank as $list)
                                    <option value="{{ $list->id }}">{{ $list->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Type Bank">Status</label>
                                <select class="form-control" name="status_invoice" id="status_invoice">
                                    <option value="1">Paid</option>
                                    <option value="0">Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="store()" data-primary>Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" style="overflow: auto;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Create Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <form action="{{ route('invoice.store') }}" method="post" id="TheHolyForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_case">No Case</label>
                                    <br>
                                    <select name="no_case" id="no_case" class="form-control" onchange="OnSelect(this)">
                                        {{-- <option selected disabled>-- Select Case --</option>
                                            @foreach($caselist as $data)
                                            <option value="{{ $data->id }}">{{ $data->file_no }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="claim_amount">Claim Amount</label>
                                    <input type="text" required id="claim_amount" class="form-control" readonly>
                                    <span class="badge badge-info text-light" id="claim_amount_badge"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="adjusted">Adjusted</label>
                                    <input type="text" required id="adjusted" class="form-control" readonly>
                                    <span class="badge badge-success" id="ForAdjusted"></span>
                                    <span class="badge badge-info" id="ForCategory"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fee_based">Fee Based</label>
                                    <input type="text" required id="fee_based" name="fee_based" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Expense</label>
                                    <input type="text" required id="expense" class="form-control" readonly>
                                    <span class="badge badge-info text-light" id="expense_badge"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">PPN</label>
                                    <input type="text" required id="share" class="form-control" readonly>
                                    <span class="badge badge-primary" id="ForPercent"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Total</label>
                                    <input type="text" required id="total" class="form-control" name="total" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Date Invoice</label>
                                    <input type="date" id="date_invoice" class="form-control" name="date_invoice">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="bg-primary text-light">
                                        <tr>
                                            <th>Member</th>
                                            <th>Member Share</th>
                                            <th>No Invoice</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="forLoop">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="Currency()">Currency</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="FormSubmit()" class="btn btn-primary" data-primary>Save changes</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal- {
        overflow-y: scroll !important;
    }
</style>
@stop

@section('footer')
<script>
    function konfirmasi(id) {
        $(`#no_case`).select2({
            placeholder: 'Select Product',
            ajax: {
                url: `/api/autocomplete`,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $('#id_invoice').val($(id).attr('data-id'))
    }

    function store() {
        $.ajax({
            url: '/api/invoice/post',
            data: {
                id: $('#id_invoice').val(),
                bank: $('#bank').val(),
                status: $('#status_invoice').val()
            },
            method: 'post',
            success: function(data) {
                console.log(data)
                location.reload()
            }
        })
    }
    $(`#no_case`).select2({
        placeholder: 'Select Product',
        ajax: {
            url: `/api/autocomplete`,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    async function GetTheCaseList() {
        let resource = await fetch('/api/autocomplete').then(data => data.json())
        return resource
    }
    const shedString = (string, separator) => {
        const separatedArray = string.split(separator);
        const separatedString = separatedArray.join("");
        return separatedString;
    }
    const Currency = async function() {
        let resource = await fetch('/api/currency').then(data => data.json())
        let claim_amount = $('#claim_amount').val()
        let expense = $('#expense').val()
        claim_amount = parseInt(shedString(claim_amount, ','))
        expense = parseInt(shedString(expense, ','))
        console.log(claim_amount, expense)
        if ($('#ForAdjusted').html() == 'RP') {
            console.log('RP')
            console.info(claim_amount * resource.kurs, expense / resource.kurs)
            $('#claim_amount_badge').html(`Rp. ${formatter(claim_amount)} -> $ ${formatter(claim_amount / resource.kurs)}`)
            $('#expense_badge').html(`Rp. ${formatter(expense)} -> $ ${formatter(expense / resource.kurs)}`)
        }
        if ($('#ForAdjusted').html() == 'USD') {
            console.log('USD')
            console.info(claim_amount * resource.kurs, expense * resource.kurs)
            $('#claim_amount_badge').html(`$ ${formatter(claim_amount)} -> Rp. ${formatter(claim_amount * resource.kurs)}`)
            $('#expense_badge').html(`$ ${formatter(expense)} -> Rp. ${formatter(expense * resource.kurs)}`)
        }
    }
    const FormSubmit = function() {
        $('#TheHolyForm').submit()
    }
    const formatter = function(num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };

    const GetResource = function(id) {
        return fetch(`/api/caselist/${id}`)
            .then((data) => {
                if (!data.ok) {
                    throw data.statusText;
                }
                return data.json()
            })
    }
    const OnSelect = async function(q) {
        $('#claim_amount').val('')
        $('#adjusted').val('')
        $('#fee_based').val('')
        $('#expense').val('')
        $('#share').val('')
        $('#total').val('')
        $('#forLoop').html('')
        $('#claim_amount_badge').html('')
        $('#expense_badge').html('')
        try {
            let data = await GetResource($(q).val())
            if (data.caselist.category == 1) {
                $('#ForCategory').html('Marine')
            } else {
                $('#ForCategory').html('Non Marine')
            }
            $('#claim_amount').val(formatter(data.sum.claim_amount))
            $('#adjusted').val(formatter(data.sum.adjusted))
            $('#fee_based').val(formatter(data.sum.fee))
            $('#expense').val(formatter(data.expense))
            // $('#share').val(formatter(parseInt(data.sum.fee) + parseInt(data.caselist.expense.amount)))
            let sub_total = parseInt(data.sum.claim_amount) + parseInt(data.sum.fee) + parseInt(data.expense)
            let persen = parseInt(sub_total) * parseInt(data.caselist.insurance.ppn) / 100
            $('#ForPercent').html(`${data.caselist.insurance.name} - ${data.caselist.insurance.ppn}%`)
            $('#ForAdjusted').html(`${data.caselist.currency}`)
            $('#share').val(formatter(persen))
            let total = parseInt(sub_total) + parseInt(persen)
            $('#total').val(formatter(total))
            // $('#forLoop').html('')


            $.each(data.caselist.member, function() {
                $('#forLoop').append(`<tr>` +
                    `<td id=` + this.member_insurance + `_dom>` + TheAjaxFunc(this.member_insurance) + `</td>` +
                    `<td>` + this.share + `</td>` +
                    `<td>` + `<input class="form-control" required name="no_invoice[]">` + `</td>` +
                    `<td>` + formatter(total * parseInt(this.share) / 100) + `</td>` +
                    `</tr>`)
            })
        } catch (err) {
            console.info(err)
            iziToast.error({
                title: 'Error',
                message: `${err}`,
                position: 'topRight',
            });
        }
    }

    function FindTheInsurance(id) {
        return fetch(`/api/insurance/${id}`)
            .then(data => {
                if (!data.ok) {
                    throw data.statusText
                }
                return data.json()
            })
    }

    async function TheAjaxFunc(id) {
        let response = await FindTheInsurance(id)
        $(`#${id}_dom`).html(response.name)
    }

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
            },
            {
                responsivePriority: 2,
                targets: 1
            }
        ]
    })
</script>
@stop