@extends('app', ['title' => 'Mitigasi Risiko'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('manajemen-risiko.mitigasi-risiko-component')
        </div>
    </div>
</div>
@endsection
