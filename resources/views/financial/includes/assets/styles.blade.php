<!-- Vendors Style-->
<link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">
<!-- Style-->  
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">

@if(isset($styles))
    @include('financial.includes.assets.styles.'.$styles)
@endif

@if(isset($assets))
    @include('financial.includes.assets.styles.'.$assets)
@endif