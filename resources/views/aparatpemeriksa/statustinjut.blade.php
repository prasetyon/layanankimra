@extends('app', ['title' => 'Status Tinjut'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('aparatpemeriksa.status-tinjut-component')
        </div>
    </div>
</div>
@endsection
