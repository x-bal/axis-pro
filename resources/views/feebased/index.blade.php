@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5" style="font-size: 18px;">
                    <div>
                        {{ __('Fee Base List') }}
                    </div>
                    <a href="{{ route('fee-based.create') }}" class="btn btn-primary"><i class="fas fa-pen"></i> Create</a>
                </div>
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Adjusted IDR</th>
                            <th>Adjusted USD</th>
                            <th>Fee IDR</th>
                            <th>Fee USD</th>
                            <th>Category Fee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feebased as $fee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fee->adjusted_idr }}</th>
                            <td>{{ $fee->adjusted_usd }}</th>
                            <td>{{ $fee->fee_idr }}</th>
                            <td>{{ $fee->fee_usd }}</th>
                            <td>{{ $fee->category_fee }}</th>
                            <td>
                                <a href="{{ route('fee-based.edit', $fee->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('fee-based.destroy', $fee->id) }}" method="post" style="display: inline;" onclick="return confirm('Delete data?')">
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