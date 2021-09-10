<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="file_no">File No</label>
            <input name="file_no" id="file_no" type="text" value="{{ $caselist->file_no ?? '' }}" class="form-control @error('file_no') is-invalid @enderror">
            @error('file_no')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="insurance">Insurance</label>
            <select name="insurance" autocomplete="on" id="insurance" class="form-control @error('insurance') is-invalid @enderror">
                @foreach($client as $data)
                <option @if($data->id == $caselist->insurance_id) selected @endif value="{{ $data->id }}">{{ $data->brand }} - {{ $data->name }}</option>
                @endforeach
            </select>
            @error('insurance')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="adjuster">Adjuster</label>
            <select name="adjuster" id="adjuster" class="form-control @error('adjuster') is-invalid @enderror">
                @foreach($user as $data)
                <option @if($data->id == $caselist->adjuster_id) selected @endif value="{{ $data->id }}">{{ $data->nama_lengkap }}</option>
                @endforeach
            </select>
            @error('adjuster')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="insured">Insured</label>
            <input type="text" id="insured" value="{{ $caselist->insured }}" name="insured" class="form-control @error('insured') is-invalid @enderror">
            @error('insured')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="dol">dol</label>
            <input type="date" value="{{ $caselist->dol ?? '' }}" id="dol" name="dol" class="form-control @error('dol') is-invalid @enderror">
            @error('dol')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="risk_location">risk location</label>
            <input type="text" id="risk_location" value="{{ $caselist->risk_location }}" name="risk_location" class="form-control @error('risk_location') is-invalid @enderror">
            @error('risk_location')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="currency">Currency</label>
            <select class="form-control @error('currency') is-invalid @enderror" name="currency" id="currency">
                <option @if($caselist->currency == 'RP') selected @endif value="RP">RP</option>
                <option @if($caselist->currency == 'USD') selected @endif value="USD">USD</option>
            </select>
            @error('currency')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="broker">Broker</label>
            <select class="form-control @error('broker') is-invalid @enderror" name="broker" id="broker">
                @foreach($broker as $data)
                <option @if($data->id == $caselist->broker_id) selected @endif value="{{ $data->id }}">{{ $data->nama_broker }}</option>
                @endforeach
            </select>
            @error('broker')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="incident">incident</label>
            <select class="form-control @error('incident') is-invalid @enderror incident" name="incident" id="incident">
                @foreach($incident as $data)
                <option @if($data->id == $caselist->incident_id) selected @endif value="{{ $data->id }}">{{ $data->type_incident }}</option>
                @endforeach
            </select>
            @error('incident')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="policy">policy</label>
            <select class="form-control @error('policy') is-invalid @enderror" name="policy" id="policy">
                @foreach($policy as $data)
                <option @if($data->id == $caselist->policy_id) selected @endif value="{{ $data->id }}">{{ $data->type_policy }}</option>
                @endforeach
            </select>
            @error('policy')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="leader">Leader</label>
            <input class="form-control @error('leader') is-invalid @enderror" value="{{ $caselist->leader ?? '' }}" name="leader" id="leader" type="text">
            @error('leader')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="begin">begin</label>
            <input class="form-control @error('begin') is-invalid @enderror" value="{{ $caselist->begin }}" name="begin" id="begin" type="date">
            @error('begin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="end">end</label>
            <input class="form-control @error('end') is-invalid @enderror" value="{{ $caselist->end }}" name="end" id="end" type="date">
            @error('end')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="">LEADER / MEMBER <span id="total" name="total" class="badge badge-primary">{{ $caselist->member->sum('share') }}</span><strong>%</strong></label>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Member Share</th>
                            <th>Status</th>
                            <th class="text-center">
                                <a onclick="AddForm()" class="btn btn-outline-success" id="add">Add Member</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dynamic_form">
                        @foreach($caselist->member as $row)
                        <tr>
                            <td>
                                <div class="form-group">
                                    <select name="member[{{ $row->id }}]" id="member_{{ $row->id }}" class="form-control">
                                        @foreach($client as $data)
                                        <option @if($data->id == $row->member_insurance) selected @endif value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <input type="number" name="percent[{{ $row->id }}]" value="{{ $row->share ?? '' }}" oninput="LetMeHereToCount(this)" class="form-control percent">
                                        <span class="input-group-text" id="basic-addon3">%</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="status[{{ $row->id }}]" id="status" class="form-control">
                                        <option @if($row->is_leader) selected @endif value="LEADER">LEADER</option>
                                        <option @if(!$row->is_leader) selected @endif value="MEMBER">MEMBER</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a onclick="DeleteForm(this)" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <script>
                            setTimeout(function() {
                                $('#member_{{ $row->id }}').select2()
                            }, 500)
                        </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>