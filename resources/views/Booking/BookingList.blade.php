@extends('parts.header')
	
@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">Booking</li>
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
						<div class="card card-custom gutter-b bg-transparent shadow-none border-0">
							<div class="card-header align-items-center  border-bottom-dark px-0">
								<div class="card-title mb-0">
									<h3 class="card-label mb-0 font-weight-bold text-body">Booking</h3>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 px-4">
						<div class="card card-custom gutter-b bg-white border-0">
							<div class="card-body">

                                <!-- FILTER SECTION -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label for="startDate">Start Date</label>
                                        <input type="date" id="startDate" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">End Date</label>
                                        <input type="date" id="endDate" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bookingType">Booking Type</label>
                                        <select id="bookingType" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="Tour">Tour</option>
                                            <option value="Hotel">Hotel</option>
                                            <option value="Travel">Travel</option>
                                        </select>
                                    </div>
                                </div>

								<div class="table-responsive" id="printableTable">
									<table id="bookingTable" class="display" style="width:100%">
										<thead>
											<tr>
												<th>Action</th>
												<th>Booking ID</th>
												<th>Document Number</th>
												<th>Booking Date</th>
												<th>Booking Time</th>
												<th>Booking Type</th>
												<th>Full Name</th>
												<th>Email</th>
												<th>Adult</th>
												<th>Child</th>
												<th>Infant</th>
												<th>Booking Item</th>
												<th>Booking Package</th>
												<th>Total Net</th>
												<th>Booking Status</th>
												<th>Reject Factor</th>
												<th>Payment Update At</th>
												<th>Payment Update By</th>
											</tr>
										</thead>
										<tbody>
											@if (count($bookings) > 0)
												@foreach ($bookings as $booking)
													<tr>
														<td>
															<button class="btn btn-sm btn-primary view-booking-btn" 
																	data-id="{{ $booking->BookingID }}"
																	data-booking='@json($booking)'
																	data-toggle="tooltip"
																	data-placement="top"
																	title="View Booking Detail">
																<i class="fas fa-eye"></i>
															</button>

															{{-- <button class="btn btn-sm btn-warning edit-booking-btn"
																	data-id="{{ $booking->BookingID }}"
																	data-toggle="tooltip"
																	data-placement="top"
																	title="Edit Booking"
																	{{ in_array($booking->BookingStatus, [2, 3]) ? '' : 'disabled' }}>
																<i class="fas fa-edit"></i>
															</button> --}}
														</td>
														<td>{{ $booking->BookingID }}</td>
														<td>{{ $booking->DocumentNumber }}</td>
														<td>{{ $booking->BookingDate }}</td>
														<td>{{ $booking->BookingTime }}</td>
														<td>{{ $booking->BookingType }}</td>
														<td>{{ $booking->BookingFullName }}</td>
														<td>{{ $booking->BookingEmail }}</td>
														<td>{{ $booking->AdultBookingPerson }}</td>
														<td>{{ $booking->ChildBookingPerson }}</td>
														<td>{{ $booking->InfantBookingPerson }}</td>
														<td>{{ $booking->BookingItem }}</td>
														<td>{{ $booking->BookingPackage }}</td>
														<td>{{ number_format($booking->TotalNetTransaction, 0, ',', '.') }}</td>
														<td class="text-center {{ $booking->BookingStatusColor }}">{{ $booking->BookingStatusName }}</td>
														<td>{{ $booking->RejectFactor }}</td>
														<td>{{ $booking->PaymentUpdatedAt }}</td>
														<td>{{ $booking->PaymentUpdatedBy }}</td>
													</tr>
												@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div> <!-- end card-body -->
						</div> <!-- end card -->
					</div> <!-- end col -->
				</div> <!-- end row -->
			</div>
		</div>
	</div>
</div>

<!-- Booking Detail Modal -->
<div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-labelledby="bookingDetailModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="bookingDetailModalLabel">Booking Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<ul class="list-group">
					<li class="list-group-item"><strong>Booking Number:</strong> <span id="modalBookingID"></span></li>
					<li class="list-group-item"><strong>Booking Date:</strong> <span id="modalBookingDate"></span></li>
					<li class="list-group-item"><strong>Full Name:</strong> <span id="modalFullName"></span></li>
					<li class="list-group-item"><strong>Email:</strong> <span id="modalEmail"></span></li>
					<li class="list-group-item"><strong>Booking Type:</strong> <span id="modalBookingType"></span></li>
					<li class="list-group-item"><strong>Person Count:</strong> 
					<span id="modalAdult"></span> Adult(s), 
					<span id="modalChild"></span> Child(ren), 
					<span id="modalInfant"></span> Infant(s)
					</li>
					<li class="list-group-item"><strong>Price Detail:</strong> 
					<div id="modalPriceDetail"></div>
					</li>
					<li class="list-group-item"><strong>Guide Fee:</strong> <span id="modalGuideFee"></span></li>
					<li class="list-group-item"><strong>Payment Proof:</strong><br>
					<img id="modalPaymentImage" src="" alt="Payment Proof" class="img-fluid rounded border mt-2" style="max-height:300px;">
					</li>
				</ul>
			</div>
			<div class="modal-footer justify-content-between">
				<div id="rejectReasonContainer" class="w-100" style="display: none;">
					<label for="rejectReason" class="form-label">Please provide a reason for rejection:</label>
					<textarea class="form-control" id="rejectReason" rows="2" placeholder="Enter rejection reason..."></textarea>
				</div>

				<div class="ms-auto">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button id="btnRejectBooking" type="button" class="btn btn-danger">Reject</button>
					<button id="btnConfirmBooking" type="button" class="btn btn-success">Confirm</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
	var currentDocumentNumber = '';
	jQuery(document).ready(function() {
		moment.locale('id'); // Set locale Indonesia

		let table = jQuery('#bookingTable').DataTable({
			"initComplete": function(settings, json) {
				$('#bookingTable tbody tr').each(function () {
					const $dateCell = $(this).find('td:eq(3)');
					const $timeCell = $(this).find('td:eq(4)');
					const $issuedCell = $(this).find('td:eq(16)');

					// Format tanggal
					const dateText = $dateCell.text();
					if (dateText) {
						const formatted = moment(dateText).format('LL');
						$dateCell.text(formatted);
					}

					// Format jam
					const timeText = $timeCell.text();
					if (timeText) {
						const formattedTime = moment(timeText, "HH:mm:ss").format("HH:mm");
						$timeCell.text(formattedTime);
					}

					// Format Payment Issued
					const issuedText = $issuedCell.text();
					if (issuedText) {
						const formattedIssued = moment(issuedText).format('LL');
						$issuedCell.text(formattedIssued);
					}
				});
			},
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
			}
		});

		var SearchBox = "<?php echo $SearchBox ?>";

		// console.log(SearchBox);
		

		table.search(SearchBox).draw();
        // Filter logic
        jQuery('#startDate, #endDate, #bookingType').on('change', function () {
            table.draw();
        });

        jQuery.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();
            let bookingType = $('#bookingType').val();

            let bookingDate = data[2]; // kolom Booking Date
            let bookingTypeData = data[4]; // kolom Booking Type

            if (bookingDate) {
                let dateParsed = bookingDate
                // moment(bookingDate, 'LL').format('YYYY-MM-DD');

                console.log(startDate);
                if (startDate && dateParsed < startDate) {
                    return false;
                }

                if (endDate && dateParsed > endDate) {
                    return false;
                }
            }

            if (bookingType && bookingType !== bookingTypeData) {
                return false;
            }

            return true;
        });
	});

	let currentBookingID = null;

	jQuery(document).on('click', '.view-booking-btn', function () {
		const data = jQuery(this).data('booking');
		console.log(data);
		currentBookingID = data.BookingID;

		// Populate modal
		currentDocumentNumber = data.DocumentNumber;
		jQuery('#modalBookingID').text(data.DocumentNumber);
		jQuery('#modalBookingDate').text(moment(data.BookingDate).format('LL'));
		jQuery('#modalFullName').text(data.BookingFullName);
		jQuery('#modalEmail').text(data.BookingEmail);
		jQuery('#modalBookingType').text(data.BookingType);
		jQuery('#modalAdult').text(data.AdultBookingPerson || 0);
		jQuery('#modalChild').text(data.ChildBookingPerson || 0);
		jQuery('#modalInfant').text(data.InfantBookingPerson || 0);

		const adultQty = parseInt(data.AdultBookingPerson || 0);
		const childQty = parseInt(data.ChildBookingPerson || 0);
		const infantQty = parseInt(data.InfantBookingPerson || 0);

		const adultPrice = parseInt(data.TourPackagePrice || 0);
		const childPrice = parseInt(data.TourPackageChildPrice || 0);
		const infantPrice = parseInt(data.InfantPrice || 0);
		const total = parseInt(data.TotalNetTransaction || 0);

		const guideFee = parseInt(data.TourPackageGuildFee || 0);

		const priceHTML = `
			Adult: ${adultQty} x Rp ${adultPrice.toLocaleString('id-ID')} = <strong>Rp ${(adultQty * adultPrice).toLocaleString('id-ID')}</strong><br>
			Child: ${childQty} x Rp ${childPrice.toLocaleString('id-ID')} = <strong>Rp ${(childQty * childPrice).toLocaleString('id-ID')}</strong><br>
			Infant: ${infantQty} x Rp ${infantPrice.toLocaleString('id-ID')} = <strong>Rp ${(infantQty * infantPrice).toLocaleString('id-ID')}</strong><br>
			<hr class="my-1">
			<strong>Guide Fee:</strong> Rp ${guideFee.toLocaleString('id-ID')}<br>
			<strong>Total:</strong> Rp ${total.toLocaleString('id-ID')}
		`;

		jQuery('#modalPriceDetail').html(priceHTML);
		jQuery('#modalGuideFee').text("Rp " + guideFee.toLocaleString('id-ID'));

		if (data.PaymentProff) {
			jQuery('#modalPaymentImage').attr('src', data.PaymentProff).show();
		} else {
			jQuery('#modalPaymentImage').hide();
		}

		// Reset reject form & buttons
		jQuery('#rejectReasonContainer').hide();
		jQuery('#rejectReason').val('');
		jQuery('#btnRejectBooking').text('Reject').prop('disabled', false).removeClass('btn-success').addClass('btn-danger');
		jQuery('#btnConfirmBooking').prop('disabled', false);

		jQuery('#bookingDetailModal').modal('show');
	});

	// Confirm button
	jQuery('#btnConfirmBooking').on('click', function () {
		if (!currentBookingID) return;

		Swal.fire({
			title: 'Are you sure?',
			text: 'This booking will be confirmed.',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Yes, confirm it',
			cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result.isConfirmed) {
				// TODO: Kirim permintaan konfirmasi booking ke backend
				$.ajax({
					url: '{{ route("booking.approval") }}',
					type: 'POST',
					data: {
						_token: '{{ csrf_token() }}',
						DocumentNumber: currentDocumentNumber,
						Status: 2
					},
					success: function (res) {
						Swal.fire('Success', res.message, 'success').then(() => {
							location.reload();
						});
					},
					error: function (xhr) {
						Swal.fire('Error', xhr.responseJSON.message, 'error');
					}
				});
				jQuery('#bookingDetailModal').modal('hide');
			}
		});
	});

	// Reject button (toggle form and handle submission)
	jQuery('#btnRejectBooking').on('click', function () {
		const $btn = jQuery(this);
		const $container = jQuery('#rejectReasonContainer');

		if (!$container.is(':visible')) {
			// Show reject form
			$container.slideDown();
			jQuery('#rejectReason').focus();
			$btn.text('Submit').removeClass('btn-danger').addClass('btn-success');
			jQuery('#btnConfirmBooking').prop('disabled', true);
		} else {
			const reason = jQuery('#rejectReason').val().trim();
			if (!reason) {
				Swal.fire('Warning', 'Please provide a reason for rejection.', 'warning');
				return;
			}

			Swal.fire({
				title: 'Are you sure?',
				text: `You are rejecting this booking with reason:\n"${reason}"`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, reject it',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					// TODO: Kirim alasan penolakan ke backend
					$.ajax({
					url: '{{ route("booking.approval") }}',
					type: 'POST',
					data: {
						_token: '{{ csrf_token() }}',
						DocumentNumber: currentDocumentNumber,
						Status: 3,
						RejectReason: reason
					},
					success: function (res) {
						Swal.fire('Success', res.message, 'success').then(() => {
							location.reload();
						});
					},
					error: function (xhr) {
						Swal.fire('Error', xhr.responseJSON.message, 'error');
					}
				});
					jQuery('#bookingDetailModal').modal('hide');
				}
			});
		}
	});



</script>
@endpush
