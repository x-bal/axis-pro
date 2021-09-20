@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

</div> -->
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card">
                <div class=" card-body bg-danger">
                    <i class="fas fa-file-alt fa-4x text-white"></i>
                    <div class="float-right">
                        <div class="text-white">
                            <h1 style="font-size: 50px; font-weight: bold; margin-left: 30px; margin-bottom: -10px;">4</h1>
                            <span>Report 1</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span>Detail</span>
                    <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class=" card-body bg-primary">
                    <i class="fas fa-file-alt fa-4x text-white"></i>
                    <div class="float-right">
                        <div class="text-white">
                            <h1 style="font-size: 50px; font-weight: bold; margin-left: 30px; margin-bottom: -10px; ">4</h1>
                            <span>Report 2</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span>Detail</span>
                    <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class=" card-body bg-success">
                    <i class="fas fa-file-alt fa-4x text-white"></i>
                    <div class="float-right">
                        <div class="text-white">
                            <h1 style="font-size: 50px; font-weight: bold; margin-left: 30px; margin-bottom: -10px;">4</h1>
                            <span>Report 3</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span>Detail</span>
                    <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class=" card-body bg-info">
                    <i class="fas fa-file-alt fa-4x text-white"></i>
                    <div class="float-right">
                        <div class="text-white">
                            <h1 style="font-size: 50px; font-weight: bold; margin-left: 30px; margin-bottom: -10px;">4</h1>
                            <span>Report 4</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span>Detail</span>
                    <span class="float-right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection