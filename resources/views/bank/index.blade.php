@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5" style="font-size: 18px;">
                    <div>
                        {{ __('Bank List') }}
                    </div>
                    <a href="{{ route('bank.create') }}" class="btn btn-primary"><i class="fas fa-pen"></i> Create</a>
                </div>
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bank Name</th>
                            <th>No Account</th>
                            <th>Currency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banks as $bank)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bank->bank_name }}</td>
                            <td>{{ $bank->no_account }}</td>
                            <td>{{ $bank->currency }}</td>
                            <td>
                                <a href="{{ route('bank.edit', $bank->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('bank.destroy', $bank->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
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

@section('footer')
<script>
    $('.table').DataTable()
</script>
@stop