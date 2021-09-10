@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('Type Of Business List') }}
                <a href="{{ route('type-of-business.create') }}" class="btn btn-primary float-right"><i class="fas fa-pen"></i> Create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type Policy</th>
                            <th>Abbreviation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policies as $policy)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $policy->type_policy }}</td>
                            <td>{{ $policy->abbreviation }}</td>
                            <td>
                                <a href="{{ route('type-of-business.edit', $policy->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('type-of-business.destroy', $policy->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
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