<div class="profile-activity-section profileSection-views hidden" data-activity-parent="views">

	<p>Note: Other users can&apos;t see your profile views</p>
	<h4>Total Profile Views: {{ $count_profile_views[0]->totalview }}</h4>

	<div class="sectionViews-users">
		@if ( count( $profile_viewers ) > 0 )
			@foreach ( $profile_viewers as $viewer )
				<div class="viewsUsers-item">
					<div class="viewsUsers-picture">
						<a href="/user/{{ $viewer->profile_code }}"><img src="{{ $viewer->profilephoto != '' && $viewer->profilephoto != 'default-profile-pic.jpg' ? '/upload/user/profile/thumbs/' . $viewer->profilephoto : '/images/profile/default-profile-pic.jpg' }}"></a>
					</div>
					<h3><a href="/user/{{ $viewer->profile_code }}">{{ $viewer->first_name }} {{ $viewer->last_name }}</a></h3>
					<span>{{ time_ago(strtotime($viewer->date)) }}</span>
				</div>
			@endforeach
		@else
			<h3>No Profile Views</h3>
		@endif
	</div>

</div>