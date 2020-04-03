<div class="form-group">
    {{ Form::label($key, $label) }}
    {{ Form::select($key, $list, (isset($data)) ? $data[(isset($custom_key)) ? $custom_key : $key] : null, ['class' => 'form-control']) }}
</div>