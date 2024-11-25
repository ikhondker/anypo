

		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3>Dashboard</h3>
			</div>

			<div class="col-auto ms-auto text-end mt-n1">

				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-lucide="calendar"></i> Today
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<h6 class="dropdown-header">Settings</h6>
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Separated link</a>
					</div>
				</div>

				<button class="btn btn-primary shadow-sm">
					<i class="align-middle" data-lucide="filter">&nbsp;</i>
				</button>
				<button class="btn btn-primary shadow-sm">
					<i class="align-middle" data-lucide="refresh-cw">&nbsp;</i>
				</button>
			</div>
		</div>

		<a href="#" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New project</a>
		<h1 class="h3 mb-3">Reusable Widgets</h1>


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('users.edit', 123) }}"><i class="fas fa-edit"></i> Edit</a>
					 @endif
				</div>
				<h5 class="card-title">Interface Components Guideline</h5>
				<h6 class="card-subtitle text-muted">Please follow these for UI. Prototype is -> dept</h6>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>route </th>
						<th>Page Dropdown</th>
						<th>Page Buttons<br>x-tenant.page-header</th>
						<th>Page Icons</th>
						<th>Card Buttons</th>
						<th>Card Icons</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>index</td>
						<td>[index-actions]</td>
						<td>Create </td>
						<td>[Lucide]</td>
						<td>Search + Export</td>
						<td>[Lucide]</td>
					</tr>
					<tr>
						<td>show</td>
						<td>actions </td>
						<td>Create+View all</td>
						<td>&nbsp;</td>
						<td>Edit + View All </td>
						<td>[FontAwesome]</td>
					</tr>
					<tr>
						<td>edit</td>
						<td>actions</td>
						<td>Create+View all</td>
						<td>&nbsp;</td>
						<td>Create + View All</td>
						<td>[FontAwesome]</td>
					</tr>
					<tr>
						<td>create</td>
						<td>[index-actions] </td>
						<td>View all</td>
						<td>&nbsp;</td>
						<td>[View All]</td>
						<td>[FontAwesome]</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-orders-search" placeholder="Search orders…">
							<button class="btn" type="button">
							<i class="align-middle" data-lucide="search"></i>
							</button>
						</div>
					</div>
					<div class="col-md-6 col-xl-8">
						<div class="text-sm-end">
							<button type="button" class="btn btn-light btn-lg me-2"><i data-lucide="download"></i> Export</button>
							<button type="button" class="btn btn-primary btn-lg"><i data-lucide="plus"></i> New Order</button>
						</div>
					</div>
				</div>

				<table class="table w-100">
					<thead>
						<tr>

							<th class="align-middle">Order ID</th>
							<th class="align-middle">Billing Name</th>
							<th class="align-middle">Date</th>
							<th class="align-middle">Total</th>
							<th class="align-middle">Payment Method</th>
							<th class="align-middle">Payment Status</th>
							<th class="align-middle text-end">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>

							<td><strong>#SK01</strong></td>
							<td>Tony Sheley</td>
							<td>July 5, 2023</td>
							<td>$350 USD</td>
							<td><i class="fa-brands fa-cc-mastercard"></i> Mastercard</td>
							<td><span class="badge badge-subtle-success">Paid</span></td>
							<td class="text-end">
								<button type="button" class="btn btn-light">View</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<h1 class="h3 mb-3">List with Avatar</h1>
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-6 mb-2 mb-md-0">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-customers-search" placeholder="Search customers…">
							<button class="btn" type="button">
							<i class="align-middle" data-lucide="search"></i>
						</button>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-sm-end">
							<button type="button" class="btn btn-light btn-lg me-2"><i data-lucide="download"></i> Export</button>
							<button type="button" class="btn btn-primary btn-lg"><i data-lucide="plus"></i> Add Customer</button>
						</div>
					</div>
				</div>
				<table id="datatables-customers" class="table w-100">
					<thead>
						<tr>
							<th class="text-start">#</th>
							<th>Name</th>
							<th>Company</th>
							<th>Email</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<img src="{{ asset('/assets/img/avatars/avatar.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar">
							</td>
							<td>Garrett Winters</td>
							<td>Good Guys</td>
							<td>garrett@winters.com</td>
							<td><span class="badge badge-subtle-success">Active</span></td>
						</tr>
						<tr>
							<td><img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar"></td>
							<td>Ashton Cox</td>
							<td>Levitz Furniture</td>
							<td>ashton@cox.com</td>
							<td><span class="badge badge-subtle-success">Active</span></td>
						</tr>
						<tr>
							<td><img src="{{ asset('/assets/img/avatars/avatar-3.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar"></td>
							<td>Sonya Frost</td>
							<td>Child World</td>
							<td>sonya@frost.com</td>
							<td><span class="badge badge-subtle-danger">Deleted</span></td>
						</tr>


					</tbody>
				</table>
			</div>
		</div>

		<h2 class="h4 mb-3">Task List (card-body)</h1>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<h2 class="card-title">Upcoming</h2>
					</div>
					<div class="col-6">
						<div class="text-sm-end">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal"><i data-lucide="plus"></i> New Task</button>
						</div>
					</div>
				</div>
				<table class="table w-100">
					<thead>
						<tr>
							<th class="align-middle w-25px">
								<div class="form-check fs-4"> <input class="form-check-input tasks-check-all" type="checkbox" id="tasks-check-all"> <label class="form-check-label" for="tasks-check-all"></label> </div>
							</th>
							<th class="align-middle w-50">Name</th>
							<th class="align-middle d-none d-xl-table-cell">Assigned To</th>
							<th class="align-middle d-none d-xxl-table-cell">Due Date</th>
							<th class="align-middle">Priority</th>
							<th class="align-middle text-end">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="form-check fs-4"> <input class="form-check-input" type="checkbox"> <label class="form-check-label"></label> </div>
							</td>
							<td><strong>Improve email marketing strategy</strong></td>
							<td class="d-none d-xl-table-cell">
								<img src="{{ asset('/assets/img/avatars/avatar.jpg') }}" class="rounded-circle me-1" alt="Ashley Briggs" width="32" height="32"> Ashley Briggs
							</td>
							<td class="d-none d-xxl-table-cell">August 1, 2023</td>
							<td><span class="badge badge-subtle-warning">Medium</span></td>
							<td class="text-end"> <button type="button" class="btn btn-light">View</button> </td>
						</tr>
						<tr>
							<td>
								<div class="form-check fs-4"> <input class="form-check-input" type="checkbox"> <label class="form-check-label"></label> </div>
							</td>
							<td><strong>Develop new product video</strong></td>
							<td class="d-none d-xl-table-cell">
								<img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" class="rounded-circle me-1" alt="Carl Jenkins" width="32" height="32"> Carl Jenkins
							</td>
							<td class="d-none d-xxl-table-cell">July 15, 2023</td>
							<td><span class="badge badge-subtle-danger">High</span></td>
							<td class="text-end"> <button type="button" class="btn btn-light">View</button> </td>
						</tr>
						<tr>
							<td>
								<div class="form-check fs-4"> <input class="form-check-input" type="checkbox"> <label class="form-check-label"></label> </div>
							</td>
							<td><strong>Conduct user interviews for new feature</strong></td>
							<td class="d-none d-xl-table-cell">
								<img src="{{ asset('/assets/img/avatars/avatar-3.jpg') }}" class="rounded-circle me-1" alt="Bertha Martin" width="32" height="32"> Bertha Martin
							</td>
							<td class="d-none d-xxl-table-cell">June 20, 2023</td>
							<td><span class="badge badge-subtle-success">Low</span></td>
							<td class="text-end"> <button type="button" class="btn btn-light">View</button> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


		<h1 class="h3 mb-3">Double Line List</h1>
		<div class="card flex-fill">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
							<i class="align-middle" data-lucide="more-horizontal"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Latest Projects</h5>
			</div>
			<table class="table table-borderless my-0">
				<thead>
					<tr>
						<th>Name</th>
						<th class="d-none d-xxl-table-cell">Company</th>
						<th class="d-none d-xl-table-cell">Author</th>
						<th>Status</th>
						<th class="d-none d-xl-table-cell text-end">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="d-flex">
								<div class="flex-shrink-0">
									<div class="bg-body-tertiary rounded-2">
										<img src="{{ asset('/assets/img/avatars/avatar.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar">
									</div>
								</div>
								<div class="flex-grow-1 ms-3">
									<strong>Project Apollo</strong>
									<div class="text-muted">
										Web, UI/UX Design
									</div>
								</div>
							</div>
						</td>
						<td class="d-none d-xxl-table-cell">
							<strong>Gantos</strong>
							<div class="text-muted">
								Real Estate
							</div>
						</td>
						<td class="d-none d-xl-table-cell">
							<strong>Carl Jenkins</strong>
							<div class="text-muted">
								HTML, JS, React
							</div>
						</td>
						<td>
							<div class="d-flex flex-column w-100">
								<span class="me-2 mb-1 text-muted">65%</span>
								<div class="progress progress-sm w-100">
									<div class="progress-bar bg-success" role="progressbar" style="width: 65%;"></div>
								</div>
							</div>
						</td>
						<td class="d-none d-xl-table-cell text-end">
							<a href="#" class="btn btn-light">View</a>
						</td>
					</tr>
					<tr>
						<td>
							<div class="d-flex">
								<div class="flex-shrink-0">
									<div class="bg-body-tertiary rounded-2">
										<img src="{{ asset('/assets/img/avatars/avatar.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar">
									</div>
								</div>
								<div class="flex-grow-1 ms-3">
									<strong>Project Bongo</strong>
									<div class="text-muted">
										Web
									</div>
								</div>
							</div>
						</td>
						<td class="d-none d-xxl-table-cell">
							<strong>Adray Transportation</strong>
							<div class="text-muted">
								Transportation
							</div>
						</td>
						<td class="d-none d-xl-table-cell">
							<strong>Bertha Martin</strong>
							<div class="text-muted">
								HTML, JS, Vue
							</div>
						</td>
						<td>
							<div class="d-flex flex-column w-100">
								<span class="me-2 mb-1 text-muted">33%</span>
								<div class="progress progress-sm w-100">
									<div class="progress-bar bg-danger" role="progressbar" style="width: 33%;"></div>
								</div>
							</div>
						</td>
						<td class="d-none d-xl-table-cell text-end">
							<a href="#" class="btn btn-light">View</a>
						</td>
					</tr>
					<tr>
						<td>
							<div class="d-flex">
								<div class="flex-shrink-0">
									<div class="bg-body-tertiary rounded-2">
										<img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar">
									</div>
								</div>
								<div class="flex-grow-1 ms-3">
									<strong>Project Canary</strong>
									<div class="text-muted">
										Web, UI/UX Design
									</div>
								</div>
							</div>
						</td>
						<td class="d-none d-xxl-table-cell">
							<strong>Evans</strong>
							<div class="text-muted">
								Insurance
							</div>
						</td>
						<td class="d-none d-xl-table-cell">
							<strong>Stacie Hall</strong>
							<div class="text-muted">
								HTML, JS, Laravel
							</div>
						</td>
						<td>
							<div class="d-flex flex-column w-100">
								<span class="me-2 mb-1 text-muted">50%</span>
								<div class="progress progress-sm w-100">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 50%;"></div>
								</div>
							</div>
						</td>
						<td class="d-none d-xl-table-cell text-end">
							<a href="#" class="btn btn-light">View</a>
						</td>
					</tr>
					<tr>
						<td>
							<div class="d-flex">
								<div class="flex-shrink-0">
									<div class="bg-body-tertiary rounded-2">
										<img src="{{ asset('/assets/img/avatars/avatar-3.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar">
									</div>
								</div>
								<div class="flex-grow-1 ms-3">
									<strong>Project Edison</strong>
									<div class="text-muted">
										UI/UX Design
									</div>
								</div>
							</div>
						</td>
						<td class="d-none d-xxl-table-cell">
							<strong>Monsource Investment Group</strong>
							<div class="text-muted">
								Finance
							</div>
						</td>
						<td class="d-none d-xl-table-cell">
							<strong>Carl Jenkins</strong>
							<div class="text-muted">
								HTML, JS, React
							</div>
						</td>
						<td>
							<div class="d-flex flex-column w-100">
								<span class="me-2 mb-1 text-muted">80%</span>
								<div class="progress progress-sm w-100">
									<div class="progress-bar bg-success" role="progressbar" style="width: 80%;"></div>
								</div>
							</div>
						</td>
						<td class="d-none d-xl-table-cell text-end">
							<a href="#" class="btn btn-light">View</a>
						</td>
					</tr>
					<tr>
						<td>
							<div class="d-flex">
								<div class="flex-shrink-0">
									<div class="bg-body-tertiary rounded-2">
										<img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar">
									</div>
								</div>
								<div class="flex-grow-1 ms-3">
									<strong>Project Indigo</strong>
									<div class="text-muted">
										Web, UI/UX Design
									</div>
								</div>
							</div>
						</td>
						<td class="d-none d-xxl-table-cell">
							<strong>Edwards</strong>
							<div class="text-muted">
								Retail
							</div>
						</td>
						<td class="d-none d-xl-table-cell">
							<strong>Ashley Briggs</strong>
							<div class="text-muted">
								HTML, JS, Vue
							</div>
						</td>
						<td>
							<div class="d-flex flex-column w-100">
								<span class="me-2 mb-1 text-muted">78%</span>
								<div class="progress progress-sm w-100">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 78%;"></div>
								</div>
							</div>
						</td>
						<td class="d-none d-xl-table-cell text-end">
							<a href="#" class="btn btn-light">View</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<h2 class="h4 mb-3">Specifications</h2>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-sm mb-0">
								<tbody>
									<tr>
										<th scope="row" style="width: 320px;">Category</th>
										<td>Smartphones</td>
									</tr>
									<tr>
										<th scope="row">Brand</th>
										<td>Apple</td>
									</tr>
									<tr>
										<th scope="row">Product number</th>
										<td>935277</td>
									</tr>
									<tr>
										<th scope="row">Warranty</th>
										<td>24 Months</td>
									</tr>
									<tr>
										<th scope="row">Color</th>
										<td>Blue</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-sm mb-0">
								<tbody>
									<tr>
										<th scope="row" style="width: 320px;">Year introduced</th>
										<td>2023</td>
									</tr>
									<tr>
										<th scope="row">Operating system</th>
										<td>iOS</td>
									</tr>
									<tr>
										<th scope="row">Operation system when introduced</th>
										<td>iOS 17</td>
									</tr>
									<tr>
										<th scope="row">Update frequency</th>
										<td>Each quarter</td>
									</tr>
									<tr>
										<th scope="row">Date of last security update</th>
										<td>September 2028</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<h2 class="h4 mb-3">Project Detail</h1>
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle" data-lucide="more-horizontal"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Upgrade CRM software</h5>
				<div class="badge bg-info my-2">In progress</div>
			</div>
			<div class="card-body pt-0">
				<h5>Description</h5>

				<p class="text-muted">
					Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus
					pulvinar, hendrerit id, lorem.
				</p>

				<p class="text-muted">
					Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a,
					consectetuer eget, posuere ut, mauris.
				</p>

				<div>
					<h5>Assignee</h5>
					<img src="{{ asset('/assets/img/avatars/avatar.jpg') }}" class="rounded-circle me-1" alt="Avatar" width="34" height="34">
					<img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" class="rounded-circle me-1" alt="Avatar" width="34" height="34">
					<img src="{{ asset('/assets/img/avatars/avatar-3.jpg') }}" class="rounded-circle me-1" alt="Avatar" width="34" height="34">
				</div>
			</div>
		</div>

		<h2 class="h4 mb-3">Comments</h2>
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle" data-lucide="more-horizontal"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Comments (4)</h5>
			</div>
			<div class="card-body">
				<div class="d-flex align-items-start">
					<img src="{{ asset('/assets/img/avatars/avatar.jpg') }}" width="56" height="56" class="rounded-circle me-3" alt="Ashley Briggs">
					<div class="flex-grow-1">
						<small class="float-end">5m ago</small>
						<p class="mb-2"><strong>Ashley Briggs</strong></p>
						<p>Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit
							vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.</p>
						<small class="text-muted">Today 7:51 pm</small><br />

						<div class="d-flex align-items-start mt-3">
							<a class="pe-2" href="#">
								<img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" width="36" height="36" class="rounded-circle me-2" alt="Stacie Hall">
							</a>
							<div class="flex-grow-1">
								<p class="text-muted">
									<strong>Stacie Hall</strong>: Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices
									mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris.
								</p>
							</div>
						</div>
					</div>
				</div>

				<hr />
				<div class="d-flex align-items-start">
					<img src="{{ asset('/assets/img/avatars/avatar-2.jpg') }}" width="56" height="56" class="rounded-circle me-3" alt="Chris Wood">
					<div class="flex-grow-1">
						<small class="float-end">30m ago</small>
						<p class="mb-2"><strong>Chris Wood</strong></p>
						<p>
							Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus
							pulvinar, hendrerit id, lorem.
						</p>
						<small class="text-muted">Today 7:26 pm</small><br />
					</div>
				</div>

				<hr />
				<div class="d-flex align-items-start">
					<img src="{{ asset('/assets/img/avatars/avatar-3.jpg') }}" width="56" height="56" class="rounded-circle me-3" alt="Stacie Hall">
					<div class="flex-grow-1">
						<small class="float-end">45m ago</small>
						<p class="mb-2"><strong>Stacie Hall</strong></p>
						<p>
							Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris.
						</p>
						<small class="text-muted">Today 7:11 pm</small><br />
					</div>
				</div>
			</div>
		</div>


		<h1 class="h3 mb-3">Email /Notification</h1>
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-12 col-xxl-8">
						<div class="btn-toolbar">
							<div class="btn-group btn-group-lg me-2">
								<button class="btn btn-light"><i data-lucide="inbox"></i></button>
								<button class="btn btn-light"><i data-lucide="triangle-alert"></i></button>
								<button class="btn btn-light"><i data-lucide="trash-2"></i></button>
							</div>
							<div class="btn-group btn-group-lg me-2">
								<button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
								<i data-lucide="folder"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-end">
									<button to="#" value="0" class="dropdown-item">Inbox</button>
									<button to="#" value="2" class="dropdown-item">Drafts</button>
									<button to="#" value="4" class="dropdown-item">Trash</button>
								</div>
							</div>
							<div class="btn-group btn-group-lg me-2">
								<button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
								<i data-lucide="tag"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-end">
									<button to="#" class="dropdown-item">Support</button>
									<button to="#" class="dropdown-item">Freelance</button>
									<button to="#" class="dropdown-item">Social</button>
									<button to="#" class="dropdown-item">Friends</button>
									<button to="#" class="dropdown-item">Family</button>
								</div>
							</div>
							<div class="btn-group btn-group-lg">
								<button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
								More
								</button>
								<div class="dropdown-menu dropdown-menu-end">
									<button to="#" class="dropdown-item">Mark as Unread</button>
									<button to="#" class="dropdown-item">Mark as Important</button>
									<button to="#" class="dropdown-item">Add Star</button>
									<button to="#" class="dropdown-item">Move to Spam</button>
									<button to="#" class="dropdown-item">Move to Trash</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-xxl-4 d-none d-xxl-block">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" placeholder="Search emails…" aria-label="Search">
							<button class="btn" type="button">
							<i class="align-middle" data-lucide="search"></i>
							</button>
						</div>
					</div>
				</div>

				<div>
					<h5>Exciting news! Our company's quarterly earnings have exceeded expectations. Celebratory dinner tonight at 7:00 PM.</h5>
					<hr>

					<div class="d-flex">
						<img width="40" height="40" src="{{ asset('/assets/img/avatars/avatar.jpg') }}" class="rounded-circle d-flex me-2" alt="Stacie Hall">
						<div class="w-100 mt-1">
							<small class="float-end">April 5, 2024, 9:12 AM</small>
							<h6 class="mb-0">Stacie Hall</h6>
							<small class="text-muted">from: stacie@staciehall.co</small>
						</div>
					</div>

					<div class="mx-5 my-3">
						<p>Dear Team,</p>
						<p>I hope this email finds you well.</p>
						<p>I'm thrilled to share some fantastic news with all of you &ndash; our company's quarterly earnings have surpassed expectations! This is a significant
							achievement that wouldn't have been possible without each and every one of your hard work, dedication, and commitment to excellence.</p>
						<p>To celebrate this incredible milestone, we're hosting a special celebratory dinner tonight at 7:00 PM. It will be an opportunity for us to come together,
							unwind, and toast to our success as a team.</p>
						<p>Please RSVP by replying to this email at your earliest convenience so we can finalize arrangements. If you have any dietary restrictions or preferences,
							please let us know so we can accommodate them.</p>
						<p>Let's make tonight a memorable and enjoyable evening as we celebrate our achievements together. Looking forward to seeing you all there!</p>
						<p>Best regards,<br />Stacie Hall</p>
					</div>

					<hr />

					<div class="btn-toolbar">
						<button class="btn btn-light me-2"><i data-lucide="reply-all"></i> Reply to all</button>
						<button class="btn btn-light me-2"><i data-lucide="reply"></i> Reply</button>
						<button class="btn btn-light"><i data-lucide="forward"></i> Forward</button>
					</div>
				</div>

			</div>
		</div>

		<h1 class="h3 mb-3">Dashbaord</h1>
		<div class="row">
			<div class="col-12 col-sm-6 col-xxl-3 d-flex">
				<div class="card illustration flex-fill">
					<div class="card-body p-0 d-flex flex-fill">
						<div class="row g-0 w-100">
							<div class="col-6">
								<div class="illustration-text p-3 m-1">
									<h4 class="illustration-text">Welcome Back, Chris!</h4>
									<p class="mb-0">AppStack Dashboard</p>
								</div>
							</div>
							<div class="col-6 align-self-end text-end">
								<img src="{{ asset('/assets/img/illustrations/customer-support.png') }}" alt="Customer Support" class="img-fluid illustration-img">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-xxl-3 d-flex">
				<div class="card flex-fill">
					<div class="card-body py-4">
						<div class="d-flex align-items-start">
							<div class="flex-grow-1">
								<h3 class="mb-2">$ 24.300</h3>
								<p class="mb-2">Total Earnings</p>
								<div class="mb-0">
									<span class="badge badge-subtle-success me-2"> +5.35% </span>
									<span class="text-muted">Since last week</span>
								</div>
							</div>
							<div class="d-inline-block ms-3">
								<div class="stat">
									<i class="align-middle text-success" data-lucide="dollar-sign"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-xxl-3 d-flex">
				<div class="card flex-fill">
					<div class="card-body py-4">
						<div class="d-flex align-items-start">
							<div class="flex-grow-1">
								<h3 class="mb-2">43</h3>
								<p class="mb-2">Pending Orders</p>
								<div class="mb-0">
									<span class="badge badge-subtle-danger me-2"> -4.25% </span>
									<span class="text-muted">Since last week</span>
								</div>
							</div>
							<div class="d-inline-block ms-3">
								<div class="stat">
									<i class="align-middle text-danger" data-lucide="shopping-bag"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-xxl-3 d-flex">
				<div class="card flex-fill">
					<div class="card-body py-4">
						<div class="d-flex align-items-start">
							<div class="flex-grow-1">
								<h3 class="mb-2">$ 18.700</h3>
								<p class="mb-2">Total Revenue</p>
								<div class="mb-0">
									<span class="badge badge-subtle-success me-2"> +8.65% </span>
									<span class="text-muted">Since last week</span>
								</div>
							</div>
							<div class="d-inline-block ms-3">
								<div class="stat">
									<i class="align-middle text-info" data-lucide="dollar-sign"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<h1 class="h3 mb-3">Empty card (card-header)</h1>
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('users.edit', 123) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
					<a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
					@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('users.edit', 123) }}"><i class="fas fa-edit"></i> Edit</a>
					@endif
				</div>
				<h5 class="card-title">Empty card</h5>
				<h6 class="card-subtitle text-muted">Please provide brief description of this card.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Name</th>
							<td>Angelica Ramos</td>
						</tr>
						<tr>
							<th>Company</th>
							<td>The Wiz</td>
						</tr>
						<tr>
							<th>Email</th>
							<td>angelica@ramos.com</td>
						</tr>
						<tr>
							<th>Status</th>
							<td><span class="badge badge-subtle-success">Active</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>



		<h1 class="h3 mb-3">Empty card (Formateted)</h1>
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('users.edit', 123) }}"><i class="fas fa-edit"></i> Edit</a>
					<a href="{{ route('depts.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i>Create</a>
					<a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
				</div>
				<h5 class="card-title">Empty (Formateted)</h5>
				<h6 class="card-subtitle text-muted">Please provide brief description of this card.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th></th>
							<td>

							</td>
						</tr>
						<tr>
							<th></th>
							<td>

							</td>
						</tr>
						<tr>
							<th></th>
							<td>

							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
