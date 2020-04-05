@extends('layout.admin.app')

@section('content')

    @include('layout.admin.header')

    <div class="container" id="app">
        <div class="row">
            @include('layout.admin.sidebar')
            <div class="col-lg-9">
                @include('admin.todo.form')
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="/js/admin.js"></script>
@stop