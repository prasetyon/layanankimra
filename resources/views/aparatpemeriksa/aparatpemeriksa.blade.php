@extends('app', ['title' => 'Aparat Pemeriksa'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('aparatpemeriksa.aparat-pemeriksa-component')
        </div>
    </div>
</div>
@endsection
