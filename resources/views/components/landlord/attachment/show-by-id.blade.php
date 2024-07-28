@if (! empty($attachment->file_name))
	{{-- <a href="{{ route('attachments.download',$attachment->file_name) }}" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Attachments"> --}}
	<a href="{{ route('attachments.download',$attachment->file_name) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Attachment">
		<i data-lucide="paperclip" class="text-muted"></i>{{ Str::limit($attachment->org_file_name,15) }}
	</a>
@endif



