@extends('layouts.landlord-app')
@section('title', 'Functions in Models')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Functions in Models</h5>
			<h6 class="card-subtitle text-muted">{{ config('bo.DOC_DIR_MODEL') }}</h6>
		</div>
		<div class="card-body">
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6>
						<a class="" href="{{ route('tables.fnc-models') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
						<a class="" href="{{ route('tables.fnc-models','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
						<a class="" href="{{ route('tables.fnc-models','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
						<a class="" href="{{ route('tables.fnc-models','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					</div>
					<!-- End Col -->
					<div class="col-lg-auto">
						<x-landlord.table-links/>
					</div>
					<!-- End Col -->
					</div>
					<!-- End Row -->
			</div>
			<!-- End Breadcrumb -->
			
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="">#</th>
						<th class="">Name</th>
						<th class="">Method Name</th>
						<th class="">Days Ago</th>
						<th class="">Days</th>
						<th class="">Jump</th>
					</tr>
				</thead>
			
				<tbody>
			
					@php
					$exclude = array(
							'__call',
							'__callStatic',
							'__construct',
							'__get',
							'__isset',
							'__set',
							'__sleep',
							'__toString',
							'__unset',
							'__wakeup',
							'addGlobalScope',
							'addObservableEvents',
							'all',
							'append',
							'attributesToArray',
							'belongsTo',
							'belongsToMany',
							'bootAddCreatedUpdatedBy',
							'bootSoftDeletes',
							'broadcastChannel',
							'broadcastChannelRoute',
							'cacheMutatedAttributes',
							'callNamedScope',
							'clearBootedModels',
							'created',
							'creating',
							'delete',
							'deleted',
							'deleteOrFail',
							'deleteQuietly',
							'deleting',
							'destroy',
							'discardChanges',
							'encryptUsing',
							'escapeWhenCastingToString',
							'factory',
							'fill',
							'fillable',
							'fillJsonAttribute',
							'flushEventListeners',
							'forceDelete',
							'forceDeleted',
							'forceDeleteQuietly',
							'forceDeleting',
							'forceFill',
							'fresh',
							'freshTimestamp',
							'freshTimestampString',
							'fromDateTime',
							'fromEncryptedString',
							'fromFloat',
							'fromJson',
							'getActualClassNameForMorph',
							'getAllGlobalScopes',
							'getAppends',
							'getAttribute',
							'getAttributes',
							'getAttributeValue',
							'getCasts',
							'getChanges',
							'getConnection',
							'getConnectionName',
							'getConnectionResolver',
							'getCreatedAtColumn',
							'getDateFormat',
							'getDates',
							'getDeletedAtColumn',
							'getDirty',
							'getEventDispatcher',
							'getFillable',
							'getForeignKey',
							'getGlobalScope',
							'getGlobalScopes',
							'getGuarded',
							'getHidden',
							'getIncrementing',
							'getKey',
							'getKeyName',
							'getKeyType',
							'getMorphClass',
							'getMutatedAttributes',
							'getObservableEvents',
							'getOriginal',
							'getPerPage',
							'getQualifiedCreatedAtColumn',
							'getQualifiedDeletedAtColumn',
							'getQualifiedKeyName',
							'getQualifiedUpdatedAtColumn',
							'getQueueableConnection',
							'getQueueableId',
							'getQueueableRelations',
							'getRawOriginal',
							'getRelation',
							'getRelations',
							'getRelationValue',
							'getRouteKey',
							'getRouteKeyName',
							'getTable',
							'getTouchedRelations',
							'getUpdatedAtColumn',
							'getVisible',
							'guard',
							'handleDiscardedAttributeViolationUsing',
							'handleLazyLoadingViolationUsing',
							'handleMissingAttributeViolationUsing',
							'hasAppended',
							'hasAttributeGetMutator',
							'hasAttributeMutator',
							'hasAttributeSetMutator',
							'hasCast',
							'hasGetMutator',
							'hasGlobalScope',
							'hasMany',
							'hasManyThrough',
							'hasNamedScope',
							'hasOne',
							'hasOneThrough',
							'hasSetMutator',
							'initializeSoftDeletes',
							'is',
							'isClean',
							'isDirty',
							'isFillable',
							'isForceDeleting',
							'isGuarded',
							'isIgnoringTimestamps',
							'isIgnoringTouch',
							'isNot',
							'isRelation',
							'isUnguarded',
							'joiningTable',
							'joiningTableSegment',
							'jsonSerialize',
							'load',
							'loadAggregate',
							'loadAvg',
							'loadCount',
							'loadExists',
							'loadMax',
							'loadMin',
							'loadMissing',
							'loadMorph',
							'loadMorphAggregate',
							'loadMorphAvg',
							'loadMorphCount',
							'loadMorphMax',
							'loadMorphMin',
							'loadMorphSum',
							'loadSum',
							'makeHidden',
							'makeHiddenIf',
							'makeVisible',
							'makeVisibleIf',
							'mergeCasts',
							'mergeFillable',
							'mergeGuarded',
							'morphedByMany',
							'morphMany',
							'morphOne',
							'morphTo',
							'morphToMany',
							'newCollection',
							'newEloquentBuilder',
							'newFromBuilder',
							'newInstance',
							'newModelQuery',
							'newPivot',
							'newQuery',
							'newQueryForRestoration',
							'newQueryWithoutRelationships',
							'newQueryWithoutScope',
							'newQueryWithoutScopes',
							'newUniqueId',
							'observe',
							'offsetExists',
							'offsetGet',
							'offsetSet',
							'offsetUnset',
							'on',
							'only',
							'onWriteConnection',
							'originalIsEquivalent',
							'preventAccessingMissingAttributes',
							'preventLazyLoading',
							'preventsAccessingMissingAttributes',
							'preventSilentlyDiscardingAttributes',
							'preventsLazyLoading',
							'preventsSilentlyDiscardingAttributes',
							'push',
							'pushQuietly',
							'qualifyColumn',
							'qualifyColumns',
							'query',
							'refresh',
							'registerGlobalScopes',
							'reguard',
							'relationLoaded',
							'relationResolver',
							'relationsToArray',
							'removeObservableEvents',
							'replicate',
							'replicateQuietly',
							'replicating',
							'resolveChildRouteBinding',
							'resolveConnection',
							'resolveRelationUsing',
							'resolveRouteBinding',
							'resolveRouteBindingQuery',
							'resolveSoftDeletableChildRouteBinding',
							'resolveSoftDeletableRouteBinding',
							'restore',
							'restored',
							'restoreQuietly',
							'restoring',
							'retrieved',
							'save',
							'saved',
							'saveOrFail',
							'saveQuietly',
							'saving',
							'setAllGlobalScopes',
							'setAppends',
							'setAttribute',
							'setConnection',
							'setConnectionResolver',
							'setCreatedAt',
							'setDateFormat',
							'setEventDispatcher',
							'setHidden',
							'setIncrementing',
							'setKeyName',
							'setKeyType',
							'setObservableEvents',
							'setPerPage',
							'setRawAttributes',
							'setRelation',
							'setRelations',
							'setTable',
							'setTouchedRelations',
							'setUniqueIds',
							'setUpdatedAt',
							'setVisible',
							'shouldBeStrict',
							'softDeleted',
							'syncChanges',
							'syncOriginal',
							'syncOriginalAttribute',
							'syncOriginalAttributes',
							'through',
							'toArray',
							'toJson',
							'totallyGuarded',
							'touch',
							'touches',
							'touchOwners',
							'touchQuietly',
							'trashed',
							'unguard',
							'unguarded',
							'uniqueIds',
							'unsetConnectionResolver',
							'unsetEventDispatcher',
							'unsetRelation',
							'unsetRelations',
							'update',
							'updated',
							'updateOrFail',
							'updateQuietly',
							'updateTimestamps',
							'updating',
							'usesTimestamps',
							'usesUniqueIds',
							'wasChanged',
							'with',
							'withoutBroadcasting',
							'withoutEvents',
							'withoutRelations',
							'withoutTimestamps',
							'withoutTimestampsOn',
							'withoutTouching',
							'withoutTouchingOn',
							'addGlobalScopes',
						);
					@endphp
					@foreach ($filesInFolder as $row)
						@php
						//$class = new ReflectionClass('App\Http\Controllers\Tenant\HomeController');
						//$class = new ReflectionClass('App\Models\Tenant\\'. $row["f"]);

						if ($dir == "") {
							$class = new ReflectionClass( $target_dir .$row["f"]);
						} else  {
							$class = new ReflectionClass( $target_dir .'\\'. $row["f"]);
						}

						//$class = new ReflectionClass(config('bo.DOC_DIR_MODEL') .'\\'. $row["f"]);
						$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
						@endphp
						@foreach ($methods as $method)
							@if  (!in_array($method->name, $exclude))
								<tr>
									<th scope="row">{{ $loop->iteration }}</th>
									<td class="">{{ $row['f'] }}</td>
									<td class="">{{ $method->name }}</td>
									<td class="text-start"></td>
									<td class="text-start"></td>
									<td class="text-start"></td>
								</tr>
							@endif
						@endforeach
					@endforeach
				</tbody>
			
			</table>
		</div>
	</div>

@endsection
