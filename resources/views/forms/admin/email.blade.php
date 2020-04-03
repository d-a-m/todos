<div class="form-group">
    {{ Form::label($key, $label) }}
    {{
        Form::text(
            $key,
            old($key),
            [
                'class' => $errors->has($key) ? 'form-control is-invalid' : 'form-control',
                'type' => 'email'
            ]
        )
    }}
    @if ($errors->has($key))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($key) }}</strong>
        </span>
    @endif
</div>