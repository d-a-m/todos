@if(isset($data))
    {{ Form::model($data, ['url' => route('admin.todo.update', [$data->id]), 'method' => 'patch']) }}
@else
    {{ Form::open(['url' => route('admin.todo.store'), 'method' => 'post']) }}
@endif

    <div class="row">
        <div class="col-12">
            @include('forms.admin.text', ['key' => 'title', 'label' => 'Название'])
        </div>

        <div class="col-12">
            @include('forms.admin.textarea', ['key' => 'description', 'label' => 'Описание задачи', 'edit' => '', 'rows' => 3])
        </div>

        <div class="col-12">
            <h4>Автор</h4>
            <p>
                <a href="{{ route('admin.user.edit', [$data['author']['id']]) }}">
                    {{ $data['author']['name'] }}
                </a>
            </p>
        </div>

    </div>


    <div class="form-group">
        <input type="submit" value="Отправить" class="btn btn-primary">
    </div>

{{ Form::close() }}