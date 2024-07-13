<!-- Mainly scripts -->
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset ('backend/library/library.js') }}"></script>
{{-- <script src="backend/vendor/flasher/flasher.min.js"></script> --}}

<!-- jQuery UI -->
<script src="{{ asset('backend/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

{{-- kiểm tra config có tồn tại hay ko --}}
@if(isset($config['js']) && is_array($config['js']))
    @foreach ($config['js'] as $value)
        {!! '<script src="'.$value.'"></script>' !!}
    @endforeach
@endif


