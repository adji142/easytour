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
      width: 414px;
      height: 311px;
    }
	.image_result_home_banner{
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid black;
      /*flex-grow: 1;*/
      vertical-align: middle;
      align-content: center;
      flex-basis: 200;
      width: 814px;
      height: 311px;
    }
	.image_result_icon{
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid black;
      /*flex-grow: 1;*/
      vertical-align: middle;
      align-content: center;
      flex-basis: 200;
      width: 63px;
      height: 69px;
    }
	.image_result_banner{
		display: flex;
		justify-content: center;
		align-items: center;
		border: 1px solid black;
		/*flex-grow: 1;*/
		vertical-align: middle;
		align-content: center;
		flex-basis: 200;
		width: 414px;
		height: 311px;
    }
    .image_result img {
      max-width: 100%; /* Fit the image to the container width */
      height: 100%; /* Maintain the aspect ratio */
    }
	.image_result_icon img {
      max-width: 100%; /* Fit the image to the container width */
      height: 100%; /* Maintain the aspect ratio */
    }
	.image_result_home_banner img {
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
					<a href="#">Easy Tour Setting</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Input Easy Tour Setting</li>
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
										Edit Top Services
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
								<form action="{{ route('easytoursetting-store') }}" method="post">
                            		@csrf
	                            	<div class="row">
                                        <div class="col-md-3">
											<ul class="nav flex-column nav-pills mb-3" id="v-pills-tab1" role="tablist" aria-orientation="vertical">
												<li class="nav-item" >
													<a class="nav-link active" id="general-tab2" data-bs-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
												</li>
												<li class="nav-item" >
													<a class="nav-link" id="about-tab2" data-bs-toggle="pill" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
												</li>
												<li class="nav-item" >
													<a class="nav-link" id="about-tab2" data-bs-toggle="pill" href="#bannersetting" role="tab" aria-controls="bannersetting" aria-selected="true">Banner</a>
												</li>
												<li class="nav-item" >
													<a class="nav-link" id="about-tab2" data-bs-toggle="pill" href="#privacypolicysetting" role="tab" aria-controls="privacypolicysetting" aria-selected="true">Privacy & Policy</a>
												</li>
												<li class="nav-item" >
													<a class="nav-link" id="about-tab2" data-bs-toggle="pill" href="#faqsetting" role="tab" aria-controls="faqsetting" aria-selected="true">FaQ</a>
												</li>
												<li class="nav-item" >
													<a class="nav-link" id="about-tab2" data-bs-toggle="pill" href="#howitworks" role="tab" aria-controls="howitworks" aria-selected="true">How It'S Works</a>
												</li>
												<li class="nav-item" >
													<a class="nav-link" id="about-tab2" data-bs-toggle="pill" href="#termandcondition" role="tab" aria-controls="termandcondition" aria-selected="true">Term and Condition</a>
												</li>
											</ul>
										</div>

										<div class="col-md-9">
											<div class="tab-content" id="v-pills-tabContent1">
												<div class="tab-pane fade show active" id="general" role="tabpanel" >
													<div class="form-group row">
														
														<div class="col-md-6"> 
															<label  class="text-body">Legal Company name</label>
					                            			<fieldset class="form-group mb-3">
																<input type ="hidden" class="form-control" id="id" name="id" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['id'] : '' }}"  >
					                            				<input type="text" class="form-control" id="LegalName" name="LegalName" placeholder="Enter Legal Company Name" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['LegalName'] : '' }}"  >
					                            			</fieldset>
														</div>
														<div class="col-md-6"> 
															<label  class="text-body">Apps Name</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="AppsName" name="AppsName" placeholder="Enter Apps Name" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AppsName'] : '' }}"  >
					                            			</fieldset>
														</div>

														<div class="col-md-6"> 
															<label  class="text-body">Email</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="AppsEmail" name="AppsEmail" placeholder="Enter Email" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AppsEmail'] : '' }}"  >
					                            			</fieldset>
														</div>

														<div class="col-md-6"> 
															<label  class="text-body">Phone</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="AppsPhone" name="AppsPhone" placeholder="Enter Phone" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AppsPhone'] : '' }}"  >
					                            			</fieldset>
														</div>

														<div class="col-md-12"> 
															<label  class="text-body">Address</label>
					                            			<fieldset class="form-group mb-3">
																<div id="AppsAddress">
																	{!! count($easytoursetting) > 0 ? $easytoursetting[0]['AppsAddress'] : '' !!}
																</div>
															</fieldset>
														</div>
														
														<div class="col-md-3"> 
															<label  class="text-body">Facebook Page</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="FacebookPage" name="FacebookPage" placeholder="Enter Facebook Page" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['FacebookPage'] : '' }}"  >
					                            			</fieldset>
														</div>

														<div class="col-md-3"> 
															<label  class="text-body">Instagram Page</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="InstagramPage" name="InstagramPage" placeholder="Enter Instagram Page" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['InstagramPage'] : '' }}"  >
					                            			</fieldset>
														</div>

														<div class="col-md-3"> 
															<label  class="text-body">Twitter Page</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="TwitterPage" name="TwitterPage" placeholder="Enter Twitter Page" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['TwitterPage'] : '' }}"  >
					                            			</fieldset>
														</div>

														<div class="col-md-3"> 
															<label  class="text-body">Youtube Page</label>
					                            			<fieldset class="form-group mb-3">
					                            				<input type="text" class="form-control" id="YoutubePage" name="YoutubePage" placeholder="Enter Youtube Page" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['YoutubePage'] : '' }}"  >
					                            			</fieldset>
														</div>

													</div>
												</div>

												<div class="tab-pane fade show" id="about" role="tabpanel" >
													<div class="form-group row">
														<div class = "col-md-12">
															<label  class="text-body">About Headline</label>
															<fieldset class="form-group mb-3">
																<input type="text" class="form-control" id="AboutHeadline" name="AboutHeadline" placeholder="Enter About Headline" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutHeadline'] : '' }}"  >
															</fieldset>
														</div>

														<div class="col-md-12">
															<label  class="text-body">About Text</label>
					                            			<fieldset class="form-group mb-3">
																<div id="About">
																	{!! count($easytoursetting) > 0 ? $easytoursetting[0]['About'] : '' !!}
																</div>
															</fieldset>
														</div>
														<div class="col-md-6"> 
															<fieldset class="form-group mb-3">
																<textarea id = "Base64_AboutImage" name = "Base64_AboutImage" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutImage'] : '' }}</textarea>
																
																<input type="file" id="AttachmentAboutImage" name="AttachmentAboutImage" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																<div class="xContainer">
																	<div id="image_result_AboutImage" class="image_result">
																		<img src="{{ !empty($easytoursetting[0]['AboutImage']) ? $easytoursetting[0]['AboutImage'] : asset('images/about_two.png') }}">
																	</div>
																</div>
																<small><span class="text-danger">* Image size should be 830 x 620 px</span><br></small>
															</fieldset>
														</div>
														
														<div class="col-md-6"> 
															<div class ="row">
																<div class="col-md-3">
																	<fieldset class="form-group mb-3">
																		<textarea id = "image_icon1_base64" name = "image_icon1_base64" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutIcon1'] : '' }}</textarea>
																		
																		<input type="file" id="AttachmentIcon1" name="AttachmentIcon1" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																		<div class="xContainer">
																			<div id="image_result_icon1" class="image_result_icon">
																				<img src="{{ !empty($easytoursetting[0]['AboutIcon1']) ? $easytoursetting[0]['AboutIcon1'] : asset('images/about-1.png') }}">
																			</div>
																		</div>
																	</fieldset>
																</div>

																<div class="col-md-9">
																	<div class="row">
																		<div class = "col-md-12">
																			<label  class="text-body">Headline About Point 1</label>
																			<fieldset class="form-group mb-3">
																				<input type="text" class="form-control" id="AboutSubHeadline1" name="AboutSubHeadline1" placeholder="Enter About Point 1" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutSubHeadline1'] : '' }}"  >
																			</fieldset>
																		</div>
																		<div class = "col-md-12">
																			<fieldset class="form-group mb-3">
																				<label  class="text-body">About Point 1</label>
																				<fieldset class="form-group mb-3">
																					<div id="AboutDescriptionSubHeadline1">
																						{!! count($easytoursetting) > 0 ? $easytoursetting[0]['AboutDescriptionSubHeadline1'] : '' !!}
																					</div>
																					<small><span class="text-danger">* Image size should be 53 x 49 px</span><br></small>
																				</fieldset>
																			</fieldset>
																		</div>
																	</div>
																</div>

																<div class="col-md-3">
																	<fieldset class="form-group mb-3">
																		<textarea id = "image_icon2_base64" name = "image_icon2_base64" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutIcon2'] : '' }}</textarea>
																		
																		<input type="file" id="AttachmentIcon2" name="AttachmentIcon2" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																		<div class="xContainer">
																			<div id="image_result_icon2" class="image_result_icon">
																				<img src="{{ !empty($easytoursetting[0]['AboutIcon2']) ? $easytoursetting[0]['AboutIcon2'] : asset('images/about-1.png') }}">
																			</div>
																		</div>
																	</fieldset>
																</div>

																<div class="col-md-9">
																	<div class="row">
																		<div class = "col-md-12">
																			<label  class="text-body">Headline About Point 2</label>
																			<fieldset class="form-group mb-3">
																				<input type="text" class="form-control" id="AboutSubHeadline2" name="AboutSubHeadline2" placeholder="Enter About Point 2" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutSubHeadline2'] : '' }}"  >
																			</fieldset>
																		</div>
																		<div class = "col-md-12">
																			<fieldset class="form-group mb-3">
																				<label  class="text-body">About Point 2</label>
																				<fieldset class="form-group mb-3">
																					<div id="AboutDescriptionSubHeadline2">
																						{!! count($easytoursetting) > 0 ? $easytoursetting[0]['AboutDescriptionSubHeadline2'] : '' !!}
																					</div>
																					<small><span class="text-danger">* Image size should be 53 x 49 px</span><br></small>
																				</fieldset>
																			</fieldset>
																		</div>
																	</div>
																</div>

																<div class="col-md-3">
																	<fieldset class="form-group mb-3">
																		<textarea id = "image_icon3_base64" name = "image_icon3_base64" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutIcon3'] : '' }}</textarea>
																		
																		<input type="file" id="AttachmentIcon3" name="AttachmentIcon3" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																		<div class="xContainer">
																			<div id="image_result_icon3" class="image_result_icon">
																				<img src="{{ !empty($easytoursetting[0]['AboutIcon3']) ? $easytoursetting[0]['AboutIcon3'] : asset('images/about-1.png') }}">
																			</div>
																		</div>
																	</fieldset>
																</div>

																<div class="col-md-9">
																	<div class="row">
																		<div class = "col-md-12">
																			<label  class="text-body">Headline About Point 3</label>
																			<fieldset class="form-group mb-3">
																				<input type="text" class="form-control" id="AboutSubHeadline3" name="AboutSubHeadline3" placeholder="Enter About Point 3" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['AboutSubHeadline3'] : '' }}"  >
																			</fieldset>
																		</div>
																		<div class = "col-md-12">
																			<fieldset class="form-group mb-3">
																				<label  class="text-body">About Point 3</label>
																				<fieldset class="form-group mb-3">
																					<div id="AboutDescriptionSubHeadline3">
																						{!! count($easytoursetting) > 0 ? $easytoursetting[0]['AboutDescriptionSubHeadline3'] : '' !!}
																					</div>
																					<small><span class="text-danger">* Image size should be 53 x 49 px</span><br></small>
																				</fieldset>
																			</fieldset>
																		</div>
																	</div>
																</div>

															</div>
														</div>

													</div>
												</div>

												<div class="tab-pane fade show" id="bannersetting" role="tabpanel" >
													<div class="form-group row">

														<div class="col-md-12">
															<fieldset class="form-group mb-3">
																<textarea id = "image_banner_base64" name = "image_banner_base64" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['BannerImage'] : '' }}</textarea>
																
																<input type="file" id="AttachmentBanner" name="AttachmentBanner" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																<div class="xContainer">
																	<div id="image_result_BannerImage" class="image_result_home_banner">
																		<img src="{{ !empty($easytoursetting[0]['BannerImage']) ? $easytoursetting[0]['BannerImage'] : asset('images/about-1.png') }}">
																	</div>
																	<small><span class="text-danger">* Image size should be 1920 x 920 px</span><br></small>
																</div>
															</fieldset>
														</div>

														<div class="col-md-12">
															<label  class="text-body">Banner Headline</label>
															<fieldset class="form-group mb-3">
																<input type="text" class="form-control" id="BannerHeadline" name="BannerHeadline" placeholder="Enter Banner Headline" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['BannerHeadline'] : '' }}"  >
															</fieldset>
														</div>

														<div class="col-md-12">
															<label  class="text-body">Banner Sub Headline</label>
															<fieldset class="form-group mb-3">
																<input type="text" class="form-control" id="BannerSubHeadline" name="BannerSubHeadline" placeholder="Enter Banner Sub Headline" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['BannerSubHeadline'] : '' }}"  >
															</fieldset>
														</div>

													</div>
												</div>

												<div class="tab-pane fade show" id="privacypolicysetting" role="tabpanel" >
													<div class="form-group row">
														<div class = "col-md-12">
															<label  class="text-body">Privacy & Policy</label>
															<fieldset class="form-group mb-3">
																<div id="PrivacyPolicy">
																	{!! count($easytoursetting) > 0 ? $easytoursetting[0]['PrivacyPolicy'] : '' !!}
																</div>
															</fieldset>
														</div>

													</div>
												</div>

												<div class="tab-pane fade show" id="faqsetting" role="tabpanel" >
													<div class="form-group row">
														<div class="col-md-12">
															<button type="button" id="btAddFaQ" class="btn btn-primary text-white font-weight-bold me-1 mb-1">Add FaQ </button>
														</div>
				
														<div class="col-md-12">
															<div id="iteneraryData">
																<div class="accordion" id="accordionFaQData">
				
																</div>
															</div>
															
														</div>

													</div>
												</div>

												<div class="tab-pane fade show" id="howitworks" role="tabpanel" >
													<div class="form-group row">
														<div class="col-md-6"> 
															<fieldset class="form-group mb-3">
																<textarea id = "Base64_HiWImage1" name = "Base64_HiWImage1" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['HiWImage1'] : '' }}</textarea>
																
																<input type="file" id="AttachmentHiWImage1" name="AttachmentHiWImage1" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																<div class="xContainer">
																	<div id="image_result_HiWImage1" class="image_result">
																		<img src="{{ !empty($easytoursetting[0]['HiWImage1']) ? $easytoursetting[0]['HiWImage1'] : "" }}">
																	</div>
																</div>
																<small><span class="text-danger">* Image size should be 387 x 356 px</span><br></small>
															</fieldset>
														</div>

														<div class="col-md-6"> 
															<div class="row">
																<div class="col-md-12"> 
																	<label  class="text-body">Headline Text 1</label>
																	<fieldset class="form-group mb-3">
																		<input type="text" class="form-control" id="HiWHeadline1" name="HiWHeadline1" placeholder="Enter Banner Sub Headline" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['HiWHeadline1'] : '' }}"  >
																	</fieldset>
																</div>

																<div class="col-md-12"> 
																	<label  class="text-body">How It'S Work Text 1</label>
																	<fieldset class="form-group mb-3">
																		<div id="HiWText1">
																			{!! count($easytoursetting) > 0 ? $easytoursetting[0]['HiWText1'] : '' !!}
																		</div>
																	</fieldset>
																</div>

															</div>
														</div>



														<div class="col-md-6"> 
															<fieldset class="form-group mb-3">
																<textarea id = "Base64_HiWImage2" name = "Base64_HiWImage2" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['HiWImage2'] : '' }}</textarea>
																
																<input type="file" id="AttachmentHiWImage2" name="AttachmentHiWImage2" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																<div class="xContainer">
																	<div id="image_result_HiWImage2" class="image_result">
																		<img src="{{ !empty($easytoursetting[0]['HiWImage2']) ? $easytoursetting[0]['HiWImage2'] : "" }}">
																	</div>
																</div>
																<small><span class="text-danger">* Image size should be 387 x 356 px</span><br></small>
															</fieldset>
														</div>

														<div class="col-md-6"> 
															<div class="row">
																<div class="col-md-12"> 
																	<label  class="text-body">Headline Text 2</label>
																	<fieldset class="form-group mb-3">
																		<input type="text" class="form-control" id="HiWHeadline2" name="HiWHeadline2" placeholder="Enter Banner Sub Headline" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['HiWHeadline2'] : '' }}"  >
																	</fieldset>
																</div>

																<div class="col-md-12"> 
																	<label  class="text-body">How It'S Work Text 2</label>
																	<fieldset class="form-group mb-3">
																		<div id="HiWText2">
																			{!! count($easytoursetting) > 0 ? $easytoursetting[0]['HiWText2'] : '' !!}
																		</div>
																	</fieldset>
																</div>

															</div>
														</div>


														<div class="col-md-6"> 
															<fieldset class="form-group mb-3">
																<textarea id = "Base64_HiWImage3" name = "Base64_HiWImage3" style="display: none;">{{ count($easytoursetting) > 0 ? $easytoursetting[0]['HiWImage3'] : '' }}</textarea>
																
																<input type="file" id="AttachmentHiWImage3" name="AttachmentHiWImage3" accept=".jpg" class="btn btn-warning" style="display: none;"/>
																<div class="xContainer">
																	<div id="image_result_HiWImage3" class="image_result">
																		<img src="{{ !empty($easytoursetting[0]['HiWImage3']) ? $easytoursetting[0]['HiWImage3'] : "" }}">
																	</div>
																</div>
																<small><span class="text-danger">* Image size should be 387 x 356 px</span><br></small>
															</fieldset>
														</div>

														<div class="col-md-6"> 
															<div class="row">
																<div class="col-md-12"> 
																	<label  class="text-body">Headline Text 3</label>
																	<fieldset class="form-group mb-3">
																		<input type="text" class="form-control" id="HiWHeadline3" name="HiWHeadline3" placeholder="Enter Banner Sub Headline" value="{{ count($easytoursetting) > 0 ? $easytoursetting[0]['HiWHeadline3'] : '' }}"  >
																	</fieldset>
																</div>

																<div class="col-md-12"> 
																	<label  class="text-body">How It'S Work Text 3</label>
																	<fieldset class="form-group mb-3">
																		<div id="HiWText3">
																			{!! count($easytoursetting) > 0 ? $easytoursetting[0]['HiWText3'] : '' !!}
																		</div>
																	</fieldset>
																</div>

															</div>
														</div>

														

													</div>
												</div>

												<div class="tab-pane fade show" id="termandcondition" role="tabpanel" >
													<div class="form-group row">

														<div class="col-md-12"> 
															<label  class="text-body">Term and Condition</label>
															<fieldset class="form-group mb-3">
																<div id="TermandCondition">
																	{!! count($easytoursetting) > 0 ? $easytoursetting[0]['TermandCondition'] : '' !!}
																</div>
															</fieldset>
														</div>

													</div>
												</div>

												
{{-- termandcondition --}}
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

<div class="modal fade text-left" id="LookupFaQ" tabindex="-1" role="dialog" aria-labelledby="LookupFaQ" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1444">Add FaQ</h3>
                <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-bs-dismiss="modal" aria-label="Close">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmFaQ" class="form-group row">
                    <div class="col-md-12">
                        <label  class="text-body">FaQ Title</label>
                        <fieldset class="form-group mb-3">
                            <input type="text" class="form-control" id="FaqHeader" name="FaqHeader" placeholder="FaQ Title">
                            <input type="hidden" class="form-control" id="FaQid" name="FaQid" placeholder="<AUTO>" value="" readonly="">
                        </fieldset>
                    </div>

                    <div class="col-md-12">
                        <label  class="text-body">FaQ Detail</label>
                        <fieldset class="form-group mb-3">
                            <div id="FaqDetail">
                                
                            </div>
                        </fieldset>
                    </div>
                </form>
                <hr>
                <div class="form-group row justify-content-end mb-0">
                    <div class="col-md-6  text-end">
                        <button type="button" class="btn btn-primary" id="btSaveFaQ">Save</button>
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

	var oFaQData = [];

	const quill_AppsAddress = new Quill('#AppsAddress', {
		theme: 'snow'
	});
	const quill_AboutDescriptionSubHeadline1 = new Quill('#AboutDescriptionSubHeadline1', {
		theme: 'snow'
	});
	const quill_AboutDescriptionSubHeadline2 = new Quill('#AboutDescriptionSubHeadline2', {
		theme: 'snow'
	});
	const quill_AboutDescriptionSubHeadline3 = new Quill('#AboutDescriptionSubHeadline3', {
		theme: 'snow'
	});
	const quill_About = new Quill('#About', {
		theme: 'snow'
	});

	const quill_PrivacyPolicy = new Quill('#PrivacyPolicy', {
		theme: 'snow'
	});

	const quill_FaqDetail = new Quill('#FaqDetail', {
		theme: 'snow'
	});

	const quill_HiWText1 = new Quill('#HiWText1', {
		theme: 'snow'
	});

	const quill_HiWText2 = new Quill('#HiWText2', {
		theme: 'snow'
	});

	const quill_HiWText3 = new Quill('#HiWText3', {
		theme: 'snow'
	});

	const quill_TermandCondition = new Quill('#TermandCondition', {
		theme: 'snow'
	});

	jQuery(function () {
		// FaqDetail
		jQuery(document).ready(function() {
			var faq = <?php echo $faq ?>;
			for (let index = 0; index < faq.length; index++) {
				var oData = {
					'FaqHeader': faq[index]['FaqHeader'],
					'FaqDetail': faq[index]['FaqDetail'],
				};
				oFaQData.push(oData);
				
			}
			LoadFaQ()
		});

        jQuery('#image_result_AboutImage').click(function(){
            $('#AttachmentAboutImage').click();
        });
		jQuery('#image_result_icon1').click(function(){
			$('#AttachmentIcon1').click();
		});
		jQuery('#image_result_icon2').click(function(){
			$('#AttachmentIcon2').click();
		});
		jQuery('#image_result_icon3').click(function(){
			$('#AttachmentIcon3').click();
		});
		jQuery('#image_result_BannerImage').click(function(){
			$('#AttachmentBanner').click();
		});
		jQuery('#image_result_HiWImage1').click(function(){
			$('#AttachmentHiWImage1').click();
		});
		jQuery('#image_result_HiWImage2').click(function(){
			$('#AttachmentHiWImage2').click();
		});
		jQuery('#image_result_HiWImage3').click(function(){
			$('#AttachmentHiWImage3').click();
		});

		// Handle form submission

		jQuery('form').submit(function(e) {

            e.preventDefault(); // Prevent default form submission

            var form = $(this);
            var formData = form.serializeArray();
            var actionUrl = form.attr('action');
			var submitButton = form.find("button[type='submit']");
			submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

            var AppsAddress = quill_AppsAddress.root.innerHTML;
			var AboutDescriptionSubHeadline1 = quill_AboutDescriptionSubHeadline1.root.innerHTML;
			var AboutDescriptionSubHeadline2 = quill_AboutDescriptionSubHeadline2.root.innerHTML;
			var AboutDescriptionSubHeadline3 = quill_AboutDescriptionSubHeadline3.root.innerHTML;
			var About = quill_About.root.innerHTML;

			var HiWText1 = quill_HiWText1.root.innerHTML;
			var HiWText2 = quill_HiWText2.root.innerHTML;
			var HiWText3 = quill_HiWText3.root.innerHTML;

			var TermandCondition = quill_TermandCondition.root.innerHTML;
			var PrivacyPolicy = quill_PrivacyPolicy.root.innerHTML;

			var AboutIcon1 = $('#image_icon1_base64').val();
			var AboutIcon2 = $('#image_icon2_base64').val();
			var AboutIcon3 = $('#image_icon3_base64').val();

			var HiWImage1 = $('#Base64_HiWImage1').val();
			var HiWImage2 = $('#Base64_HiWImage2').val();
			var HiWImage3 = $('#Base64_HiWImage3').val();

			if (Array.isArray(oFaQData) && oFaQData.length > 0) {
				formData.push({ name: "oFAQ", value: JSON.stringify(oFaQData) });
			}

			formData.push({ name: "AppsAddress", value: AppsAddress });
			formData.push({ name: "AboutDescriptionSubHeadline1", value: AboutDescriptionSubHeadline1 });
			formData.push({ name: "AboutDescriptionSubHeadline2", value: AboutDescriptionSubHeadline2 });
			formData.push({ name: "AboutDescriptionSubHeadline3", value: AboutDescriptionSubHeadline3 });
			formData.push({ name: "About", value: About });
			formData.push({ name: "AboutIcon1", value: AboutIcon1 });
			formData.push({ name: "AboutIcon2", value: AboutIcon2 });
			formData.push({ name: "AboutIcon3", value: AboutIcon3 });
			formData.push({ name: "HiWImage1", value: HiWImage1 });
			formData.push({ name: "HiWImage2", value: HiWImage2 });
			formData.push({ name: "HiWImage3", value: HiWImage3 });
			formData.push({ name: "HiWText1", value: HiWText1 });
			formData.push({ name: "HiWText2", value: HiWText2 });
			formData.push({ name: "HiWText3", value: HiWText3 });
			formData.push({ name: "TermandCondition", value: TermandCondition });
			formData.push({ name: "PrivacyPolicy", value: PrivacyPolicy });

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
							window.location.href = "{{ route('easytoursetting') }}";
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

		jQuery('#btAddFaQ').click(function() {
            jQuery('#LookupFaQ').modal('show');
        });

		jQuery('#btSaveFaQ').click(function() {
            var FaQid = jQuery('#FaQid').val();
            var FaqHeader = jQuery('#FaqHeader').val();
            var FaqDetail = quill_FaqDetail.root.innerHTML;

			console.log(oFaQData);
            
            if (FaQid) {
                oFaQData = oFaQData.map(item => {
                    if (item.id === FaQid) {
                        item.FaqHeader = FaqHeader;
                        item.FaqDetail = FaqDetail;
                    }
                    return item;
                });
                jQuery('#FaQid').val('');
            } else {
                var oData = {
                    'FaqHeader': FaqHeader,
                    'FaqDetail': FaqDetail,
                    'expanded': true
                };
                oFaQData.push(oData);
            }
            jQuery('#LookupFaQ').modal('hide');
            LoadFaQ();
            // frmItinerary
        });

		jQuery('#LookupFaQ').on('hidden.bs.modal', function () {
            jQuery('#frmFaQ')[0].reset();
            quill_FaqDetail.root.innerHTML = "";
        });
	});

	function LoadFaQ() {
        // iteneraryData
        var previewContainer = document.getElementById("accordionFaQData");
        previewContainer.innerHTML = "";

        if (!Array.isArray(oFaQData) || oFaQData.length === 0) {
            let noImageDiv = document.createElement("div");
            noImageDiv.className = "col-12 text-center";
            noImageDiv.innerText = "No FaQ Data Found";
            previewContainer.appendChild(noImageDiv);
            return;
        }

        oFaQData.forEach((item, index) => {
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
                        <h2><strong>${item.FaqHeader}</strong></h2>
                    </button>
                </h2>
                <div id="collapse${item.id}" class="accordion-collapse collapse ${showClass}" 
                    aria-labelledby="heading${item.id}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">${item.FaqDetail}</div>

                    <div class="d-flex justify-content-end mt-2 p-2">
                        <button type="button" class="btn btn-danger" onclick="deleteFaQ('${item.id}')">Delete</button>
                        <button type="button" class="btn btn-success ms-2" onclick="editFaQ('${item.id}')">Edit</button>
                    </div>
                </div>
            `;

            previewContainer.appendChild(accordionItem);
        });

    }

	function deleteFaQ(params) {
        oFaQData = oFaQData.filter(item => item.id !== params);
        LoadFaQ();
    }
	function editFaQ(params) {
        const selectedFaQ = oFaQData.find(item => item.id === params);
        jQuery('#FaqHeader').val(selectedFaQ.FaqHeader);
		jQuery('#FaQid').val(selectedFaQ.id);

        quill_FaqDetail.root.innerHTML = selectedFaQ.FaqDetail;

        jQuery('#LookupFaQ').modal('show');
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


	$("#AttachmentHiWImage1").change(function(){
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
      readURL_Hiw1(this);
      encodeImagetoBase64_Hiw1(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });

	$("#AttachmentHiWImage2").change(function(){
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
      readURL_Hiw2(this);
      encodeImagetoBase64_Hiw2(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });

	$("#AttachmentHiWImage3").change(function(){
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
      readURL_Hiw3(this);
      encodeImagetoBase64_Hiw3(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });

    $("#AttachmentAboutImage").change(function(){
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
	$("#AttachmentIcon1").change(function(){
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
	  readURL_1(this);
	  encodeImagetoBase64_1(this);
	});

	$("#AttachmentIcon2").change(function(){
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
	  readURL_2(this);
	  encodeImagetoBase64_2(this);
	});

	$("#AttachmentIcon3").change(function(){
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
	  readURL_3(this);
	  encodeImagetoBase64_3(this);
	});

	$("#AttachmentBanner").change(function(){
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
      readURLBanner(this);
      encodeImagetoBase64Banner(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });

	function readURLBanner(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
          
        reader.onload = function (e) {
          // console.log(e.target.result);
          $('#image_result_BannerImage').html("<img src ='"+e.target.result+"'> ");
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
          
        reader.onload = function (e) {
          // console.log(e.target.result);
          $('#image_result_AboutImage').html("<img src ='"+e.target.result+"'> ");
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
	function readURL_1(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		  
		reader.onload = function (e) {
		  // console.log(e.target.result);
		  $('#image_result_icon1').html("<img src ='"+e.target.result+"'> ");
		}
		reader.readAsDataURL(input.files[0]);
	  }
	}

	function readURL_2(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		  
		reader.onload = function (e) {
		  // console.log(e.target.result);
		  $('#image_result_icon2').html("<img src ='"+e.target.result+"'> ");
		}
		reader.readAsDataURL(input.files[0]);
	  }
	}

	function readURL_3(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		  
		reader.onload = function (e) {
		  // console.log(e.target.result);
		  $('#image_result_icon3').html("<img src ='"+e.target.result+"'> ");
		}
		reader.readAsDataURL(input.files[0]);
	  }
	}

	function readURL_Hiw1(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		  
		reader.onload = function (e) {
		  // console.log(e.target.result);
		  $('#image_result_HiWImage1').html("<img src ='"+e.target.result+"'> ");
		}
		reader.readAsDataURL(input.files[0]);
	  }
	}

	function readURL_Hiw2(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		  
		reader.onload = function (e) {
		  // console.log(e.target.result);
		  $('#image_result_HiWImage2').html("<img src ='"+e.target.result+"'> ");
		}
		reader.readAsDataURL(input.files[0]);
	  }
	}

	function readURL_Hiw3(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		  
		reader.onload = function (e) {
		  // console.log(e.target.result);
		  $('#image_result_HiWImage3').html("<img src ='"+e.target.result+"'> ");
		}
		reader.readAsDataURL(input.files[0]);
	  }
	}
	
	function encodeImagetoBase64Banner(element) {
      $('#image_banner_base64').val('');
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
          // $(".link").attr("href",reader.result);
          // $(".link").text(reader.result);
          $('#image_banner_base64').val(reader.result);
        }
        reader.readAsDataURL(file);
    }
    function encodeImagetoBase64(element) {
      $('#Icon_Base64').val('');
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
          // $(".link").attr("href",reader.result);
          // $(".link").text(reader.result);
          $('#Base64_AboutImage').val(reader.result);
        }
        reader.readAsDataURL(file);
    }
	function encodeImagetoBase64_1(element) {
	  $('#image_icon1_base64').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
		  // $(".link").attr("href",reader.result);
		  // $(".link").text(reader.result);
		  $('#image_icon1_base64').val(reader.result);
		}
		reader.readAsDataURL(file);
	}
	function encodeImagetoBase64_2(element) {
	  $('#image_icon2_base64').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
		  // $(".link").attr("href",reader.result);
		  // $(".link").text(reader.result);
		  $('#image_icon2_base64').val(reader.result);
		}
		reader.readAsDataURL(file);
	}
	function encodeImagetoBase64_3(element) {
	  $('#image_icon3_base64').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
		  // $(".link").attr("href",reader.result);
		  // $(".link").text(reader.result);
		  $('#image_icon3_base64').val(reader.result);
		}
		reader.readAsDataURL(file);
	}

	function encodeImagetoBase64_Hiw1(element) {
		$('#Base64_HiWImage1').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
		  // $(".link").attr("href",reader.result);
		  // $(".link").text(reader.result);
		  $('#Base64_HiWImage1').val(reader.result);
		}
		reader.readAsDataURL(file);
	}

	function encodeImagetoBase64_Hiw2(element) {
		$('#Base64_HiWImage2').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
		  // $(".link").attr("href",reader.result);
		  // $(".link").text(reader.result);
		  $('#Base64_HiWImage2').val(reader.result);
		}
		reader.readAsDataURL(file);
	}

	function encodeImagetoBase64_Hiw3(element) {
		$('#Base64_HiWImage3').val('');
		var file = element.files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
		  // $(".link").attr("href",reader.result);
		  // $(".link").text(reader.result);
		  $('#Base64_HiWImage3').val(reader.result);
		}
		reader.readAsDataURL(file);
	}
</script>
@endpush