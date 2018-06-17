<div class="profileBody-container profileBody-edit hidden" data-profile-section="edit">

	<div class="profile-edit-container">

		<div class="profile-edit-column">

			<div class="editColumn-section">

				<h3>Account Settings</h3>

				<div class="form-error account-settings-name">
				<!--
					<ul>
						<li><p>No special characters allowed in first name, middle name &amp; last name <- line of origin</p></li>
						<li><p>No special characters allowed in first name &amp; middle name</p></li>
						<li><p>No special characters allowed in first name &amp; last name</p></li>
						<li><p>No special characters allowed in middle name &amp; last name</p></li>
						<li><p>No special characters allowed in first name</p></li>
						<li><p>No special characters allowed in middle name</p></li>
						<li><p>No special characters allowed in last name</p></li>
						<li><p>First name is required</p></li>
						<li><p>Last name is required</p></li>
						<li><p>Passwords are not matched</p></li>
						<li><p>Your password is incorrect</p></li>
						<li><p>Password is too short, it must be greater than 4 characters</p></li>
						<li><p>You cannot leave the email blank</p></li>
						<li><p>Email is in a incorrect format</p></li>
						<li><p>This url is already existed</p></li>
					</ul>
				-->
				</div>

				<div class="editColumn-partial">
					<div class="editColumn-data">
						<div class="columnPartial-header">
							<h3>Name</h3>
							<div class="partialHeader-buttons">
								<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
								<a href="#" class="headerButtons headerButtons-save btn-save" data-cat="account-settings-name" data-form-profile="form">Save</a>
								<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
							</div>
						</div>
						<div class="columnPartial-content" data-form-profile="data">
							<h3 class="edit-profile-fullname">{{ $user->first_name }} {{ ( $user->userbasicinfo && !empty($user->userbasicinfo->middlename) ) ? $user->userbasicinfo->middlename : "" }} {{ $user->last_name }}</h3>
						</div>
					</div>
					<div class="editColumn-form" data-form-profile="form">
						<div class="columnPartial-field">
							<input type="text" class="field-fname" name="first-name" value="{{ !empty($user->first_name) ? $user->first_name : "" }}" placeholder="First Name">
						</div>
						<div class="columnPartial-field">
							<input type="text" class="field-mname" name="middle-name" value="{{ ( $user->userbasicinfo && !empty($user->userbasicinfo->middlename) ) ? $user->userbasicinfo->middlename : "" }}" placeholder="Middle Name">
						</div>
						<div class="columnPartial-field">
							<input type="text" class="field-lname" name="last-name" value="{{ ( !empty($user->last_name) ) ? $user->last_name : "" }}" placeholder="Last Name">
						</div>
					</div>
				</div>

				<div class="editColumn-partial">
					<div class="editColumn-data">
						<div class="columnPartial-header">
							<h3>Email Address</h3>
							<div class="partialHeader-buttons">
								<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
								<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="account-settings-email">Save</a>
								<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
							</div>
						</div>
						<div class="columnPartial-content" data-form-profile="data">
							<h3 class="edit-profile-email">{{ !empty($user->email) ? $user->email : "Enter your email address" }}</h3>
						</div>
					</div>
					<div class="editColumn-form" data-form-profile="form">
						<div class="columnPartial-field">
							<input type="text" class="field-email" name="email-address" value="{{ !empty($user->email) ? $user->email : "" }}" placeholder="Email Address">
						</div>
					</div>
				</div>

				<div class="editColumn-partial editColumn-url">
					<div class="columnPartial-header">
						<h3>Your personalized URL</h3>
						<div class="partialHeader-buttons">
							<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
							<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="account-settings-personalized-url">Save</a>
							<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
						</div>
					</div>
					<div class="columnPartial-content editColumn-form">
						<h3>
							http://www.strings.co/user/
							<span data-form-profile="data" class="edit-profile-custom-id">{{ !empty($user->url_id) ? $user->url_id : "YourName" }}</span>
							<span class="columnPartial-field" data-form-profile="form"><input type="text" name="custom-id" value="{{ !empty($user->url_id) ? $user->url_id : "" }}" class="field-url" placeholder="URL"></span>
						</h3>
					</div>
				</div>

				<div class="editColumn-partial editColumn-password">
					<div class="editColumn-data">
						<div class="columnPartial-header">
							<h3>Password</h3>
							<div class="partialHeader-buttons">
								<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Change</a>
								<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="account-settings-password">Save</a>
								<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
							</div>
						</div>
						<div class="columnPartial-content" data-form-profile="data">
							<h3>•••••••••••</h3>
						</div>
					</div>
					<div class="editColumn-form" data-form-profile="form">
						<div class="columnPartial-field">
							<input type="password" class="field-passwordold" name="old-password" placeholder="Old password">
						</div>
						<div class="columnPartial-field">
							<input type="password" class="field-passwordnew" name="password" placeholder="New password">
						</div>
						<div class="columnPartial-field">
							<input type="password" class="field-passwordconfirm" name="confirm-password" placeholder="Confirm password">
						</div>
					</div>
				</div>

			</div>

			<div class="editColumn-section">

				<h3>Basic Information</h3>

				<div class="form-error basic-information-error-container">
				<!--
					<ul>
						<li><p>Error type (It can be multiple lines) (It covers only the Account settings fields)</p></li>
					</ul>
				-->
				</div>

				<div class="editColumn-global">
					<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
					<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="basic-information">Save</a>
					<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
				</div>

				<div class="editColumn-partial">
					<div class="columnPartial-column columnPartial-birthdate">
						<h3>Birthdate</h3>
						<p data-form-profile="data" class="edit-profile-dateofbirth">{{ ($user->userbasicinfo && ($user->userbasicinfo->birthmonth != 0 || !empty($user->userbasicinfo->birthmonth))) ? convertMonthNumToName($user->userbasicinfo->birthmonth) : "" }}
						{{ ($user->userbasicinfo && ($user->userbasicinfo->birthday != 0 || !empty($user->userbasicinfo->birthday))) ? $user->userbasicinfo->birthday . " , " : "" }}
						{{ $user->birthyear }}</p>
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<select class="field-bmonth" name="month">
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
							</div>
							<div class="columnPartial-field">
								<select class="field-bday" name="day">
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
							</div>
							<div class="columnPartial-field">
								<select class="field-byear" name="year">
									@foreach (getYears() as $year)
										<option value="{{ $year }}" {{ $user->birthyear == $year ? "selected" : "" }}>{{ $year }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="columnPartial-column columnPartial-gender">
						<h3>Gender</h3>
						<p data-form-profile="data" class="edit-profile-gender">{{ getGenderPrefix($user->gender) }}</p>
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<select class="field-gender" name="gender">
									@foreach (getGender() as $prefix => $gender)
										<option value="{{ $prefix }}" {{ $prefix == $user->gender ? "selected" : "" }}>{{ $gender }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="columnPartial-column columnPartial-bloodtype">
						<h3>Bloodtype</h3>
						<p data-form-profile="data" class="edit-profile-bloodtype">{{ ($bloodType) ? $bloodType : "Enter your Bloodtype" }}</p>
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<select class="field-bloodtype" name="blood-type">
									@foreach ($bloodTypes as $bloodtype)
										<option value="{{ $bloodtype->id }}" {{ !empty($bloodType) && $bloodtype->name == $bloodType ? "selected" : "" }}>{{ $bloodtype->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="columnPartial-column columnPartial-religion">
						<div style="display: {{ ($user->userbasicinfo && !empty($user->userbasicinfo->religion)) ? 'block' : 'none' }};">
							<h3>Religion</h3>
							<p data-form-profile="data" class="edit-profile-religion">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->religion)) ? $user->userbasicinfo->religion : "Enter your Religion" }}</p>
						</div>
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<input type="text" placeholder="Religion" name="religion" value="{{ ($user->userbasicinfo && !empty($user->userbasicinfo->religion)) ? $user->userbasicinfo->religion : "" }}" class="religion input-field">
							</div>
						</div>
					</div>
					<div class="columnPartial-column columnPartial-political">
						<div style="display: {{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? 'block' : 'none' }};">
							<h3>Political views</h3>
							<p data-form-profile="data" class="edit-profile-politics">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? $user->userbasicinfo->politics : "Enter your Political View" }}</p>
						</div>
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<input type="text" class="field-politicalviews" placeholder="Political Views" name="political-view" value="{{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? $user->userbasicinfo->politics : "" }}">
							</div>
						</div>
					</div>
				</div>

				{{--<div class="editColumn-partial editColumn-politicalviews">--}}
					{{--<div class="columnPartial-column">--}}
						{{--<h3>Political views</h3>--}}
						{{--<p data-form-profile="data" class="edit-profile-politics">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? $user->userbasicinfo->politics : "Enter your Political View" }}</p>--}}
						{{--<div class="editColumn-form" data-form-profile="form">--}}
							{{--<div class="columnPartial-field">--}}
								{{--<textarea class="field-politicalviews" placeholder="Political Views" name="political-view">{{ ($user->userbasicinfo && !empty($user->userbasicinfo->politics)) ? $user->userbasicinfo->politics : "" }}</textarea>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}

			</div>

			<div class="editColumn-section">

				<h3>Contact Information</h3>

				<div class="form-error">
				<!--
					<ul>
						<li><p>Mobile number is in a wrong format!</p></li>
					</ul>
				-->
				</div>

				<div class="editColumn-global">
					<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
					<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="contact-information">Save</a>
					<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
				</div>

				<div class="editColumn-partial editColumn-contact" data-form-column="contact">
					<div class="columnPartial-header">
						<h3>Mobile phone number(s)</h3>
					</div>
					<div class="editColumn-data" data-form-profile="data">
						<div class="columnPartial-content edit-profile-phonenumbers">
							@if ($user->usercontactinfo && count($mobilenumbers) > 0 )
								@foreach ($mobilenumbers as $phonenum)
									@if (!empty($phonenum))
										<h3>{{ $phonenum }}</h3>
									@endif
								@endforeach
							@else
								Add your mobile numbers
							@endif
						</div>
					</div>
					<div class="editColumn-form mobile-info" data-form-profile="form" data-form-area="parent" data-field-limit="3">
						@if ($user->usercontactinfo && count($mobilenumbers) > 0 )
							@foreach ($mobilenumbers as $phonenum)
								@if (!empty($phonenum))
									<div class="columnPartial-field" style="float: none;" data-form-area="field">
										<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
										<!--
										<select class="field-phonecountry error">
											<option value="Philippines (+63)">Philippines (+63)</option>
											<option value="United States (+1)">United States (+1)</option>
										</select>
										-->
										<input type="tel" class="field-phonenumber" name="mobile-phone" value="{{ $phonenum }}" placeholder="Mobile no.">
									</div>
								@endif
							@endforeach
						@else
							<div class="columnPartial-field" style="float: none;" data-form-area="field">
								<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
								<!--
								<select class="field-phonecountry error">
									<option value="Philippines (+63)">Philippines (+63)</option>
									<option value="United States (+1)">United States (+1)</option>
								</select>
								-->
								<input type="tel" class="field-phonenumber" name="mobile-phone" placeholder="Mobile no.">
							</div>
						@endif
						<!--<div class="columnPartial-field" data-form-area="field">
							<select class="field-phonecountry">
								<option value="Philippines (+63)">Philippines (+63)</option>
								<option value="United States (+1)">United States (+1)</option>
							</select>
							<input type="tel" class="field-phonenumber" placeholder="Mobile no.">
						</div>
						<div class="columnPartial-field" data-form-area="field">
							<select class="field-phonecountry">
								<option value="Philippines (+63)">Philippines (+63)</option>
								<option value="United States (+1)">United States (+1)</option>
							</select>
							<input type="tel" class="field-phonenumber" placeholder="Mobile no.">
						</div>-->
					</div>
					<div class="editColumn-global editColumn-add">
						<a href="#" class="headerButtons headerButtons-add" data-form-profile="form">Add new</a>
					</div>
				</div>

				<div class="editColumn-partial">
					<div class="columnPartial-header">
						<h3>Location</h3>
					</div>
					<div class="editColumn-data" data-form-profile="data">
						<div class="columnPartial-content edit-profile-location">
							<h3>
								@if ($user->usercontactinfo && (!empty($user->usercontactinfo->city) || !empty($country)))
									{{ !empty($country) ? $country : "" }} {{ !empty($user->usercontactinfo->city) ? ", " . $user->usercontactinfo->city : "" }}
								@else
									City, Country
								@endif
							</h3>
						</div>
					</div>
					<div class="editColumn-form" data-form-profile="form">
						<div class="columnPartial-field">
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
					</div>
				</div>

				<div class="editColumn-partial editColumn-email" data-form-column="email">
					<div class="columnPartial-header">
						<h3>Email(s)</h3>
					</div>
					<div class="editColumn-data" data-form-profile="data">
						<div class="columnPartial-content edit-profile-emails">
							@if ($user->usercontactinfo && count($emails) > 0)
								@foreach ($emails as $email)
									@if (!empty($email))
										<h3><a href="mailto:{{ $email }}">{{ $email }}</a></h3>
									@endif
								@endforeach
							@else
								<h3><a href="mailto:email@address.com">email@address.com</a></h3>
							@endif
						</div>
					</div>
					<div class="editColumn-form email-info" data-form-profile="form" data-form-area="parent" data-field-limit="3">
						@if ($user->usercontactinfo && count($emails) > 0)
							@foreach ($emails as $email)
								@if (!empty($email))
									<div class="columnPartial-field" data-form-area="field">
										<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
										<input type="email" class="field-email" name="email-address" value="{{ $email }}" name="email-address" placeholder="Your email">
									</div>
								@endif
							@endforeach
						@else
							<div class="columnPartial-field" data-form-area="field">
								<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
								<input type="email" class="field-email" name="email-address" placeholder="Your email">
							</div>
						@endif
						<!--<div class="columnPartial-field" data-form-area="field">
							<input type="email" class="field-email" placeholder="Your email">
						</div>
						<div class="columnPartial-field" data-form-area="field">
							<input type="email" class="field-email" placeholder="Your email">
						</div>-->
					</div>
					<div class="editColumn-global editColumn-add">
						<a href="#" class="headerButtons headerButtons-add" data-form-profile="form">Add new</a>
					</div>
				</div>
				
			</div>

			<div class="editColumn-section editColumn-links your-websites" data-form-section="links">

				<h3>Your Links</h3>

				<div class="form-error">
				<!--
					<ul>
						<li><p>Error type (It can be multiple lines) (It covers only the Account settings fields)</p></li>
					</ul>
				-->
				</div>

				<div class="editColumn-global">
					<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
					<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="your-websites">Save</a>
					<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
					<a href="#" class="headerButtons headerButtons-add" data-form-profile="form">Add new</a>
				</div>

				<div class="editColumn-partials your-websites-container" data-form-profile="data">
					@if ($user->usercontactinfo && count($webtitles) > 0)
						@foreach (array_combine($webtitles, $weblinks) as $webtitle => $weblink)
							@if (!empty($webtitle))
								<div class="editColumn-partial">
									<div class="editColumn-data">
										<div class="columnPartial-header">
											<h3>{{ $webtitle }}</h3>
										</div>
										<div class="columnPartial-content">
											<h3><a href="#">{{ $weblink }}</a></h3>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<p class="profile-value">Add Your Links</p>
					@endif
				</div>

				<div class="editColumn-partials" data-form-area="parent" data-field-limit="3">
					@if ($user->usercontactinfo && count($webtitles) > 0)
						@foreach (array_combine($webtitles, $weblinks) as $webtitle => $weblink)
							@if (!empty($webtitle))
								<div class="editColumn-partial" data-form-area="field">
									<div class="editColumn-form" data-form-profile="form">
										<div class="columnPartial-field">
											<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
											<input type="text" name="website-title" class="field-linktitle" value="{{ $webtitle }}" placeholder="Title/Name">
										</div>
										<div class="columnPartial-field">
											<input type="text" name="website-link" class="field-linkurl" value="{{ $weblink }}" placeholder="URL">
										</div>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<div class="editColumn-partial" data-form-area="field">
							<div class="editColumn-form" data-form-profile="form">
								<div class="columnPartial-field">
									<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
									<input type="text" name="website-title" class="field-linktitle" placeholder="Title/Name">
								</div>
								<div class="columnPartial-field">
									<input type="text" name="website-link" class="field-linkurl" placeholder="URL">
								</div>
							</div>
						</div>
					@endif
					<!--<div class="editColumn-partial" data-form-area="field">
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<input type="text" class="field-linktitle" placeholder="Title/Name">
							</div>
							<div class="columnPartial-field">
								<input type="text" class="field-linkurl" placeholder="URL">
							</div>
						</div>
					</div>
					<div class="editColumn-partial" data-form-area="field">
						<div class="editColumn-form" data-form-profile="form">
							<div class="columnPartial-field">
								<input type="text" class="field-linktitle" placeholder="Title/Name">
							</div>
							<div class="columnPartial-field">
								<input type="text" class="field-linkurl" placeholder="URL">
							</div>
						</div>
					</div>-->
				</div>
				
			</div>

		</div>

		<div class="profile-edit-column">

			<div class="editColumn-section editColumn-work work-info" data-form-section="work">

				<h3>Work Information</h3>

				<div class="form-error">
				<!--
					<ul>
						<li><p>Position is required</p></li>
						<li><p>Company is required</p></li>
						<li><p>Location is required</p></li>
						<li><p>Work term is required</p></li>
					</ul>
				-->
				</div>

				<div class="editColumn-partial">
					<div class="columnPartial-header">
						<h3>List of your work</h3>
						<div class="partialHeader-buttons">
							<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
							<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="personal-information-work">Save</a>
							<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
							<a href="#" class="headerButtons headerButtons-add" data-form-profile="form">Add new</a>
						</div>
					</div>


					<div class="work-info-container">
						@if (count($user->userworkhistory) > 0)
							@foreach ($user->userworkhistory as $work)
								<div class="columnPartials-columns">
									<div class="columnPartial-column">
										<div class="editColumn-data" data-form-profile="data">
											<!--<h3>Current</h3>-->
											<h3>{{ $work->position }}</h3>
											<p>{{ $work->companyname }}</p>
											<p>{{ $work->location }}</p>
											<p>{{ $work->yearstarted == "0" ? "Present" : $work->yearstarted }} ~ {{ $work->yearended == "0" ? "Present" : $work->yearended }}</p>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="columnPartials-columns">
								<div class="columnPartial-column">
									<div class="editColumn-data" data-form-profile="data">
										No Data
									</div>
								</div>
							</div>
						@endif
					</div>
					
					<div class="columnPartials-columns" data-form-area="parent" data-field-limit="3">
						@if (count($user->userworkhistory) > 0)
							@foreach ($user->userworkhistory as $work)
								<div class="columnPartial-column" data-form-area="field">
									<a href="#" class="field-remove" data-id="{{ $work->id }}" data-cat="work-history" data-form-profile="form"><i></i></a>
									<div class="editColumn-form" data-form-profile="form">
										<div class="columnPartial-field">
											<input type="text" class="field-position" value="{{ $work->position }}" name="company-position" placeholder="Position">
											<input type="text" class="field-company" value="{{ $work->companyname }}" name="company-name" placeholder="Company">
											<input type="text" class="field-location" value="{{ $work->location }}" name="company-location" placeholder="Location">
											<select class="field-workfrom" name="year-start">
												@for( $i = date('Y') ; $i >= date('Y') - 13 ; $i-- )
													<option value="{{ $i }}" {{ $work->yearstarted == $i ? "selected" : "" }}>{{ $i == date('Y') ? 'Present' : $i }}</option>
												@endfor
											</select>
											<select class="field-workto" name="year-end">
												@for( $i = date('Y') ; $i >= date('Y') - 13 ; $i-- )
													<option value="{{ $i }}" {{ $work->yearended == $i ? "selected" : "" }}>{{ $i == date('Y') ? 'Present' : $i }}</option>
												@endfor
											</select>
											<input type="hidden" name="work-history-id" value="{{ $work->id }}" />
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="columnPartial-column" data-form-area="field">
								<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
								<div class="editColumn-form" data-form-profile="form">
									<div class="columnPartial-field">
										<input type="text" class="field-position" name="company-position" placeholder="Position">
										<input type="text" class="field-company" name="company-name" placeholder="Company">
										<input type="text" class="field-location" name="company-location" placeholder="Location">
										<select class="field-workfrom" name="year-start">
											@for( $i = date('Y') ; $i >= date('Y') - 13 ; $i-- )
												<option value="{{ $i }}">{{ $i == date('Y') ? 'Present' : $i }}</option>
											@endfor
										</select>
										<select class="field-workto" name="year-end">
											@for( $i = date('Y') ; $i >= date('Y') - 13 ; $i-- )
												<option value="{{ $i }}">{{ $i == date('Y') ? 'Present' : $i }}</option>
											@endfor
										</select>
										<input type="hidden" name="work-history-id" value="0" />
									</div>
								</div>
							</div>
						@endif
						
					</div>
				</div>

			</div>

			<div class="editColumn-section editColumn-education " data-form-section="education">

				<h3>Education</h3>

				<div class="form-error">
				<!--
					<ul>
						<li><p>School name is required</p></li>
						<li><p>Province is required</p></li>
						<li><p>School year is required</p></li>
					</ul>
				-->
				</div>

				<div class="editColumn-partial college-info" data-form-education="college">
					<div class="columnPartial-header">
						<h3>College</h3>
						<div class="partialHeader-buttons">
							<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
							<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="personal-information-college">Save</a>
							<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
							<a href="#" class="headerButtons headerButtons-add" data-form-profile="form">Add new</a>
						</div>
					</div>

					<div class="college-info-container">
						@if (count($user->usereduccollege) > 0)
							@foreach ($user->usereduccollege as $college)
								<div class="columnPartials-columns">
									<div class="columnPartial-column">
										<div class="editColumn-data" data-form-profile="data">
											<h3>{{ $college->schoolname }}</h3>
											<p>{{ $college->location }}</p>
											<p>{{ $college->course }}</p>
											<p>{{ $college->yearstarted == "0" ? "Present" : $college->yearstarted }} ~ {{ $college->yearended == "0" ? "Present" : $college->yearended }}</p>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="columnPartials-columns">
								<div class="columnPartial-column">
									<div class="editColumn-data" data-form-profile="data">
										No Data
									</div>
								</div>
							</div>
						@endif
					</div>

					<div class="columnPartials-columns">
						<div class="columnPartial-column">
							@if (count($user->usereduccollege) > 0)
					
								@foreach ($user->usereduccollege as $college)
									<div class="editColumns-forms" data-form-area="parent" data-field-limit="3">
										<div class="editColumn-form" data-form-profile="form" data-form-area="field">
											<a href="#" class="field-remove" data-id="{{ $college->id }}" data-cat="educcollege" data-form-profile="form"><i></i></a>
											<div class="columnPartial-field">
												<input type="text" class="field-school" name="school-name" value="{{ $college->schoolname }}" placeholder="School">
												<input type="text" class="field-province" name="school-location" value="{{ $college->location }}" placeholder="State/Province">
												<input type="text" class="field-course" name="school-major" value="{{ $college->course }}" placeholder="Course">
												<select class="field-educfrom" name="year-start">
													@for( $i = date('Y') ; $i >= date('Y') - 13 ; $i-- )
														<option value="{{ $i }}" {{ $college->yearended == $i ? "selected" : "" }}>{{ $i == date('Y') ? 'Present' : $i }}</option>
													@endfor
												</select>
												<select class="field-educto" name="year-end">
													@for( $i = date('Y') ; $i >= date('Y') - 13 ; $i-- )
														<option value="{{ $i }}" {{ $college->yearended == $i ? "selected" : "" }}>{{ $i == date('Y') ? 'Present' : $i }}</option>
													@endfor
												</select>
												<input type="hidden" name="college-id" value="{{ $college->id }}" />
											</div>
										</div>
									</div>
								@endforeach

							@else
					
								<div class="editColumns-forms" data-form-area="parent" data-field-limit="3">
									<div class="editColumn-form" data-form-profile="form" data-form-area="field">
										<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
										<div class="columnPartial-field">
											<input type="text" class="field-school" name="school-name" placeholder="School">
											<input type="text" class="field-province" name="school-location" placeholder="State/Province">
											<input type="text" class="field-course" value="" placeholder="Course">
											<select class="field-educfrom" name="year-start">
												@for( $i = date('Y') ; $i >= 1700 ; $i-- )
													<option value="{{ $i }}">{{ $i == date('Y') ? 'Present' : $i }}</option>
												@endfor
											</select>
											<select class="field-educto" name="year-end">
												@for( $i = date('Y') ; $i >= 1700 ; $i-- )
													<option value="{{ $i }}">{{ $i == date('Y') ? 'Present' : $i }}</option>
												@endfor
											</select>
											<input type="hidden" name="college-id" value="0" />
										</div>
									</div>
								</div>

							@endif
								
						</div>
					</div>
				</div>

				<div class="editColumn-partial highschool-info" data-form-education="highschool">
					<div class="columnPartial-header">
						<h3>High School</h3>
						<div class="partialHeader-buttons">
							<a href="#" class="headerButtons headerButtons-edit" data-form-profile="data">Edit</a>
							<a href="#" class="headerButtons headerButtons-save btn-save" data-form-profile="form" data-cat="personal-information-highschool">Save</a>
							<a href="#" class="headerButtons headerButtons-cancel" data-form-profile="form">Cancel</a>
							<a href="#" class="headerButtons headerButtons-add" data-form-profile="form">Add new</a>
						</div>
					</div>
					
					<div class="highschool-info-container">
						@if (count($user->usereduchighschool) > 0)
							@foreach ($user->usereduchighschool as $school)
								<div class="columnPartials-columns">
									<div class="columnPartial-column">
										<div class="editColumn-data" data-form-profile="data">
											<h3>{{ $school->schoolname }}</h3>
											<p>{{ $school->location }}</p>
											<p>{{ $school->yearstarted == "0" ? "Present" : $school->yearstarted }} ~ {{ $school->yearended == "0" ? "Present" : $school->yearended }}</p>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="columnPartials-columns">
								<div class="columnPartial-column">
									<div class="editColumn-data" data-form-profile="data">
										No Data
									</div>
								</div>
							</div>
						@endif
					</div>

					<div class="columnPartials-columns">
						<div class="columnPartial-column">
							<div class="editColumns-forms" data-form-area="parent" data-field-limit="3">
								@if (count($user->usereduchighschool) > 0)
									@foreach ($user->usereduchighschool as $school)
										<div class="editColumn-form" data-form-profile="form" data-form-area="field">
											<a href="#" class="field-remove" data-id="{{ $school->id }}" data-cat="educhighschool" data-form-profile="form"><i></i></a>
											<div class="columnPartial-field">
												<input type="text" class="field-school" value="{{ $school->schoolname }}" name="school-name" placeholder="School">
												<input type="text" class="field-province" value="{{ $school->location }}" name="school-location" placeholder="Province">
												<select class="field-educfrom" name="year-start">
													@for( $i = date('Y') ; $i >= 1700 ; $i-- )
														<option value="{{ $i }}" {{ $school->yearstarted == $i ? "selected" : "" }}>{{ $i == date('Y') ? 'Present' : $i }}</option>
													@endfor
												</select>
												<select class="field-educto" name="year-end">
													@for( $i = date('Y') ; $i >= 1700 ; $i-- )
														<option value="{{ $i }}" {{ $school->yearended == $i ? "selected" : "" }}>{{ $i == date('Y') ? 'Present' : $i }}</option>
													@endfor
												</select>
												<input type="hidden" name="highschool-id" value="{{ $school->id }}" />
											</div>
										</div>
									@endforeach
								@else
									<div class="editColumn-form" data-form-profile="form" data-form-area="field">
										<a href="#" class="field-remove" data-form-profile="form"><i></i></a>
										<div class="columnPartial-field">
											<input type="text" class="field-school" name="school-name" placeholder="School">
											<input type="text" class="field-province" name="school-location" placeholder="Province">
											<select class="field-educfrom" name="year-start">
												@for( $i = date('Y') ; $i >= 1700 ; $i-- )
													<option value="{{ $i }}">{{ $i == date('Y') ? 'Present' : $i }}</option>
												@endfor
											</select>
											<select class="field-educto" name="year-end">
												@for( $i = date('Y') ; $i >= 1700 ; $i-- )
													<option value="{{ $i }}">{{ $i == date('Y') ? 'Present' : $i }}</option>
												@endfor
											</select>
											<input type="hidden" name="highschool-id" value="0" />
										</div>
									</div>
								@endif
									
								
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>