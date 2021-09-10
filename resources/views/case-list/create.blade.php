@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('Create Case') }}
                <a href="{{ route('case-list.index') }}" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('case-list.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('case-list.form')
                    <button type="submit" class="btn btn-primary float-right">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#incident').select2();
            $('#policy').select2();
            $('#broker').select2();
            $('#adjuster').select2();
            $('#insurance').select2();
        }, 1000)
    })


    function form_dinamic() {
        let index = $('#dynamic_form tr').length + 1
        let template = `
            <tr>
                <td>
                    <div class="form-group">
                        <select name="member[${index}]" id="member_${index}" class="form-control">
                                @foreach($client as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="input-group-prepend">
                                <input type="number" name="percent[${index}]" oninput="LetMeHereToCount(this)" class="form-control percent">
                                <span class="input-group-text" id="basic-addon3">%</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <select name="status[${index}]" id="status" class="form-control">
                                <option value="LEADER">LEADER</option>
                                <option value="MEMBER">MEMBER</option>
                            </select>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a onclick="DeleteForm(this)" class="btn btn-outline-danger">Delete</a>
                    </div>
                </td>
            </tr>
    `
        $('#dynamic_form').append(template)

        setTimeout(function() {
            $(`#member_${index}`).select2();
        }, 500)
    }

    function LetMeHereToCount(qr) {
        let input = $(qr).val()
        let coll = document.querySelectorAll('.percent')
        let total = 0
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            total += parseInt(ele.value)
        }
        if (total > 100) {
            $('#submit_case_list').addClass('disabled')
            $('#add').addClass('disabled')
            $('#total').html('Lebih')
        } else {
            $('#submit_case_list').removeClass('disabled')
            $('#add').removeClass('disabled')
            $('#total').html(total)
        }
    }

    function AddForm() {
        event.preventDefault()
        form_dinamic()
    }

    function DeleteForm(qr) {
        event.preventDefault()
        $(qr).parent().parent().parent().remove()
        LetMeHereToCount()
    }
</script>
@stop