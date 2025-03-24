@extends('parts.header')
	
@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('tour')}}">Tour</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Tour</li>
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
										@if (count($tourDetail) > 0)
                                    		Edit Tour
	                                	@else
	                                    	Add Tour
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
									<h3 class="card-label mb-0 font-weight-bold text-body">Your Tour Image
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
								@if (count($tourDetail) > 0)
                            		<form action="{{route('tour-edit')}}" method="post">
                            	@else
                                	<form action="{{route('tour-store')}}" method="post">
                            	@endif
                            		@csrf
	                            	<div class="form-group row">
	                            		<div class="col-md-12">
	                            			<label  class="text-body">Tour Name</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="TourName" name="TourName" placeholder="Tour Name" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourName'] : '' }}">
	                            				<input type="hidden" class="form-control" id="id" name="id" placeholder="<AUTO>" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['id'] : '' }}" readonly="" >
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Tour Type</label>
	                            			<fieldset class="form-group mb-3">
												<select class="form-select js-example-basic-single" id="TourTypeID" name="TourTypeID">
                                                    <option value="">Select Tour Type</option>
                                                    @foreach($tourType as $key => $value)
                                                        <option value="{{ $value['id'] }}" {{ count($tourDetail) > 0 && $tourDetail[0]['TourTypeID'] == $value['id'] ? 'selected' : '' }}>{{ $value['TourTypeName'] }}</option>
                                                    @endforeach
                                                </select>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Tour Duration (Days)</label>
	                            			<fieldset class="form-group mb-3">
												<input type="number" class="form-control" id="TourDuration" name="TourDuration" placeholder="Tour Duration" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourDuration'] : '' }}">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Tour Group Size (Pax)</label>
	                            			<fieldset class="form-group mb-3">
												<input type="number" class="form-control" id="TourGroupSize" name="TourGroupSize" placeholder="Tour Group Size" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourGroupSize'] : '' }}">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<label  class="text-body">Tour Location</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="TourLocation" name="TourLocation" placeholder="tour Location" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourLocation'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Tour Check Point</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="TourCheckPoints" name="TourCheckPoints" placeholder="tour Check Point" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourCheckPoints'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Tour Check Point</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="TourCheckPoints2" name="TourCheckPoints2" placeholder="tour Check Point 2" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourCheckPoints2'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Tour Check Point</label>
	                            			<fieldset class="form-group mb-3">
	                            				<input type="text" class="form-control" id="TourCheckPoints3" name="TourCheckPoints3" placeholder="tour Check Point 3" value="{{ count($tourDetail) > 0 ? $tourDetail[0]['TourCheckPoints3'] : '' }}" required="">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<label  class="text-body">Tour Description</label>
	                            			<fieldset class="form-group mb-3">
												<div id="TourDescription">
													{!! count($tourDetail) > 0 ? $tourDetail[0]['TourDescription'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<label  class="text-body">Tour Include / Exclude</label>
	                            			<fieldset class="form-group mb-3">
												<div id="TourIncludeExclude">
													{!! count($tourDetail) > 0 ? $tourDetail[0]['TourIncludeExclude'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>
                                        
                                        <hr>

                                        <div class="col-md-12">
	                            			<button type="button" id="btAddItinerary" class="btn btn-primary text-white font-weight-bold me-1 mb-1">Add Itinerary </button>
	                            		</div>

                                        <div class="col-md-12">
                                            <div id="iteneraryData">
                                                <div class="accordion" id="accordioniteneraryData">

                                                </div>
                                            </div>
                                            
                                        </div>

                                        <hr>

                                        <div class="col-md-12">
	                            			<button type="button" id="btAddPackage" class="btn btn-primary text-white font-weight-bold me-1 mb-1">Add Pakcage </button>
	                            		</div>

										<div class="col-md-12">
                                            <div id="packageData">
                                                <div class="accordion" id="accordionpackageData">

                                                </div>
                                            </div>
                                            
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

<div class="modal fade text-left" id="LookupItinerary" tabindex="-1" role="dialog" aria-labelledby="LookupCustomer" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1444">Add Itinerary</h3>
                <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-bs-dismiss="modal" aria-label="Close">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmItinerary" class="form-group row">
                    <div class="col-md-4">
                        <label  class="text-body">Day</label>
                        <fieldset class="form-group mb-3">
                            <input type="number" class="form-control" id="DayNumber" name="DayNumber" placeholder="Day Number">
                            <input type="hidden" class="form-control" id="TourItineraryID" name="TourItineraryID" placeholder="<AUTO>" value="" readonly="">
                        </fieldset>
                    </div>

                    <div class="col-md-8">
                        <label  class="text-body">Itinerary Name</label>
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" id="TourItineraryName" name="TourItineraryName" placeholder="Itinerary Name">
                        </fieldset>
                    </div>

                    <div class="col-md-12">
                        <label  class="text-body">Itenerary Description</label>
                        <fieldset class="form-group mb-3">
                            <div id="TourItineraryDescription">
                                
                            </div>
                        </fieldset>
                    </div>
                </form>
                <hr>
                <div class="form-group row justify-content-end mb-0">
                    <div class="col-md-6  text-end">
                        <button type="button" class="btn btn-primary" id="btSaveItenerary">Save</button>
                    </div>
                </div>
            </div>
		</div>
	</div>	  	  
</div>


<div class="modal fade text-left" id="LookupTourPackage" tabindex="-1" role="dialog" aria-labelledby="LookupCustomer" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1444">Add Tour Package</h3>
                <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-bs-dismiss="modal" aria-label="Close">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmTourPackage" class="form-group row">
                    <div class="col-md-12">
                        <label  class="text-body">Tour Package Name</label>
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" id="TourPackageName" name="TourPackageName" placeholder="Tour Package Name">
							<input type="hidden" class="form-control" id="TourItineraryID_Package" name="TourItineraryID_Package" placeholder="<AUTO>" value="" readonly="">
                        </fieldset>
                    </div>

					<div class="col-md-6">
                        <label  class="text-body">Valid From</label>
                        <fieldset class="form-group mb-3">
                            <input type="date" class="form-control" id="TourStartDate" name="TourStartDate" placeholder="Tour Start Date">
                        </fieldset>
                    </div>

					<div class="col-md-6">
						<label  class="text-body">Valid To</label>
						<fieldset class="form-group mb-3">
							<input type="date" class="form-control" id="TourEndDate" name="TourEndDate" placeholder="Tour End Date">
						</fieldset>
					</div>

                    <div class="col-md-12">
                        <label  class="text-body">Tour Package Description</label>
                        <fieldset class="form-group mb-3">
                            <div id="TourPackageDescription">
                                
                            </div>
                        </fieldset>
                    </div>

					<div class="col-md-6">
                        <label  class="text-body">Tour Package Price</label>
                        <fieldset class="form-group mb-3">
                            <input type="number" class="form-control" id="TourPackagePrice" name="TourPackagePrice" placeholder="Tour Package Price">
                        </fieldset>
                    </div>

					<div class="col-md-6">
                        <label  class="text-body">Tour Package Discount</label>
                        <fieldset class="form-group mb-3">
                            <input type="number" class="form-control" id="TourPackageDiscountPrice" name="TourPackageDiscountPrice" placeholder="Tour Package Discount">
                        </fieldset>
                    </div>

					<hr>
					<br>
                </form>
                <div class="form-group row justify-content-end mb-0">
                    <div class="col-md-6  text-end">
                        <button type="button" class="btn btn-primary" id="btSavePackage">Save</button>
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
    const quill_TourDescription = new Quill('#TourDescription', {
        theme: 'snow'
    });
    const quill_TourIncludeExclude = new Quill('#TourIncludeExclude', {
        theme: 'snow'
    });
    const quill_TourItineraryDescription = new Quill('#TourItineraryDescription', {
        theme: 'snow'
    });
	const quill_TourPackageDescription = new Quill('#TourPackageDescription', {
        theme: 'snow'
    });

    var oImageData = [];
    var oItineraryData = [];
    var oPackageData = [];
	jQuery(function () {
		jQuery(document).ready(function() {
			jQuery('.js-example-basic-single').select2();
            jQuery('.js-example-basic-multiple').select2({
				// templateResult: formatState,
				tags: true
			});
            var tourImage = <?php echo $tourImage ?>;
			var tourItinerary = <?php echo $tourItinerary ?>;
			var tourPackage = <?php echo $tourPackage ?>;
            for (let index = 0; index < tourImage.length; index++) {
				var category = [];
				category.push(tourImage[index]['ImageCategory']);
				var oData = {
					'image': tourImage[index]['TourImage'],
					'category': category
				};
				oImageData.push(oData);
				
			}

			for (let index = 0; index < tourItinerary.length; index++) {
				var oData = {
					'id': tourItinerary[index]['id'],
					'DayNumber': tourItinerary[index]['DayNumber'],
					'TourItineraryName': tourItinerary[index]['TourItineraryName'],
					'TourItineraryDescription': tourItinerary[index]['TourItineraryDescription'],
					'expanded': true
				};
				oItineraryData.push(oData);
			}

			for (let index = 0; index < tourPackage.length; index++) {
				var oData = {
					'id': tourPackage[index]['id'],
					'TourPackageName': tourPackage[index]['TourPackageName'],
					'TourStartDate': tourPackage[index]['TourStartDate'],
					'TourEndDate': tourPackage[index]['TourEndDate'],
					'TourPackageDescription': tourPackage[index]['TourPackageDescription'],
					'TourPackagePrice': tourPackage[index]['TourPackagePrice'],
					'TourPackageDiscountPrice': tourPackage[index]['TourPackageDiscountPrice'],
					'expanded': true
				};
				oPackageData.push(oData);
			}
			
			LoadImage();
            LoadItenerary();
			LoadPackage();
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

            var form = $(this);
            var formData = form.serializeArray();
            var actionUrl = form.attr('action');
			var submitButton = form.find("button[type='submit']");
			submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

			var TourDescription = quill_TourDescription.root.innerHTML;
			var TourIncludeExclude = quill_TourIncludeExclude.root.innerHTML;

			formData.push({ name: "TourDescription", value: TourDescription });
			formData.push({ name: "TourIncludeExclude", value: TourIncludeExclude });

			if (Array.isArray(oImageData) && oImageData.length > 0) {
				formData.push({ name: "oImageData", value: JSON.stringify(oImageData) });
			}
			
			if (Array.isArray(oItineraryData) && oItineraryData.length > 0) {
				formData.push({ name: "oTourItineraryData", value: JSON.stringify(oItineraryData) });
			}

			if (Array.isArray(oPackageData) && oPackageData.length > 0) {
				formData.push({ name: "oTourPackageData", value: JSON.stringify(oPackageData) });
			}
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
							window.location.href = "{{ route('tour') }}";
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

        jQuery('#btAddItinerary').click(function() {
            jQuery('#LookupItinerary').modal('show');
        });
		jQuery('#btAddPackage').click(function() {
			jQuery('#LookupTourPackage').modal('show');
		});
        jQuery('#btSaveItenerary').click(function() {
            var TourItineraryID = jQuery('#TourItineraryID').val();
            var DayNumber = jQuery('#DayNumber').val();
            var TourItineraryName = jQuery('#TourItineraryName').val();
            var TourItineraryDescription = quill_TourItineraryDescription.root.innerHTML;
            
            if (TourItineraryID) {
                oItineraryData = oItineraryData.map(item => {
                    if (item.id === TourItineraryID) {
                        item.DayNumber = DayNumber;
                        item.TourItineraryName = TourItineraryName;
                        item.TourItineraryDescription = TourItineraryDescription;
                    }
                    return item;
                });
                jQuery('#TourItineraryID').val('');
            } else {
                var oData = {
                    'DayNumber': DayNumber,
                    'TourItineraryName': TourItineraryName,
                    'TourItineraryDescription': TourItineraryDescription,
                    'expanded': true
                };
                oItineraryData.push(oData);
            }
            jQuery('#LookupItinerary').modal('hide');
            LoadItenerary();
            // frmItinerary
        });

		jQuery('#btSavePackage').click(function() {
            var TourItineraryID = jQuery('#TourItineraryID_Package').val();
            var TourPackageName = jQuery('#TourPackageName').val();
            var TourStartDate = jQuery('#TourStartDate').val();
			var TourEndDate = jQuery('#TourEndDate').val();
            var TourPackageDescription = quill_TourPackageDescription.root.innerHTML;
			var TourPackagePrice = jQuery('#TourPackagePrice').val();
			var TourPackageDiscountPrice = jQuery('#TourPackageDiscountPrice').val();
            
            if (TourItineraryID) {
                oPackageData = oPackageData.map(item => {
                    if (item.id === TourItineraryID) {
                        item.TourPackageName = TourPackageName;
                        item.TourStartDate = TourStartDate;
                        item.TourEndDate = TourEndDate;
						item.TourPackageDescription = TourPackageDescription;
						item.TourPackagePrice = TourPackagePrice;
						item.TourPackageDiscountPrice = TourPackageDiscountPrice;
                    }
                    return item;
                });
                jQuery('#TourItineraryID_Package').val('');
            } else {
                var oData = {
                    'TourPackageName': TourPackageName,
                    'TourStartDate': TourStartDate,
                    'TourEndDate': TourEndDate,
					'TourPackageDescription': TourPackageDescription,
					'TourPackagePrice': TourPackagePrice,
					'TourPackageDiscountPrice': TourPackageDiscountPrice,
                    'expanded': true
                };
                oPackageData.push(oData);
            }
            jQuery('#LookupTourPackage').modal('hide');
            LoadPackage();
            // frmItinerary
        });

        jQuery('#LookupItinerary').on('hidden.bs.modal', function () {
            jQuery('#frmItinerary')[0].reset();
            quill_TourItineraryDescription.root.innerHTML = "";
        });
		jQuery('#LookupTourPackage').on('hidden.bs.modal', function () {
            jQuery('#frmTourPackage')[0].reset();
            quill_TourPackageDescription.root.innerHTML = "";
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
        
        
	});
    function LoadItenerary() {
        // iteneraryData
        var previewContainer = document.getElementById("accordioniteneraryData");
        previewContainer.innerHTML = "";

        if (!Array.isArray(oItineraryData) || oItineraryData.length === 0) {
            let noImageDiv = document.createElement("div");
            noImageDiv.className = "col-12 text-center";
            noImageDiv.innerText = "No Itinerary Data Found";
            previewContainer.appendChild(noImageDiv);
            return;
        }

        oItineraryData.sort((a, b) => a.DayNumber - b.DayNumber);

        oItineraryData.forEach((item, index) => {
            const randomID = generateRandomText(5);
            item.id = randomID;
            item.expanded = false;
            const isExpanded = item.expanded ? "true" : "false";
            const showClass = item.expanded ? "show" : "";
            const collapsedClass = item.expanded ? "" : "collapsed";

            const accordionItem = document.createElement("div");
            accordionItem.classList.add("accordion-item");

            accordionItem.innerHTML = `
                <h2 class="accordion-header" id="heading${item.id}">
                    <button class="accordion-button ${collapsedClass}" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapse${item.id}" aria-expanded="${isExpanded}" aria-controls="collapse${item.id}">
                        <h2><strong>Day ${item.DayNumber}</strong></h2> - ${item.TourItineraryName}
                    </button>
                </h2>
                <div id="collapse${item.id}" class="accordion-collapse collapse ${showClass}" 
                    aria-labelledby="heading${item.id}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">${item.TourItineraryDescription}</div>

                    <div class="d-flex justify-content-end mt-2 p-2">
                        <button type="button" class="btn btn-danger" onclick="deleteItinerary('${item.id}')">Delete</button>
                        <button type="button" class="btn btn-success ms-2" onclick="editItinerary('${item.id}')">Edit</button>
                    </div>
                </div>
            `;

            previewContainer.appendChild(accordionItem);
        });

    }

	function LoadPackage() {
        // iteneraryData
		console.log(oPackageData);
        var previewContainer = document.getElementById("accordionpackageData");
        previewContainer.innerHTML = "";

        if (!Array.isArray(oPackageData) || oPackageData.length === 0) {
            let noImageDiv = document.createElement("div");
            noImageDiv.className = "col-12 text-center";
            noImageDiv.innerText = "No Package Data Found";
            previewContainer.appendChild(noImageDiv);
            return;
        }

        oPackageData.forEach((item, index) => {
            const randomID = generateRandomText(5);
            item.id = randomID;
            item.expanded = false;
            const isExpanded = item.expanded ? "true" : "false";
            const showClass = item.expanded ? "show" : "";
            const collapsedClass = item.expanded ? "" : "collapsed";

            const accordionItem = document.createElement("div");
            accordionItem.classList.add("accordion-item");

            accordionItem.innerHTML = `
                <h2 class="accordion-header" id="heading${item.id}">
                    <button class="accordion-button ${collapsedClass}" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapse${item.id}" aria-expanded="${isExpanded}" aria-controls="collapse${item.id}">
                        <h2><strong>${item.TourPackageName}</strong></h2>
                    </button>
                </h2>
                <div id="collapse${item.id}" class="accordion-collapse collapse ${showClass}" 
                    aria-labelledby="heading${item.id}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
						<p><strong>Start Date:</strong> ${item.TourStartDate}</p>
        				<p><strong>End Date:</strong> ${item.TourEndDate}</p>
						<p><strong>Description:</strong> ${item.TourPackageDescription}</p>

						<p><strong>Price:</strong> 
							${item.TourPackageDiscountPrice > 0 
								? `<span class="text-muted text-decoration-line-through">${item.TourPackagePrice}</span> 
								<span class="text-success fw-bold ms-2">${item.TourPackagePrice - item.TourPackageDiscountPrice}</span>`
								: `<span class="fw-bold">${item.TourPackagePrice}</span>`
							}
						</p>
					</div>

                    <div class="d-flex justify-content-end mt-2 p-2">
                        <button type="button" class="btn btn-danger" onclick="deletePackage('${item.id}')">Delete</button>
                        <button type="button" class="btn btn-success ms-2" onclick="editPackage('${item.id}')">Edit</button>
                    </div>
                </div>
            `;

            previewContainer.appendChild(accordionItem);
        });

    }

    function generateRandomText(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let randomText = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            randomText += characters[randomIndex];
        }
        return randomText;
    }
    function deleteItinerary(params) {
        oItineraryData = oItineraryData.filter(item => item.id !== params);
        LoadItenerary();
    }
	function deletePackage(params) {
		oPackageData = oPackageData.filter(item => item.id !== params);
		LoadPackage();
	}
    function editItinerary(params) {
        const selectedItinerary = oItineraryData.find(item => item.id === params);
        jQuery('#DayNumber').val(selectedItinerary.DayNumber);
        jQuery('#TourItineraryID').val(selectedItinerary.id);
        jQuery('#TourItineraryName').val(selectedItinerary.TourItineraryName);
        quill_TourItineraryDescription.root.innerHTML = selectedItinerary.TourItineraryDescription;

        jQuery('#LookupItinerary').modal('show');
    }
	function editPackage(params) {
		const selectedPackage = oPackageData.find(item => item.id === params);
		jQuery('#TourPackageName').val(selectedPackage.TourPackageName);
		jQuery('#TourStartDate').val(selectedPackage.TourStartDate);
		jQuery('#TourEndDate').val(selectedPackage.TourEndDate);
		quill_TourPackageDescription.root.innerHTML = selectedPackage.TourPackageDescription;
		jQuery('#TourPackagePrice').val(selectedPackage.TourPackagePrice);
		jQuery('#TourPackageDiscountPrice').val(selectedPackage.TourPackageDiscountPrice);

		jQuery('#TourItineraryID_Package').val(selectedPackage.id);
		jQuery('#LookupTourPackage').modal('show');
	}

</script>
@endpush