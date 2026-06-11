<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


	<!-- Meta data -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Favicon -->

	<!-- Title -->
	<title>{{$title}}</title>

	@include('includes.css')
<style>
.app-content .side-app {
    padding: 20px 30px 0 30px !important;
}	
</style>
</head>


@include('includes.navigation')
@yield('content')

<!--Footer-->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center" style="display: flex; justify-content: center; align-items: center; gap: 5px; flex-wrap: wrap;">
                <span>Copyright © {{date('Y')}}</span> 
                <a href="javascript:void(0)" class="fs-14 text-primary" style="display: inline-flex; align-items: center; line-height: 1; overflow: visible !important;">
                    <svg width="140" height="36" viewBox="0 0 280 72" xmlns="http://www.w3.org/2000/svg" style="display: block; overflow: visible !important;">
                        <rect x="2" y="2" width="42" height="54" rx="5" fill="none" stroke="#3b82f6" stroke-width="2"/>
                        <rect x="9" y="12" width="20" height="4" rx="2" fill="#3b82f6" opacity="0.8"/>
                        <rect x="9" y="21" width="28" height="5" rx="2" fill="none" stroke="#3b82f6" stroke-width="1.2"/>
                        <rect x="9" y="32" width="28" height="5" rx="2" fill="none" stroke="#3b82f6" stroke-width="1.2"/>
                        <rect x="9" y="43" width="16" height="6" rx="3" fill="#3b82f6"/>
                        <text x="54" y="44" font-family="system-ui,sans-serif" font-size="22" font-weight="700" fill="#1e293b" letter-spacing="-0.5">Form<tspan fill="#3b82f6">Craft</tspan></text>
                    </svg>
                </a>
                <span>. All rights reserved.</span>
            </div>
        </div>
    </div>
</footer>
<!--/Footer-->
</div>

<!-- Back to top -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

@include('includes.js')

</body>

</html>