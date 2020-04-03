<!doctype html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body class="text-gray-900 leading-normal">
    <div class="mx-auto mt-2 bg-white main-container" id="app">

        {{-- content --}}

        <div id="content">
            <div class="p-5">
                @yield('content')
            </div>
        </div>

        {{-- footer --}}
    </div>
</body>
</html>