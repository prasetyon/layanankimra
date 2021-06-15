@extends('app', ['title' => 'Monitoring Tinjut'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('aparatpemeriksa.tinjut-component')
        </div>
    </div>
</div>
@endsection
