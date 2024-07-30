
@extends('template-admin.index')

@section('content-admin')
<div class="signature-invoice">
    <div class="page-header">
        <div class="content-page-header">
            <h5>Tambah Stok Sales</h5>
        </div>    
    </div>                  
    <div class="row">
        <div class="col-md-12">
            <div class="edit-card">
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif(session('update'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Selamat! </strong> {{ session('update') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('delete') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif


					<div class="row">
						<div class="col-xl-2 col-lg-4 col-sm-6 col-12 d-flex">
							<div class="card inovices-card w-100">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="inovices-widget-icon bg-info-light">
											<img src="{{asset('assets/img/icons/receipt-item.svg')}}" alt="img">
										</span>
										<div class="dash-count">
											<div class="dash-title">Total Invoice</div>
											<div class="dash-counts">
												<p>$298</p>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<p class="inovices-all">No of Invoice <span class="rounded-circle bg-light-gray">02</span></p>
										<p class="inovice-trending text-success-light">02 <span class="ms-2"><i class="fe fe-trending-up"></i></span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-sm-6 col-12 d-flex">
							<div class="card inovices-card w-100">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="inovices-widget-icon bg-primary-light">
											<img src="{{asset('assets/img/icons/transaction-minus.svg')}}" alt="img">
										</span>
										<div class="dash-count">
											<div class="dash-title">Outstanding</div>
											<div class="dash-counts">
												<p>$325,215</p>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<p class="inovices-all">No of Invoice <span class="rounded-circle bg-light-gray">03</span></p>
										<p class="inovice-trending text-success-light">04 <span class="ms-2"><i class="fe fe-trending-up"></i></span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-sm-6 col-12 d-flex">
							<div class="card inovices-card w-100">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="inovices-widget-icon bg-warning-light">
											<img src="{{asset('assets/img/icons/archive-book.svg')}}" alt="img">
										</span>
										<div class="dash-count">
											<div class="dash-title">Total Overdue</div>
											<div class="dash-counts">
												<p>$7825</p>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<p class="inovices-all">No of Invoice <span class="rounded-circle bg-light-gray">01</span></p>
										<p class="inovice-trending text-danger-light">03 <span class="ms-2"><i class="fe fe-trending-down"></i></span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-sm-6 col-12 d-flex">
							<div class="card inovices-card w-100">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="inovices-widget-icon bg-primary-light">
											<img src="{{asset('assets/img/icons/clipboard-close.svg')}}" alt="img">
										</span>
										<div class="dash-count">
											<div class="dash-title">Cancelled</div>
											<div class="dash-counts">
												<p>100</p>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<p class="inovices-all">No of Invoice <span class="rounded-circle bg-light-gray">04</span></p>
										<p class="inovice-trending text-danger-light">05 <span class="ms-2"><i class="fe fe-trending-down"></i></span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-sm-6 col-12 d-flex">
							<div class="card inovices-card w-100">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="inovices-widget-icon bg-green-light">
											<img src="{{asset('assets/img/icons/message-edit.svg')}}" alt="img">
										</span>
										<div class="dash-count">
											<div class="dash-title">Draft</div>
											<div class="dash-counts">
												<p>$125,586</p>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<p class="inovices-all">No of Invoice <span class="rounded-circle bg-light-gray">06</span></p>
										<p class="inovice-trending text-danger-light">02 <span class="ms-2"><i class="fe fe-trending-down"></i></span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-4 col-sm-6 col-12 d-flex">
							<div class="card inovices-card w-100">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="inovices-widget-icon bg-danger-light">
											<img src="{{asset('assets/img/icons/3d-rotate.svg')}}" alt="img">
										</span>
										<div class="dash-count">
											<div class="dash-title">Recurring</div>
											<div class="dash-counts">
												<p>$86,892</p>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-between align-items-center">
										<p class="inovices-all">No of Invoice <span class="rounded-circle bg-light-gray">03</span></p>
										<p class="inovice-trending text-success-light">02 <span class="ms-2"><i class="fe fe-trending-up"></i></span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Inovices card -->
                  
                    <div class="form-group-item">
                        <div class="card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Item</th>
                                                <th>Nama Item</th>
                                                <th>Stok (pcs)</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($riwayat_stok as $stok)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $stok->kode_item }}</td>
                                                <td>{{ $stok->nama_item }}</td> 
                                                <td>{{ number_format($stok->total_stok_sales, 0, ',', '.') }}</td>
												<td>
													<a href="{{ route('return-stok-sales', $stok->kode_item) }}" class="btn btn-greys bg-primary-light me-2">
														<i class="fa fa-eye me-1"></i> View
													</a> 
												</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


