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
						<div id="generalmedia" class= "media0 linked card card-custom gutter-b bg-white border-0"  >
							<div class="card-header border-0 align-items-center">
								<div class="card-title mb-0">
									<h3 class="card-label mb-0 font-weight-bold text-body">Your Room Image
									</h3>
								</div>
								<div class="icons d-flex">
								
									<button type="button" class="btn btn-danger p-2 ms-2" title="Delete" id="deleteImage">Delete</button>
								
									<button type="button" title="Add New" class="btn btn-primary white p-2 ms-2" data-bs-toggle="modal" data-bs-target="#imagepopup">
										Add New
									</button>
									<!--Basic Modal -->
									<div class="modal fade text-left" id="imagepopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
										<div class="modal-dialog " role="document">
										<div class="modal-content">
											<div class="modal-header">
											<h3 class="modal-title" id="myModalLabel1">Add File Here</h3>
											<button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-bs-dismiss="modal" aria-label="Close">
												<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
												</svg>
											</button>
									
											</div>
											<div class="modal-body">
											<p>
												Click or Drop Images in the Box for Upload.
											</p>
											<div class="avatar-upload mb-3">
												<div class="avatar-edit">
													<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
													<label for="imageUpload">
														image upload
													</label>
												</div>
												<div class="avatar-preview">
													<div id="imagePreview" class="rounded" style="background-image: url(./assets/images/carousel/slide3.jpg);">
													</div>
												</div>
											</div>
											<fieldset class="form-group">
												<select class="js-example-basic-multiple js-states form-control" name="states[]" multiple="multiple">
													<option selected value="General">General</option>
												  </select>
											</fieldset>
											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-light" data-bs-dismiss="modal">
											
												<span class="">Close</span>
											</button>
											<button type="button" id="btSaveImage" class="btn btn-primary ms-1">
											
												<span class="">Submit</span>
											</button>
											</div>
										</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card-body" >
								<div class="row" id="PreviewAllImage">
									
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
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityAC" id="RoomFacilityAC" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityAC'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityAC">Room With AC</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityTV" id="RoomFacilityTV" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityTV'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityTV">Room With TV</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityShower" id="RoomFacilityShower" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityShower'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityShower">Room With Shower</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityWaterHeater" id="RoomFacilityWaterHeater" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityWaterHeater'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityWaterHeater">Room With Water Heater</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityFreeWifi" id="RoomFacilityFreeWifi" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityFreeWifi'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityFreeWifi">Room With Free Wifi</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityBreakfast" id="RoomFacilityBreakfast" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityBreakfast'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityBreakfast">Room With Breakfast</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityNoSmoking" id="RoomFacilityNoSmoking" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityNoSmoking'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityNoSmoking">Room With No Smoking</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityParking" id="RoomFacilityParking" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityParking'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityParking">Parking Lot</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilitySwimmingPool" id="RoomFacilitySwimmingPool" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilitySwimmingPool'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilitySwimmingPool">Swimming Pool</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block ms-2 mb-1">
                                                    <fieldset>
                                                      <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input bg-primary"  name="RoomFacilityFitness" id="RoomFacilityFitness" {{ count($hotelroom) > 0 ? ($hotelroom[0]['RoomFacilityFitness'] == '1' ? 'checked' : '') : '' }}>
                                                        <label class="custom-control-label" for="RoomFacilityFitness">Gym</label>
                                                      </div>
                                                    </fieldset>
                                                </li>
                                            </ul>
	                            		</div>

										<div class="col-md-12">
	                            			<label  class="text-body">Room description</label>
	                            			<fieldset class="form-group mb-3">
												<div id="RoomDescription">
													{!! count($hotelroom) > 0 ? $hotelroom[0]['RoomDescription'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-6">
	                            			<label  class="text-body">Room Include</label>
	                            			<fieldset class="form-group mb-3">
												<div id="RoomInclude">
													{!! count($hotelroom) > 0 ? $hotelroom[0]['RoomInclude'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-6">
	                            			<label  class="text-body">Room Exclude</label>
	                            			<fieldset class="form-group mb-3">
												<div id="RoomExclude">
													{!! count($hotelroom) > 0 ? $hotelroom[0]['RoomExclude'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-12">
	                            			<label  class="text-body">Why Chose US</label>
	                            			<fieldset class="form-group mb-3">
												<div id="RoomWhyChooseUS">
													{!! count($hotelroom) > 0 ? $hotelroom[0]['RoomWhyChooseUS'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-4">
	                            			<label  class="text-body">Room Rating</label>
	                            			<fieldset class="form-group mb-3">
												<input type="number" class="form-control" id="RoomRating" name="RoomRating" placeholder="Room Rating" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['RoomRating'] : '0' }}" readonly>
	                            			</fieldset>
	                            		</div>

										<div class="col-md-4">
	                            			<label  class="text-body">Room Rate</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="RoomPrice" name="RoomPrice" placeholder="Room Rate" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['RoomPrice'] : '0' }}">
	                            			</fieldset>
	                            		</div>

										
										<div class="col-md-4">
	                            			<label  class="text-body">Room Discount</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="RoomDiscount" name="RoomDiscount" placeholder="Room Discount" value="{{ count($hotelroom) > 0 ? $hotelroom[0]['RoomDiscount'] : '0' }}">
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
<script type="text/javascript">
	// jQuery(document).ready(function() {
	// 	jQuery('.js-example-basic-multiple').select2();
	// });
	jQuery(function () {
		var imageIndex = -1;
		const quill_RoomDescription = new Quill('#RoomDescription', {
			theme: 'snow'
		});
		const quill_RoomInclude = new Quill('#RoomInclude', {
			theme: 'snow'
		});
		const quill_RoomExclude = new Quill('#RoomExclude', {
			theme: 'snow'
		});
		const quill_RoomWhyChooseUS = new Quill('#RoomWhyChooseUS', {
			theme: 'snow'
		});
		var oImageData = [];
		jQuery(document).ready(function() {
			var hotelimage = <?php echo $hotelimage ?>;
			jQuery('.js-example-basic-single').select2();
			jQuery('.js-example-basic-multiple').select2({
				// templateResult: formatState,
				tags: true
			});
			for (let index = 0; index < hotelimage.length; index++) {
				// const element = array[index];
				// console.log(hotelimage[index]['ImageCategory']);
				var category = [];
				category.push(hotelimage[index]['ImageCategory']);
				var oData = {
					'image': hotelimage[index]['RoomImage'],
					'category': category
				};
				oImageData.push(oData);
				
			}
			LoadImage();
		});
		jQuery('#btSaveImage').click(function() {
			var oImage = jQuery('#imagePreview').css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
			var selectedValues = jQuery('.js-example-basic-multiple').val();
			var oData = {
				'image': oImage,
				'category': selectedValues
			};
			oImageData.push(oData);

			jQuery('#imagePreview').css('background-image', 'none');
			console.log(oImageData);
			jQuery('#imagepopup').modal('hide');
			LoadImage();
		});

		jQuery('form').submit(function(e) {

            e.preventDefault(); // Prevent default form submission

			jQuery('input[type="checkbox"]').each(function () {
				console.log(jQuery(this).is(':checked'));
				if (!jQuery(this).is(':checked')) {
					jQuery(this).prop('checked', true).val('0');
				}
				else{
					jQuery(this).prop('checked', true).val('1');
				}
			});
			
            var form = $(this);
            var formData = form.serializeArray();
            var actionUrl = form.attr('action');
			// Add new Parameter
			var RoomDescription = quill_RoomDescription.root.innerHTML;
			var RoomInclude = quill_RoomInclude.root.innerHTML;
			var RoomExclude = quill_RoomExclude.root.innerHTML;
			var RoomWhyChooseUS = quill_RoomWhyChooseUS.root.innerHTML;

			formData.push({ name: "RoomDescription", value: RoomDescription });
			formData.push({ name: "RoomInclude", value: RoomInclude });
			formData.push({ name: "RoomExclude", value: RoomExclude });
			formData.push({ name: "RoomWhyChooseUS", value: RoomWhyChooseUS });
			if (Array.isArray(oImageData) && oImageData.length > 0) {
				formData.push({ name: "oImageData", value: JSON.stringify(oImageData) });
			}

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

		jQuery('#deleteImage').click(function() {
			if (imageIndex < 0) {
				swal.fire({
					title: 'Error',
					text: 'Please select image to delete',
					icon: 'error',
					confirmButtonText: 'OK'
				});
				return;
			}

			swal.fire({
				title: 'Are you sure?',
				text: 'You want to delete this image?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes',
				cancelButtonText: 'No'
			}).then(function(result) {
				if (result.isConfirmed) {
					oImageData.splice(imageIndex, 1);
					imageIndex = -1;
					LoadImage();
				}
			});
		});

		function LoadImage() {
			var previewContainer = document.getElementById("PreviewAllImage");

			// Clear previous content
			previewContainer.innerHTML = "";

			// Check if images exist
			if (!Array.isArray(oImageData) || oImageData.length === 0) {
				let noImageDiv = document.createElement("div");
				noImageDiv.className = "col-12 text-center";
				noImageDiv.innerText = "No Image Found";
				previewContainer.appendChild(noImageDiv);
				return;
			}

			// Loop through images and append dynamically
			oImageData.forEach((data, index) => {
				let imageUrl = data.image;

				if (!imageUrl) {
					console.warn("Skipping image with invalid URL:", data);
					return;
				}

				// Create the main div container
				let colDiv = document.createElement("div");
				colDiv.className = "col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3 loadingmore";
				colDiv.style.display = "block";

				let thumbnailDiv = document.createElement("div");
				thumbnailDiv.className = "thumbnail text-center mb-4";
				thumbnailDiv.dataset.index = index;

				thumbnailDiv.addEventListener("click", function () {
					document.querySelectorAll(".thumbnail").forEach(el => el.classList.remove("active"));
					this.classList.add("active");
					imageIndex = this.dataset.index; // Store selected index
            		console.log("Selected Image Index:", imageIndex);
				});
				// Create detail-link div
				let detailLinkDiv = document.createElement("div");
				detailLinkDiv.className = "detail-link";

				// Create thumbnail-imges div
				let thumbnailImgDiv = document.createElement("div");
				thumbnailImgDiv.className = "thumbnail-imges mb-2";

				let anchor = document.createElement("a");
				anchor.className = "img-select d-block";
				anchor.href = "javascript:void(0);";

				let img = document.createElement("img");
				img.className = "img-fluid";
				img.src = imageUrl;
				img.alt = "image";

				// Append elements
				anchor.appendChild(img);
				thumbnailImgDiv.appendChild(anchor);
				thumbnailDiv.appendChild(detailLinkDiv); // Add detail-link first
				thumbnailDiv.appendChild(thumbnailImgDiv);
				
				colDiv.appendChild(thumbnailDiv);
				previewContainer.appendChild(colDiv);
			});

			console.log("Images loaded successfully!");
			console.log(previewContainer.innerHTML);	
		}


	})
</script>
@endpush