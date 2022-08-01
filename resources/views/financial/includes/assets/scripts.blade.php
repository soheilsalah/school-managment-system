<!-- Vendor JS -->
<script src="{{ asset('js/vendors.min.js') }}"></script>
<script src="{{ asset('js/pages/chat-popup.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

<!-- EduAdmin App -->
<script src="{{ asset('js/template.js') }}"></script>


@if(isset($scripts))
    @include('financial.includes.assets.scripts.'.$scripts)
@endif

@if(isset($assets))
    @include('financial.includes.assets.scripts.'.$assets)
@endif