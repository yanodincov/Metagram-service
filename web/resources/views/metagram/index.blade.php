@extends('layouts.app', [
    'title' => 'Метраграммы'
])

@section('content')
    <div class="container" style="height: 100vh">
        <div class="row h-100">
            <div class="col-12  h-100 d-flex justify-content-center align-items-center">
                <div class="w-50">
                    <metagram-manager-component></metagram-manager-component>
                </div>
            </div>
        </div>
    </div>
@endsection