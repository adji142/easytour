@extends('parts.header')
	
@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('hotelroom')}}">Hotel Room</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Hotel Room</li>
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
										@if (count($hotelroom) > 0)
                                    		Edit Hotel Room
	                                	@else
	                                    	Add Hotel Room
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
								@if (count($hotelroom) > 0)
                            		<form action="{{route('hotelroom-edit')}}" method="post">
                            	@else
                                	<form action="{{route('hotelroom-store')}}" method="post">
                            	@endif
                            		@csrf
	                            	<div class="form-group row">
	                            		<div class="col-md-6">
	                            			<label  class="text-body">Hotel Room Name</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="RoomName" name="RoomName" placeholder="Hotel Room Name" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['RoomName'] : '' }}">
	                            				<input type="hidden" class="form-control" id="id" name="id" placeholder="<AUTO>" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['id'] : '' }}" readonly="" >
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-6">
	                            			<label  class="text-body">Hotel Room Name</label>
	                            			<fieldset class="form-group mb-3">
												<select name="HotelID" id="HotelID" class="js-example-basic-single js-states form-control bg-transparent">
                                                    <option value="">Select Hotel</option>
                                                    @foreach($hotel as $key)
                                                        <option value="{{ $key->id }}" {{ count($hotelroom) > 0 ? ($hotelroom[0]['HotelID'] == $key->id ? 'selected' : '') : '' }}>{{ $key->HotelName }}</option>   
                                                    @endforeach
                                                </select>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-3">
	                            			<label  class="text-body">Room Type</label>
	                            			<fieldset class="form-group mb-3">
												<select name="RoomType" id="RoomType" class="js-example-basic-single js-states form-control bg-transparent">
                                                    <option value="">Select Room Type</option>
                                                    @foreach($roomtype as $key)
                                                        <option value="{{ $key->id }}" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomType'] == $key->id ? 'selected' : '') : '' }}>{{ $key->RoomTypeName }}</option>   
                                                    @endforeach
                                                </select>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-3">
	                            			<label  class="text-body">Bed Type</label>
	                            			<fieldset class="form-group mb-3">
												<select name="RoomBedType" id="RoomBedType" class="js-example-basic-single js-states form-control bg-transparent">
                                                    <option value="">Select Bed Type</option>
                                                    @foreach($bedtype as $key)
                                                        <option value="{{ $key->id }}" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomBedType'] == $key->id ? 'selected' : '') : '' }}>{{ $key->BedTypeName }}</option>   
                                                    @endforeach
                                                </select>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-3">
	                            			<label  class="text-body">Room Capacity</label>
	                            			<fieldset class="form-group mb-3">
												<input type="number" class="form-control" id="RoomCapacity" name="RoomCapacity" placeholder="Room Capacity" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['RoomCapacity'] : '' }}"> 
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-3">
	                            			<label  class="text-body">Room Size (m2)</label>
	                            			<fieldset class="form-group mb-3">
												<input type="number" class="form-control" id="RoomSize" name="RoomSize" placeholder="Room Size" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['RoomSize'] : '' }}">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<ul class="list-unstyled mb-0">
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityAC" id="RoomFacilityAC">
                                                        <label class="custom-control-label" for="RoomFacilityAC">Room With AC</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityTV" id="RoomFacilityTV">
                                                        <label class="custom-control-label" for="RoomFacilityTV">Room With TV</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityShower" id="RoomFacilityShower">
                                                        <label class="custom-control-label" for="RoomFacilityShower">Room With Shower</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityWaterHeater" id="RoomFacilityWaterHeater">
                                                        <label class="custom-control-label" for="RoomFacilityWaterHeater">Room With Water Heater</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityFreeWifi" id="RoomFacilityFreeWifi">
                                                        <label class="custom-control-label" for="RoomFacilityFreeWifi">Room With Free Wifi</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityBreakfast" id="RoomFacilityBreakfast">
                                                        <label class="custom-control-label" for="RoomFacilityBreakfast">Room With Breakfast</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityNoSmoking" id="RoomFacilityNoSmoking">
                                                        <label class="custom-control-label" for="RoomFacilityNoSmoking">Room With No Smoking</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityParking" id="RoomFacilityParking">
                                                        <label class="custom-control-label" for="RoomFacilityParking">Parking Lot</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilitySwimmingPool" id="RoomFacilitySwimmingPool">
                                                        <label class="custom-control-label" for="RoomFacilitySwimmingPool">Swimming Pool</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityFitness" id="RoomFacilityFitness">
                                                        <label class="custom-control-label" for="RoomFacilityFitness">Gym</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                            </ul>
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
<script type="text/javascript">
	// jQuery(document).ready(function() {
	// 	jQuery('.js-example-basic-multiple').select2();
	// });
	jQuery(function () {

		jQuery(document).ready(function() {
			jQuery('.js-example-basic-single').select2();
			
		});

		jQuery('form').submit(function(e) {

            e.preventDefault(); // Prevent default form submission

            var form = $(this);
            var formData = form.serialize();
            var actionUrl = form.attr('action');
			var submitButton = form.find("button[type='submit']");
			submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

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
							window.location.href = "{{ route('hotelroom') }}";
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