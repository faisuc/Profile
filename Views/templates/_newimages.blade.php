<div id="profileImage-section" class="profile-section hidden">

	<div class="imageSection-upload uploadContainer">
		@if ( $myprofile )
			{!! Form::open(['id' => 'formPhotos']) !!}
				<input type="file" name="file[]" class="feedImage-upload uploadFile hidden" multiple>
			{!! Form::close() !!}
		@endif
	</div>

	<div id="container-image-feeds">

	</div>

</div>
