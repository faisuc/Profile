<div id="profileEdit-section" class="profile-section hidden">

	{{--<div class="edit-overlay"></div>--}}

	<div class="content-grid edit-profile">

		<section class="account-settings">

			<h2>Account Settings</h2>

			<form id="account-settings" class="edit-form" action="" method="">

				<fieldset>

					<h3>Name</h3>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="account-settings-name">
					<div class="btn-edit form-edit">
						<a href="#">Edit</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>
					<p class="profile-value">{{ $user->last_name . " , " . $user->first_name }} {{ ( $user->userbasicinfo && !empty($user->userbasicinfo->middlename) ) ? $user->userbasicinfo->middlename : "" }}</p>

					<div class="input-details">

						<label>
							<span>First</span>
							<input type="text" placeholder="First Name" name="first-name" value="{{ !empty($user->first_name) ? $user->first_name : "" }}" class="fname input-field">
							<span class="fname-errmsg errmsg-holder"></span>
						</label>

						<label>
							<span>Middle</span>
							<input type="text" placeholder="Middle Name" name="middle-name" value="{{ ( $user->userbasicinfo && !empty($user->userbasicinfo->middlename) ) ? $user->userbasicinfo->middlename : "" }}" class="mname input-field">
							<span class="mname-errmsg errmsg-holder"></span>
						</label>

						<label>
							<span>Last</span>
							<input type="text" placeholder="Last Name" name="last-name" value="{{ ( !empty($user->last_name) ) ? $user->last_name : "" }}" class="lname input-field">
							<span class="lname-errmsg errmsg-holder"></span>
						</label>

					</div>

				</fieldset>

				<fieldset>

					<h3>Email Address</h3>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="account-settings-email">
					<div class="btn-edit form-edit">
						<a href="#">Edit</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>
					<p class="profile-value">{{ !empty($user->email) ? $user->email : "Enter your email address" }}</p>

					<div class="input-details">

						<input type="email" placeholder="Email Address" name="email-address" value="{{ !empty($user->email) ? $user->email : "Enter your email address" }}" class="email-address input-field">
						<span class="email-errmsg errmsg-holder"></span>
					</div>

				</fieldset>

				<fieldset class="url-info">

					<h3>Your personalized url</h3>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="account-settings-personalized-url">
					<div class="btn-edit form-edit">
						<a href="#">Edit</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>
					<p>
						http://www.strings.co/profile/<span class="id-num">{{ !empty($user->url_id) ? $user->url_id : "YourName" }}</span>
						<input type="text" name="custom-id" class="custom-id input-field">
						<span class="customid-errmsg errmsg-holder"></span>
					</p>

				</fieldset>

				<fieldset>

					<h3>Password</h3>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="account-settings-password">
					<div class="btn-edit form-edit">
						<a href="#">Change</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>

					<p class="profile-value">Password</p>

					<div class="input-details">

						<input type="password" name="old-password" placeholder="Old Password" class="password input-field">

						<input type="password" name="confirm-password" placeholder="New Password" class="password input-field">

						<input type="password" name="password" placeholder="Confirm Password" class="password input-field">
						<span class="password-errmsg errmsg-holder"></span>

					</div>

				</fieldset>

			</form>

		</section> <!-- end of account settings -->

		<section class="personal-information">

			<h2>Work Information</h2>

			<form id="personal-information" class="edit-form" action="" method="">

				<fieldset class="work-info">

					<h3>Work</h3>
					<button class="btn-form add-input">Add Work</button>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="personal-information-work">
					<div class="btn-edit form-edit">
						<a href="#">Edit</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>

					@if (count($user->userworkhistory) > 0)
						@foreach ($user->userworkhistory as $work)
							<div class="item-group">
								<p class="label profile-value">{{ $work->companyname }}</p>
								<p class="profile-value">{{ $work->position }}</p>
								<p class="profile-value">{{ $work->yearstarted == "0" ? "Present" : $work->yearstarted }} to {{ $work->yearended == "0" ? "Present" : $work->yearended }}</p>
							</div>
						@endforeach
						@foreach ($user->userworkhistory as $work)
							<div class="input-details input-group input-first">
								<input type="text" placeholder="Company Name" value="{{ $work->companyname }}" name="company-name" class="company-name input-field">
								<button class="btn-remove" data-id="{{ $work->id }}" data-cat="work-history">Remove</button>
								<input type="text" placeholder="Position" value="{{ $work->position }}" name="company-position" class="company-position input-field">
								<select class="select-year" name="year-start">
									<option value="{{ $work->yearstarted }}">{{ $work->yearstarted == "0" ? "Present" : $work->yearstarted }}</option></select> to <select class="select-year" name="year-end">
									<option value="{{ $work->yearended }}">{{ $work->yearended == "0" ? "Present" : $work->yearended }}</option>
								</select>
								<input type="hidden" name="work-history-id" value="{{ $work['id'] }}" />
							</div>
						@endforeach
					@else
						<div class="item-group">
							<p class="label profile-value">Company Name</p>
							<p class="profile-value">Position</p>
							<p class="profile-value">Year to Year</p>
						</div>

						<div class="input-details input-group input-first">
							<input type="text" placeholder="Company Name" name="company-name" class="company-name input-field">
							<button class="btn-remove">Remove</button>
							<input type="text" placeholder="Position" name="company-position" class="company-position input-field">
							<select class="select-year" name="year-start">
								<option value="">Year</option></select> to <select class="select-year" name="year-end">
								<option value="">Present</option>
							</select>
							<input type="hidden" name="work-history-id" value="0" />
						</div>
					@endif

				</fieldset>

				<fieldset class="college-info">

					<h3>College</h3>
					<button class="btn-form add-input">Add College</button>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="personal-information-college">
					<div class="btn-edit form-edit">
						<a href="#">Edit</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>

					@if (count($user->usereduccollege) > 0)
						@foreach ($user->usereduccollege as $college)
							<div class="item-group">
								<p class="label profile-value">{{ $college->schoolname }}</p>
								<p class="profile-value">{{ $college->course }}</p>
								<p class="profile-value">{{ $college->yearstarted == "0" ? "Present" : $college->yearstarted }} to {{ $college->yearended == "0" ? "Present" : $college->yearended }}</p>
							</div>
						@endforeach
						@foreach ($user->usereduccollege as $college)
							<div class="input-details input-group input-first">
								<input type="text" placeholder="School Name" name="college-name" value="{{ $college->schoolname }}" class="college-name input-field">
								<button class="btn-remove" data-id="{{ $college['id'] }}" data-cat="educcollege">Remove</button>
								<input type="text" placeholder="Major" name="college-major" value="{{ $college->course }}" class="college-major input-field">
								<select class="select-year" name="year-start">
									<option value="{{ $college->yearstarted }}">{{ $college->yearstarted == "0" ? "Present" : $college->yearstarted }}</option>
								</select> to
								<select class="select-year" name="year-end">
									<option value="{{ $college->yearended }}">{{ $college->yearended == "0" ? "Present" : $college->yearended }}</option>
								</select>
								<input type="hidden" name="college-id" value="{{ $college->id }}" />
							</div>
						@endforeach
					@else
						<div class="item-group">
							<p class="label profile-value">School Name</p>
							<p class="profile-value">Major</p>
							<p class="profile-value">Year to Year</p>
						</div>

						<div class="input-details input-group input-first">
							<input type="text" placeholder="School Name" name="college-name" class="college-name input-field">
							<button class="btn-remove">Remove</button>
							<input type="text" placeholder="Major" name="college-major" class="college-major input-field">
							<select class="select-year" name="year-start">
								<option value="">Year</option>
							</select> to
							<select class="select-year" name="year-end">
								<option value="">Present</option>
							</select>
							<input type="hidden" name="college-id" value="0" />
						</div>
					@endif

				</fieldset>

				<fieldset class="highschool-info">

					<h3>High School</h3>
					<button class="btn-form add-input">Add School</button>
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="personal-information-highschool">
					<div class="btn-edit form-edit">
						<a href="#">Edit</a>
					</div>
					<div class="btn-edit form-cancel">
						<button class="btn-form btn-cancel">Cancel</button>
					</div>

					@if (count($user->usereduchighschool) > 0)
						@foreach ($user->usereduchighschool as $school)
							<div class="item-group">
								<p class="label profile-value">{{ $school->schoolname }}</p>
								<p class="profile-value">{{ $school->yearstarted == "0" ? "Present" : $school->yearstarted }} to {{ $school->yearended == "0" ? "Present" : $school->yearended }}</p>
							</div>
						@endforeach

						@foreach ($user->usereduchighschool as $school)
							<div class="input-details input-group input-first">
								<input type="text" placeholder="School Name" name="highschool-name" value="{{ $school->schoolname }}" class="highschool-name input-field">
								<select class="select-year" name="year-start">
									<option value="{{ $school->yearstarted }}">{{ $school->yearstarted == "0" ? "Present" : $school->yearstarted }}</option>
								</select> to
								<select class="select-year" name="year-end">
									<option value="{{ $school->yearended }}">{{ $school->yearended == "0" ? "Present" : $school->yearended }}</option>
								</select>
								<input type="hidden" name="highschool-id" value="{{ $school->id }}" />
								<button class="btn-remove" data-id="{{ $school->id }}" data-cat="educhighschool">Remove</button>
							</div>
						@endforeach
					@else
						<div class="item-group">
							<p class="label profile-value">Schoolname</p>
							<p class="profile-value">Year to Present</p>
						</div>

						<div class="input-details input-group input-first">
							<input type="text" placeholder="School Name" name="highschool-name" class="highschool-name input-field">
							<select class="select-year" name="year-start">
								<option value="">Year</option>
							</select> to
							<select class="select-year" name="year-end">
								<option value="">Present</option>
							</select>
							<input type="hidden" name="highschool-id" value="0" />
							<button class="btn-remove">Remove</button>
						</div>
					@endif

				</fieldset>

			</form>

			<div class="edit-buttons">

				<input type="submit" value="Save" class="btn-form btn-save">
				<button class="btn-form btn-cancel">Cancel</button>

			</div>

		</section> <!-- end of personal information -->

		<section class="basic-information">

			<form id="basic-information" class="edit-form" action="" method="">

				<h2>Basic information</h2>
				<div class="edit-buttons">
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="basic-information">
					<button class="btn-form btn-cancel cancel-all">Cancel</button>
					<button class="btn-edit edit-general">Edit</button>
				</div>

				<fieldset>

					<h3>Birthday</h3>
					<div class="btn-edit edit-all">
						<a href="#">Edit</a>
					</div>

					<p class="profile-value">
						{{ ($user->userbasicinfo && ($user->userbasicinfo->birthmonth != 0 || !empty($user->userbasicinfo->birthmonth))) ? convertMonthNumToName($user->userbasicinfo->birthmonth) : "" }}
						{{ ($user->userbasicinfo && ($user->userbasicinfo->birthday != 0 || !empty($user->userbasicinfo->birthday))) ? $user->userbasicinfo->birthday . " , " : "" }}
						{{ $user->birthyear }}
					</p>

					<div class="input-details input-group">

						<select class="select-month" name="month">
							@if ((!$user->userbasicinfo) || ($user->userbasicinfo && ($user->userbasicinfo->birthmonth == 0 || empty($user->userbasicinfo->birthmonth))))
								<option selected value="0">Select Month</option>
							@endif
							@foreach (getMonths() as $month)
								@if ((!$user->userbasicinfo) || ($user->userbasicinfo && ($user->userbasicinfo->birthmonth == 0 || empty($user->userbasicinfo->birthmonth))))
									<option value="{{ $month }}">{{ $month }}</option>
								@else
									<option value="{{ $month }}" {{ convertMonthNumToName($user->userbasicinfo->birthmonth) == $month ? "selected" : "" }}>{{ $month }}</option>
								@endif
							@endforeach
						</select>

						<select class="select-day" name="day">
							@if ((!$user->userbasicinfo) || ($user->userbasicinfo && ($user->userbasicinfo->birthday == 0 || empty($user->userbasicinfo->birthday))))
								<option value="0">Select Day</option>
							@endif
							@foreach (getDays() as $day)
								@if ((!$user->userbasicinfo) || ($user->userbasicinfo && ($user->userbasicinfo->birthday == 0 || empty($user->userbasicinfo->birthday))))
									<option value="{{ $day }}">{{ $day }}</option>
								@else
									<option value="{{ $day }}" {{ $user->userbasicinfo->birthday == $day ? "selected" : "" }}>{{ $day }}</option>
								@endif
							@endforeach
						</select>

						<select class="select-year" name="year">
							@foreach (getYears() as $year)
								<option value="{{ $year }}" {{ $user->birthyear == $year ? "selected" : "" }}>{{ $year }}</option>
							@endforeach
						</select>

					</div>

				</fieldset>

				<fieldset>

					<h3>Gender</h3>
					<div class="btn-edit edit-all">
						<a href="#">Edit</a>
					</div>

					<p class="profile-value">{{ getGenderPrefix($user->gender) }}</p>

					<div class="input-details input-group">

						<select class="select-gender" name="gender">
							@foreach (getGender() as $prefix => $gender)
								<option value="{{ $prefix }}" {{ $prefix == $user->gender ? "selected" : "" }}>{{ $gender }}</option>
							@endforeach
						</select>

					</div>

				</fieldset>

				<fieldset>

					<h3>Blood Type</h3>
					<div class="btn-edit edit-all">
						<a href="#">Edit</a>
					</div>

					<p class="profile-value">{{ ($bloodType) ? $bloodType : "Enter your Bloodtype" }}</p>

					<div class="input-details">
						<select name="blood-type">
							@foreach ($bloodTypes as $bloodtype)
								<option value="{{ $bloodtype->id }}" {{ !empty($bloodType) && $bloodtype->name == $bloodType ? "selected" : "" }}>{{ $bloodtype->name }}</option>
							@endforeach
						</select>
					</div>

				</fieldset>

				<fieldset>

					<h3>Religion</h3>
					<div class="btn-edit edit-all">
						<a href="#">Edit</a>
					</div>

					<p class="profile-value">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->religion)) ? $user->userbasicinfo->religion : "Enter your Religion" }}</p>

					<div class="input-details">

						<input type="text" placeholder="Religion" name="religion" value="{{ ($user->userbasicinfo && !empty($user->userbasicinfo->religion)) ? $user->userbasicinfo->religion : "" }}" class="religion input-field">

					</div>

				</fieldset>

				<fieldset>

					<h3>Political View</h3>
					<div class="btn-edit edit-all">
						<a href="#">Edit</a>
					</div>

					<p class="profile-value">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? $user->userbasicinfo->politics : "Enter your Political View" }}</p>

					<div class="input-details">
						<textarea name="political-view" class="political-view input-field">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? $user->userbasicinfo->politics : "" }}</textarea>
					</div>

				</fieldset>

			</form>

		</section> <!-- end of basic information -->

		<section class="contact-information">

			<form id="contact-information" class="edit-form" action="" method="">

				<h2>Contact Information</h2>
				<div class="edit-buttons">
					<input type="submit" value="Save" class="btn-form btn-save" data-cat="contact-information">
					<button class="btn-form btn-cancel cancel-all">Cancel</button>
					<button class="btn-edit edit-general">Edit</button>
				</div>

				<fieldset class="mobile-info">

					<h3>Mobile Phone</h3>
					<button class="btn-form add-input">Add Phone number</button>
					<div class="btn-edit edit-all hidden">
						<a href="#">Edit</a>
					</div>

					<div class="item-group">
						<p class="profile-value">
							@if ($user->usercontactinfo && count($mobilenumbers) > 0 )
								@foreach ($mobilenumbers as $phonenum)
									@if (!empty($phonenum))
										{{ $phonenum }} <br />
									@endif
								@endforeach
							@else
								Add your mobile numbers
							@endif
						</p>
					</div>



					@if ($user->usercontactinfo && count($mobilenumbers) > 0 )
						@foreach ($mobilenumbers as $phonenum)
							@if (!empty($phonenum))
								<div class="input-details" style="display: block;"><input type="tel" placeholder="Your Phone Number" value="{{ $phonenum}}" name="mobile-phone" class="mobile-phone input-field"><button class="btn-remove">Remove</button></div>
							@endif
						@endforeach
					@else
						<div class="input-details" style="display: block;"><input type="tel" placeholder="Your Phone Number" name="mobile-phone" class="mobile-phone input-field"><button class="btn-remove">Remove</button></div>
					@endif

				</fieldset>

				<fieldset>

					<h3>Location</h3>
					<div class="btn-edit edit-all hidden">
						<a href="#">Edit</a>
					</div>

					<p class="profile-value">
						@if ($user->usercontactinfo && (!empty($user->usercontactinfo->city) || !empty($country)))
							{{ !empty($user->usercontactinfo->city) ? $user->usercontactinfo->city : "" }}
							{{ !empty($country) ? " , " . $country : "" }}
						@else
							City, Country
						@endif
					</p>

					<div class="input-details">
						<select class="select-country" name="country">
							@if (count($countries) > 0)
								@if (!empty($country))
									@foreach ($countries as $country)
										<option value="{{ $country->id }}" {{ $user->usercontactinfo->country == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
									@endforeach
								@else
									@foreach ($countries as $country)
										<option value="{{ $country->id }}">{{ $country->name }}</option>
									@endforeach
								@endif
							@else
								<option value="" disabled>No Country Available</option>
							@endif
						</select>

						<input type="text" placeholder="City" name="city" value="{{ !empty($user->usercontactinfo->city) ? $user->usercontactinfo->city : "" }}" class="city input-field">

					</div>

				</fieldset>

				<fieldset class="email-info">

					<h3>Email Address</h3>
					<button class="btn-form add-input">Add Email</button>
					<div class="btn-edit edit-all hidden">
						<a href="#">Edit</a>
					</div>

					<div class="item-group">
						<p class="profile-value">
							@if ($user->usercontactinfo && count($emails) > 0)
								@foreach ($emails as $email)
									@if (!empty($email))
										{{ $email }} <br />
									@endif
								@endforeach
							@else
								Add another email address
							@endif
						</p>
					</div>

					@if ($user->usercontactinfo && count($emails) > 0)
						@foreach ($emails as $email)
							@if (!empty($email))
								<div class="input-details input-group">
									<input type="email" placeholder="Email Address" name="email-address" value="{{ $email }}" class="email-address input-field">
									<button class="btn-remove">Remove</button>
								</div>
							@endif
						@endforeach
					@else
						<div class="input-details input-group input-new">
							<input type="email" placeholder="Email Address" name="email-address" class="email-address input-field">
							<button class="btn-remove">Remove</button>
						</div>
					@endif

				</fieldset>

			</form>

		</section> <!-- end of contact information -->

		<section class="your-websites">

			<h2>Your Websites</h2>
			<div class="edit-buttons">
				<input type="submit" value="Save" class="btn-form btn-save" data-cat="your-websites">
				<button class="btn-form btn-cancel cancel-all">Cancel</button>
				<button class="btn-edit edit-general">Edit</button>
			</div>

			<form id="your-websites" class="edit-form" action="" method="">

				<fieldset class="website-info">

					<div class="btn-edit edit-all hidden">
						<a href="#">Edit</a>
					</div>

					<div class="item-group website-item">

						@if ($user->usercontactinfo && count($webtitles) > 0)
							@foreach (array_combine($webtitles, $weblinks) as $webtitle => $weblink)
								@if (!empty($webtitle))
									<p class="website-title">{{ $webtitle }}</p>
									<p class="profile-value">{{ $weblink }}</p>
								@endif
							@endforeach
						@else
							<p class="profile-value">http://www.bruii.com/YourName</p>
						@endif

					</div>

					@if ($user->usercontactinfo && count($webtitles) > 0)
						@foreach (array_combine($webtitles, $weblinks) as $webtitle => $weblink)
							@if (!empty($webtitle))
								<div class="input-details">
									<input type="text" placeholder="Link Title" name="website-title" value="{{ $webtitle }}" class="web-title input-field">
									<button class="btn-remove">Remove</button><br>
									<input type="text" placeholder="Link" name="website-link" value="{{ $weblink }}" class="web-link input-field">
								</div>
							@endif
						@endforeach
					@else
						<div class="input-details">
							<input type="text" placeholder="Link Title" name="website-title" class="web-title input-field">
							<button class="btn-remove">Remove</button><br>
							<input type="text" placeholder="Link" name="website-link" class="web-link input-field">
						</div>
					@endif

					<button class="btn-form add-input">Add another website</button>

				</fieldset>

			</form>

		</section> <!-- end of your websites -->

	</div> <!-- end of edit profile -->


</div>
