<link href="{{ asset('js/jquery-notifyjs/styles/metro/notify-metro.css') }}" rel="stylesheet"/>
<script src="{{ asset('js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('js/jquery-notifyjs/notify.min.js') }}"></script>
<script src="{{ asset('js/jquery-notifyjs/styles/metro/notify-metro.js') }}"></script>
<script src="{{ asset('js/pages/notifications.js') }}"></script>

{{-- flash.blade.php --}}
@if (session()->has('flash_message'))
    <script type="text/javascript">
        setTimeout(function () {
            notify('{{ session('flash_message.type') }}', '{{ session('flash_message.position') }}', '{{ session('flash_message.message') }}');
        }, 1);
    </script>
@endif
