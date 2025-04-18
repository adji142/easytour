@extends('parts.header')
@section('content')

<div class="subheader py-2 py-lg-6 subheader-solid">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white mb-0 px-0 py-2">
				<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                    <div class="col-lg-6 col-xl-4">
                        <div class="card card-custom gutter-b bg-white border-0 theme-circle theme-circle-primary">

                            <div class="card-body">
                                <h3 class="text-body font-weight-bold">Tour</h3>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-dark font-weight-bold font-size-h1 me-3">
                                            {{ $omset_tour }}
                                        </span>

                                    </div>
                                    {{-- <div class="text-black-50 mt-3">Compare to last year (2019)</div> --}}
                                </div>

                            </div>

                            
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card card-custom gutter-b bg-white border-0 theme-circle theme-circle theme-circle-secondary">

                            <div class="card-body">
                                <h3 class="text-body font-weight-bold">Hotel</h3>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-dark font-weight-bold font-size-h1 me-3">
                                            {{ $omset_hotel }}
                                        </span>

                                    </div>
                                    {{-- <div class="text-black-50 mt-3">Compare to last year (2019)</div> --}}
                                </div>

                            </div>

                            
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card card-custom gutter-b bg-white border-0 theme-circle theme-circle-success">

                            <div class="card-body">
                                <h3 class="text-body font-weight-bold">Travel</h3>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-dark font-weight-bold font-size-h1 me-3">
                                            {{ $omset_travel }}
                                        </span>

                                    </div>
                                    {{-- <div class="text-black-50 mt-3">Compare to last year (2019)</div> --}}
                                </div>

                            </div>

                            
                        </div>
                    </div>
                    
                </div>

				<div class="row">
					<div class="card mt-4">
						<div class="card-header">
							<h3 class="card-title">Grafik Omset per Booking Type</h3>
						</div>
						<div class="card-body">
							<div id="omsetByTypeChart"></div>
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
    document.addEventListener("DOMContentLoaded", function () {
        const options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Omset',
                data: [
                    {{ $chart_data['Tour'] }},
                    {{ $chart_data['Hotel'] }},
                    {{ $chart_data['Travel'] }}
                ]
            }],
            xaxis: {
                categories: ['Tour', 'Hotel', 'Travel']
            },
            dataLabels: {
                formatter: function (val) {
                    if (val >= 1000000000) return (val / 1000000000).toFixed(1) + " M";
                    if (val >= 1000000) return (val / 1000000).toFixed(1) + " Jt";
                    if (val >= 1000) return (val / 1000).toFixed(1) + " K";
                    return val;
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(val);
                    }
                }
            },
            colors: ['#00b894']
        };

        const chart = new ApexCharts(document.querySelector("#omsetByTypeChart"), options);
        chart.render();
    });
</script>
@endpush