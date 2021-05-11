<!DOCTYPE html>
<html lang="en">
<head>
	<title>Layanan Pengaduan KIMRA DJA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('contact/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="-6.172832" data-map-y="106.838972" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<span class="contact100-form-symbol">
				<img src="{{ asset('logo.png') }}" alt="Logo Kemenkeu">
			</span>

			<form class="contact100-form validate-form flex-sb flex-w" action="{{route('aduan')}}" method="POST" enctype="multipart/form-data">
                @csrf
				<span class="contact100-form-title">
                    Buat Pengaduan<br/>
                    <a href="{{route('login')}}" style="color: blue">Sudah punya akun? Klik untuk login</a>
				</span>
				<span class="contact100-form">
                    @if(session('alert-success'))
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class='alert alert-success alert-dismissible' id="alert">
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='icon fa fa-check'></i> {{session('alert-success')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
				</span>

				<div class="wrap-input100 rs4 validate-input" data-validate = "Name is required">
					<input class="input100" type="text" name="name" placeholder="Nama">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs4 validate-input" data-validate = "Email is required: e@a.z">
					<input class="input100" type="text" name="Email" placeholder="Email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs4 validate-input" data-validate = "Phone is required">
					<input class="input100" type="text" name="phone" placeholder="NO HP">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs4 validate-input" data-validate = "NIK is required">
					<input class="input100" type="text" name="nik" placeholder="NIK / NIP">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs4 validate-input" data-validate = "Title is required">
					<input class="input100" type="text" name="perihal" placeholder="Perihal Pengaduan">
					<span class="focus-input100"></span>
                </div>

				<div class="wrap-input100 rs4">
					<select class="input100" name="type" style="height: 60px; margin-right:10px; padding: 0 20px 0 25px; border: none;">
                        @foreach($data['jenis'] as $d)
                        <option value="{{$d->id}}">{{$d->name}}</option>
                        @endforeach
                    </select>
				</div>

				<div class="wrap-input100 rs4 validate-input" data-validate = "Date is required">
					<input class="input100" type="date" name="tanggal" placeholder="Tanggal Kejadian">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs4 validate-input" data-validate = "Location is required">
					<input class="input100" type="text" name="lokasi" placeholder="Lokasi Kejadian">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs3 validate-input" data-validate = "Chronology is required">
					<textarea class="input100" name="kronologi" placeholder="Kronologi Kejadian"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs3 validate-input" data-validate = "Person is required">
					<textarea class="input100" name="pihak" placeholder="Pihak yang Terlibat"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs3">
					<textarea class="input100" name="motif" placeholder="Motif Kejadian"></textarea>
					<span class="focus-input100"></span>
                </div>

				<div class="wrap-input100 rs3">
					<input type="file" name="file" multiple>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Send
					</button>
				</div>
			</form>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="{{ asset('contact/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('contact/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('contact/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('contact/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('contact/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('contact/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('contact/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('contact/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxQfd0X4Ai62z50ckEq-vnxtKjW7S1rcE"></script>
	<script src="{{ asset('contact/js/map-custom.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('contact/js/main.js') }}"></script>
</body>
</html>
