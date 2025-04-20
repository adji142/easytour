@extends('parts.header')
	
@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('transportation')}}">Transportation</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Transportation</li>
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
										@if (count($transportationdetail) > 0)
                                    		Edit Transportation
	                                	@else
	                                    	Add Transportation
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
									<h3 class="card-label mb-0 font-weight-bold text-body">Your Transportation Image
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
								@if (count($transportationdetail) > 0)
                            		<form action="{{route('transportation-edit')}}" method="post">
                            	@else
                                	<form action="{{route('transportation-store')}}" method="post">
                            	@endif
                            		@csrf
	                            	<div class="form-group row">
	                            		<div class="col-md-12">
	                            			<label  class="text-body">Transportation Name</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="TransportationName" name="TransportationName" placeholder="Transportation Name" value="{{ count($transportationdetail) > 0 ? $transportationdetail[0]['TourName'] : '' }}">
	                            				<input type="hidden" class="form-control" id="id" name="id" placeholder="<AUTO>" value="{{ count($transportationdetail) > 0 ? $transportationdetail[0]['id'] : '' }}" readonly="" >
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-8">
	                            			<label  class="text-body">Transportation Type</label>
	                            			<fieldset class="form-group mb-3">
												<select class="form-select js-example-basic-single" id="TransportationType" name="TransportationType">
                                                    <option value="" {{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationType'] == '' ? 'selected' : '' : '' }}>Select Transportation Type</option>
                                                    <option value="Mini Bus" {{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationType'] == 'Mini Bus' ? 'selected' : '' : '' }}>Mini Bus</option>
                                                    <option value="City Car" {{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationType'] == 'City Car' ? 'selected' : '' : '' }}>City Car</option>
                                                    <option value="Bus" {{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationType'] == 'Bus' ? 'selected' : '' : '' }}>Bus</option>
                                                    <option value="Elf" {{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationType'] == 'Elf' ? 'selected' : '' : '' }}>Elf</option>
                                                    <option value="Motor Cycle" {{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationType'] == 'Motor Cycle' ? 'selected' : '' : '' }}>Motor Cycle</option>
                                                </select>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-4">
	                            			<label  class="text-body">Transportation Capacity</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="TransportationCapacity" name="TransportationCapacity" placeholder="1 - 2 Person" value="{{ count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationCapacity'] : '' }}">
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<label  class="text-body">Transportation Description</label>
	                            			<fieldset class="form-group mb-3">
												<div id="TransportationDescription">
													{!! count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationDescription'] : '' !!}
												</div>
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<label  class="text-body">Transportation Term And Condition</label>
	                            			<fieldset class="form-group mb-3">
												<div id="TransportationTnC">
													{!! count($transportationdetail) > 0 ? $transportationdetail[0]['TransportationTnC'] : '' !!}
												</div>
	                            			</fieldset>
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


<div class="modal fade text-left" id="LookupTourPackage" tabindex="-1" role="dialog" aria-labelledby="LookupCustomer" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1444">Add Transportation Package</h3>
                <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-bs-dismiss="modal" aria-label="Close">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmTourPackage" class="form-group row">
                    <div class="col-md-12">
                        <label  class="text-body">Transportation Package Name</label>
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" id="PackageName" name="PackageName" placeholder="Transportation Package Name">
							<input type="hidden" class="form-control" id="TransportationID_Package" name="TransportationID_Package" placeholder="<AUTO>" value="" readonly="">
                        </fieldset>
                    </div>

					<div class="col-md-6">
                        <label  class="text-body">Transportation Package Price</label>
                        <fieldset class="form-group mb-3">
                            <input type="number" class="form-control" id="PackagePrice" name="PackagePrice" placeholder="Transportation Package Price">
                        </fieldset>
                    </div>

					<div class="col-md-6">
                        <label  class="text-body">Transportation Package Discount</label>
                        <fieldset class="form-group mb-3">
                            <input type="number" class="form-control" id="PackagePriceDiscount" name="PackagePriceDiscount" placeholder="Transportation Package Discount">
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
    const quill_TransportationDescription = new Quill('#TransportationDescription', {
        theme: 'snow'
    });
    const quill_TransportationTnC = new Quill('#TransportationTnC', {
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
			var transportationpackage = <?php echo $transportationpackage ?>;

			for (let index = 0; index < transportationpackage.length; index++) {
				var oData = {
					'id': transportationpackage[index]['id'],
					'PackageName': transportationpackage[index]['PackageName'],
					'PackagePrice': transportationpackage[index]['PackagePrice'],
					'PackagePriceDiscount': transportationpackage[index]['PackagePriceDiscount'],
					'TransportationCapacity': transportationpackage[index]['TransportationCapacity'],
					'TransportationRentDuration': transportationpackage[index]['TransportationRentDuration'],
					'expanded': true
				};
				oPackageData.push(oData);
			}
			
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

			var TransportationDescription = quill_TransportationDescription.root.innerHTML;
			var TransportationTnC = quill_TransportationTnC.root.innerHTML;

			formData.push({ name: "TransportationDescription", value: TransportationDescription });
			formData.push({ name: "TransportationTnC", value: TransportationTnC });

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
							window.location.href = "{{ route('transportation') }}";
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

		jQuery('#btAddPackage').click(function() {
			jQuery('#LookupTourPackage').modal('show');
		});

		jQuery('#btSavePackage').click(function() {
            var TransportationID = jQuery('#TransportationID_Package').val();
            var PackageName = jQuery('#PackageName').val();
            var PackagePrice = jQuery('#PackagePrice').val();
			var PackagePriceDiscount = jQuery('#PackagePriceDiscount').val();
            var TransportationCapacity = 0;
			var TransportationRentDuration = 0;
            
            if (TransportationID) {
                oPackageData = oPackageData.map(item => {
                    if (item.id === TransportationID) {
                        item.PackageName = PackageName;
                        item.PackagePrice = PackagePrice;
                        item.PackagePriceDiscount = PackagePriceDiscount;
						item.TransportationCapacity = TransportationCapacity;
						item.TransportationRentDuration = TransportationRentDuration;
                    }
                    return item;
                });
                jQuery('#TransportationID_Package').val('');
            } else {
                var oData = {
                    'PackageName': PackageName,
                    'PackagePrice': PackagePrice,
                    'PackagePriceDiscount': PackagePriceDiscount,
					'TransportationCapacity': TransportationCapacity,
					'TransportationRentDuration': TransportationRentDuration,
                    'expanded': true
                };
                oPackageData.push(oData);
            }
            jQuery('#LookupTourPackage').modal('hide');
            LoadPackage();
            // frmItinerary
        });

		jQuery('#LookupTourPackage').on('hidden.bs.modal', function () {
            jQuery('#frmTourPackage')[0].reset();
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
                        <h2><strong>${item.PackageName}</strong></h2>
                    </button>
                </h2>
                <div id="collapse${item.id}" class="accordion-collapse collapse ${showClass}" 
                    aria-labelledby="heading${item.id}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

						<p><strong>Price:</strong> 
							${item.PackagePriceDiscount > 0 
								? `<span class="text-muted text-decoration-line-through">${item.PackagePrice}</span> 
								<span class="text-success fw-bold ms-2">${item.PackagePriceDiscount}</span>`
								: `<span class="fw-bold">${item.PackagePrice}</span>`
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
	function deletePackage(params) {
		oPackageData = oPackageData.filter(item => item.id !== params);
		LoadPackage();
	}
	function editPackage(params) {
		const selectedPackage = oPackageData.find(item => item.id === params);
		jQuery('#PackageName').val(selectedPackage.PackageName);
		jQuery('#PackagePrice').val(selectedPackage.PackagePrice);
		jQuery('#PackagePriceDiscount').val(selectedPackage.PackagePriceDiscount);

		jQuery('#TransportationID_Package').val(selectedPackage.id);
		jQuery('#LookupTourPackage').modal('show');
	}

</script>
@endpush