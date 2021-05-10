@extends('app', ['title' => 'Pengaduan'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('pengaduan.pengaduan-component')
        </div>
    </div>
</div>
@endsection
