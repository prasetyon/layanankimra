@extends('app', ['title' => 'Pengawasan'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('aparatpemeriksa.pengawasan-component')
        </div>
    </div>
</div>
@endsection
