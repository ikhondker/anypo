
	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
			</div>
			<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
			<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}
				<a class="" href="{{ route('tables.fnc-models') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
				<a class="" href="{{ route('tables.fnc-models','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
				<a class="" href="{{ route('tables.fnc-models','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
				<a class="" href="{{ route('tables.fnc-models','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
				<a class="" href="{{ route('tables.fnc-models','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
				<a class="" href="{{ route('tables.fnc-models','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
			</h6>
			<span class="text-secondary small">NOTE: user_created_by and user_updated_by excluded. Auto added by Trait</span>
		</div>
		<div class="card-body">
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
							'bootHasEvents',
							'resolveObserveAttributes',
							'bootHasGlobalScopes',
							'resolveGlobalScopeAttributes',
							'initializeHasUuids',
							// Auto added by trait
							'user_created_by',
							'user_updated_by'
						);
					@endphp
					@foreach ($filesInFolder as $row)
						@php
						//$class = new ReflectionClass('App\Http\Controllers\Tenant\HomeController');
						//$class = new ReflectionClass('App\Models\Tenant\\'. $row["f"]);
						//$class = new ReflectionClass(config('akk.DOC_DIR_MODEL') .'\\'. $row["f"]);

						//$class = new ReflectionClass($target_dir .'\\'. $row["f"]);
						if ($dir == "") {
							$class = new ReflectionClass( $target_dir .$row["f"]);
						} else {
							$class = new ReflectionClass( $target_dir .'\\'. $row["f"]);
						}


						$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
						@endphp
						@foreach ($methods as $method)
							@if (!in_array($method->name, $exclude))
								<tr>
									<th scope="row">{{ $loop->iteration }}</th>
									<td class="">{{ $row['f'] }}</td>

									<td class="">
										@if (str_contains($method->name, 'scope'))
											<span class="text-danger">{{ $method->name }}</span>
										@else
											{{ $method->name }}
										@endif
									</td>

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
