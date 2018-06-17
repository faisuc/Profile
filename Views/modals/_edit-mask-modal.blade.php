<div class="content-grid edit-mask">

	<div class="editMask-details">

		<a href="#" class="editMask-close"><img src="/images/profile/close.png"></a>

		<h2>Mask Settings</h2>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu rhoncus felis, vel pretium nisi. Quisque auctor metus nibh, in venenatis mi sollicitudin sit amet. Donec condimentum massa et tempus elementum. Nam aliquet non lacus quis imperdiet. Mauris dignissim massa orci, in tristique ex mollis sed. </p>

		<p>Cras ut mi bibendum, convallis purus vitae, vestibulum dolor.</p>

	</div>

	<div class="editMask-image">

		<div class="maskImage-profile">

			<img id="maskImage" src="{{ !empty($user->maskimage) ? '/upload/user/mask/thumbs/' . $user->maskimage : '/images/profile/profile-pic-old.png' }}">

			<a href="#" class="maskImage-upload">
				<img src="/images/profile/upload-image.png">
				Upload Mask Image
			</a>

			{!! Form::open(array('enctype' => 'multipart/form-data' , 'method' => 'post' , 'name' => 'maskimage' , 'route' => 'route.uploadMaskPhoto')) !!}
				<input type="file" class="maskImage-file hidden" name="file">
			{!! Form::close() !!}

		</div>

		<div class="maskImage-thumbnail">

			<div class="imageThumbnail-small">

				<img src="{{ !empty($user->maskimage) ? '/upload/user/mask/thumbs/' . $user->maskimage : '/images/profile/profile-pic-old.png' }}">

			</div>

			<div class="imageThumbnail-medium">

				<img src="{{ !empty($user->maskimage) ? '/upload/user/mask/thumbs/' . $user->maskimage : '/images/profile/profile-pic-old.png' }}">

			</div>

		</div>

	</div>

	<div class="editMask-form">

		<fieldset>

			{!! Form::open(array('id' => 'maskForm' , 'name' => 'maskForm' , 'method' => 'post')) !!}
				<h2>Choose Mask ID</h2>
				<input type="text" value="{{$mask_id}}" name="maskForm-text" class="maskForm-text">
				<input type="submit" name="maskForm-submit" class="maskForm-submit" value="Save">
			{!! Form::close() !!}
		</fieldset>
		<label class="message-result" style="padding-left:100px !important"></label>

		<p>Reminder: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt nunc tortor, id porta nisl tincidunt vitae. Proin semper fermentum mollis. Morbi sit amet massa et arcu auctor porttitor.</p>

		<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra.</p>

		<p class="mask-warning">Warning message Sample e.g.: Mask resets every 6:00AM, PST</p>

	</div>

</div> <!-- end of edit mask -->
