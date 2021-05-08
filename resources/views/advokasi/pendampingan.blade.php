@extends('app', ['title' => 'Pendampingan'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('advokasi.pendampingan-component')
        </div>
    </div>
</div>
@endsection
