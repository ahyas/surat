
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic 
Product Version: 8.2.1
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="../../../" />
		<title>Simisol - Sistem Aplikasi Manajemen Surat Online</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template - Metronic by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />-->
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{asset('public/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('public/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }
        </script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page bg image-->
			<style>body { background-color: #031c45 } body { background-image: url("{{asset('assets/media/auth/bg4-dark.jpg')}}"); }</style>
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<div class="d-flex flex-center flex-lg-start flex-column">
						<a href="javascript:void(0)" class="mb-7">
						<img alt="Logo" src="{{asset('public/assets/media/logos/default-small.svg')}}" class="h-25px h-lg-30px"/>
						</a>
						<h2 class="text-white fw-bold m-0">SIMISOL</h2> <h4 class="text-white fw-normal">Sistem Aplikasi Manajemen Surat Online</h4>
					</div>
				</div>
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
					<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
						<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
							<form method="POST" class="form w-100" id="kt_sign_in_form" action="{{route('login')}}" autocomplete="off">
                            @csrf
								<div class="text-center mb-11">
									<a href="javascript:void(0)" class="mb-7">
										<img alt="Logo" src="{{asset('public/assets/media/logos/default-small.svg')}}" class="h-25px h-lg-30px" style="margin-bottom:20px"/>
									</a>
									<h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
									<div class="text-gray-500 fw-semibold fs-6">Masukan Username dan Password</div>
								</div>
								<div class="fv-row mb-8">
                                    <input id="email" placeholder="Username" type="email" class="form-control bg-transparent @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </span>
                                    @enderror
								</div>
								<div class="fv-row mb-3">
                                    <input id="password" placeholder="Password" type="password" class="form-control bg-transparent @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </span>
                                    @enderror
								</div>
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
								</div>
								<div class="d-grid mb-10">
									<button type="submit" class="btn btn-primary spinner spinner-white spinner-left sign_in" id="sign_in" data-kt-indicator="off">
										<span class="indicator-progress">
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										Sign In
									</button>
								</div>
							</form>
						</div>
						<div class="d-flex flex-stack px-lg-10">
							<div class="d-flex fw-semibold text-primary fs-base gap-5">
								<a href="javascript:void(0)" target="_blank">Terms</a>
								<a href="javascript:void(0)" target="_blank">Plans</a>
								<a href="javascript:void(0)" target="_blank">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "{{asset('public/assets/')}}";</script>
		<script src="{{asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('public/assets/js/scripts.bundle.js')}}"></script>
		<script >
			$(document).ready(function(){
				var btn = document.querySelector(".sign_in");
				$("body").on("click","#sign_in",function(){
					console.log("Login")
					btn.setAttribute("data-kt-indicator", "on");
       				
				});
			});
		</script>
	</body>
</html>