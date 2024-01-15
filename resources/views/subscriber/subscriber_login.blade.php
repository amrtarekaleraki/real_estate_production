<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    @php
        $settings = App\Models\Setting::latest()->get();
    @endphp

    @foreach ($settings as $item)
      <link rel="icon" href="{{ asset($item->favicon)}}" type="image/png" />
    @endforeach

	<!--plugins-->
	<link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('adminbackend/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{ asset('adminbackend/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('adminbackend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet">
	<title>تسجيل دخول المشتركين</title>
</head>

<body>





                  <div class="container" style="max-width:100%;">
					 <div class="row">

						 <div class="col-lg-4 login-sidebar">
							<div class="login-side-logo" >
                            {{-- @php
                                $settings = App\Models\Setting::latest()->get();
                            @endphp

                            @foreach ($settings as $item)
                              <img src="{{ asset($item->logo) }}" class="logo-icon" alt="logo icon" />
                            @endforeach --}}
                                <img src="{{ asset('adminbackend/assets/images/new/logo1.png')}}">
								<h2>تسجيل دخول المشتركين</h2>
							</div>

							<div class="form-login-page">

                                <form method="POST" action="{{ route('login') }}" class="row g-3">
                                    @csrf


                                    @if ($errors->any())
                                        <div class="col-12">
                                            <div class="alert alert-danger mt-3">
                                                <ul class="mb-0">
                                                        <li class="error-message" style="cursor: pointer">هناك خطا في البريد الالكتروني او كلمه السر</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="parent-login-update">
                                        <div class="col-8">
                                            <label for="inputEmailAddress" class="form-label">البريد الالكتروني</label>
                                            <input id="email" name="email" type="email" class="form-control" id="inputEmailAddress" placeholder="example@gmail.com">
                                        </div>

                                        <div class="col-8">
                                            <label for="password" class="form-label">الرقم السري</label>
                                            <div class="input-group password-button" id="show_hide_password">
                                                <input name="password" type="password" class="form-control" id="password" placeholder="123asd">
                                                <a href="javascript:;" class="password-eye"><i class='bx bx-show'></i></a>
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <div class="d-grid">
                                                <button type="submit" class="btn mt-5 button-submit m-auto">تسجيل الدخول</button>
                                            </div>
                                        </div>

                               </div>




								</form>

							</div>

						 </div>



						 <div class="col-lg-8 login-img">
                            <img src="{{ asset('adminbackend/assets/images/new/login-1.png')}}" alt="">
						</div>

					 </div>
				  </div>









	<!-- Bootstrap JS -->
	<script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('adminbackend/assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-show");
					$('#show_hide_password i').removeClass("bx-hide");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-show");
					$('#show_hide_password i').addClass("bx-hide");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('adminbackend/assets/js/app.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('.error-message').click(function() {
                $(this).closest('.alert-danger').hide();
            });
        });
    </script>

</body>

</html>
