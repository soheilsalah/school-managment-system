<!-- Vendor JS -->
<script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
<script src="{{ asset('app-assets/js/pages/chat-popup.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

<!-- EduAdmin App -->
<script src="{{ asset('app-assets/js/template.js') }}"></script>


@if(isset($scripts))
    @include('admin.includes.assets.scripts.'.$scripts)
@endif

@if(isset($assets))
    @include('admin.includes.assets.scripts.'.$assets)
@endif