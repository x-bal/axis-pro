@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('User List') }}
                <a href="{{ route('users.create') }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
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