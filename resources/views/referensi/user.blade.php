@extends('app', ['title' => 'User'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @livewire('user-component')
        </div>
    </div>
</div>
@endsection
