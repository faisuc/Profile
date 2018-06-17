<div id="profile-modal-about" class="profile-modal modal-about">
	<div class="modal-close"><a href="#" id="close-modal"><img src="{{ URL::route('route.home') }}/images/profile/close.png"></a></div>
	<h2 class="profile-modal-title">About</h2>

	<div class="about-first-row">

		<div class="about-first-column">

			<div class="about-image"><img width="125px" height="125px" src="{{ !empty($user->userbasicinfo->coverphoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-cover-photo.jpg' && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? '/upload/user/profile/thumbs/' . $user->userbasicinfo->profilephoto : '/images/profile/profile-pic.jpg' }}" /></div>

			<h2 class="about-username">{{ $user->last_name . " , " }}<br /> {{ $user->first_name }} {{ $user->userbasicinfo && !empty($user->userbasicinfo->nickname) ? "(" . $user->userbasicinfo->nickname . ")" : "" }}</h2>

			<h4 class="about-description">Expert</h4>

		</div>

		<div class="about-second-column">
			@foreach (array_combine($webtitles, $weblinks) as $webtitle => $weblink)
				<div class="about-links">{{ $webtitle }} - <a href="#">{{ $weblink }}</a></div>
			@endforeach
		</div>

	</div>

	<div class="about-second-row">

		<div class="about-info-column column-basicInformation">

			<h3 class="about-column-title">Basic Information</h3>

			<h5 class="about-column-label">Birthdate</h5>
			<h6 class="about-column-item">
				{{ ($user->userbasicinfo && ($user->userbasicinfo->birthmonth != 0 && !empty($user->userbasicinfo->birthmonth))) ? convertMonthNumToName($user->userbasicinfo->birthmonth) : "" }}
				{{ ($user->userbasicinfo && ($user->userbasicinfo->birthday != 0 && !empty($user->userbasicinfo->birthday))) ? $user->userbasicinfo->birthday . " , " : "" }}
				{{ $user->birthyear }}
			</h6>

			@if (!empty($user->gender))
				<h5 class="about-column-label">Gender</h5>
				<h6 class="about-column-item">{{ getGenderPrefix($user->gender) }}</h6>
			@endif

			@if ($user->userbasicinfo && !empty($user->userbasicinfo->bloodtype))
				<h5 class="about-column-label">Blood Type</h5>
				<h6 class="about-column-item">{{ $user->userbasicinfo->bloodtype }}</h6>
			@endif

			@if ($user->userbasicinfo && !empty($user->userbasicinfo->religion))
				<h5 class="about-column-label">Religion</h5>
				<h6 class="about-column-item">{{ $user->userbasicinfo->religion }}</h6>
			@endif

			@if ($user->userbasicinfo && !empty($user->userbasicinfo->politics))
				<h5 class="about-column-label">Political View</h5>
				<h6 class="about-column-item">{{ $user->userbasicinfo->politics }}</h6>
			@endif

		</div>

		<div class="about-info-column">

			@if ($user->usercontactinfo && (count($mobilenumbers) > 0 || ( !empty($user->usercontactinfo->city) || !empty($user->usercontactinfo->country)) || count($emails) > 0))
				<h3 class="about-column-title">Contact Information</h3>
			@endif

			@if ($user->usercontactinfo && count($mobilenumbers))
				<h5 class="about-column-label">Mobile Phones</h5>
				@foreach ($mobilenumbers as $mobilenumber)
					@if (!empty($mobilenumber))
						<h6 class="about-column-item">
							{{ $mobilenumber }}
						</h6>
					@endif
				@endforeach
			@endif

			@if ($user->usercontactinfo && (!empty($user->usercontactinfo->city) || !empty($user->usercontactinfo->country)))
				<h5 class="about-column-label">Location</h5>
				<h6 class="about-column-item">
					{{ !empty($user->usercontactinfo->city) ? $user->usercontactinfo->city : "" }}
					{{ !empty($user->usercontactinfo->country) ? " , " . $user->usercontactinfo->country : "" }}
				</h6>
			@endif

			@if ($user->usercontactinfo && count($emails) > 0)
				<h5 class="about-column-label">Email</h5>

				@foreach ($emails as $email)
					@if (!empty($email))
						<h6 class="about-column-item">{{ $email }}</h6>
					@endif
				@endforeach
			@endif

		</div>

		<div class="about-info-column">

			@if (count($user->userworkhistory) > 0)
				<h3 class="about-column-title">Work</h3>

				@foreach ($user->userworkhistory as $work)
					<h5 class="about-column-label">{{ $work->companyname }}</h5>
					<h6 class="about-column-item">{{ $work->position }}</h6>
					<h6 class="about-column-item">({{ $work->yearstarted == 0 ? "Present" : $work->yearstarted }} to {{ $work->yearended == 0 ? "Present" : $work->yearended }})</h6>
				@endforeach
			@endif

		</div>

		<div class="about-info-column">

			@if (count($user->usereduccollege) > 0 || count($user->usereduchighschool) > 0)
				<h3 class="about-column-title">Education</h3>
			@endif

			@if (count($user->usereduccollege) > 0)
				<h5 class="about-column-label">College</h5>

				@foreach ($user->usereduccollege as $college)
					<h6 class="about-column-item">
						{{ $college->schoolname }}<br>
						{{ $college->course }}<br>
						({{ $college->yearstarted == 0 ? "Present" : $college->yearstarted }} to {{ $college->yearended == 0 ? "Present" : $college->yearended }})
					</h6>
				@endforeach
			@endif

			@if (count($user->usereduchighschool) > 0)
				<h5 class="about-column-label">High School</h5>

				@foreach ($user->usereduchighschool as $highschool)
					<h6 class="about-column-item">
						{{ $highschool->schoolname }}<br>
						({{ $highschool->yearstarted == 0 ? "Present" : $highschool->yearstarted }} to {{ $highschool->yearended == 0 ? "Present" : $highschool->yearended }})
					</h6>
				@endforeach
			@endif

		</div>

		<div class="about-qr">

			<img src="/images/profile/qr.png">

		</div>

	</div>

</div>
