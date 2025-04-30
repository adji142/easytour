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
        vertical-align: middle;
        align-content: center;
        width: 400px;
        height: 250px;
    }
    .image_result img {
      max-width: 100%;
      height: 100%;
    }
</style>

<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">
					<a href="{{route('article')}}">Article</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Article</li>
			</ol>
		</nav>
	</div>
</div>

<div class="d-flex flex-column-fluid">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 px-4">
				<div class="row">
					<div class="col-lg-12 col-xl-12 px-4">
						<div class="card card-custom gutter-b bg-transparent shadow-none border-0">
							<div class="card-header align-items-center border-bottom-dark px-0">
								<div class="card-title mb-0">
									<h3 class="card-label mb-0 font-weight-bold text-body">
										@if (count($article) > 0)
											Edit Article
										@else
											Add Article
										@endif
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 px-4">
						<div class="card card-custom gutter-b bg-white border-0">
							<div class="card-body">
								@if (count($article) > 0)
									<form action="{{route('article-edit')}}" method="post">
								@else
									<form action="{{route('article-store')}}" method="post">
								@endif
									@csrf
									<div class="form-group row">

										<div class="col-md-12">
											<label class="text-body">Title</label>
											<fieldset class="form-group mb-3">
												<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ count($article) > 0 ? $article[0]['title'] : '' }}">
												<input type="hidden" class="form-control" id="id" name="id" value="{{ count($article) > 0 ? $article[0]['id'] : '' }}" readonly>
											</fieldset>
										</div>

                                        <div class="col-md-12"> 
	                            			<fieldset class="form-group mb-3">
	                            				<textarea id = "image_base64" name = "image_base64" style="display: none;"> {{ count($article) > 0 ? $article[0]['thumnail'] : '' }} </textarea>
	                            				
	                            				<input type="file" id="Attachment" name="Attachment" accept=".jpg, .png" class="btn btn-warning" style="display: none;"/>
	                            				<div class="xContainer">
									                <div id="image_result" class="image_result">
									                	@if (count($article) > 0)
				                                    		<img src=" {{$article[0]['thumbnail']}} ">
				                                    	@else
				                                    		<img src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg">
					                                	@endif
									                </div>
									            </div>
	                            			</fieldset>
	                            			
	                            		</div>

                                        <div class="col-md-12">
											<label class="text-body">Contect</label>
											<fieldset class="form-group mb-3">
												<textarea id="editor" name="content">{{ count($article) > 0 ? $article[0]['content'] : '' }}</textarea><br>
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
	var _URL = window.URL || window.webkitURL;
	jQuery(function () {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '/upload?_token={{ csrf_token() }}'
                }
            })
            .catch(error => {
                console.error(error);
            });
            
		jQuery('#image_result').click(function(){
			$('#Attachment').click();
		});

		jQuery('form').submit(function(e) {
			e.preventDefault();

			var form = $(this);
			var formData = form.serializeArray();
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
							window.location.href = "{{ route('article') }}";
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
		img.onload = function () {
			readURL($("#Attachment")[0]);
			encodeImagetoBase64($("#Attachment")[0]);
		}
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#image_result').html("<img src='" + e.target.result + "'>");
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	function encodeImagetoBase64(element) {
		$('#image_base64').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
			$('#image_base64').val(reader.result);
		}
		reader.readAsDataURL(file);
	}
</script>
@endpush
