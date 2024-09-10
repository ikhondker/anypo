<div class="row mb-3">
	<div class="col-sm-2"><p class="text-end text-secondary"><strong>Attachments X:</strong></p></div>
	<div class="col-sm-10"> 
			{{-- @foreach ($attachments as $attachment)
			<a class="btn btn-info btn-sm" href="{{ route('attachments.download',$attachment->file_name) }}"> {{ $attachment->org_file_name }}</a> --}}
			{{-- {{ $attachment->id }} => {{ $attachment->org_file_name }} -> {{ $attachment->file_name }} --}}
			{{-- @endforeach --}}
		@foreach ($attachments as $attachment)
			<a href="{{ route('attachments.download',$attachment->id) }}" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Attachments">
				<i data-feather="paperclip" class="fea text-danger feather-16"></i> 
				{{ $attachment->org_file_name }}
			</a>
		@endforeach
	</div>
		
</div>