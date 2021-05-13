@extends('app', ['title' => 'Piagam Risiko'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('manajemen-risiko.piagam-risiko-component')
        </div>
    </div>
</div>
@endsection
