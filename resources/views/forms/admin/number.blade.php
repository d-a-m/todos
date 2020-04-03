<div class="form-group">
    {{ Form::label($key, $label) }}
    {{
        Form::number(
            $key,
            old($key),
            [
                'class' => $errors->has($key) ? 'form-control is-invalid' : 'form-control',
                'min' => $min ?? null,
                'max' => $max ?? null,
            ]
        )
    }}
    @if ($errors->has($key))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($key) }}</strong>
        </span>
    @endif
</div>