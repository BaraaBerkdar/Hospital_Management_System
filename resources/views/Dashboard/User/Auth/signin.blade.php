@extends('Dashboard.layouts.master2')
@section('css')
@section('title',__('Dashboard/auth.login'))
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-aulsydto mx-auto wd-100p">
							<img src="{{URL::asset('WebSite/images/main-slider/3.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{__('Dashboard/login_trans.Welcome')}}</h2>
												<h5 class="font-weight-semibold mb-4">{{__('Dashboard/login_trans.Please_sign_in_to_continue')}}</h5>
												<form method="post" action="{{route('login.user')}}">
													@csrf
													<div class="form-group">
														<label>Email</label> <input name='email' class="form-control" placeholder="Enter your email" type="text">
													</div>
													@if ($errors->any())
													<div class="alert alert-danger">
														<ul>
															@foreach ($errors->all() as $error)
																<li>{{ $error }}</li>
															@endforeach
														</ul>
													</div>
												@endif
													<div class="form-group">
														<label>Password</label> <input name='password' class="form-control" placeholder="Enter your password" type="password">
													</div><button class="btn btn-main-primary btn-block">Sign In</button>
													<div class="row row-xs">
														
													</div>
												</form>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
@endsection