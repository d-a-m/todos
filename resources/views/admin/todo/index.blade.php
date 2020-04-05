@extends('layout.admin.app')

@section('content')

    @include('layout.admin.header')

    <div class="container">
        <div class="row">
            @include('layout.admin.sidebar')
            <div class="col-lg-9">
                @if($data->isNotEmpty())
                    @foreach($data as $item)
                        <div class="category">
                            <a href="{{ route('admin.todo.edit', [$item->id]) }}">
                                {{ $item->title }} [id: {{ $item->id }}]
                            </a>
                            <a href="{{ route('admin.todo.destroy', [$item->id]) }}" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Удалить?">Удалить</a>
                        </div>
                        <hr />
                    @endforeach

                    {{ $data->render() }}
                @else
                    <p>Список пуст.</p>
                @endif
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="/js/admin.js"></script>
@stop