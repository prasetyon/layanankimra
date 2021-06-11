@extends('app', ['title' => 'Jenis Pengawasan'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('aparatpemeriksa.jenis-pengawasan-component')
        </div>
    </div>
</div>
@endsection
