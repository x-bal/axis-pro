@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-light" style="font-weight: bold;">DETAIL CASE / INSURANCE : {{ $caseList->insurance->name }} / FILE NO : {{ $caseList->file_no }} / INSTRUCTION DATE : // TANGGAL INVOICE : //</div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTabs">
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-assigment' ? 'active bg-primary text-white' : '' }} {{ !request()->get('page') ? 'active bg-primary text-white' : '' }}" href="?page=nav-assigment">Assigment Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-expense' ? 'active bg-primary text-white' : '' }}" href="?page=nav-expense">Expense</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-email' ? 'active bg-primary text-white' : '' }}" href="?page=nav-email">Email Transcript</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-file-survey' ? 'active bg-primary text-white' : '' }}" href="?page=nav-file-survey">File Survey</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-claim-document' ? 'active bg-primary text-white' : '' }}" href="?page=nav-claim-document">Claim Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-report-1' ? 'active bg-primary text-white' : '' }}" href="?page=nav-report-1">Report 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-report-2' ? 'active bg-primary text-white' : '' }}" href="?page=nav-report-2">Report 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-report-3' ? 'active bg-primary text-white' : '' }}" href="?page=nav-report-3">Report 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-report-4' ? 'active bg-primary text-white' : '' }}" href="?page=nav-report-4">Report 4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-tab {{ request()->get('page') == 'nav-report-5' ? 'active bg-primary text-white' : '' }}" href="?page=nav-report-5">Report 5</a>
                    </li>
                </ul>

                <div class="tab-content">
                    @if(request()->get('page') == "nav-assigment" || !request()->get('page'))
                    <div class="tab-pane fade show active mt-3" id="nav-assigmnet" aria-labelledby="nav-assigmnet-tab">
                        <h5 class="mb-3">Assigment info</h5>

                        <table width="200" border="1" class="table table-bordered hurufkecil table-striped" style="font-size: 12px;">
                            <tbody>

                                <tr>
                                    <td width="12%">CURRENT STATUS</td>
                                    <td width="2%">:</td>
                                    <td width="31%">
                                        <select name="kategori" class="form-control kategori">
                                            @foreach($status as $stt)
                                            <option {{ $stt->id == $caseList->file_status_id ? 'selected' : '' }} value="{{ $stt->id }}">{{ $stt->nama_status }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td width="15%">INSURED</td>
                                    <td width="2%">:</td>
                                    <td width="38%">{{ $caseList->insurance->name }}</td>
                                </tr>
                                <tr>
                                    <td width="12%">FILE NO</td>
                                    <td width="2%">:</td>
                                    <td width="31%">{{ $caseList->file_no }}</td>
                                    <td width="15%">INSURED</td>
                                    <td width="2%">:</td>
                                    <td width="38%">{{ $caseList->insurance->name }}</td>
                                </tr>
                                <tr>
                                    <td>INITIAL ADJUSTER</td>
                                    <td>:</td>
                                    <td>{{ $caseList->adjuster->kode_adjuster }} ({{ $caseList->adjuster->nama_lengkap }})</td>
                                    <td>DOL</td>
                                    <td>:</td>
                                    <td>{{ Carbon\Carbon::parse($caseList->dol)->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <td>INSURANCE</td>
                                    <td>:</td>
                                    <td>
                                        @foreach($caseList->member as $member)
                                        <p>{{ $caseList->insurance->name }} ({{ $member->share }})</p>
                                        @endforeach
                                    </td>
                                    <td>LOCATION RISK / PROJECT</td>
                                    <td>:</td>
                                    <td>{{ $caseList->risk_location }}</td>
                                </tr>
                                <tr>
                                    <td>BROKER</td>
                                    <td>:</td>
                                    <td><span class="bg-secondary p-2 text-light">{{ $caseList->broker->nama_broker }}</span> </td>
                                    <td>CAUSE OF LOSS</td>
                                    <td>:</td>
                                    <td>{{ $caseList->incident->description }}</td>
                                </tr>
                                <tr>
                                    <td>TYPE OF BUSINESS</td>
                                    <td>:</td>
                                    <td>{{ $caseList->policy->type_policy }}</td>
                                    <td>LEADER POLICY</td>
                                    <td>:</td>
                                    <td>{{ $caseList->leader }} <br> </td>
                                </tr>
                                <tr>
                                    <td>SURVEY DATE</td>
                                    <td>:</td>
                                    <td>{{ $caseList->begin }}</td>
                                    <td>LEADER CLAIM NO</td>
                                    <td>:</td>
                                    <td>TBA</td>
                                </tr>
                                <tr>
                                    <td>NOW UPDATE</td>
                                    <td>:</td>
                                    <td>{{ $caseList->end }}</td>
                                    <td>AGING (DAY)</td>
                                    <td>:</td>
                                    <td>NOW UPDATE - INSTRUCTION DATE</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <h5>Report Issue</h5>
                        <table width="100%" border="1" class="table table-bordered hurufkecil table-striped" style="font-size: 12px;">
                            <tbody>
                                <tr>
                                    <td colspan="2"><strong>IA</strong></td>
                                    <td width="10%">&nbsp;</td>
                                    <td width="10%">&nbsp;</td>
                                    <td colspan="4"><strong>IR</strong></td>
                                    <td width="6%">&nbsp;</td>
                                    <td width="7%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="7%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="11%">&nbsp;</td>
                                    <td width="12%">&nbsp;</td>
                                    <td><strong>PR</strong></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><strong>1st</strong></td>
                                    <td colspan="2"><strong>2nd</strong></td>
                                    <td colspan="2"><strong>PA</strong></td>
                                    <td colspan="2"><strong>FR</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>DATE</strong></td>
                                    <td><strong>AMOUNT</strong></td>
                                    <td><strong>DATE</strong></td>
                                    <td><strong>AMOUNT</strong></td>
                                    <td width="8%"><strong>DATE</strong></td>
                                    <td width="8%"><strong>AMOUNT</strong></td>
                                    <td width="7%"><strong>DATE</strong></td>
                                    <td width="9%"><strong>AMOUNT</strong></td>
                                    <td><strong>DATE</strong></td>
                                    <td><strong>AMOUNT</strong></td>
                                    <td><strong>DATE</strong></td>
                                    <td><strong>AMOUNT</strong></td>
                                </tr>
                                <tr>
                                    <td>28/01/2021</td>
                                    <td>663,067.241</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>533.451.424.</td>
                                    <td>06/04/2021</td>
                                    <td>533.451.424</td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-expense")
                    <div class="tab-pane fade show active mt-3" id="nav-expense" aria-labelledby="nav-expense-tab">
                        <h5 class="mb-3">Expense list</h5>

                        <table width="200" border="0" class="table table-striped">
                            <form action="" method="post">
                                <tbody>
                                    <tr>
                                        <td width="28%">Upload File</td>
                                        <td width="54%">Category</td>
                                        <td width="6%">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                        <td width="6%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><input type="file"></td>
                                        <td>
                                            <select name="" class="form-control contoh">
                                                <option>Load dari tabel_category_expense</option>
                                            </select>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </form>
                        </table>

                        <table width="100%" height="52" border="0" class="table tabelbelang table-bordered table-striped table-hover" style="font-size:12px;">
                            <tbody>
                                <tr>
                                    <td width="3%">No</td>
                                    <td width="15%">Name</td>
                                    <td width="9%">Category</td>

                                    <td width="10%">Date</td>
                                    <td width="53%">Amount</td>
                                </tr>

                                <tr>
                                    <td height="25">1</td>
                                    <td>Bensin</td>
                                    <td>Meal</td>
                                    <td>20-02-2021</td>
                                    <td>300.000</td>
                                </tr>
                                <tr>
                                    <td height="25">2</td>
                                    <td>Entertainment</td>
                                    <td>Food</td>

                                    <td>21-02-2021 </td>
                                    <td>400.000</td>
                                </tr>
                                <tr>
                                    <td height="25">Total</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>700.000</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-email")
                    <div class="tab-pane fade show active mt-3" id="nav-email" aria-labelledby="nav-email-tab">
                        <h5 class="mb-3">Email Transcript</h5>
                        "******"
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-file-survey")
                    <div class="tab-pane fade show active mt-3" id="nav-file-survey" aria-labelledby="nav-file-survey-tab">
                        <h5 class="mb-3">File survey </h5>

                        <form action="{{ route('file-survey.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-survey">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">

                                            @error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            @error('time_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><button type="button" class="btn btn-success plus-survey"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>


                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>No</td>
                                    <td>File Name</td>
                                    <td width="">Upload date</td>
                                    <td>File size</td>
                                    <!-- <td>Action</td> -->
                                </tr>
                                @foreach($caseList->filesurvey as $filesurvey)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/file-survey/', '', $filesurvey->file_upload) }}</td>
                                    <td>{{ $filesurvey->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($filesurvey->file_upload) / 102400,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-claim-document")
                    <div class="tab-pane fade show active mt-3" id="nav-claim-document" aria-labelledby="nav-claim-document-tab">
                        <h5 class="mb-3">Claim Document </h5>

                        <form action="{{ route('claim-document.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-claim">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">
                                            @error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                                        <td><button type="button" class="btn btn-success plus-claim"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>

                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="49">No</td>
                                    <td>File Name</td>
                                    <td>Upload date</td>
                                    <td>File size</td>
                                    <!-- <td width="280">Action</td> -->
                                </tr>
                                @foreach($caseList->claimdocuments as $claimdocument)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/claim-document/', '', $claimdocument->file_upload) }}</td>
                                    <td>{{ $claimdocument->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($claimdocument->file_upload) / 1048576,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-report-1")
                    <div class="tab-pane fade show active mt-3" id="nav-report-1" aria-labelledby="nav-report-1-tab">
                        <h5 class="mb-3">Report 1 </h5>

                        <form action="{{ route('report-satu.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-1">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">@error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                                        <td><button type="button" class="btn btn-success plus-1"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>

                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="49">No</td>
                                    <td>File Name</td>
                                    <td>Upload date</td>
                                    <td>File size</td>
                                    <!-- <td width="280">Action</td> -->
                                </tr>
                                @foreach($caseList->reportsatu as $reportsatu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/report-satu/', '', $reportsatu->file_upload) }}</td>
                                    <td>{{ $reportsatu->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($reportsatu->file_upload) / 1048576,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- <div class="row">
                            <div class="col-md-3">
                                <select name="status" class="form-control my-3">
                                    <option>OUTSTANDING</option>
                                    <option>CLOSED</option>
                                </select>
                            </div>
                        </div> -->

                    </div>
                    @endif

                    @if(request()->get('page') == "nav-report-2")
                    <div class="tab-pane fade show active mt-3" id="nav-report-2" aria-labelledby="nav-report-2-tab">
                        <h5 class="mb-3">Report 2 </h5>

                        <form action="{{ route('report-dua.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-2">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">

                                            @error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                                        <td><button type="button" class="btn btn-success plus-2"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>

                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="49">No</td>
                                    <td>File Name</td>
                                    <td>Upload date</td>
                                    <td>File size</td>
                                    <!-- <td width="280">Action</td> -->
                                </tr>
                                @foreach($caseList->reportdua as $reportdua)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/report-dua/', '', $reportdua->file_upload) }}</td>
                                    <td>{{ $reportdua->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($reportdua->file_upload) / 1048576,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-report-3")
                    <div class="tab-pane fade show active mt-3" id="nav-report-3" aria-labelledby="nav-report-3-tab">
                        <h5 class="mb-3">Report 3 </h5>

                        <form action="{{ route('report-tiga.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-3">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">
                                            @error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                                        <td><button type="button" class="btn btn-success plus-3"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>

                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="49">No</td>
                                    <td>File Name</td>
                                    <td>Upload date</td>
                                    <td>File size</td>
                                    <!-- <td width="280">Action</td> -->
                                </tr>
                                @foreach($caseList->reporttiga as $reporttiga)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/report-tiga/', '', $reporttiga->file_upload) }}</td>
                                    <td>{{ $reporttiga->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($reporttiga->file_upload) / 1048576,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-report-4")
                    <div class="tab-pane fade show active mt-3" id="nav-report-4" aria-labelledby="nav-report-4-tab">
                        <h5 class="mb-3">Report 4 </h5>

                        <form action="{{ route('report-empat.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-4">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">
                                            @error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                                        <td><button type="button" class="btn btn-success plus-4"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>

                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="49">No</td>
                                    <td>File Name</td>
                                    <td>Upload date</td>
                                    <td>File size</td>
                                    <!-- <td width="280">Action</td> -->
                                </tr>
                                @foreach($caseList->reportempat as $reportempat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/report-empat/', '', $reportempat->file_upload) }}</td>
                                    <td>{{ $reportempat->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($reportempat->file_upload) / 1048576,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(request()->get('page') == "nav-report-5")
                    <div class="tab-pane fade show active mt-3" id="nav-report-5" aria-labelledby="nav-report-5-tab">
                        <h5 class="mb-3">Report 5 </h5>

                        <form action="{{ route('report-lima.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table width="658" border="0" class="table table-5">
                                <tbody>
                                    <tr>
                                        <td width="197">File Upload</td>
                                        <td width="214">Time Upload</td>
                                        <td width="822">Add new</td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="case_list_id" value="{{ $caseList->id }}">
                                        <td>
                                            <input type="file" name="file_upload[]">
                                            @error('file_upload')
                                            <br>
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td><input type="date" name="time_upload" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                                        <td><button type="button" class="btn btn-success plus-5"><i class="fas fa-plus"></i></button></td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td><input type="submit" class="btn btn-success" value="Upload"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>

                        <table width="265" border="0" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="49">No</td>
                                    <td>File Name</td>
                                    <td>Upload date</td>
                                    <td>File size</td>
                                    <!-- <td width="280">Action</td> -->
                                </tr>
                                @foreach($caseList->reportlima as $reportlima)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_replace('files/report-lima/', '', $reportlima->file_upload) }}</td>
                                    <td>{{ $reportlima->time_upload }}</td>
                                    <td>{{ number_format(Storage::size($reportlima->file_upload) / 1048576,2)  }} MB</td>
                                    <!-- <td>&nbsp;</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                <div class="button">
                    <a href="{{ route('case-list.index') }}" class="btn btn-success">Kembali</a>
                    <a href="#" class="btn btn-primary">Cetak Invoice</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script src="https://code.jquery.com/jquery-1.7.2.min.js" integrity="sha256-R7aNzoy2gFrVs+pNJ6+SokH04ppcEqJ0yFLkNGoFALQ=" crossorigin="anonymous"></script>

<script>
    let tr = `<tr>
                <td><input type="file" name="file_upload[]"></td>
                <td><input type="date" name="time_upload" class="form-control" id="" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"></td>
                <td><button type="button" class="btn btn-danger remove-survey"><i class="fas fa-times"></i></button></td>
            </tr>`;

    $(".plus-survey").on('click', function() {
        $(".table-survey").append(tr)
    })

    $(".plus-claim").on('click', function() {
        $(".table-claim").append(tr)
    })

    $(".plus-1").on('click', function() {
        $(".table-1").append(tr)
    })

    $(".plus-2").on('click', function() {
        $(".table-2").append(tr)
    })

    $(".plus-3").on('click', function() {
        $(".table-3").append(tr)
    })

    $(".plus-4").on('click', function() {
        $(".table-4").append(tr)
    })

    $(".plus-5").on('click', function() {
        $(".table-5").append(tr)
    })

    $(".remove-survey").live('click', function() {
        $(this).parent().parent().remove();
    })
    $(".remove-claim").live('click', function() {
        $(this).parent().parent().remove();
    })
    $(".remove-1").live('click', function() {
        $(this).parent().parent().remove();
    })
    $(".remove-2").live('click', function() {
        $(this).parent().parent().remove();
    })
    $(".remove-3").live('click', function() {
        $(this).parent().parent().remove();
    })
    $(".remove-4").live('click', function() {
        $(this).parent().parent().remove();
    })
    $(".remove-5").live('click', function() {
        $(this).parent().parent().remove();
    })
</script>
@stop