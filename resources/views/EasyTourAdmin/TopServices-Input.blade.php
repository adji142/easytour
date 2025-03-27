@extends('parts.headeradmin')
	
@section('content')

<style type="text/css">
    .xContainer{
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      vertical-align: middle;
    }
    .image_result{
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid black;
      /*flex-grow: 1;*/
      vertical-align: middle;
      align-content: center;
      flex-basis: 200;
      width: 150px;
      height: 200px;
    }
    .image_result img {
      max-width: 100%; /* Fit the image to the container width */
      height: 100%; /* Maintain the aspect ratio */
    }
  </style>

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('topservices')}}">Top Services</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Top Services</li>
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
										@if (count($topservices) > 0)
                                    		Edit Top Services
	                                	@else
	                                    	Add Top Services
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
								@if (count($topservices) > 0)
                            		<form action="{{route('topservices-edit')}}" method="post">
                            	@else
                                	<form action="{{route('topservices-store')}}" method="post">
                            	@endif
                            		@csrf
	                            	<div class="form-group row">
                                        <div class="col-md-12"> 
	                            			<fieldset class="form-group mb-3">
	                            				<textarea id = "Icon_Base64" name = "Icon_Base64" style="display: none;"> {{ count($topservices) > 0 ? $topservices[0]['Icon'] : '' }} </textarea>
	                            				
	                            				<input type="file" id="Attachment" name="Attachment" accept=".jpg, .png" class="btn btn-warning" style="display: none;"/>
	                            				<div class="xContainer">
									                <div id="image_result" class="image_result">
									                	@if (count($topservices) > 0)
				                                    		<img src=" {{$topservices[0]['Icon']}} ">
				                                    	@else
				                                    		<img src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg">
					                                	@endif
									                </div>
									            </div>
	                            			</fieldset>
	                            			
	                            		</div>

	                            		<div class="col-md-12">
	                            			<label  class="text-body">Head Line</label>
	                            			<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="HeadLine" name="HeadLine" placeholder="Head Line" value="{{ count($topservices) > 0 ? $topservices[0]['HeadLine'] : '' }}">
	                            				<input type="hidden" class="form-control" id="id" name="id" placeholder="<AUTO>" value="{{ count($topservices) > 0 ? $topservices[0]['id'] : '' }}" readonly="" >
	                            			</fieldset>
	                            		</div>

                                        <div class="col-md-12">
	                            			<label  class="text-body">Description</label>
	                            			<fieldset class="form-group mb-3">
												<div id="Description">
													{!! count($topservices) > 0 ? $topservices[0]['Description'] : '' !!}
												</div>
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
    var _URL = window.URL || window.webkitURL;
    var _URLePub = window.URL || window.webkitURL;
	jQuery(function () {
        const quill_Description = new Quill('#Description', {
            theme: 'snow'
        });
		jQuery(document).ready(function() {
			
		});

        jQuery('#image_result').click(function(){
            $('#Attachment').click();
        });

		jQuery('form').submit(function(e) {

            e.preventDefault(); // Prevent default form submission

            var form = $(this);
            var formData = form.serializeArray();
            var actionUrl = form.attr('action');
			var submitButton = form.find("button[type='submit']");
			submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

            var Description = quill_Description.root.innerHTML;
            formData.push({ name: "Description", value: Description });

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
							window.location.href = "{{ route('topservices') }}";
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
	});

    $("#Attachment").change(function(){
      var file = $(this)[0].files[0];
      img = new Image();
      img.src = _URL.createObjectURL(file);
      var imgwidth = 0;
      var imgheight = 0;
      img.onload = function () {
        imgwidth = this.width;
        imgheight = this.height;
        $('#width').val(imgwidth);
        $('#height').val(imgheight);
      }
      readURL(this);
      encodeImagetoBase64(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
          
        reader.onload = function (e) {
          // console.log(e.target.result);
          $('#image_result').html("<img src ='"+e.target.result+"'> ");
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    function encodeImagetoBase64(element) {
      $('#Icon_Base64').val('');
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
          // $(".link").attr("href",reader.result);
          // $(".link").text(reader.result);
          $('#Icon_Base64').val(reader.result);
        }
        reader.readAsDataURL(file);
    }
</script>
@endpush