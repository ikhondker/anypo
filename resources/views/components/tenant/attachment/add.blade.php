<!-- form start -->
{{-- <form action="{{ route('items.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
	@csrf
	<input type="text" name="attach_item_id" id="attach_item_id" class="form-control" placeholder="1001" value="{{ old('id', $item->id ) }}" hidden>
	<div class="row">
		<div class="col-sm-3 text-end">
		</div>
		<div class="col-sm-9 text-end">
			<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
			<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
		</div>
	</div>
</form> --}}
<!-- /.form end -->
{{-- <form action="{{ route( $route.'.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data"> --}}
<form action="{{ route( 'attachments.add',['entity'=>$entity,'articleId'=>$articleId]) }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
	@csrf
	{{-- <input type="text" name="attach_{{ strtolower($entity) }}_id" id="attach_{{ strtolower($entity) }}_id" class="form-control" placeholder="ID" value="{{ old('id', $articleId ) }}" hidden> --}}
	<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
	<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false"><i class="align-middle me-1" data-lucide="paperclip"></i> Add Attachment</a>
</form>
<!-- /.form end -->
<script type="text/javascript">
	function mySubmit() {
		document.getElementById('frm1').submit();
	}
</script>
