@extends('app', ['title' => 'Profil Risiko'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('manajemen-risiko.profil-risiko-component')
        </div>
    </div>
</div>
@endsection
