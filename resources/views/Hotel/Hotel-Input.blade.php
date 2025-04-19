@extends('parts.header')
	
@section('content')
<style>
	#map {
		height: 300px;
		width: 100%;
	}
	#search-box {
		width: 300px;
		padding: 10px;
		margin-bottom: 10px;
	}
</style>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('hotels')}}">Hotel</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Hotel</li>
			</ol>
		</nav>
	</div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 px-4">
				<div class="row">
					<div class="col-lg-12 col-xl-12 px-4">
						<div class="card card-custom gutter-b bg-transparent shadow-none border-0" >
							<div class="card-header align-items-center  border-bottom-dark px-0">
								<div class="card-title mb-0">
									<h3 class="card-label mb-0 font-weight-bold text-body">
										@if (count($hotel) > 0)
                                    		Edit Hotel
	                                	@else
	                                    	Add Hotel
	                                	@endif
									</h3>
								</div>
							</div>
						
						</div>


					</div>
				</div>

				<div class="row">
					<div class="col-12  px-4">
						<div class="card card-custom gutter-b bg-white border-0" >
							<div class="card-body" >
								@if (count($hotel) > 0)
                            		<form action="{{route('hotels-edit')}}" method="post">
                            	@else
                                	<form action="{{route('hotels-store')}}" method="post">
                            	@endif
                            		@csrf
	                            	<div class="form-group row">
	                            		<div class="col-md-12">
	                            			<label  class="text-body">Hotel Name</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="HotelName" name="HotelName" placeholder="Hotel Name" value="{{ count($hotel) > 0 ? $hotel[0]['HotelName'] : '' }}">
	                            				<input type="hidden" class="form-control" id="id" name="id" placeholder="<AUTO>" value="{{ count($hotel) > 0 ? $hotel[0]['id'] : '' }}" readonly="" >
	                            			</fieldset>
	                            		</div>
	                            		
										<div class="col-md-12">
	                            			<label  class="text-body">Hotel Location</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="HotelLocation" name="HotelLocation" placeholder="Hotel Location" value="{{ count($hotel) > 0 ? $hotel[0]['HotelLocation'] : '' }}" required="">
	                            			</fieldset>
	                            			
	                            		</div>

										<div class="col-md-12">
	                            			<label  class="text-body"></label>
	                            			<fieldset class="form-group mb-3">
												<div id="map"></div>
	                            			</fieldset>
	                            			
	                            		</div>

	                            		<div class="col-md-12">
	                            			<label  class="text-body">Hotel Address</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="HotelAddress" name="HotelAddress" placeholder="Hotel Address" value="{{ count($hotel) > 0 ? $hotel[0]['HotelAddress'] : '' }}" required="">
	                            			</fieldset>
	                            			
	                            		</div>

										<div class="col-md-4">
	                            			<label  class="text-body">Country</label>
	                            			<fieldset class="form-group mb-3">
	                            				<select name="HotelState" id="HotelState" class="js-example-basic-single js-states form-control bg-transparent">
													<option value="">Select Country</option>

													@foreach($negara as $ko)
														<option value="{{ $ko->id }}"{{ count($hotel) > 0 ? $hotel[0]['HotelState'] == $ko->id ? "selected" : '' :""}}>
                                                            {{ $ko->NationName }}
                                                        </option>
													@endforeach
												</select>
	                            			</fieldset>
	                            			
	                            		</div>

										<div class="col-md-4">
	                            			<label  class="text-body">Province</label>
	                            			<fieldset class="form-group mb-3">
	                            				<select name="HotelProvince" id="HotelProvince" class="js-example-basic-single js-states form-control bg-transparent">
													<option value="">Select Province</option>
												</select>
	                            			</fieldset>
	                            			
	                            		</div>

										<div class="col-md-4">
	                            			<label  class="text-body">City</label>
	                            			<fieldset class="form-group mb-3">
	                            				<select name="HotelCity" id="HotelCity" class="js-example-basic-single js-states form-control bg-transparent">
													<option value="">Select City</option>
												</select>
	                            			</fieldset>
	                            		</div>
										
										<div class="col-md-3">
	                            			<label  class="text-body">Hotel Phone Number</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="HotelPhone" name="HotelPhone" placeholder="Hotel Phone Number" value="{{ count($hotel) > 0 ? $hotel[0]['HotelPhone'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

										<div class="col-md-3">
	                            			<label  class="text-body">Hotel Email</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="mail" class="form-control" id="HotelEmail" name="HotelEmail" placeholder="Hotel Email Address" value="{{ count($hotel) > 0 ? $hotel[0]['HotelEmail'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

										<div class="col-md-3">
	                            			<label  class="text-body">Website</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="HotelWebsite" name="HotelWebsite" placeholder="Hotel Web Site" value="{{ count($hotel) > 0 ? $hotel[0]['HotelWebsite'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

										<div class="col-md-3">
	                            			<label  class="text-body">Hotel Ratting</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="number" step="0.1" class="form-control" id="HotelRating" name="HotelRating" placeholder="Hotel Ratting" value="{{ count($hotel) > 0 ? $hotel[0]['HotelRating'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

										<div class="col-md-12">
	                            			<label  class="text-body">Hotel Description</label>
											<fieldset class="form-group mb-3">
												<div id="HotelDescription">
													{!! count($hotel) > 0 ? $hotel[0]['HotelDescription'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-12">
	                            			<label  class="text-body">Hotel Include Exclude</label>
											<fieldset class="form-group mb-3">
												<div id="HotelIncludeExclude">
													{!! count($hotel) > 0 ? $hotel[0]['HotelIncludeExclude'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-4">
	                            			<label  class="text-body">Country</label>
	                            			<fieldset class="form-group mb-3">
	                            				<select name="HotelStatus" id="HotelStatus" class="js-example-basic-single js-states form-control bg-transparent">
													<option value="">Select Status</option>
													<option value="Y" {{ count($hotel) > 0 ? $hotel[0]['HotelStatus'] == 'Y' ? "selected" : '' :""}}>ACTIVE</option>
													<option value="N" {{ count($hotel) > 0 ? $hotel[0]['HotelStatus'] == 'N' ? "selected" : '' :""}}>INACTIVE</option>
												</select>
	                            			</fieldset>
	                            			
	                            		</div>

	                            		<div class="col-md-12">
	                            			<button type="submit" class="btn btn-success text-white font-weight-bold me-1 mb-1">Save</button>
	                            		</div>
	                            	</div>

                            	</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
</div>

@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzbtoJMUdsWh7Rg7893cACd--PacQyxWs&libraries=places"></script>
<script type="text/javascript">
	// jQuery(document).ready(function() {
	// 	jQuery('.js-example-basic-multiple').select2();
	// });
	jQuery(function () {
		var oProvinsi;
        var oKota;
		var oHotel;
		function initMap() {
			const newLocation = jQuery('#HotelLocation').val();
			const latLng = newLocation.split(',');
			const lat = parseFloat(latLng[0]);
			const lng = parseFloat(latLng[1]);
			
			console.log(latLng.length);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: latLng[0] == '' ? -6.200000 : lat, lng: latLng[0] =='' ?  106.816666 : lng }, // Default to Jakarta
                zoom: 13
            });

            var input = document.getElementById('HotelLocation');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var marker = new google.maps.Marker({
				position: { lat: latLng[0] == '' ? -6.200000 : lat, lng: latLng[0] =='' ?  106.816666 : lng },
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function () {
                marker.setVisible(false);
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    return;
                }

				var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
				jQuery('#HotelAddress').val(place.formatted_address);
				jQuery('#HotelLocation').val(lat + ',' + lng);
                map.setCenter(place.geometry.location);
                map.setZoom(15);

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });
        }

        google.maps.event.addDomListener(window, 'load', initMap);

		const quill_HotelDescription = new Quill('#HotelDescription', {
			theme: 'snow'
		});
		const quill_HotelIncludeExclude = new Quill('#HotelIncludeExclude', {
			theme: 'snow'
		});
		jQuery(document).ready(function() {
			jQuery('.js-example-basic-single').select2();
			oProvinsi = <?php echo $provinsi; ?>;
            oKota = <?php echo $kota; ?>;
			oHotel = <?php echo $hotel; ?>;
			
			jQuery('#HotelState').val(oHotel.length > 0 ? oHotel[0]['HotelState'] : '');
			jQuery('#HotelState').trigger('change');
			jQuery('#HotelProvince').val(oHotel.length > 0 ? oHotel[0]['HotelProvince'] : '');
			jQuery('#HotelProvince').trigger('change');
			jQuery('#HotelCity').val(oHotel.length > 0 ? oHotel[0]['HotelCity'] : '');
			
		});

		jQuery('#HotelState').change(function () {
            const filterProvinsi = oProvinsi.filter(kota => kota.locationid == jQuery('#HotelState').val());
            $('#HotelProvince').empty();
            var newOption = $('<option>', {
                value: -1,
                text: "Select Province"
            });
            $('#HotelProvince').append(newOption);

            $.each(filterProvinsi,function (k,v) {
                var newOption = $('<option>', {
                    value: v.prov_id,
                    text: v.prov_name
                });

                $('#HotelProvince').append(newOption);
            });
        });

		jQuery('#HotelProvince').change(function () {
            const filterProvinsi = oKota.filter(kota => kota.prov_id == jQuery('#HotelProvince').val());
            $('#HotelCity').empty();
            var newOption = $('<option>', {
                value: -1,
                text: "Select City"
            });
            $('#HotelCity').append(newOption);

            $.each(filterProvinsi,function (k,v) {
                var newOption = $('<option>', {
                    value: v.city_id,
                    text: v.city_name
                });

                $('#HotelCity').append(newOption);
            });
        });

		jQuery('form').submit(function(e) {

            e.preventDefault(); // Prevent default form submission

            var form = $(this);
            var formData = form.serializeArray();
            var actionUrl = form.attr('action');
			var submitButton = form.find("button[type='submit']");
			submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');


			var HotelDescription = quill_HotelDescription.root.innerHTML;
			var HotelIncludeExclude = quill_HotelIncludeExclude.root.innerHTML;

			formData.push({ name: "HotelDescription", value: HotelDescription });
			formData.push({ name: "HotelIncludeExclude", value: HotelIncludeExclude });
            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if(response.success == true){
						swal.fire({
							title: 'Success',
							text: response.message,
							icon: 'success',
							confirmButtonText: 'OK'
						}).then(function() {
							window.location.href = "{{ route('hotels') }}";
						});
					} else {
						swal.fire({
							title: 'Error',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						}).then(function() {
							submitButton.prop('disabled', false).html('Save');
						});
					}
                },
            });
        });
	})
</script>
@endpush