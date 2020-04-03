<div class="row">
    <div class="col-sm-6">
        @include('forms.admin.textarea', ['key' => 'gallery', 'label' => 'Фотографии объекта', 'rows' => 5, 'edit' => ''])
    </div>
    <div class="col-sm-6">
        <multi-upload-images
                result="{{ $key }}"

                root="
            @isset($data)
                {{ $directory . $data->id }}
                @else
                {{ $directory . \Illuminate\Support\Str::random(5) }}
                @endisset
                        "
        >
        </multi-upload-images>
    </div>
</div>