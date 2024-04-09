@extends('layouts.landlord-app')
@section('title','Event Log')
@section('breadcrumb','Event Log')

@section('content')


	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Event Log</h4>
		</div>

		<!-- Body -->
		<div class="card-body">

			<x-landlord.show.my-badge		value="{{ $activity->id }}" label="ID"/>
			<x-landlord.show.my-date-time	value="{{ $activity->created_at }}"/>
			<x-landlord.show.my-text		value="{{ $activity->object_id  }}" label="Object ID"/>
			<x-landlord.show.my-badge		value="{{ $activity->object_name  }}" label="Object"/>
		
			<x-landlord.show.my-text		value="{{ $activity->event_name  }}" label="Event"/>
			<x-landlord.show.my-text		value="{{ $activity->column_name  }}" label="Column"/>
			<x-landlord.show.my-text		value="{{ $activity->prior_value  }}" label="Prior Value"/>
			
			<x-landlord.show.my-text		value="{{ $activity->role }}" label="Role"/>
			<x-landlord.show.my-text		value="{{ $activity->user->name }}" label="Performer"/>
			@if (auth()->user()->isSeeded())
				<x-landlord.show.my-text		value="{{ $activity->object_type }}" label="Type"/>
				<x-landlord.show.my-text		value="{{ $activity->ip }}" label="IP"/>
				<x-landlord.show.my-text		value="{{ $activity->URL}}" label="URL"/>
				<x-landlord.show.my-text		value="{{ $activity->method }}" label="Method"/>
			@endif 


		</div>
		<!-- End Body -->
			
			@if (auth()->user()->isSystem())
				<!-- Footer -->
				<div class="card-footer pt-0">
					<div class="d-flex justify-content-end gap-3">
						<a class="btn btn-danger" href="{{ route('activities.edit',$activity->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
					</div>
				</div>
				<!-- End Footer -->
			@endif	
	</div>
	<!-- End Card -->



@endsection
