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
												<th>Payment Method</th>
												<th>Payment Reference</th>
												<th>Payment Issued</th>
											</tr>
										</thead>
										<tbody>
											@if (count($bookings) > 0)
												@foreach ($bookings as $booking)
													<tr>
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
														<td>{{ $booking->PaymentMethod }}</td>
														<td>{{ $booking->PaymentReff }}</td>
														<td>{{ $booking->PaymentIssued }}</td>
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

@endsection

@push('scripts')
<script type="text/javascript">
	jQuery(document).ready(function() {
		moment.locale('id'); // Set locale Indonesia

		let table = jQuery('#bookingTable').DataTable({
			"initComplete": function(settings, json) {
				$('#bookingTable tbody tr').each(function () {
					const $dateCell = $(this).find('td:eq(2)');
					const $timeCell = $(this).find('td:eq(3)');
					const $issuedCell = $(this).find('td:eq(15)');

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
</script>
@endpush
