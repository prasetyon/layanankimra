@extends('app', ['title' => 'Notifikasi'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('notifikasi-component')
        </div>
    </div>
</div>
@endsection
