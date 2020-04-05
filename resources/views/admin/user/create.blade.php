@extends('layout.admin.app')

@section('content')

    @include('layout.admin.header')

    <div class="container" id="app">
        <div class="row">
            @include('layout.admin.sidebar')
            <div class="col-lg-9">
                @include('admin.user.form')
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="/js/admin.js"></script>
    <script>
        let tokenUpdateBtn = document.querySelector('#token_update_btn');

        tokenUpdateBtn.addEventListener('click', (event) => {
            event.preventDefault();

            let oldTokenInput = document.querySelector('input[name="api_token"]');

            $.ajax({
                url: "/api/update-token",
                type: "get",
                data: {
                    'api_token': oldTokenInput.value,
                },
                success: (response) => {
                    let result = response['response'];
                    if (! result) { return; }

                    console.log(result['api_token']);

                    oldTokenInput.value = result['api_token'];
                },
                error: (xhr) => {

                }
            });
        });

    </script>
@stop