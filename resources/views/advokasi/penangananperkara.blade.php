@extends('app', ['title' => 'Penanganan Perkara'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('advokasi.penanganan-perkara-component')
        </div>
    </div>
</div>
@endsection
