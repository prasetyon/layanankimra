@extends('app', ['title' => 'Sasaran Organisasi'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('manajemen-risiko.sasaran-organisasi-component')
        </div>
    </div>
</div>
@endsection
