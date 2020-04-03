<div class="form-group">
    {{ Form::label($key, $label) }}
    {{
        Form::textarea(
            $key,
            old($key),
            [
                'class' => $errors->has($key) ? "$edit form-control is-invalid" : "$edit form-control",
                'rows' => $rows
            ]
        )
    }}
    @if ($errors->has($key))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($key) }}</strong>
        </span>
    @endif
</div>