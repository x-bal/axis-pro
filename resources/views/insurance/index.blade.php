@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('Insurance List') }}
                <a href="{{ route('insurance.create') }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Brand</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>No Telp</th>
                            <th>Hp</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>PPN</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->brand }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->no_telp }}</td>
                            <td>{{ $client->no_hp }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->status }}</td>
                            <td>{{ $client->ppn }}</td>
                            <td>{{ $client->type }}</td>
                            <td>
                                <a href="{{ route('insurance.edit', $client->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('insurance.destroy', $client->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
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