<form method="post" action="{{route('import.excel')}}" enctype="multipart/form-data">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Import Excel Member</h5>
		</div>
		<div class="modal-body">
 
			{{ csrf_field() }}
 
			<label>Pilih file excel</label>
			<div class="form-group">
				<input type="file" name="file" required="required">
			</div>
 
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Import</button>
		</div>
	</div>
</form>

<form method="post" action="{{route('import.tree')}}" enctype="multipart/form-data">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Import Excel Tree</h5>
		</div>
		<div class="modal-body">
 
			{{ csrf_field() }}
 
			<label>Pilih file excel</label>
			<div class="form-group">
				<input type="file" name="file" required="required">
			</div>
 
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Import</button>
		</div>
	</div>
</form>

<form method="post" action="{{route('import.sponsor')}}" enctype="multipart/form-data">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Import Excel Sponsor</h5>
		</div>
		<div class="modal-body">
 
			{{ csrf_field() }}
 
			<label>Pilih file excel</label>
			<div class="form-group">
				<input type="file" name="file" required="required">
			</div>
 
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Import</button>
		</div>
	</div>
</form>

<form method="post" action="{{route('import.bonus1')}}" enctype="multipart/form-data">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Import bonus</h5>
		</div>
		<div class="modal-body">
 
			{{ csrf_field() }}
 
			<label>Pilih file excel</label>
			<div class="form-group">
				<input type="file" name="file" required="required">
			</div>
 
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Import</button>
		</div>
	</div>
</form>
