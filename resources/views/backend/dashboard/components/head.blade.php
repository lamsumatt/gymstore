<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="{{ env('APP_URL') }}">

<title>INSPINIA | Dashboard v.2</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="backend/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="backend/css/animate.css" rel="stylesheet">
<link href="backend/css/bootstrap.min.css" rel="stylesheet">
<meta name="referrer" content="strict-origin-when-cross-origin">

{{-- kiểm tra config có tồn tại hay ko --}}
@if (isset($config['css']) && is_array($config['css']))
    @foreach ($config['css'] as $value)
        {!! '<link rel="stylesheet" href="' . $value . '">' !!}
    @endforeach
@endif


<script>
    var domain = "{{ env('APP_URL') }}";
</script>

<link href="backend/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="backend/css/customize.css">
<script src="backend/js/jquery-3.1.1.min.js"></script>
<script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
