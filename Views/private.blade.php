@extends('layouts.profile')

@section('content')

	<div class="profile-banner uploadContainer blurTarget">
		<div class="profile-banner-image">
			<img src="/images/profile/background-default-cover.jpg">
		</div>
		<div class="profile-grid">
				<span class="profileBanner-upload">
					<a href="#" class="upload-button cover">Upload Cover Photo</a>
				</span>

			<div class="profileBanner-edit">
				<div class="cover-edit-details">
					<p>
						Reposition your cover photo
						<span>You can slide up and down</span>
					</p>
				</div>
				<a href="#" class="done-button cover">Done</a>
				<a href="#" class="cancel-button cover">Cancel</a>
				<a href="" onclick="return false;" class="cropping-image-label" style="display: none;">CROPPING IMAGE. PLEASE WAIT.</a>
			</div>
		</div>
		<div class="profile-grid profile-connect">
			<div class="userProfile-connect">
				<ul id="userConnect">
					<li class="user-connect">
							<a href="#" class="acquaintance_button state_1" style="background-image: url('../../images/icons/profile/profile-icon-connections-inactive.png'); background-position: 18px center; padding: 7px 10px 7px 42px; width: 80px;">Connect with <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="profile-grid blurTarget">

		<div class="profile-wrap">
			<div class="profile-user">

				<div class="profileUser-image uploadContainer">
					<img src='/images/profile/default-profile-pic.jpg' />
					<a href="#" class="upload-button photo">
						<span class="profileImage-upload"><img src="/images/icons/profile/profile-image-upload-button.png">Change Profile Picture</span>
					</a>
				</div>

				<div class="profileUser-details">
					<div class="userDetails-name">
						<h2>First Name, Last Name</h2>
					</div>
					<div class="userDetails-bio">
						<p>
						Bio (300 char limit)
						<a href="#" class="edit-bio">Edit Bio</a></p>
						<div class="userBio-edit hidden">
							<textarea class="userBio-textarea" name="userBio-textarea" placeholder=""></textarea>
							<input type="submit" class="userBio-save" value="Save Bio">
						</div>
					</div>
				</div>

			</div>

			<div class="profile-tab">
				<ul id="profileTab-nav">
					<li class="active"><a href="#profilePosts" data-target="profilePosts">Posts</a></li>
					<li><a href="#profileImage" data-target="profileImage">Images</a></li>
					<li><a href="#profileConnections" data-target="profileConnections">Connections</a></li>
					<li><a href="#profileActivity" data-target="profileActivity">Activities</a></li>
					<li class="global-dropdown click">
						<a href="#" data-target="profileDropdown" class="action-global"><img src="/images/icons/profile/profile-tabs-more-options.png"></a>
						<ul class="global-submenu hidden">
							<li><a href="#badges">Badges</a></li>
							<li class="profileTab-edit"><a href="#editprofile" data-target="profileEdit">Edit Profile</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<div class="error-wrapper">
			
			<div class="error-grid error-container error-404">

				<div class="error-type">
					<div class="error-type-sphere">
						<div class="sphere sphere-one"></div>
						<div class="sphere sphere-two"></div>
					</div>
					<div class="error-type-message">
						<p class="error-type-one">This profile is currently private</p>
						<p class="error-type-three">Click the Connect<br/>button to add this<br/>user to your connections</p>
					</div>
				</div>

			</div>

		</div>

		

	</div>


	@include('home::modals._edit-text-modal')
	@include('home::modals._edit-image-modal')
	@include('home::modals._confirm-delete-modal')
	@include('profile::modals._crop-profile-image')
	@include('profile::modals._upload-image-modal')
	@include('topics::modals._topics-modal')
	@include('home::partials._report-form')
	@include('home::partials._scroll-top')

@stop

@section("js")

<script type="text/javascript">
	$(document).ready(function(){
	    Posts.initPost();
	});
</script>

@stop
