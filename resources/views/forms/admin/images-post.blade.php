<upload-image-post
        existing_files="{{ json_encode($files) }}"
        root="
    @isset($data)
        {{ $directory . $data->id }}
        @else
        {{ $directory . \Illuminate\Support\Str::random(5) }}
        @endisset
                "
>
</upload-image-post>