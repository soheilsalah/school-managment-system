<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="قم بالدخول الي لوحة التحكم الخاصة بك">
    <meta name="author" content="{{ config('app.name') }}">
    {{-- <link rel="icon" href="../images/favicon.ico"> --}}

    <title>
    @isset($title)
        {{ $title }}
    @else
        {{ config('app.name') }}
    @endisset
    </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('app-assets/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('app-assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('app-assets/css/skin_color.css') }}">	

</head>
	
<body class="hold-transition theme-primary bg-img text-right" style="background-image: url({{ asset('app-assets/images/auth-bg/bg-1.jpg') }})">
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">{{ isset($title) ? $title : 'لوحة التحكم' }}</h2>
							</div>
							<div class="p-40">
                                @yield('content')
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Vendor JS -->
	<script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
	<script src="{{ asset('app-assets/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>	
</body>
</html>
