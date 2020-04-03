<title>{!! (isset($meta)) ? $meta['title'] : ''  !!}</title>

<link rel="stylesheet" href="{{ asset('/css/admin/style.css') }}"/>
@yield('style')

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">