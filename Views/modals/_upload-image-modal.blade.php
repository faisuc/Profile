<div class="image-upload-wrapper hidden">

	<div class="image-upload-container">

	{!! Form::open(['id' => 'uploadPhotos']) !!}
		<div class="image-upload-content"></div>
		<br />
		<div style="clear: both;"></div>
		<div class="image-upload-action">

			<button type="submit" class="image-upload-button image-upload-button-save">Save</button>
			<button type="button" class="image-upload-button image-upload-button-cancel">Cancel</button>

		</div>
		{!! Form::close() !!}


	</div>

</div>
