<div class="form-group">
    {{ Form::label($key, $label) }}
    {{ Form::date($key, old($key), ['class' => $errors->has($key) ? 'form-control is-invalid' : 'form-control']) }}
    @if ($errors->has('start'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($key) }}</strong>
        </span>
    @endif
</div>