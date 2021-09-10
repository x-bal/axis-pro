@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('Broker List') }}
                <a href="{{ route('broker.create') }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Broker Name</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brokers as $broker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $broker->nama_broker }}</td>
                            <td>{{ $broker->telepon_broker }}</td>
                            <td>{{ $broker->email_broker }}</td>
                            <td>{{ $broker->alamat_broker }}</td>
                            <td>
                                <a href="{{ route('broker.edit', $broker->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('broker.destroy', $broker->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
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