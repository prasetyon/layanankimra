@extends('app', ['title' => 'Pendapat Hukum'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('advokasi.pendapat-hukum-component')
        </div>
    </div>
</div>
@endsection
