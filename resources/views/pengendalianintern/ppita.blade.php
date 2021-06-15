@extends('app', ['title' => 'PPITA'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('pengendalian-internal.pi-component', ['modul' => 'PPITA'])
        </div>
    </div>
</div>
@endsection
