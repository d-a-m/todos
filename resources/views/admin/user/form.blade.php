@if(isset($data))
    {{ Form::model($data, ['url' => route('admin.user.update', [$data->id]), 'method' => 'patch']) }}
@else
    {{ Form::open(['url' => route('admin.user.store'), 'method' => 'post']) }}
@endif

    <div class="row">
        <div class="col-sm-6">
            @include('forms.admin.text', ['key' => 'name', 'label' => 'Имя'])
        </div>

        <div class="col-sm-6">
            @include('forms.admin.email', ['key' => 'email', 'label' => 'E-mail'])
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @include('forms.admin.disables_text', ['key' => 'api_token', 'label' => 'API токен'])
        </div>
    </div>

    <div class="form-group">
        <input type="submit" value="Отправить" class="btn btn-primary">
    </div>

{{ Form::close() }}