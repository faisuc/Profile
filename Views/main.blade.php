@extends('layouts.profile')

@section('content')

	<div class="profile-banner uploadContainer">
		<img src="/images/profile/background-default-cover.png">
		<input type="file" name="profile-uploadCover" class="profile-uploadCover uploadFile hidden">
		<div class="profile-grid">
			<span class="profileBanner-upload">
				<a href="#">
					<img src="/images/icons/profile/profile-image-upload-button.png">Upload Cover Photo
				</a>
			</span>
		</div>
		<div class="profile-grid profile-connect">
			<div class="userProfile-connect">
				<ul id="userConnect">
					<li class="user-connect">
						<a href="#" class="">Connect with <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>
						<ul class="connect-dropdown">
							<li><a href="#">Add Acquaintance</a></li>
							<li><a href="#">Message</a></li>
						</ul>
					</li>
					<li class="user-track"><a href="#">Track</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="profile-grid">

		<div class="profile-wrap">
			<div class="profile-user">

				<div class="profileUser-image uploadContainer">
					<img src="/images/profile/default-profile-pic.jpg">
					<input type="file" name="profile-uploadImage" class="profile-uploadImage uploadFile hidden">
					<a href="#">
						<span class="profileImage-upload"><img src="/images/icons/profile/profile-image-upload-button.png">Change Profile Picture</span>
					</a>
				</div>

				<div class="profileUser-details">
					<div class="userDetails-name">
						<h2>First Name, Last Name</h2>
					</div>
					<div class="userDetails-bio">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet nisl vestibulum libero vestibulum venenatis pharetra eget tortor. Nulla et lorem nec ligula cursus ultricies. Donec a lectus mattis, euismod magna vitae, tristique elit. Maecenas ullamcorper massa quis nulla sodales pellente. <a href="#" class="edit-bio">Edit Bio</a></p>
						<textarea class="userBio-textarea" name="userBio-textarea" placeholder=""></textarea>
					</div>
				</div>

			</div>

			<div class="profile-tab">
				<ul id="profileTab-nav">
					<li class="active"><a href="#" data-target="profilePosts">Posts</a></li>
					<li><a href="#" data-target="profileImage">Images</a></li>
					<li><a href="#" data-target="profileConnections">Connections</a></li>
					<li><a href="#" data-target="profileActivity">Activities</a></li>
					<li class="global-dropdown click">
						<a href="#" data-target="profileDropdown" class="action-global"><img src="/images/icons/profile/profile-tabs-more-options.png"></a>
						<ul class="global-submenu hidden">
							<li><a href="#">Badges</a></li>
							<li><a href="#" data-target="profileEdit">Edit Profile</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		@include('profile::templates._newposts')
		@include('profile::templates._newimages')
		@include('profile::templates._newconnections')
		@include('profile::templates._newactivity')
		@include('profile::templates._newedit-profile')

	</div>

	@include('home::partials._report-form')
	@include('home::partials._scroll-top')

@stop
