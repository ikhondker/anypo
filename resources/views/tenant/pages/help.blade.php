@extends('layouts.app')
@section('title','Documentation')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Documentation
		@endslot
		@slot('buttons')
			<a href="tel:{{config('akk.SUPPORT_PHONE_NO')}}" class="btn btn-primary float-end me-2"><i data-feather="phone-outgoing"></i> Call support {{config('akk.SUPPORT_PHONE_NO')}}</a>
			<a  href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-2"><i data-feather="message-square"></i> Create Support Ticket</a>
		@endslot
	</x-tenant.page-header>

	
	<div class="row">
		<div class="col-md-3 col-xl-2"> 

			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0 text-primary">Contents</h5>
				</div>
				<div class="list-group list-group-flush" role="tablist">
					<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#helpstart" role="tab">Getting Started</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpsetup" role="tab">Setups</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppr" role="tab">PR Creation</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppo" role="tab">PO Creation</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpapproval" role="tab">PR/PO Approval</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpcurrency" role="tab">Multi Currency</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpbudget" role="tab">Budgets</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpmaster" role="tab">Master Data</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpuser" role="tab">User Management</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpsupport" role="tab">Support</a>
				</div>
			</div>
		</div>

		<div class="col-md-9 col-xl-10">
			<div class="tab-content">
				
				<div class="tab-pane fade show active" id="helpstart" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Getting Started</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionStart">

								<div class="card">
									<div class="card-header" id="headingStart1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseStart1" aria-expanded="true" aria-controls="collapseStart1">Accordion</a>
										</h5>
									</div>
									<div id="collapseStart1" class="collapse show" aria-labelledby="headingStart1" data-bs-parent="#accordionStart">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-header" id="headingStart2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseStart2" aria-expanded="true" aria-controls="collapseStart1">Another Po1</a>
										</h5>
									</div>
									<div id="collapseStart2" class="collapse" aria-labelledby="headingStart2" data-bs-parent="#accordionStart">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-header" id="headingStart3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseStart3" aria-expanded="true" aria-controls="collapseStart1">Something else</a>
										</h5>
									</div>
									<div id="collapseStart3" class="collapse" aria-labelledby="headingStart3" data-bs-parent="#accordionStart">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helpsetup" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Password</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionSetup">

								<div class="card">
									<div class="card-header" id="headingSetup1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSetup1" aria-expanded="true" aria-controls="collapseSetup1">Accordion</a>
										</h5>
									</div>
									<div id="collapseSetup1" class="collapse show" aria-labelledby="headingSetup1" data-bs-parent="#accordionSetup">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-header" id="headingSetup2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSetup2" aria-expanded="true" aria-controls="collapseSetup1">Another Po1</a>
										</h5>
									</div>
									<div id="collapseSetup2" class="collapse" aria-labelledby="headingSetup2" data-bs-parent="#accordionSetup">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-header" id="headingSetup3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSetup3" aria-expanded="true" aria-controls="collapseSetup1">Something else</a>
										</h5>
									</div>
									<div id="collapseSetup3" class="collapse" aria-labelledby="headingSetup3" data-bs-parent="#accordionSetup">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helppr" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">PR Creation</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionPr">

								<div class="card">
									<div class="card-header" id="headingPr1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapsePr1" aria-expanded="true" aria-controls="collapsePr1">Accordion</a>
										</h5>
									</div>
									<div id="collapsePr1" class="collapse show" aria-labelledby="headingPr1" data-bs-parent="#accordionPr">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-header" id="headingPr2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapsePr2" aria-expanded="true" aria-controls="collapsePr1">Another Po1</a>
										</h5>
									</div>
									<div id="collapsePr2" class="collapse" aria-labelledby="headingPr2" data-bs-parent="#accordionPr">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								
								<div class="card">
									<div class="card-header" id="headingPr3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapsePr3" aria-expanded="true" aria-controls="collapsePr1">Something else</a>
										</h5>
									</div>
									<div id="collapsePr3" class="collapse" aria-labelledby="headingPr3" data-bs-parent="#accordionPr">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
								
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helppo" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">PO Creation</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionPo">

								<div class="card">
									<div class="card-header" id="headingPo1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapsePo1" aria-expanded="true" aria-controls="collapsePo1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapsePo1" class="collapse show" aria-labelledby="headingPo1" data-bs-parent="#accordionPo">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingPo2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapsePo2" aria-expanded="true" aria-controls="collapsePo1">Another Po1</a>
										</h5>
									</div>
									<div id="collapsePo2" class="collapse" aria-labelledby="headingPo2" data-bs-parent="#accordionPo">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingPo3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapsePo3" aria-expanded="true" aria-controls="collapsePo1">Something else</a>
										</h5>
									</div>
									<div id="collapsePo3" class="collapse" aria-labelledby="headingPo3" data-bs-parent="#accordionPo">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->
				
				<div class="tab-pane fade" id="helpapproval" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">PR/PO Approval</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionApproval">

								<div class="card">
									<div class="card-header" id="headingApproval1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseApproval1" aria-expanded="true" aria-controls="collapseApproval1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapseApproval1" class="collapse show" aria-labelledby="headingApproval1" data-bs-parent="#accordionApproval">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingApproval2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseApproval2" aria-expanded="true" aria-controls="collapseApproval1">Another Approval1</a>
										</h5>
									</div>
									<div id="collapseApproval2" class="collapse" aria-labelledby="headingApproval2" data-bs-parent="#accordionApproval">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingApproval3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseApproval3" aria-expanded="true" aria-controls="collapseApproval1">Something else</a>
										</h5>
									</div>
									<div id="collapseApproval3" class="collapse" aria-labelledby="headingApproval3" data-bs-parent="#accordionApproval">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helpcurrency" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Multi Currency</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionCurrency">

								<div class="card">
									<div class="card-header" id="headingCurrency1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseCurrency1" aria-expanded="true" aria-controls="collapseCurrency1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapseCurrency1" class="collapse show" aria-labelledby="headingCurrency1" data-bs-parent="#accordionCurrency">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingCurrency2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseCurrency2" aria-expanded="true" aria-controls="collapseCurrency1">Another Currency1</a>
										</h5>
									</div>
									<div id="collapseCurrency2" class="collapse" aria-labelledby="headingCurrency2" data-bs-parent="#accordionCurrency">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingCurrency3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseCurrency3" aria-expanded="true" aria-controls="collapseCurrency1">Something else</a>
										</h5>
									</div>
									<div id="collapseCurrency3" class="collapse" aria-labelledby="headingCurrency3" data-bs-parent="#accordionCurrency">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helpbudget" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Budget Management and Monitoring</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionBudget">

								<div class="card">
									<div class="card-header" id="headingBudget1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseBudget1" aria-expanded="true" aria-controls="collapseBudget1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapseBudget1" class="collapse show" aria-labelledby="headingBudget1" data-bs-parent="#accordionBudget">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingBudget2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseBudget2" aria-expanded="true" aria-controls="collapseBudget1">Another Budget1</a>
										</h5>
									</div>
									<div id="collapseBudget2" class="collapse" aria-labelledby="headingBudget2" data-bs-parent="#accordionBudget">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingBudget3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseBudget3" aria-expanded="true" aria-controls="collapseBudget1">Something else</a>
										</h5>
									</div>
									<div id="collapseBudget3" class="collapse" aria-labelledby="headingBudget3" data-bs-parent="#accordionBudget">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helpmaster" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Master Data Managment</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionMaster">

								<div class="card">
									<div class="card-header" id="headingMaster1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseMaster1" aria-expanded="true" aria-controls="collapseMaster1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapseMaster1" class="collapse show" aria-labelledby="headingMaster1" data-bs-parent="#accordionMaster">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingMaster2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseMaster2" aria-expanded="true" aria-controls="collapseMaster1">Another Master1</a>
										</h5>
									</div>
									<div id="collapseMaster2" class="collapse" aria-labelledby="headingMaster2" data-bs-parent="#accordionMaster">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingMaster3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseMaster3" aria-expanded="true" aria-controls="collapseMaster1">Something else</a>
										</h5>
									</div>
									<div id="collapseMaster3" class="collapse" aria-labelledby="headingMaster3" data-bs-parent="#accordionMaster">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helpuser" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">User Managment</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionUser">

								<div class="card">
									<div class="card-header" id="headingUser1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser1" aria-expanded="true" aria-controls="collapseUser1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapseUser1" class="collapse show" aria-labelledby="headingUser1" data-bs-parent="#accordionUser">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingUser2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser2" aria-expanded="true" aria-controls="collapseUser1">Another User1</a>
										</h5>
									</div>
									<div id="collapseUser2" class="collapse" aria-labelledby="headingUser2" data-bs-parent="#accordionUser">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingUser3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser3" aria-expanded="true" aria-controls="collapseUser1">Something else</a>
										</h5>
									</div>
									<div id="collapseUser3" class="collapse" aria-labelledby="headingUser3" data-bs-parent="#accordionUser">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

				<div class="tab-pane fade" id="helpsupport" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">How to ask Support</h5>
						</div>
						<div class="card-body">
							<div class="accordion" id="accordionSupport">

								<div class="card">
									<div class="card-header" id="headingSupport1">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupport1" aria-expanded="true" aria-controls="collapseSupport1">Accordion Accordion</a>
										</h5>
									</div>
									<div id="collapseSupport1" class="collapse show" aria-labelledby="headingSupport1" data-bs-parent="#accordionSupport">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>


								<div class="card">
									<div class="card-header" id="headingSupport2">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupport2" aria-expanded="true" aria-controls="collapseSupport1">Another Support1</a>
										</h5>
									</div>
									<div id="collapseSupport2" class="collapse" aria-labelledby="headingSupport2" data-bs-parent="#accordionSupport">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingSupport3">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupport3" aria-expanded="true" aria-controls="collapseSupport1">Something else</a>
										</h5>
									</div>
									<div id="collapseSupport3" class="collapse" aria-labelledby="headingSupport3" data-bs-parent="#accordionSupport">
										<div class="card-body">
											Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
											Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch
											et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
											craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
										</div>
									</div>
								</div>
							</div>
							<!-- end accordion -->
						</div>
					</div>
					<!-- end card -->
				</div>
				<!-- end tab-pan -->

			</div>
			 <!-- end tab-content -->
		</div>
		
	</div>


	
   
@endsection

