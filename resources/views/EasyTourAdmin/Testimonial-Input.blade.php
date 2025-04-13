@extends('parts.headeradmin')

@section('content')

<div class="subheader py-2 py-lg-6 subheader-solid">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                <li class="breadcrumb-item"><a href="{{ route('testimonial') }}">Testimonial</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Testimonial</li>
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
                                        {{ isset($testimonials[0]) ? 'Edit Testimonial' : 'Add Testimonial' }}
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
                                <form action="{{ isset($testimonials[0]) ? route('testimonial-edit') : route('testimonial-store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $testimonials[0]['id'] ?? '' }}">

                                    <div class="form-group">
                                        <label>Sender Name</label>
                                        <input type="text" name="SenderName" class="form-control" value="{{ $testimonials[0]['SenderName'] ?? '' }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Sender Email</label>
                                        <input type="email" name="SenderEmail" class="form-control" value="{{ $testimonials[0]['SenderEmail'] ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Sender Phone</label>
                                        <input type="text" name="SenderPhone" class="form-control" value="{{ $testimonials[0]['SenderPhone'] ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Sender Job Title</label>
                                        <input type="text" name="SenderJobTitle" class="form-control" value="{{ $testimonials[0]['SenderJobTitle'] ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Testimonial Title</label>
                                        <input type="text" name="TestimonnialTitle" class="form-control" value="{{ $testimonials[0]['TestimonnialTitle'] ?? '' }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Testimonial Content</label>
                                        <div id="Testimonnial">{!! $testimonials[0]['Testimonnial'] ?? '' !!}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Other Remarks</label>
                                        <input type="text" name="OtherRemarks" class="form-control" value="{{ $testimonials[0]['OtherRemarks'] ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Icon (URL or base64 string)</label>
                                        <input type="text" name="Icon" class="form-control" value="{{ $testimonials[0]['Icon'] ?? '' }}">
                                    </div>

                                    <button type="submit" class="btn btn-success font-weight-bold">Save</button>
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
<script>
    jQuery(function () {
        const quill_Testimonnial = new Quill('#Testimonnial', {
            theme: 'snow'
        });

        $('form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serializeArray();
            let actionUrl = form.attr('action');
            let submitBtn = form.find("button[type='submit']");
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

            let Testimonnial = quill_Testimonnial.root.innerHTML;
            formData.push({ name: "Testimonnial", value: Testimonnial });

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Success', response.message, 'success').then(() => {
                            window.location.href = "{{ route('testimonial') }}";
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                        submitBtn.prop('disabled', false).html('Save');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                    submitBtn.prop('disabled', false).html('Save');
                }
            });
        });
    });
</script>
@endpush
