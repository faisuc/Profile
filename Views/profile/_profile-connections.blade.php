<div class="profileBody-container profileBody-connections hidden" data-profile-section="connections">

	<div class="profile-connections-container">

		<div class="profile-connections-menu">
			<ul class="profileConnect-nav">
				@if (!$myprofile)
					<li class="active"><a href="#" data-connections="mutual">Mutual</a><span></span></li>
				@endif

				<li><a href="#" data-connections="friends">Friends</a><span></span></li>
				<li><a href="#" data-connections="following">Following</a><span></span></li>
				<li><a href="#" data-connections="followers">Followers</a><span></span></li>

				@if ($myprofile)
					<li><a href="#" data-connections="requests">Requests</a><span></span></li>
				@endif
			</ul>
			<span class="connectMenu-border"></span>
		</div>

		@if (!$myprofile)
			@include('profile::profile.partials._connections-mutual')
		@endif

		@include('profile::profile.partials._connections-friends')
		@include('profile::profile.partials._connections-following')
		@include('profile::profile.partials._connections-followers')

		@if ($myprofile)
			@include('profile::profile.partials._connections-requests')
		@endif
		
	</div>

</div>