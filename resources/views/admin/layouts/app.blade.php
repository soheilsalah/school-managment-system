<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="icon" href="../images/favicon.ico"> --}}

    <title>
    @isset($title)
        {{ $title }}
    @else
        {{ config('app.name') }}
    @endisset
    </title>
  
	
	@include('admin.includes.assets.styles')
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed rtl">
    <div class="wrapper">
        <div id="loader"></div>
        
        <!-- Header (Navbar) -->
        @include('admin.includes.navs.navbar')
        
        <!-- Aside (Sidbar) -->
        @include('admin.includes.navs.sidebar')

        <div class="content-wrapper">
            <div class="container-full">
                @isset($breadcrumb)
              	<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="page-title">{{ isset($breadcrumb['title']) ? $breadcrumb['title'] : '' }}</h3>
						<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
							@foreach($breadcrumb['map'] as $title => $route)
							<li class="breadcrumb-item {{ $route == 'active' ? 'active' : ''}}">
								@if(is_array($route))
								{!! $route == 'active' ? $title : '<a href="'.route($route['route'], $route['slug']).'">'.$title.'</a>' !!}
								@else
								{!! $route == 'active' ? $title : '<a href="'.route($route).'">'.$title.'</a>' !!}
								@endif
							</li>
							@endforeach
							{{-- <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
							<li class="breadcrumb-item" aria-current="page">Tables</li>
							<li class="breadcrumb-item active" aria-current="page">Data Tables</li> --}}
							</ol>
						</nav>
						</div>
					</div>
					</div>
				</div>
				@endisset

              <!-- Main content -->
              @yield('content')
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Purchase Now</a>
              </li>
            </ul>
        </div>
          &copy; {{ date('Y') }} <a href="javascript:void(0);">{{ config('app.name') }}</a>. All Rights Reserved.
    </footer>

	@include('admin.includes.assets.scripts')
</body>
</html>
