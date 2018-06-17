<div class="profileBody-container profileBody-activity hidden" data-profile-section="activity">

	<div class="profile-activity-container">

		<div class="profile-activity-menu">
			<ul class="profileActivity-nav">
				<li class="active"><a href="#" data-activity="activity">Activity</a><span></span></li>
				<li><a href="#" data-activity="about">About</a><span></span></li>
				<li><a href="#" data-activity="strings">Strings</a><span></span></li>
				<li><a href="#" data-activity="comments">Comments</a><span></span></li>

				@if ( $myprofile )
					<li><a href="#" data-activity="views">Views</a><span></span></li>
				@endif
			</ul>
			<span class="activityMenu-border"></span>
		</div>

		@include('profile::profile.partials._activity-activity')
		@include('profile::profile.partials._activity-about')
		@include('profile::profile.partials._activity-strings')
		@include('profile::profile.partials._activity-comments')

		@if ( $myprofile )
			@include('profile::profile.partials._activity-views')
		@endif
		
	</div>

</div>