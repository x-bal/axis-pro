@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="font-size: 18px;">
                {{ __('Edit Permission') }}
                <a href="{{ route('permission.index') }}" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.update', $permission->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    @include('permission.form')
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection