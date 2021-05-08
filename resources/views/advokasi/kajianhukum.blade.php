@extends('app', ['title' => 'Kajian Hukum'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('advokasi.kajian-hukum-component')
        </div>
    </div>
</div>
@endsection
