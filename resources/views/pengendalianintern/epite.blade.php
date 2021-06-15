@extends('app', ['title' => 'EPITE'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('pengendalian-internal.pi-component', ['modul' => 'EPITE'])
        </div>
    </div>
</div>
@endsection
