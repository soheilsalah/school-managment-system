<!-- Vendors Style-->
<link rel="stylesheet" href="{{ asset('app-assets/css/vendors_css.css') }}">
<!-- Style-->  
<link rel="stylesheet" href="{{ asset('app-assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/css/skin_color.css') }}">

@if(isset($styles))
    @include('financial.includes.assets.styles.'.$styles)
@endif

@if(isset($assets))
    @include('financial.includes.assets.styles.'.$assets)
@endif