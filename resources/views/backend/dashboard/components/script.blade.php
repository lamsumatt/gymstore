<!-- Mainly scripts -->
<script src="backend/js/bootstrap.min.js"></script>
<script src="backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="backend/library/library.js"></script>

<!-- jQuery UI -->
<script src="backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>

{{-- kiểm tra config có tồn tại hay ko --}}

    @foreach ($config['js'] as $key => $value)
       {!! '<script src="'.$value.'"></script>' !!}
    @endforeach


