@extends('parts.header')
	
@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('tourtypes')}}">Tour Types</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Tour Types</li>
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
										@if (count($tourtype) > 0)
                                    		Edit Tour Types
	                                	@else
	                                    	Add Tour Types
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
								@if (count($tourtype) > 0)
                            		<form action="{{route('tourtypes-edit')}}" method="post">
                            	@else
                                	<form action="{{route('tourtypes-store')}}" method="post">
                            	@endif
                            		@csrf
	                            	<div class="form-group row">
	                            		<div class="col-md-12">
	                            			<label  class="text-body">Tour Types Name</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="TourTypeName" name="TourTypeName" placeholder="Tour Types Name" value="{{ count($tourtype) > 0 ? $tourtype[0]['TourTypeName'] : '' }}">
	                            				<input type="hidden" class="form-control" id="id" name="id" placeholder="<AUTO>" value="{{ count($tourtype) > 0 ? $tourtype[0]['id'] : '' }}" readonly="" >
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
							window.location.href = "{{ route('tourtypes') }}";
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