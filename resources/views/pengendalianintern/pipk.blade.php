@extends('app', ['title' => 'PIPK'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('pengendalian-internal.pi-component', ['modul' => 'PIPK'])
        </div>
    </div>
</div>
@endsection
