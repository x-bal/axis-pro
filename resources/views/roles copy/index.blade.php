@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('Permission List') }}
                <a href="{{ route('permission.create') }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('permission.edit', $role->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('permission.destroy', $role->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
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