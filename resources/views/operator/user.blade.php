@extends('layouts.app')

@section('content')
    <!--begin::Container-->
	<div class="d-flex flex-column flex-column-fluid container-fluid">
		<!--begin::Toolbar-->
		<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column me-3">
				<!--begin::Title-->
				<h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Tables</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-gray-600">
						<a href="index.html" class="text-gray-600 text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-gray-600">Widgets</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-gray-500">Tables</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center py-2 py-md-1">
				<!--begin::Wrapper-->
				<div class="me-3">
					<!--begin::Menu-->
					<a href="#" class="btn btn-light fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
					<i class="ki-duotone ki-filter fs-5 text-gray-500 me-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>Filter</a>
					<!--begin::Menu 1-->
					<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_655d2fa764f79">
						<!--begin::Header-->
						<div class="px-7 py-5">
							<div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
						</div>
						<!--end::Header-->
						<!--begin::Menu separator-->
						<div class="separator border-gray-200"></div>
						<!--end::Menu separator-->
						<!--begin::Form-->
						<div class="px-7 py-5">
							<!--begin::Input group-->
							<div class="mb-10">
								<!--begin::Label-->
								<label class="form-label fw-semibold">Status:</label>
								<!--end::Label-->
								<!--begin::Input-->
								<div>
									<select class="form-select form-select-solid" multiple="multiple" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select option" data-dropdown-parent="#kt_menu_655d2fa764f79" data-allow-clear="true">
										<option></option>
										<option value="1">Approved</option>
										<option value="2">Pending</option>
										<option value="2">In Process</option>
										<option value="2">Rejected</option>
									</select>
								</div>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10">
								<!--begin::Label-->
								<label class="form-label fw-semibold">Member Type:</label>
								<!--end::Label-->
								<!--begin::Options-->
								<div class="d-flex">
									<!--begin::Options-->
									<label class="form-check form-check-sm form-check-custom form-check-solid me-5">
										<input class="form-check-input" type="checkbox" value="1" />
										<span class="form-check-label">Author</span>
									</label>
									<!--end::Options-->
									<!--begin::Options-->
									<label class="form-check form-check-sm form-check-custom form-check-solid">
										<input class="form-check-input" type="checkbox" value="2" checked="checked" />
										<span class="form-check-label">Customer</span>
									</label>
									<!--end::Options-->
								</div>
								<!--end::Options-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10">
								<!--begin::Label-->
								<label class="form-label fw-semibold">Notifications:</label>
								<!--end::Label-->
								<!--begin::Switch-->
								<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
									<label class="form-check-label">Enabled</label>
								</div>
								<!--end::Switch-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="d-flex justify-content-end">
								<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
								<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
							</div>
							<!--end::Actions-->
						</div>
						<!--end::Form-->
					</div>
					<!--end::Menu 1-->
					<!--end::Menu-->
				</div>
				<!--end::Wrapper-->
				<!--begin::Button-->
				<a href="#" class="btn btn-dark fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Create</a>
				<!--end::Button-->
			</div>
			<!--end::Actions-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Post-->
		<div class="content flex-column-fluid" id="kt_content">
			<!--begin::Row-->
			<div class="row g-5 g-xl-8">
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Tables Widget 1-->
					<div class="card card-xl-stretch mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Tasks Overview</span>
								<span class="text-muted fw-semibold fs-7">Pending 10 tasks</span>
							</h3>
							<div class="card-toolbar">
								<!--begin::Menu-->
								<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									<i class="ki-duotone ki-category fs-6">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
										<span class="path4"></span>
									</i>
								</button>
								<!--begin::Menu 1-->
								<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_655d2fa7651d7">
									<!--begin::Header-->
									<div class="px-7 py-5">
										<div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
									</div>
									<!--end::Header-->
									<!--begin::Menu separator-->
									<div class="separator border-gray-200"></div>
									<!--end::Menu separator-->
									<!--begin::Form-->
									<div class="px-7 py-5">
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fw-semibold">Status:</label>
											<!--end::Label-->
											<!--begin::Input-->
											<div>
												<select class="form-select form-select-solid" multiple="multiple" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select option" data-dropdown-parent="#kt_menu_655d2fa7651d7" data-allow-clear="true">
													<option></option>
													<option value="1">Approved</option>
													<option value="2">Pending</option>
													<option value="2">In Process</option>
													<option value="2">Rejected</option>
												</select>
											</div>
											<!--end::Input-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fw-semibold">Member Type:</label>
											<!--end::Label-->
											<!--begin::Options-->
											<div class="d-flex">
												<!--begin::Options-->
												<label class="form-check form-check-sm form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" value="1" />
													<span class="form-check-label">Author</span>
												</label>
												<!--end::Options-->
												<!--begin::Options-->
												<label class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="2" checked="checked" />
													<span class="form-check-label">Customer</span>
												</label>
												<!--end::Options-->
											</div>
											<!--end::Options-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fw-semibold">Notifications:</label>
											<!--end::Label-->
											<!--begin::Switch-->
											<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
												<input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
												<label class="form-check-label">Enabled</label>
											</div>
											<!--end::Switch-->
										</div>
										<!--end::Input group-->
										<!--begin::Actions-->
										<div class="d-flex justify-content-end">
											<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
											<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Menu 1-->
								<!--end::Menu-->
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<!--begin::Table container-->
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table align-middle gs-0 gy-5">
									<!--begin::Table head-->
									<thead>
										<tr>
											<th class="p-0 w-50px"></th>
											<th class="p-0 min-w-200px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-40px"></th>
										</tr>
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>
										<tr>
											<th>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets/media/svg/brand-logos/plurk.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</th>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Top Authors</a>
												<span class="text-muted fw-semibold d-block fs-7">Successful Fellas</span>
											</td>
											<td>
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">70%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<th>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{public('public/assets/media/svg/brand-logos/telegram.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</th>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
												<span class="text-muted fw-semibold d-block fs-7">Most Successful</span>
											</td>
											<td>
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">50%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<th>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets/media/svg/brand-logos/vimeo.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</th>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
												<span class="text-muted fw-semibold d-block fs-7">Awesome Users</span>
											</td>
											<td>
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">80%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<th>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets//media/svg/brand-logos/bebo.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</th>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
												<span class="text-muted fw-semibold d-block fs-7">Best Customers</span>
											</td>
											<td>
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">90%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<th>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets//media/svg/brand-logos/kickstarter.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</th>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller Theme</a>
												<span class="text-muted fw-semibold d-block fs-7">Amazing Templates</span>
											</td>
											<td>
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">70%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Table container-->
						</div>
						<!--end::Body-->
					</div>
					<!--endW::Tables Widget 1-->
				</div>
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Tables Widget 2-->
					<div class="card card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Latest Arrivals</span>
								<span class="text-muted mt-1 fw-semibold fs-7">More than 100 new products</span>
							</h3>
							<div class="card-toolbar">
								<!--begin::Menu-->
								<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									<i class="ki-duotone ki-category fs-6">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
										<span class="path4"></span>
									</i>
								</button>
								<!--begin::Menu 1-->
								<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_655d2fa76539e">
									<!--begin::Header-->
									<div class="px-7 py-5">
										<div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
									</div>
									<!--end::Header-->
									<!--begin::Menu separator-->
									<div class="separator border-gray-200"></div>
									<!--end::Menu separator-->
									<!--begin::Form-->
									<div class="px-7 py-5">
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fw-semibold">Status:</label>
											<!--end::Label-->
											<!--begin::Input-->
											<div>
												<select class="form-select form-select-solid" multiple="multiple" data-kt-select2="true" data-close-on-select="false" data-placeholder="Select option" data-dropdown-parent="#kt_menu_655d2fa76539e" data-allow-clear="true">
													<option></option>
													<option value="1">Approved</option>
													<option value="2">Pending</option>
													<option value="2">In Process</option>
													<option value="2">Rejected</option>
												</select>
											</div>
											<!--end::Input-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fw-semibold">Member Type:</label>
											<!--end::Label-->
											<!--begin::Options-->
											<div class="d-flex">
												<!--begin::Options-->
												<label class="form-check form-check-sm form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="checkbox" value="1" />
													<span class="form-check-label">Author</span>
												</label>
												<!--end::Options-->
												<!--begin::Options-->
												<label class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="2" checked="checked" />
													<span class="form-check-label">Customer</span>
												</label>
												<!--end::Options-->
											</div>
											<!--end::Options-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fw-semibold">Notifications:</label>
											<!--end::Label-->
											<!--begin::Switch-->
											<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
												<input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
												<label class="form-check-label">Enabled</label>
											</div>
											<!--end::Switch-->
										</div>
										<!--end::Input group-->
										<!--begin::Actions-->
										<div class="d-flex justify-content-end">
											<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
											<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Form-->
								</div>
								<!--end::Menu 1-->
								<!--end::Menu-->
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<!--begin::Table container-->
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table align-middle gs-0 gy-5">
									<!--begin::Table head-->
									<thead>
										<tr>
											<th class="p-0 w-50px"></th>
											<th class="p-0 min-w-150px"></th>
											<th class="p-0 min-w-150px"></th>
											<th class="p-0 min-w-125px"></th>
											<th class="p-0 min-w-40px"></th>
										</tr>
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Top Authors</a>
												<span class="text-muted fw-semibold d-block fs-7">Successful Fellas</span>
											</td>
											<td class="text-end">
												<span class="badge badge-light-danger fw-semibold me-1">Angular</span>
												<span class="badge badge-light-info fw-semibold me-1">PHP</span>
											</td>
											<td class="text-end">
												<span class="text-muted fw-bold">4600 Users</span>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets/media/svg/brand-logos/telegram.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
												<span class="text-muted fw-semibold d-block fs-7">Most Successful</span>
											</td>
											<td class="text-end">
												<span class="badge badge-light-danger fw-semibold me-1">HTML</span>
												<span class="badge badge-light-info fw-semibold me-1">CSS</span>
											</td>
											<td class="text-end">
												<span class="text-muted fw-bold">7200 Users</span>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets/media/svg/brand-logos/vimeo.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
												<span class="text-muted fw-semibold d-block fs-7">Awesome Users</span>
											</td>
											<td class="text-end">
												<span class="badge badge-light-danger fw-semibold me-1">React</span>
												<span class="badge badge-light-info fw-semibold me-1">SASS</span>
											</td>
											<td class="text-end">
												<span class="text-muted fw-bold">890 Users</span>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets/media/svg/brand-logos/bebo.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
												<span class="text-muted fw-semibold d-block fs-7">Best Customers</span>
											</td>
											<td class="text-end">
												<span class="badge badge-light-danger fw-semibold me-1">Java</span>
												<span class="badge badge-light-info fw-semibold me-1">PHP</span>
											</td>
											<td class="text-end">
												<span class="text-muted fw-bold">6370 Users</span>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label">
														<img src="{{asset('public/assets/media/svg/brand-logos/kickstarter.svg')}}" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller Theme</a>
												<span class="text-muted fw-semibold d-block fs-7">Amazing Templates</span>
											</td>
											<td class="text-end">
												<span class="badge badge-light-danger fw-semibold me-1">Python</span>
												<span class="badge badge-light-info fw-semibold me-1">MySQL</span>
											</td>
											<td class="text-end">
												<span class="text-muted fw-bold">354 Users</span>
											</td>
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
													<i class="ki-duotone ki-arrow-right fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</a>
											</td>
										</tr>
									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Table container-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Tables Widget 2-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Row-->
			<div class="row g-5 g-xl-8">
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Tables Widget 3-->
					<div class="card card-xl-stretch mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Files</span>
								<span class="text-muted mt-1 fw-semibold fs-7">Over 100 pending files</span>
							</h3>
							<div class="card-toolbar">
								<!--begin::Menu-->
								<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									<i class="ki-duotone ki-category fs-6">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
										<span class="path4"></span>
									</i>
								</button>
								<!--begin::Menu 3-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
									<!--begin::Heading-->
									<div class="menu-item px-3">
										<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
									</div>
									<!--end::Heading-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Create Invoice</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link flex-stack px-3">Create Payment 
										<span class="ms-2" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
											<i class="ki-duotone ki-information fs-6">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</span></a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Generate Bill</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
										<a href="#" class="menu-link px-3">
											<span class="menu-title">Subscription</span>
											<span class="menu-arrow"></span>
										</a>
										<!--begin::Menu sub-->
										<div class="menu-sub menu-sub-dropdown w-175px py-4">
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3">Plans</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3">Billing</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3">Statements</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu separator-->
											<div class="separator my-2"></div>
											<!--end::Menu separator-->
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<div class="menu-content px-3">
													<!--begin::Switch-->
													<label class="form-check form-switch form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
														<!--end::Input-->
														<!--end::Label-->
														<span class="form-check-label text-muted fs-6">Recuring</span>
														<!--end::Label-->
													</label>
													<!--end::Switch-->
												</div>
											</div>
											<!--end::Menu item-->
										</div>
										<!--end::Menu sub-->
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3 my-1">
										<a href="#" class="menu-link px-3">Settings</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu 3-->
								<!--end::Menu-->
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<!--begin::Table container-->
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table align-middle gs-0 gy-3">
									<!--begin::Table head-->
									<thead>
										<tr>
											<th class="p-0 w-50px"></th>
											<th class="p-0 min-w-150px"></th>
											<th class="p-0 min-w-140px"></th>
											<th class="p-0 min-w-120px"></th>
											<th class="p-0 min-w-40px"></th>
										</tr>
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label bg-light-success">
														<i class="ki-duotone ki-basket fs-2x text-success">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="path4"></span>
														</i>
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Top Authors</a>
											</td>
											<td class="text-end text-muted fw-bold">ReactJs, HTML</td>
											<td class="text-end text-muted fw-bold">4600 Users</td>
											<td class="text-end text-gray-900 fw-bold fs-6 pe-0">5.4MB</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label bg-light-danger">
														<i class="ki-duotone ki-element-11 fs-2x text-danger">
															<span class="path1"></span>
															<span class="path2"></span>
															<span class="path3"></span>
															<span class="path4"></span>
														</i>
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
											</td>
											<td class="text-end text-muted fw-bold">Python, MySQL</td>
											<td class="text-end text-muted fw-bold">7200 Users</td>
											<td class="text-end text-gray-900 fw-bold fs-6 pe-0">2.8MB</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label bg-light-info">
														<i class="ki-duotone ki-briefcase fs-2x text-info">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
											</td>
											<td class="text-end text-muted fw-bold">Laravel, Metronic</td>
											<td class="text-end text-muted fw-bold">890 Users</td>
											<td class="text-end text-gray-900 fw-bold fs-6 pe-0">1.5MB</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label bg-light-warning">
														<i class="ki-duotone ki-abstract-26 fs-2x text-warning">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
											</td>
											<td class="text-end text-muted fw-bold">AngularJS, C#</td>
											<td class="text-end text-muted fw-bold">4600 Users</td>
											<td class="text-end text-gray-900 fw-bold fs-6 pe-0">5.4MB</td>
										</tr>
										<tr>
											<td>
												<div class="symbol symbol-50px me-2">
													<span class="symbol-label bg-light-primary">
														<i class="ki-duotone ki-abstract-41 fs-2x text-primary">
															<span class="path1"></span>
															<span class="path2"></span>
														</i>
													</span>
												</div>
											</td>
											<td>
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
											</td>
											<td class="text-end text-muted fw-bold">ReactJS, Ruby</td>
											<td class="text-end text-muted fw-bold">354 Users</td>
											<td class="text-end text-gray-900 fw-bold fs-6 pe-0">500KB</td>
										</tr>
									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Table container-->
						</div>
						<!--begin::Body-->
					</div>
					<!--end::Tables Widget 3-->
				</div>
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Tables Widget 4-->
					<div class="card card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">New Members</span>
								<span class="text-muted mt-1 fw-semibold fs-7">More than 400 new members</span>
							</h3>
							<div class="card-toolbar">
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary active fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_4_tab_1">Month</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_4_tab_2">Week</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4" data-bs-toggle="tab" href="#kt_table_widget_4_tab_3">Day</a>
									</li>
								</ul>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<div class="tab-content">
								<!--begin::Tap pane-->
								<div class="tab-pane fade show active" id="kt_table_widget_4_tab_1">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/avatars/300-14.jpg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block fs-7">Movie Creator</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/avatars/300-5.jpg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block fs-7">HTML, CSS Coding</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/avatars/300-20.jpg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Lebron Wayde</a>
														<span class="text-muted fw-semibold d-block fs-7">ReactJS Developer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/avatars/300-23.jpg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
														<span class="text-muted fw-semibold d-block fs-7">UI/UX Designer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{public('assets/media/avatars/300-10.jpg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Kevin Leonard</a>
														<span class="text-muted fw-semibold d-block fs-7">Art Director</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_4_tab_2">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/svg/avatars/043-boy-18.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Kevin Leonard</a>
														<span class="text-muted fw-semibold d-block fs-7">Art Director</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/svg/avatars/014-girl-7.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
														<span class="text-muted fw-semibold d-block fs-7">UI/UX Designer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('assets/media/svg/avatars/018-girl-9.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block fs-7">HTML, CSS Coding</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/svg/avatars/001-boy.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block fs-7">Movie Creator</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_4_tab_3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/svg/avatars/018-girl-9.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block fs-7">HTML, CSS Coding</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/svg/avatars/047-girl-25.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Lebron Wayde</a>
														<span class="text-muted fw-semibold d-block fs-7">ReactJS Developer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px">
															<img src="{{asset('public/assets/media/svg/avatars/014-girl-7.svg')}}" alt="" />
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
														<span class="text-muted fw-semibold d-block fs-7">UI/UX Designer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Rating</span>
														<div class="rating">
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
															<div class="rating-label checked">
																<i class="ki-duotone ki-star fs-6"></i>
															</div>
														</div>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-light-twitter btn-sm me-3">
															<i class="ki-duotone ki-twitter fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
														<a href="#" class="btn btn-icon btn-light-facebook btn-sm">
															<i class="ki-duotone ki-facebook fs-4">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Tables Widget 4-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Row-->
			<div class="row g-5 g-xl-8">
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Tables Widget 5-->
					<div class="card card-xl-stretch mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Latest Products</span>
								<span class="text-muted mt-1 fw-semibold fs-7">More than 400 new products</span>
							</h3>
							<div class="card-toolbar">
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1 active" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">Month</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
									</li>
								</ul>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<div class="tab-content">
								<!--begin::Tap pane-->
								<div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
											<!--begin::Table head-->
											<thead>
												<tr class="border-0">
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-110px"></th>
													<th class="p-0 min-w-50px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/plurk.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block">Movie Creator</span>
													</td>
													<td class="text-end text-muted fw-bold">React, HTML</td>
													<td class="text-end">
														<span class="badge badge-light-success">Approved</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/telegram.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
														<span class="text-muted fw-semibold d-block">Most Successful</span>
													</td>
													<td class="text-end text-muted fw-bold">Python, MySQL</td>
													<td class="text-end">
														<span class="badge badge-light-warning">In Progress</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/vimeo.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
														<span class="text-muted fw-semibold d-block">Awesome Users</span>
													</td>
													<td class="text-end text-muted fw-bold">Laravel,Metronic</td>
													<td class="text-end">
														<span class="badge badge-light-primary">Success</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{aasset('public/assets/media/svg/brand-logos/bebo.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
														<span class="text-muted fw-semibold d-block">Movie Creator</span>
													</td>
													<td class="text-end text-muted fw-bold">AngularJS, C#</td>
													<td class="text-end">
														<span class="badge badge-light-danger">Rejected</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/kickstarter.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller Theme</a>
														<span class="text-muted fw-semibold d-block">Best Customers</span>
													</td>
													<td class="text-end text-muted fw-bold">ReactJS, Ruby</td>
													<td class="text-end">
														<span class="badge badge-light-warning">In Progress</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_5_tab_2">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
											<!--begin::Table head-->
											<thead>
												<tr class="border-0">
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-110px"></th>
													<th class="p-0 min-w-50px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/plurk.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block">Movie Creator</span>
													</td>
													<td class="text-end text-muted fw-bold">React, HTML</td>
													<td class="text-end">
														<span class="badge badge-light-success">Approved</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/telegram.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
														<span class="text-muted fw-semibold d-block">Most Successful</span>
													</td>
													<td class="text-end text-muted fw-bold">Python, MySQL</td>
													<td class="text-end">
														<span class="badge badge-light-warning">In Progress</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/bebo.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
														<span class="text-muted fw-semibold d-block">Movie Creator</span>
													</td>
													<td class="text-end text-muted fw-bold">AngularJS, C#</td>
													<td class="text-end">
														<span class="badge badge-light-danger">Rejected</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_5_tab_3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
											<!--begin::Table head-->
											<thead>
												<tr class="border-0">
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-110px"></th>
													<th class="p-0 min-w-50px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/kickstarter.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Bestseller Theme</a>
														<span class="text-muted fw-semibold d-block">Best Customers</span>
													</td>
													<td class="text-end text-muted fw-bold">ReactJS, Ruby</td>
													<td class="text-end">
														<span class="badge badge-light-warning">In Progress</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/bebo.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
														<span class="text-muted fw-semibold d-block">Movie Creator</span>
													</td>
													<td class="text-end text-muted fw-bold">AngularJS, C#</td>
													<td class="text-end">
														<span class="badge badge-light-danger">Rejected</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/vimeo.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
														<span class="text-muted fw-semibold d-block">Awesome Users</span>
													</td>
													<td class="text-end text-muted fw-bold">Laravel,Metronic</td>
													<td class="text-end">
														<span class="badge badge-light-primary">Success</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-45px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/brand-logos/telegram.svg')}}" class="h-50 align-self-center" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Popular Authors</a>
														<span class="text-muted fw-semibold d-block">Most Successful</span>
													</td>
													<td class="text-end text-muted fw-bold">Python, MySQL</td>
													<td class="text-end">
														<span class="badge badge-light-warning">In Progress</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Tables Widget 5-->
				</div>
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Table Widget 6-->
					<div class="card card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Authors Earnings</span>
								<span class="text-muted mt-1 fw-semibold fs-7">More than 400 new authors</span>
							</h3>
							<div class="card-toolbar">
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_6_tab_1">Month</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_6_tab_2">Week</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bold px-4 active" data-bs-toggle="tab" href="#kt_table_widget_6_tab_3">Day</a>
									</li>
								</ul>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<div class="tab-content">
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_6_tab_1">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/001-boy.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block">Successful Fellas</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$200,500</span>
													</td>
													<td class="text-end">
														<span class="text-primary fs-7 fw-bold">+28%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/018-girl-9.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block">HTML, CSS Coding</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$1,200,000</span>
													</td>
													<td class="text-end">
														<span class="text-warning fs-7 fw-bold">+52%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/047-girl-25.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block">PHP, Laravel, VueJS</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$1,200,000</span>
													</td>
													<td class="text-end">
														<span class="text-danger fs-7 fw-bold">+52%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/014-girl-7.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
														<span class="text-muted fw-semibold d-block">UI/UX Designer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$3,400,000</span>
													</td>
													<td class="text-end">
														<span class="text-success fs-7 fw-bold">-34%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/043-boy-18.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Kevin Leonard</a>
														<span class="text-muted fw-semibold d-block">Art Director</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$35,600,000</span>
													</td>
													<td class="text-end">
														<span class="text-info fs-7 fw-bold">+230%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_6_tab_2">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/018-girl-9.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block">HTML, CSS Coding</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$1,200,000</span>
													</td>
													<td class="text-end">
														<span class="text-warning fs-7 fw-bold">+52%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/014-girl-7.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
														<span class="text-muted fw-semibold d-block">UI/UX Designer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$3,400,000</span>
													</td>
													<td class="text-end">
														<span class="text-success fs-7 fw-bold">-34%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/001-boy.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block">Successful Fellas</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$200,500</span>
													</td>
													<td class="text-end">
														<span class="text-primary fs-7 fw-bold">+28%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade show active" id="kt_table_widget_6_tab_3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/047-girl-25.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-semibold d-block">HTML, CSS Coding</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$1,200,000</span>
													</td>
													<td class="text-end">
														<span class="text-danger fs-7 fw-bold">+52%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/014-girl-7.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
														<span class="text-muted fw-semibold d-block">UI/UX Designer</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$3,400,000</span>
													</td>
													<td class="text-end">
														<span class="text-success fs-7 fw-bold">-34%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets/media/svg/avatars/043-boy-18.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Kevin Leonard</a>
														<span class="text-muted fw-semibold d-block">Art Director</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$35,600,000</span>
													</td>
													<td class="text-end">
														<span class="text-info fs-7 fw-bold">+230%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label">
																<img src="{{asset('public/assets//media/svg/avatars/001-boy.svg')}}" class="h-75 align-self-end" alt="" />
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
														<span class="text-muted fw-semibold d-block">Successful Fellas</span>
													</td>
													<td>
														<span class="text-muted fw-semibold d-block fs-7">Paid</span>
														<span class="text-gray-900 fw-bold d-block fs-5">$200,500</span>
													</td>
													<td class="text-end">
														<span class="text-primary fs-7 fw-bold">+28%</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-duotone ki-arrow-right fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Tables Widget 6-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Row-->
			<div class="row g-5 g-xl-8">
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Table Widget 7-->
					<div class="card card-xl-stretch mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Latest Orders</span>
								<span class="text-muted mt-1 fw-semibold fs-7">More than 100 new orders</span>
							</h3>
							<div class="card-toolbar">
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary active fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_7_tab_1">Month</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_7_tab_2">Week</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4" data-bs-toggle="tab" href="#kt_table_widget_7_tab_3">Day</a>
									</li>
								</ul>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<div class="tab-content">
								<!--begin::Tap pane-->
								<div class="tab-pane fade show active" id="kt_table_widget_7_tab_1">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-success">
																<i class="ki-duotone ki-scroll fs-2x text-success">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Media Device</a>
														<span class="text-muted fw-semibold d-block fs-7">Voice and video recorder</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">5 day ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-success fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-danger">
																<i class="ki-duotone ki-element-11 fs-2x text-danger">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Special Meal</a>
														<span class="text-muted fw-semibold d-block fs-7">Quona Rice</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">2 day ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-danger fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-primary">
																<i class="ki-duotone ki-compass fs-2x text-primary">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">New Users</a>
														<span class="text-muted fw-semibold d-block fs-7">Awesome Users</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">4 day ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-primary fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-warning">
																<i class="ki-duotone ki-abstract-26 fs-2x text-warning">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
														<span class="text-muted fw-semibold d-block fs-7">Best Customers</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">1 day ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-warning fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-info">
																<i class="ki-duotone ki-bucket fs-2x text-info">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Strawberry Boxes</a>
														<span class="text-muted fw-semibold d-block fs-7">From Spain</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">7 day ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-info fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_7_tab_2">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-info">
																<i class="ki-duotone ki-abstract-41 fs-2x text-info">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Strawberry Boxes</a>
														<span class="text-muted fw-semibold d-block fs-7">From Spain</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">4 week ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-info fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-danger">
																<i class="ki-duotone ki-element-11 fs-2x text-danger">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Special Meal</a>
														<span class="text-muted fw-semibold d-block fs-7">Quona Rice</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">2 week ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-danger fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-warning">
																<i class="ki-duotone ki-abstract-26 fs-2x text-warning">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
														<span class="text-muted fw-semibold d-block fs-7">Best Customers</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">5 week ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-warning fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_7_tab_3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-140px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-success">
																<i class="ki-duotone ki-basket fs-2x text-success">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Media Device</a>
														<span class="text-muted fw-semibold d-block fs-7">Voice and video recorder</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">3 month ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-success fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-danger">
																<i class="ki-duotone ki-element-11 fs-2x text-danger">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Special Meal</a>
														<span class="text-muted fw-semibold d-block fs-7">Quona Rice</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">5 month ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-danger fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-warning">
																<i class="ki-duotone ki-abstract-26 fs-2x text-warning">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Active Customers</a>
														<span class="text-muted fw-semibold d-block fs-7">Best Customers</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">6 month ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-warning fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-info">
																<i class="ki-duotone ki-abstract-41 fs-2x text-info">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Strawberry Boxes</a>
														<span class="text-muted fw-semibold d-block fs-7">From Spain</span>
													</td>
													<td class="text-end">
														<span class="text-muted fw-semibold d-block fs-8">Ordered</span>
														<span class="text-gray-900 fw-bold d-block fs-7">4 month ago</span>
													</td>
													<td class="text-end">
														<span class="badge badge-light-info fs-7 fw-bold">Delivered</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Tables Widget 7-->
				</div>
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Table Widget 8-->
					<div class="card card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold fs-3 mb-1">Latest Products</span>
								<span class="text-muted mt-1 fw-semibold fs-7">More than 100 new orders</span>
							</h3>
							<div class="card-toolbar">
								<ul class="nav">
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary active fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_8_tab_1">Month</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_8_tab_2">Week</a>
									</li>
									<li class="nav-item">
										<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bold px-4" data-bs-toggle="tab" href="#kt_table_widget_8_tab_3">Day</a>
									</li>
								</ul>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<div class="tab-content">
								<!--begin::Tap pane-->
								<div class="tab-pane fade show active" id="kt_table_widget_8_tab_1">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-danger">
																<i class="ki-duotone ki-scroll fs-2x text-danger">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">School Music Festival</a>
														<span class="text-muted fw-semibold d-block fs-7">by Rose Liam</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">4:20PM, 03 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-warning">
																<i class="ki-duotone ki-element-11 fs-2x text-warning">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Maths Championship</a>
														<span class="text-muted fw-semibold d-block fs-7">By Tom Gere</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">10:05PM, 25 Oct</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-info">
																<i class="ki-duotone ki-compass fs-2x text-info">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Who Knows Geography</a>
														<span class="text-muted fw-semibold d-block fs-7">By Zoey Dylan</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">3:22PM, 07 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-primary">
																<i class="ki-duotone ki-abstract-26 fs-2x text-primary">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Napoleon Days</a>
														<span class="text-muted fw-semibold d-block fs-7">By Luke Owen</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">1:20PM, 02 Dec</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-success">
																<i class="ki-duotone ki-bucket fs-2x text-success">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">The School Art Leads</a>
														<span class="text-muted fw-semibold d-block fs-7">By Ellie Cole</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">6:20PM, 07 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_8_tab_2">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-info">
																<i class="ki-duotone ki-compass fs-2x text-info">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Who Knows Geography</a>
														<span class="text-muted fw-semibold d-block fs-7">By Zoey Dylan</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">3:22PM, 07 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-warning">
																<i class="ki-duotone ki-element-11 fs-2x text-warning">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Maths Championship</a>
														<span class="text-muted fw-semibold d-block fs-7">By Tom Gere</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">10:05PM, 25 Oct</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-danger">
																<i class="ki-duotone ki-scroll fs-2x text-danger">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">School Music Festival</a>
														<span class="text-muted fw-semibold d-block fs-7">by Rose Liam</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">4:20PM, 03 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
								<!--begin::Tap pane-->
								<div class="tab-pane fade" id="kt_table_widget_8_tab_3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr>
													<th class="p-0 w-50px"></th>
													<th class="p-0 min-w-150px"></th>
													<th class="p-0 min-w-120px"></th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-warning">
																<i class="ki-duotone ki-element-11 fs-2x text-warning">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																	<span class="path4"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Maths Championship</a>
														<span class="text-muted fw-semibold d-block fs-7">By Tom Gere</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">10:05PM, 25 Oct</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-info">
																<i class="ki-duotone ki-compass fs-2x text-info">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Who Knows Geography</a>
														<span class="text-muted fw-semibold d-block fs-7">By Zoey Dylan</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">3:22PM, 07 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-primary">
																<i class="ki-duotone ki-abstract-26 fs-2x text-primary">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Napoleon Days</a>
														<span class="text-muted fw-semibold d-block fs-7">By Luke Owen</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">1:20PM, 02 Dec</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
												<tr>
													<td>
														<div class="symbol symbol-50px me-2">
															<span class="symbol-label bg-light-danger">
																<i class="ki-duotone ki-scroll fs-2x text-danger">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
															</span>
														</div>
													</td>
													<td>
														<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">School Music Festival</a>
														<span class="text-muted fw-semibold d-block fs-7">by Rose Liam</span>
													</td>
													<td class="text-end">
														<span class="text-gray-900 fw-bold d-block fs-7">4:20PM, 03 Sep</span>
														<span class="text-muted fw-semibold d-block fs-8">Date</span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
															<i class="ki-solid ki-dots-horizontal fs-1"></i>
														</a>
													</td>
												</tr>
											</tbody>
											<!--end::Table body-->
										</table>
									</div>
									<!--end::Table-->
								</div>
								<!--end::Tap pane-->
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::Tables Widget 8-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Tables Widget 9-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold fs-3 mb-1">Members Statistics</span>
						<span class="text-muted mt-1 fw-semibold fs-7">Over 500 members</span>
					</h3>
					<div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
						<a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
						<i class="ki-duotone ki-plus fs-2"></i>New Member</a>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-3">
					<!--begin::Table container-->
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
							<!--begin::Table head-->
							<thead>
								<tr class="fw-bold text-muted">
									<th class="w-25px">
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
										</div>
									</th>
									<th class="min-w-200px">Authors</th>
									<th class="min-w-150px">Company</th>
									<th class="min-w-150px">Progress</th>
									<th class="min-w-100px text-end">Actions</th>
								</tr>
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-9-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-45px me-5">
												<img src="{{asset('public/assets/media/avatars/300-14.jpg')}}" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Ana Simmons</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block fs-6">Intertico</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Web, UI/UX Design</span>
									</td>
									<td class="text-end">
										<div class="d-flex flex-column w-100 me-2">
											<div class="d-flex flex-stack mb-2">
												<span class="text-muted me-2 fs-7 fw-bold">50%</span>
											</div>
											<div class="progress h-6px w-100">
												<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
									<td>
										<div class="d-flex justify-content-end flex-shrink-0">
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-switch fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-pencil fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
												<i class="ki-duotone ki-trash fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
													<span class="path3"></span>
													<span class="path4"></span>
													<span class="path5"></span>
												</i>
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-9-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-45px me-5">
												<img src="{{asset('public/assets/media/avatars/300-2.jpg')}}" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Jessie Clarcson</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">C#, ASP.NET, MS SQL</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block fs-6">Agoda</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Houses & Hotels</span>
									</td>
									<td class="text-end">
										<div class="d-flex flex-column w-100 me-2">
											<div class="d-flex flex-stack mb-2">
												<span class="text-muted me-2 fs-7 fw-bold">70%</span>
											</div>
											<div class="progress h-6px w-100">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
									<td>
										<div class="d-flex justify-content-end flex-shrink-0">
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-switch fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-pencil fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
												<i class="ki-duotone ki-trash fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
													<span class="path3"></span>
													<span class="path4"></span>
													<span class="path5"></span>
												</i>
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-9-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-45px me-5">
												<img src="{{asset('public/assets/media/avatars/300-5.jpg')}}" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Lebron Wayde</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">PHP, Laravel, VueJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block fs-6">RoadGee</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Transportation</span>
									</td>
									<td class="text-end">
										<div class="d-flex flex-column w-100 me-2">
											<div class="d-flex flex-stack mb-2">
												<span class="text-muted me-2 fs-7 fw-bold">60%</span>
											</div>
											<div class="progress h-6px w-100">
												<div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
									<td>
										<div class="d-flex justify-content-end flex-shrink-0">
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-switch fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-pencil fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
												<i class="ki-duotone ki-trash fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
													<span class="path3"></span>
													<span class="path4"></span>
													<span class="path5"></span>
												</i>
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-9-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-45px me-5">
												<img src="assets/media/avatars/300-20.jpg" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Natali Goodwin</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">Python, PostgreSQL, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block fs-6">The Hill</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span>
									</td>
									<td class="text-end">
										<div class="d-flex flex-column w-100 me-2">
											<div class="d-flex flex-stack mb-2">
												<span class="text-muted me-2 fs-7 fw-bold">50%</span>
											</div>
											<div class="progress h-6px w-100">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
									<td>
										<div class="d-flex justify-content-end flex-shrink-0">
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-switch fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-pencil fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
												<i class="ki-duotone ki-trash fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
													<span class="path3"></span>
													<span class="path4"></span>
													<span class="path5"></span>
												</i>
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-9-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-45px me-5">
												<img src="{{asset('public/assets/media/avatars/300-23.jpg')}}" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Kevin Leonard</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block fs-6">RoadGee</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Art Director</span>
									</td>
									<td class="text-end">
										<div class="d-flex flex-column w-100 me-2">
											<div class="d-flex flex-stack mb-2">
												<span class="text-muted me-2 fs-7 fw-bold">90%</span>
											</div>
											<div class="progress h-6px w-100">
												<div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
									<td>
										<div class="d-flex justify-content-end flex-shrink-0">
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-switch fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
												<i class="ki-duotone ki-pencil fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
												<i class="ki-duotone ki-trash fs-2">
													<span class="path1"></span>
													<span class="path2"></span>
													<span class="path3"></span>
													<span class="path4"></span>
													<span class="path5"></span>
												</i>
											</a>
										</div>
									</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
					<!--end::Table container-->
				</div>
				<!--begin::Body-->
			</div>
			<!--end::Tables Widget 9-->
			<!--begin::Tables Widget 10-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold fs-3 mb-1">New Products</span>
						<span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span>
					</h3>
					<div class="card-toolbar">
						<!--begin::Menu-->
						<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
							<i class="ki-duotone ki-category fs-6">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
						</button>
						<!--begin::Menu 2-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator mb-3 opacity-75"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Ticket</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Customer</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
								<!--begin::Menu item-->
								<a href="#" class="menu-link px-3">
									<span class="menu-title">New Group</span>
									<span class="menu-arrow"></span>
								</a>
								<!--end::Menu item-->
								<!--begin::Menu sub-->
								<div class="menu-sub menu-sub-dropdown w-175px py-4">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Admin Group</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Staff Group</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Member Group</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu sub-->
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Contact</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator mt-3 opacity-75"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content px-3 py-3">
									<a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
								</div>
							</div>
							<!--end::Menu item-->
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body pt-3">
					<!--begin::Table container-->
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
							<!--begin::Table head-->
							<thead>
								<tr class="border-0">
									<th class="p-0"></th>
									<th class="p-0 min-w-150px"></th>
									<th class="p-0 min-w-200px"></th>
									<th class="p-0 min-w-150px"></th>
									<th class="p-0 min-w-100px text-end"></th>
								</tr>
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<!--begin::Avatar-->
											<div class="symbol symbol-45px me-5">
												<img alt="Pic" src="{{asset('public/assets/media/avatars/300-6.jpg')}}" />
											</div>
											<!--end::Avatar-->
											<!--begin::Name-->
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Emma Smith</a>
												<a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
												<span class="text-gray-900">Email</span>: smith@kpmg.com</a>
											</div>
											<!--end::Name-->
										</div>
									</td>
									<td class="text-end">
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$560,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td class="text-muted fw-semibold text-end">Laravel, Metronic</td>
									<td class="text-end">
										<span class="badge badge-light-success">Approved</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<!--begin::Avatar-->
											<div class="symbol symbol-45px me-5">
												<span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
											</div>
											<!--end::Avatar-->
											<!--begin::Name-->
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Melody Macy</a>
												<a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
												<span class="text-gray-900">Email</span>: melody@altbox.com</a>
											</div>
											<!--end::Name-->
										</div>
									</td>
									<td class="text-end">
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$2,000,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td class="text-muted fw-semibold text-end">ReactJs, HTML</td>
									<td class="text-end">
										<span class="badge badge-light-warning">In Progress</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<!--begin::Avatar-->
											<div class="symbol symbol-45px me-5">
												<img alt="Pic" src="{{asset('public/assets/media/avatars/300-1.jpg')}}" />
											</div>
											<!--end::Avatar-->
											<!--begin::Name-->
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Max Smith</a>
												<a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
												<span class="text-gray-900">Email</span>: max@kt.com</a>
											</div>
											<!--end::Name-->
										</div>
									</td>
									<td class="text-end">
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$760,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td class="text-muted fw-semibold text-end">Python, MySQL</td>
									<td class="text-end">
										<span class="badge badge-light-danger">Success</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<!--begin::Avatar-->
											<div class="symbol symbol-45px me-5">
												<img alt="Pic" src="{{asset('public/assets/media/avatars/300-5.jpg')}}" />
											</div>
											<!--end::Avatar-->
											<!--begin::Name-->
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Sean Bean</a>
												<a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
												<span class="text-gray-900">Email</span>: sean@dellito.com</a>
											</div>
											<!--end::Name-->
										</div>
									</td>
									<td class="text-end">
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$257,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td class="text-muted fw-semibold text-end">ReactJS, Ruby</td>
									<td class="text-end">
										<span class="badge badge-light-info">Rejected</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<!--begin::Avatar-->
											<div class="symbol symbol-45px me-5">
												<img alt="Pic" src="{{asset('public/assets/media/avatars/300-25.jpg')}}" />
											</div>
											<!--end::Avatar-->
											<!--begin::Name-->
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brian Cox</a>
												<a href="#" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
												<span class="text-gray-900">Email</span>: brian@exchange.com</a>
											</div>
											<!--end::Name-->
										</div>
									</td>
									<td class="text-end">
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$560,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td class="text-muted fw-semibold text-end">AngularJS, C#</td>
									<td class="text-end">
										<span class="badge badge-light-primary">In Progress</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
					<!--end::Table container-->
				</div>
				<!--begin::Body-->
			</div>
			<!--end::Tables Widget 10-->
			<!--begin::Tables Widget 11-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold fs-3 mb-1">New Arrivals</span>
						<span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span>
					</h3>
					<div class="card-toolbar">
						<a href="#" class="btn btn-sm btn-light-primary">
						<i class="ki-duotone ki-plus fs-2"></i>New Member</a>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-3">
					<!--begin::Table container-->
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table align-middle gs-0 gy-4">
							<!--begin::Table head-->
							<thead>
								<tr class="fw-bold text-muted bg-light">
									<th class="ps-4 min-w-325px rounded-start">Product</th>
									<th class="min-w-125px">Price</th>
									<th class="min-w-125px">Deposit</th>
									<th class="min-w-200px">Agent</th>
									<th class="min-w-150px">Status</th>
									<th class="min-w-200px text-end rounded-end"></th>
								</tr>
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<img src="{{asset('public/assets/media/stock/600x400/img-26.jpg')}}" class="" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Sant Extreanet Solution</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$2,790</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$520</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Rejected</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Bradly Beal</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span>
									</td>
									<td>
										<span class="badge badge-light-primary fs-7 fw-bold">Approved</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<img src="{{asset('public/assets/media/stock/600x400/img-3.jpg')}}" class="" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Telegram Development</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">C#, ASP.NET, MS SQL</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$4,790</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$240</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Rejected</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Chris Thompson</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">NBA Player</span>
									</td>
									<td>
										<span class="badge badge-light-danger fs-7 fw-bold">In Progress</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<img src="{{asset('public/assets/media/stock/600x400/img-9.jpg')}}" class="" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Payroll Application</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">PHP, Laravel, VueJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$4,390</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$593</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Rejected</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Zoey McGee</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Ruby Developer</span>
									</td>
									<td>
										<span class="badge badge-light-success fs-7 fw-bold">Success</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<img src="{{asset('public/assets/media/stock/600x400/img-18.jpg')}}" class="" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">HR Management System</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">Python, PostgreSQL, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$7,990</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$980</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Rejected</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Brandon Ingram</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span>
									</td>
									<td>
										<span class="badge badge-light-info fs-7 fw-bold">Rejected</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<img src="{{asset('public/assets/media/stock/600x400/img-8.jpg')}}" class="" alt="" />
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Telegram Mobile</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$5,790</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$750</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Rejected</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Natali Trump</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span>
									</td>
									<td>
										<span class="badge badge-light-warning fs-7 fw-bold">Approved</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
					<!--end::Table container-->
				</div>
				<!--begin::Body-->
			</div>
			<!--end::Tables Widget 11-->
			<!--begin::Tables Widget 12-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold fs-3 mb-1">Member Statistics</span>
						<span class="text-muted mt-1 fw-semibold fs-7">Over 500 new members</span>
					</h3>
					<div class="card-toolbar">
						<!--begin::Menu-->
						<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
							<i class="ki-duotone ki-category fs-6">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
						</button>
						<!--begin::Menu 2-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator mb-3 opacity-75"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Ticket</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Customer</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
								<!--begin::Menu item-->
								<a href="#" class="menu-link px-3">
									<span class="menu-title">New Group</span>
									<span class="menu-arrow"></span>
								</a>
								<!--end::Menu item-->
								<!--begin::Menu sub-->
								<div class="menu-sub menu-sub-dropdown w-175px py-4">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Admin Group</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Staff Group</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Member Group</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu sub-->
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Contact</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator mt-3 opacity-75"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content px-3 py-3">
									<a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
								</div>
							</div>
							<!--end::Menu item-->
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-3">
					<!--begin::Table container-->
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table align-middle gs-0 gy-4">
							<!--begin::Table head-->
							<thead>
								<tr class="fw-bold text-muted bg-light">
									<th class="ps-4 min-w-300px rounded-start">Agent</th>
									<th class="min-w-125px">Earnings</th>
									<th class="min-w-125px">Comission</th>
									<th class="min-w-200px">Company</th>
									<th class="min-w-150px">Rating</th>
									<th class="min-w-200px text-end rounded-end"></th>
								</tr>
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<span class="symbol-label bg-light">
													<img src="{{asset('public/assets/media/svg/avatars/001-boy.svg')}}" class="h-75 align-self-end" alt="" />
												</span>
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$8,000,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Pending</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Intertico</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Web, UI/UX Design</span>
									</td>
									<td>
										<div class="rating">
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
										</div>
										<span class="text-muted fw-semibold text-muted d-block fs-7 mt-1">Best Rated</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">View</a>
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Edit</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<span class="symbol-label bg-light">
													<img src="{{asset('public/assets/media/svg/avatars/047-girl-25.svg')}}" class="h-75 align-self-end" alt="" />
												</span>
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Lebron Wayde</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">PHP, Laravel, VueJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$8,750,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$7,400</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Agoda</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Houses & Hotels</span>
									</td>
									<td>
										<div class="rating">
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
										</div>
										<span class="text-muted fw-semibold text-muted d-block fs-7 mt-1">Above Avarage</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">View</a>
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Edit</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<span class="symbol-label bg-light">
													<img src="{{asset('public/assets/media/svg/avatars/006-girl-3.svg')}}" class="h-75 align-self-end" alt="" />
												</span>
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brad Simmons</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$8,000,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">In Proccess</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$2,500</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Rejected</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">RoadGee</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<div class="rating">
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
										</div>
										<span class="text-muted fw-semibold text-muted d-block fs-7 mt-1">Best Rated</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">View</a>
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Edit</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<span class="symbol-label bg-light">
													<img src="{{asset('public/assets/media/svg/avatars/014-girl-7.svg')}}" class="h-75 align-self-end" alt="" />
												</span>
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Natali Trump</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$700,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Pending</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$7,760</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">The Hill</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span>
									</td>
									<td>
										<div class="rating">
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
										</div>
										<span class="text-muted fw-semibold text-muted d-block fs-7 mt-1">Avarage</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">View</a>
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Edit</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50px me-5">
												<span class="symbol-label bg-light">
													<img src="{{asset('public/assets/media/svg/avatars/020-girl-11.svg')}}" class="h-75 align-self-end" alt="" />
												</span>
											</div>
											<div class="d-flex justify-content-start flex-column">
												<a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Jessie Clarcson</a>
												<span class="text-muted fw-semibold text-muted d-block fs-7">HTML, JS, ReactJS</span>
											</div>
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$1,320,000</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Pending</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$6,250</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Intertico</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Web, UI/UX Design</span>
									</td>
									<td>
										<div class="rating">
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
											<div class="rating-label checked">
												<i class="ki-duotone ki-star fs-6"></i>
											</div>
										</div>
										<span class="text-muted fw-semibold text-muted d-block fs-7 mt-1">Best Rated</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">View</a>
										<a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Edit</a>
									</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
					<!--end::Table container-->
				</div>
				<!--begin::Body-->
			</div>
			<!--end::Tables Widget 12-->
			<!--begin::Tables Widget 13-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold fs-3 mb-1">Recent Orders</span>
						<span class="text-muted mt-1 fw-semibold fs-7">Over 500 orders</span>
					</h3>
					<div class="card-toolbar">
						<!--begin::Menu-->
						<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
							<i class="ki-duotone ki-category fs-6">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
								<span class="path4"></span>
							</i>
						</button>
						<!--begin::Menu 2-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator mb-3 opacity-75"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Ticket</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Customer</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
								<!--begin::Menu item-->
								<a href="#" class="menu-link px-3">
									<span class="menu-title">New Group</span>
									<span class="menu-arrow"></span>
								</a>
								<!--end::Menu item-->
								<!--begin::Menu sub-->
								<div class="menu-sub menu-sub-dropdown w-175px py-4">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Admin Group</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Staff Group</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Member Group</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu sub-->
							</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="#" class="menu-link px-3">New Contact</a>
							</div>
							<!--end::Menu item-->
							<!--begin::Menu separator-->
							<div class="separator mt-3 opacity-75"></div>
							<!--end::Menu separator-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<div class="menu-content px-3 py-3">
									<a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
								</div>
							</div>
							<!--end::Menu item-->
						</div>
						<!--end::Menu 2-->
						<!--end::Menu-->
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-3">
					<!--begin::Table container-->
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
							<!--begin::Table head-->
							<thead>
								<tr class="fw-bold text-muted">
									<th class="w-25px">
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-13-check" />
										</div>
									</th>
									<th class="min-w-150px">Order Id</th>
									<th class="min-w-140px">Country</th>
									<th class="min-w-120px">Date</th>
									<th class="min-w-120px">Company</th>
									<th class="min-w-120px">Total</th>
									<th class="min-w-120px">Status</th>
									<th class="min-w-100px text-end">Actions</th>
								</tr>
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-13-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">56037-XDER</a>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Brasil</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: PH</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">05/28/2020</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Intertico</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Web, UI/UX Design</span>
									</td>
									<td class="text-gray-900 fw-bold text-hover-primary fs-6">$3560</td>
									<td>
										<span class="badge badge-light-success">Approved</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-13-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">05822-FXSP</a>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Belarus</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: BY</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">04/18/2021</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Agoda</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Houses & Hotels</span>
									</td>
									<td class="text-gray-900 fw-bold text-hover-primary fs-6">$4850</td>
									<td>
										<span class="badge badge-light-warning">In Progress</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-13-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">4472-QREX</a>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Phillipines</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: BH</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">07/23/2019</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">RoadGee</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Transportation</span>
									</td>
									<td class="text-gray-900 fw-bold text-hover-primary fs-6">$8376</td>
									<td>
										<span class="badge badge-light-danger">Success</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-13-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">00347-BCLQ</a>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Argentina</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: BR</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">12/21/2021</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">The Hill</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span>
									</td>
									<td class="text-gray-900 fw-bold text-hover-primary fs-6">$9486</td>
									<td>
										<span class="badge badge-light-info">Rejected</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input class="form-check-input widget-13-check" type="checkbox" value="1" />
										</div>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">59486-XDER</a>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Agoda</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: BT</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">05/28/2020</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Code: Paid</span>
									</td>
									<td>
										<a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">Phillipines</a>
										<span class="text-muted fw-semibold text-muted d-block fs-7">Transportation</span>
									</td>
									<td class="text-gray-900 fw-bold text-hover-primary fs-6">$8476</td>
									<td>
										<span class="badge badge-light-primary">Approved</span>
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-switch fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
											<i class="ki-duotone ki-pencil fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</a>
										<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
											<i class="ki-duotone ki-trash fs-2">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
												<span class="path4"></span>
												<span class="path5"></span>
											</i>
										</a>
									</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
					<!--end::Table container-->
				</div>
				<!--begin::Body-->
			</div>
			<!--end::Tables Widget 13-->
		</div>
		<!--end::Post-->
		<!--begin::Footer-->
		<div class="footer py-4 d-flex flex-column flex-md-row flex-stack" id="kt_footer">
			<!--begin::Copyright-->
			<div class="text-gray-900 order-2 order-md-1">
				<span class="text-muted fw-semibold me-1">2023&copy;</span>
				<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
			</div>
			<!--end::Copyright-->
			<!--begin::Menu-->
			<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
				<li class="menu-item">
					<a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
				</li>
				<li class="menu-item">
					<a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
				</li>
				<li class="menu-item">
					<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
				</li>
			</ul>
			<!--end::Menu-->
		</div>
		<!--end::Footer-->
	</div>
	<!--end::Container-->
@endsection
