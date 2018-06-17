@extends('layouts.profile')

@section('title')
@parent
{{ $user->first_name.' '.$user->last_name }}
@stop

@section('meta')
@parent
	<meta name="bruii_active_user" content="{{ $active_id }}">
	<meta name="bruii_viewing_user" content="{{ $user->id }}">
@stop

@section('content')

	<div class="user-profile-wrapper blurTarget">

		<div class="user-profile-cover profile-banner uploadContainer">

			<div class="preview-loader">
				<span class="poll-stat" style="background-color: #6EAEED; display: none; height: 5px;"></span>
			</div>

			<div class="profile-banner-image">

				<input type="hidden" name="profile-cover-image" />
				@if( !empty($user->userbasicinfo->coverphoto) && isset($user->userbasicinfo) && $user->userbasicinfo->coverphoto != 'default-cover-photo.jpg')
					<img src="/upload/user/cover/original/{{$user->userbasicinfo->coverphoto . '?' . time()}}">
					<input type="hidden" name="original-profile-cover" value="{{$user->userbasicinfo->coverphoto}}" />
				@else
					<img src="/images/profile/background-default-cover.jpg">
					<input type="hidden" name="original-profile-cover" value="background-default-cover.jpg" />
				@endif
				@if($myprofile)
					<div class="profile-banner-hover"></div>
				@endif
			</div>

		@if($myprofile)

			<div class="profile-grid">
				{!! Form::open(['id' => 'uploadCoverPhotoContainer' , 'enctype' => 'multipart/form-data']) !!}
					<span class="profileBanner-upload">
						<a href="#" class="upload-button cover">Change Cover Photo</a>
					</span>
				{!! Form::close() !!}

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
		@endif

		</div>

		<div class="user-profile-grid">

			<div class="user-profile-headline">
				<div class="profileHeadline-bio">
					<p data-form-bio="data">{{ !empty($user->bio_info) ? $user->bio_info : '' }}</p>
					<textarea class="headlineBio-editor userBio-textarea" placeholder="Bio" name="userBio-textarea" data-form-bio="edit">{{ !empty($user->bio_info) ? $user->bio_info : '' }}</textarea>
					@if ($myprofile )
						<div class="headlineBio-buttons">
							<button class="bioButton-create">Create Bio</button>
							<button class="bioButton-edit" data-form-bio="data">Edit Bio</button>
							<div class="bioButton-actions">
								<button class="bioButton-save userBio-save" data-form-bio="edit">Save Bio</button>
								<button class="bioButton-cancel" data-form-bio="edit">Cancel</button>
							</div>
						</div>
					@endif
				</div>
				<div class="profileHeadline-user">
					<div class="headlineUser-picture profileUser-image uploadContainer">
						
						<img src='{{ !empty($user->userbasicinfo->profilephoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? "/upload/user/profile/thumbs/{$user->userbasicinfo->profilephoto}" : "/images/profile/default-profile-pic.jpg" }}' />
						<input type="hidden" name="original_profile_image" value='{{ !empty($user->userbasicinfo->profilephoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? "{$user->userbasicinfo->profilephoto}" : "default-profile-pic.jpg" }}' />

						@if($myprofile)
							{!! Form::open(['id' => 'uploadProfilePhotoContainer' , 'enctype' => 'multipart/form-data']) !!}

								<a href="#" class="upload-profile-picture upload-button photo">
									<span class="upload-selector profileImage-upload">
										<i></i>
										<span>Upload Profile<br/>Picture</span>
									</span>
								</a>

							{!! Form::close() !!}
						@endif
					</div>
					<div class="headlineUser-details">
						<h1>{{ $user->first_name }} {{ ( $user->userbasicinfo && !empty($user->userbasicinfo->middlename) ) ? $user->userbasicinfo->middlename : "" }} {{ $user->last_name }}</h1>

						@if (!$myprofile)
							<p>{{ $profile_heading_content->course != "" ? $profile_heading_content->course . ', ' : '' }}{{ $profile_heading_content->occupation != "" ? $profile_heading_content->occupation . ', ' : '' }}{{ $profile_heading_content->schoolname != "" ? $profile_heading_content->schoolname . ', ' : '' }}</p>
							<p>{{ $profile_heading_content->totalmutualfriends  }} Mutual friends | <a href="#">{{ $profile_heading_content->totalmutualstrings  }} String{{ $profile_heading_content->totalmutualstrings > 0 ? 's' : '' }} in common</a></p>

							@if ($mask_status == 0)
								<div class="userDetails-actions">

									@if ($connection_status->following_status == 1)
										<button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="request"><i></i>Follow</button>
									@elseif ($connection_status->following_status == 2)
										<button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="accept_acquaintance_request"><i></i>Accept</button>
									@elseif ($connection_status->following_status == 3)
										<button href="#" class="userDetails-button userDetails-follow-btn userDetails-following" rel="unfollow"><i></i>Following</button>
									@elseif ($connection_status->following_status == 4)
										<button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="cancel_acquaintance_request"><i></i>Cancel Request</button>
									@elseif ($connection_status->following_status == 5)
										<button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="request"><i></i>Follow</button>
									@elseif ($connection_status->following_status == 6)
										<button href="#" class="userDetails-button userDetails-follow-btn userDetails-following" rel="unfollow"><i></i>Following</button>
									@endif

									@if ($connection_status->friend_status == 1)
										<button href="#" class="userDetails-button userDetails-add-btn userDetails-friends" rel="unfriend"><i></i>Friends</button>
									@elseif ($connection_status->friend_status == 2)
										<button href="#" class="userDetails-button userDetails-add-btn userDetails-add" rel="accept_friend_request"><i></i>Accept</button>
									@elseif ($connection_status->friend_status == 3)
										<button href="#" class="userDetails-button userDetails-add-btn userDetails-add" rel="cancel_friend_request"><i></i>Cancel Request</button>
									@elseif ($connection_status->friend_status == 4)
										<button href="#" class="userDetails-button userDetails-add-btn userDetails-add" rel="add"><i></i>Add Friend</button>
									@endif
								</div>
							@endif

							<!--
							<div class="userDetails-actions">
								<button href="#" class="userDetails-button userDetails-following"><i></i>
									<span class="default">Following</span>
									<span class="unfollow">Unfollow</span>
								</button>
								<button href="#" class="userDetails-button userDetails-friends"><i></i>
									<span class="default">Friends</span>
									<span class="unfriend">Unfriend</span>
								</button>
							</div>
							-->
						@else
							<a href="#editProfile" class="userDetails-edit">Edit Profile</a>
						@endif
					</div>
				</div>
				<div class="profileHeadline-actions">
					<ul class="headlineActions-nav">
						<li class="profile-posts active">
							<a href="#profilePosts" data-profile-target="feeds" data-target="profilePosts">
								<i></i>
								<span>Posts</span>
							</a>
						</li>
						<li class="profile-images">
							<a href="#profileImage" data-profile-target="images" data-target="profileImage">
								<i></i>
								<span>Images</span>
							</a>
						</li>
						<li class="profile-connections">
							<a href="#profileConnections" data-profile-target="connections" data-target="profileConnections">
								<i></i>
								<span>Connections</span>
							</a>
						</li>
						<li class="profile-activity">
							<a href="#profileActivity" data-profile-target="activity" data-target="profileActivity">
								<i></i>
								<span>Personal</span>
							</a>
						</li>
						@if (!$myprofile)
						<li class="profile-dropdown">
							<a href="#" class="profileDropdown-button" data-profile-target="dropdown">
								<i></i>
							</a>
							<ul class="profileDropdown-subitem">
								<li class="fl_rep-modal"><a href="#" data-profile-target="report" data-feed-id="{{ $user->id }}" data-modal="report" data-modal-type="profile">Report</a></li>
							</ul>
						</li>
						@endif
					</ul>
				</div>
			</div>

			<div class="user-profile-body">

				@if ((!$myprofile && $user_privacy_setting != 3) && ($user_privacy_setting == 0 || ($user_privacy_setting == 1 && $users_status[0]->friends == 'Yes') || ($user_privacy_setting == 1 && $users_status[0]->acquaintance == 'Yes' ) || ($user_privacy_setting == 2 && $users_status[0]->friends == 'Yes')))

					@include('profile::profile._profile-feeds')
					@include('profile::profile._profile-images')
					@include('profile::profile._profile-connections')
					@include('profile::profile._profile-activity')

					@if ($myprofile)
						@include('profile::profile._profile-edit')
					@endif

				@elseif ($myprofile)

					@include('profile::profile._profile-feeds')
					@include('profile::profile._profile-images')
					@include('profile::profile._profile-connections')
					@include('profile::profile._profile-activity')

					@include('profile::profile._profile-edit')

				@else

					<div class="placeholder-wrapper">
						<div class="placeholder-container ph-profile-private">
							<p>This profile is set as private,<br/>follow or add user to view</p>
						</div>
					</div>

				@endif

				

			</div>

		</div>

	</div>

	@include('home::partials._report-form')
	@include('home::partials._scroll-top')
	@include('dedicatedcontent::modals._report-profile-modal')
	@include('profile::modals._crop-profile-image')

	@include('home::modals._edit-text-modal')
	@include('home::modals._confirm-delete-modal')
	@include('home::modals._report-content-modal')

	@include('topics::modals._strings-modal')

	@include('home::modals._edit-text')
	@include('home::modals._edit-image')
	@include('home::modals._edit-link')
	@include('home::modals._edit-ask')
	@include('home::modals._edit-poll')

@stop

@section("js")

<script type="text/javascript">
	$(document).ready(function(){
	    Posts.initPost();
	});
</script>

@stop
