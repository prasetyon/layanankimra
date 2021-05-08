@extends('app', ['title' => 'Kalender Kegiatan'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('advokasi.kalender-kegiatan-component')
        </div>
    </div>
</div>
@endsection
