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

	<div class="profile-banner uploadContainer blurTarget">
		<div class="profile-banner-image">
			<input type="hidden" name="profile-cover-image" />
			@if( !empty($user->userbasicinfo->coverphoto) && isset($user->userbasicinfo) && $user->userbasicinfo->coverphoto != 'default-cover-photo.jpg')
				<img src="/upload/user/cover/original/{{$user->userbasicinfo->coverphoto}}">
				<input type="hidden" name="original-profile-cover" value="{{$user->userbasicinfo->coverphoto}}" />
			@else
				<img src="/images/profile/background-default-cover.jpg">
				<input type="hidden" name="original-profile-cover" value="background-default-cover.jpg" />
			@endif
		</div>
	@if($myprofile)

		<div class="profile-grid">
			{!! Form::open(['id' => 'uploadCoverPhotoContainer' , 'enctype' => 'multipart/form-data']) !!}
				<span class="profileBanner-upload">
					<a href="#" class="upload-button cover">Upload Cover Photo</a>
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
	@if ( !$myprofile )
		<div class="profile-grid profile-connect">
			<div class="userProfile-connect">
				<ul id="userConnect">
					<li class="user-connect">


							<a href="#" class="acquaintance_button state_1 {{ count($is_acquaintances) == 0 && !$acquaintance_notified && !$friend_notified ? '' : 'hidden' }}" style="background-image: url('../../images/icons/profile/profile-icon-connections-inactive.png'); background-position: 18px center; padding: 7px 10px 7px 42px; width: 80px;">Connect with <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>
							<a href="#" class="acquaintance_button state_2 {{ count($is_acquaintances) == 0 && $acquaintance_notified && !$friend_notified ? '' : 'hidden' }}" style="background-image: url('../../images/icons/profile/connection-icon-h-blue.png'); background-position: 18px center; padding: 7px 10px 7px 42px; width: 80px;">Acquaintance <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>
							<a href="#" class="acquaintance_button state_3 {{ count($is_acquaintances) > 0 && $acquaintance_notified && !$friend_notified ? '' : 'hidden' }}" style="background-image: url('../../images/icons/profile/connection-icon-f-blue.png'); background-position: 18px center; padding: 7px 10px 7px 42px; width: 80px;">Acquaintance <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>

							<a href="#" class="friend_button state_1 {{ count($is_friend) == 0 && $friend_notified ? '' : 'hidden' }}" style="background-image: url('../../images/icons/profile/connection-icon-h-blue.png'); background-position: 18px center; padding: 7px 10px 7px 42px; width: 80px;">Friends <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>
							<a href="#" class="friend_button state_2 {{ count($is_friend) > 0 && $friend_notified ? '' : 'hidden' }}" style="background-image: url('../../images/icons/profile/connection-icon-f-blue.png'); background-position: 18px center; padding: 7px 10px 7px 42px; width: 80px;">Friends <img src="/images/icons/profile/profile-icon-connections-arrow.png"></a>


						<ul class="connect-dropdown">

								<li id="connectWithUserContainer" class="{{ ((count($is_acquaintances) > 0) && !$acquaintance_request_sent) || ((count($is_acquaintances) == 0) && ( $acquaintance_request_sent == 'notifier' || $acquaintance_request_sent == 'receiver')) ? 'hidden' : ''  }}"><a href="#" id="connectWithUser" rel="request" class="acquaintanceUser button-social button-unknown connect">Add Acquaintance</a></li>
								<li id="isConnectUser" class="acquaintancesUserStatus {{ (count($is_acquaintances) > 0 && $acquaintance_request_sent == 'notifier' && !$friend_notified) || ($acquaintance_request_sent == 'notifier' && !$friend_notified) || (count($is_friend) > 0 && $is_friend->status == 0 && $friend_request_sent != 'receiver') || (!$friend_notified && $acquaintance_notified && count($is_acquaintances) > 0) || ($friend_notified && $friend_request_sent != 'receiver' && $friend_request_sent != 'notifier' && $is_friend->status == 0) ? '' : 'hidden'  }}">
									<a href="#" style="width:120px;" rel="cancel" class="acquaintanceUser button-social button-unknown connect">Cancel Acquaintance</a>
								</li>

								<li id="acceptAcquaintanceRequestContainer" class="{{ $acquaintance_request_sent == 'receiver' ? '' : 'hidden' }}"><a href="#" id="connectWithUser" rel="accept_acquaintance_request" class="acquaintanceUser button-social button-unknown connect">Confirm Acquaintance Request</a></li>
								<li id="cancelAcquaintaneRequestContainer" class="{{ $acquaintance_request_sent == 'receiver' ? '' : 'hidden' }}">
									<a href="#" rel="cancel_acquaintance_request" class="acquaintanceUser button-social button-unknown connect">Delete Acquaintance Request</a>
								</li>

							<li id="addNowUser" class="{{ ( count($is_acquaintances) > 0 && $is_acquaintances->status == 1) ? '' : 'hidden'  }}">
								<a href="#" id="addUserFriend" rel="add" class="addFriendUser button-social button-unknown connect {{ ((count($is_friend) > 0) && !$friend_request_sent) || ((count($is_friend) == 0) && ( $friend_request_sent == 'notifier' || $friend_request_sent == 'receiver')) ? 'hidden' : ''  }}">Add Friend</a>
								<a href="#" style="width:110px;" id="cancelUserFriend" rel="cancel" class="addFriendUser button-social button-unknown connect {{ count($is_friend) > 0 || $friend_request_sent == 'notifier' ? '' : 'hidden'  }}">Cancel Friend</a>

								<a href="#" id="acceptUserFriend" rel="accept_friend_request" class="addFriendUser button-social button-unknown connect {{ $friend_request_sent == 'receiver' ? '' : 'hidden' }}">Confirm Friend Request</a>
								<a href="#" style="width:110px;" id="cancelUserFriendRequest" rel="cancel_friend_request" class="addFriendUser button-social button-unknown connect {{ $friend_request_sent == 'receiver' ? '' : 'hidden' }}">Delete Friend Request</a>
								<a class="button-social button-unknown connect {{ (count($is_friend) > 0 && ($is_friend->status == 1) ) ? '' : 'hidden' }}" id="userFriends">Friends</a>
							</li>
							<!--<li><a href="#">Message</a></li>-->
						</ul>
					</li>
					<!--
					<li class="user-track">
						<a href="#" id="untrackUser" style="background-image: url('../../images/icons/profile/track-icon-red.png');" rel="untracked" data-id="{{ $user->id }}" class="trackUser button-social button-unknown track {{ (!$is_tracked)?'hidden' : '' }}">Tracked</a>
						<a href="#" id="trackUser" rel="tracked" data-id="{{ $user->id }}" style="background-image: url('../../images/icons/profile/profile-icon-connections-track.png');" class="trackUser button-social button-unknown track {{ ($is_tracked)?'hidden' : '' }}">Track</a>
					</li>
					-->
				</ul>
			</div>
		</div>
	@endif
	</div>

	<div class="profile-grid blurTarget">

		<div class="profile-wrap">
			<div class="profile-user">

				<div class="profileUser-image uploadContainer">
					<img src='{{ !empty($user->userbasicinfo->profilephoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? "/upload/user/profile/thumbs/{$user->userbasicinfo->profilephoto}" : "/images/profile/default-profile-pic.jpg" }}' />
					<input type="hidden" name="original_profile_image" value='{{ !empty($user->userbasicinfo->profilephoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? "{$user->userbasicinfo->profilephoto}" : "default-profile-pic.jpg" }}' />
					@if($myprofile)
						{!! Form::open(['id' => 'uploadProfilePhotoContainer' , 'enctype' => 'multipart/form-data']) !!}
							<a href="#" class="upload-button photo">
								<span class="profileImage-upload"><img src="/images/icons/profile/profile-image-upload-button.png">Change Profile Picture</span>
							</a>
						{!! Form::close() !!}
					@endif
				</div>

				<div class="profileUser-details">
					<div class="userDetails-name">
						<h2>{{ $user->first_name.' '.$user->last_name }}</h2>
					</div>
					<div class="userDetails-bio">
						<p>
							@if (!empty($user->bio_info))
								{{ $user->bio_info }}
							@else
								@if ($myprofile)
									Bio (300 char limit)
								@endif
							@endif
						 {!! $myprofile ? '<a href="#" class="edit-bio">Edit Bio</a>' : "" !!}</p>
						<div class="userBio-edit hidden">
							<textarea class="userBio-textarea" name="userBio-textarea" placeholder="">{{ !empty($user->bio_info) ? $user->bio_info : '' }}</textarea>
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
							<li class="fl_rep-modal"><a href="#" data-modal="report" data-modal-type="profile">Report</a>
							@if ($myprofile)
								<li class="profileTab-edit"><a href="#editprofile" data-target="profileEdit">Edit Profile</a></li>
							@endif
						</ul>
					</li>
				</ul>
			</div>
		</div>

		@if ($users_status == 0 || $myprofile)
			@include('profile::templates._newposts')
			@include('profile::templates._newimages')
			@include('profile::templates._newconnections')
			@include('profile::templates._newactivity')
			@include('profile::templates._newedit-profile')
		@else
			<div style="text-align: center; margin-top: 100px;">
				<img src="/images/profile/profile_error.png">
			</div>
		@endif

	</div>


	@include('home::modals._edit-text-modal')
	@include('home::modals._edit-image-modal')
	@include('home::modals._confirm-delete-modal')
	@include('profile::modals._crop-profile-image')
	@include('profile::modals._upload-image-modal')
	@include('topics::modals._topics-modal')
	@include('home::partials._report-form')
	@include('home::partials._scroll-top')
	@include('dedicatedcontent::modals._report-profile-modal')

@stop

@section("js")

<script type="text/javascript">
	$(document).ready(function(){
	    Posts.initPost();
	});
</script>

@stop
