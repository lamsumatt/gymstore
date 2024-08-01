<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="{{ config('app.url') }}">

<title>INSPINIA | Dashboard v.2</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
<meta name="referrer" content="strict-origin-when-cross-origin">

{{-- kiểm tra config có tồn tại hay ko --}}
@if (isset($config['css']) && is_array($config['css']))
    @foreach ($config['css'] as $value)
        {!! '<link rel="stylesheet" href="' . $value . '">' !!}
    @endforeach
@endif


<script>
    var domain = '{{ config('app.url') }}';
    var SUFFIX = '{{ config('apps.general.suffix') }}';
</script>

<link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/css/customize.css') }}">
<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
