<div class="row">
    <div class="col-sm-6">
        @include('forms.admin.text', ['key' => $key, 'label' => $label])
    </div>

    <div class="col-sm-6">
        <upload-image
                result="{{ $key }}"
                root="{{ $directory }}"
                @isset($sizes)
                sizes="{{ $sizes }}"
                @endisset
        >
        </upload-image>
    </div>
</div>