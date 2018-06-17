@extends('layouts.profile')

@section('content')

	<div class="user-profile-wrapper blurTarget">

		<div class="user-profile-cover">

		</div>

		<div class="user-profile-grid">

			<div class="user-profile-headline">
				<div class="profileHeadline-bio no-bio create-bio">
					<p data-form-bio="data">Create your own bio</p>
					<textarea class="headlineBio-editor" placeholder="Bio" data-form-bio="edit"></textarea>
					<div class="headlineBio-buttons">
						<button class="bioButton-create" data-form-bio="data">Create Bio</button>
						<button class="bioButton-edit" data-form-bio="data">Edit Bio</button>
						<div class="bioButton-actions">
							<button class="bioButton-save userBio-save" data-form-bio="edit">Save Bio</button>
							<button class="bioButton-cancel" data-form-bio="edit">Cancel</button>
						</div>
					</div>
				</div>
				<div class="profileHeadline-user">
					<div class="headlineUser-picture">
						<img src="/images/profile/default-profile-pic.jpg">
						<a href="#" class="upload-profile-picture">
							<span class="upload-selector">
								<i></i>
								<span>Upload Profile<br/>Picture</span>
							</span>
						</a>
					</div>
					<div class="headlineUser-details">
						<h1>First Name, Last Name</h1>
						<p>BS Accountancy, Instructor, Cambridge University</p>
						<p>75 Mutual friends | <a href="#">2 Strings in common</a></p>
						<div class="userDetails-actions">
							<button href="#" class="userDetails-button userDetails-follow"><i></i>Follow</button>
							<button href="#" class="userDetails-button userDetails-add"><i></i>Add Friend</button>
						</div>
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
					</div>
				</div>
				<div class="profileHeadline-actions">
					<ul class="headlineActions-nav">
						<li class="profile-posts active">
							<a href="#" data-profile-target="feeds">
								<i></i>
								<span>Posts</span>
							</a>
						</li>
						<li class="profile-images">
							<a href="#" data-profile-target="images">
								<i></i>
								<span>Images</span>
							</a>
						</li>
						<li class="profile-connections">
							<a href="#" data-profile-target="connections">
								<i></i>
								<span>Connections</span>
							</a>
						</li>
						<li class="profile-activity">
							<a href="#" data-profile-target="activity">
								<i></i>
								<span>Activity</span>
							</a>
						</li>
						<li class="profile-dropdown">
							<a href="#" class="profileDropdown-button" data-profile-target="dropdown">
								<i></i>
							</a>
							<ul class="profileDropdown-subitem">
								<li class="fl_rep-modal"><a href="#" data-profile-target="report" data-modal="report" data-modal-type="profile">Report</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>

			<div class="user-profile-body">

				{{--@include('profile::profile._profile-feeds')--}}
				{{--@include('profile::profile._profile-images')--}}
				{{--@include('profile::profile._profile-connections')--}}
				{{--@include('profile::profile._profile-activity')--}}
				{{--@include('profile::profile._profile-edit')--}}

				<div class="profileBody-container profileBody-connections">

					<div class="profile-connections-container">

						<div class="profile-connections-menu">
							<ul class="profileConnect-nav">
								<li class="active"><a href="#" data-connections="mutual">Mutual</a><span></span></li>
								<li><a href="#" data-connections="friends">Friends</a><span></span></li>
								<li><a href="#" data-connections="following">Following</a><span></span></li>
								<li><a href="#" data-connections="followers">Followers</a><span></span></li>
								<li><a href="#" data-connections="requests">Requests</a><span></span></li>
							</ul>
							<span class="connectMenu-border"></span>
						</div>

						<div class="profile-connections-sections profileSection-friends" data-connections-parent="friends">

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-friends">
											<i></i>
											<span class="default">Friends</span>
											<span class="unfriend">Unfriend</span>
										</button>
									</div>
								</div>
							</div>

						</div>

						<div class="profile-connections-sections profileSection-following" data-connections-parent="following">

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following">
											<i></i>
											<span class="default">Following</span>
											<span class="unfollow">Unfollow</span>
										</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

						</div>

						<div class="profile-connections-sections profileSection-followers" data-connections-parent="followers">

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-follow"><i></i>Follow</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-cancel-request"><i></i>Cancel Request</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons">
										<button class="userConnect-following"><i></i>Following</button>
										<button class="userConnect-friends-add"><i></i>Add Friend</button>
									</div>
								</div>
							</div>

						</div>

						<div class="profile-connections-sections profileSection-requests" data-connections-parent="requests">

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons request-actions">
										<i class="follow"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons request-actions">
										<i class="follow"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Long Last N...</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual">1.2k Mutual friends</p>
									<p class="userDetail-common">24 Strings in common</p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">BS IT, Comp Engineer</p>
									<p class="userDetail-university">New York University</p>
									<p class="userDetail-mutual">10 Mutual friends</p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons request-actions">
										<i class="follow"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Sample Name Sample Last Name</a></h3>
									<p class="userDetail-occupation">Masteral of Information Technology, Instr...</p>
									<p class="userDetail-university">BSU</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common">7 Strings in common</p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

							<div class="profileConnections-item">
								<div class="userConnect-picture">
									<a href="#"><img src="/images/profile/default-profile-pic.jpg"></a>
								</div>
								<div class="userConnect-details">
									<h3><a href="#">Name Last Name</a></h3>
									<p class="userDetail-occupation">BS Accountancy, Instructor</p>
									<p class="userDetail-university">Cambridge University</p>
									<p class="userDetail-mutual"></p>
									<p class="userDetail-common"></p>
									<div class="userDetail-buttons request-actions">
										<i class="friend"></i>
										<button class="requestActions-accept">Accept</button>
										<button class="requestActions-accept">Decline</button>
									</div>
								</div>
							</div>

						</div>

						<div class="placeholder-wrapper">
							<div class="placeholder-container ph-profile-connections">
								<p><span>First Name Last Name</span> didn&apos;t follow any people</p>
								<p><span>You</span> and <span>First Name Last Name</span> don&apos;t have any mutual friends</p>
								<p><span>First Name Last Name</span> don&apos;t have any followers</p>
								<p><span>First Name Last Name</span> didn&apos;t have any friends</p>
							</div>
						</div>

						<div class="placeholder-wrapper">
							<div class="placeholder-container ph-profile-connections">
								<p>You have no friends, start adding people!</p>
								<p>You didn&apos;t followed any people, start following now!</p>
								<p>You have no followers</p>
								<p>There are no new requests at this time</p>
							</div>
						</div>

						<div class="placeholder-wrapper">
							<div class="placeholder-container ph-profile-images">
								<p>There are no images to show</p>
							</div>
						</div>

					</div>

				</div>

				<div class="profileBody-container profileBody-activity " data-profile-section="activity">

					<div class="profile-activity-container">

						<div class="profile-activity-menu">
							<ul class="profileActivity-nav">
								<li><a href="#" data-activity="activity">Activity</a><span></span></li>
								<li class="active"><a href="#" data-activity="about">About</a><span></span></li>
								<li><a href="#" data-activity="strings">Strings</a><span></span></li>
								<li><a href="#" data-activity="comments">Comments</a><span></span></li>
							</ul>
							<span class="activityMenu-border"></span>
						</div>

						<div class="profile-activity-section profileSection-about " data-activity-parent="about">

							<div class="profile-about-container">

								<div class="profile-about-column">

									<div class="aboutColumn-section">

										<h3>Basic Information</h3>

										<div class="aboutColumn-partial">
											<div class="columnPartial-column">
												<h3>Birthdate</h3>
												<p data-form-profile="data">November 19, 1992</p>
											</div>
											<div class="columnPartial-column">
												<h3>Gender</h3>
												<p data-form-profile="data">Male</p>
											</div>
											<div class="columnPartial-column">
												<h3>Bloodtype</h3>
												<p data-form-profile="data">B+</p>
											</div>
											<div class="columnPartial-column">
												<h3>Religion</h3>
												<p data-form-profile="data">Nyork</p>
											</div>
										</div>

										<div class="aboutColumn-partial aboutColumn-politicalviews">
											<div class="columnPartial-column">
												<h3>Political views</h3>
												<p data-form-profile="data">Well Nyork</p>
											</div>
										</div>

									</div>

									<div class="aboutColumn-section">

										<h3>Contact Information</h3>

										<div class="aboutColumn-partial aboutColumn-contact">
											<div class="columnPartial-header">
												<h3>Mobile phone number(s)</h3>
											</div>
											<div class="aboutColumn-data" data-form-profile="data">
												<div class="columnPartial-content">
													<h3>+639 975 261 907</h3>
													<h3>+639 952 155 485</h3>
													<h3>+639 255 255 125</h3>
												</div>
											</div>
										</div>

										<div class="aboutColumn-partial">
											<div class="columnPartial-header">
												<h3>Location</h3>
											</div>
											<div class="aboutColumn-data" data-form-profile="data">
												<div class="columnPartial-content">
													<h3>San Fernando, Pampanga</h3>
												</div>
											</div>
										</div>

										<div class="aboutColumn-partial aboutColumn-email">
											<div class="columnPartial-header">
												<h3>Email(s)</h3>
											</div>
											<div class="aboutColumn-data" data-form-profile="data">
												<div class="columnPartial-content">
													<h3><a href="mailto:email@address.com">email@address.com</a></h3>
												</div>
											</div>
										</div>
										
									</div>

									<div class="aboutColumn-section">

										<h3>Links</h3>

										<div class="aboutColumn-partial">
											<div class="aboutColumn-data" data-form-profile="data">
												<div class="columnPartial-header">
													<h3>Facebook</h3>
												</div>
												<div class="columnPartial-content">
													<h3><a href="#">www.facebook.com/@nyork</a></h3>
												</div>
											</div>
										</div>

										<div class="aboutColumn-partial">
											<div class="aboutColumn-data" data-form-profile="data">
												<div class="columnPartial-header">
													<h3>Twitter</h3>
												</div>
												<div class="columnPartial-content">
													<h3><a href="#">www.twitter.com/@nyork</a></h3>
												</div>
											</div>
										</div>

										<div class="aboutColumn-partial">
											<div class="aboutColumn-data" data-form-profile="data">
												<div class="columnPartial-header">
													<h3>Tumblr</h3>
												</div>
												<div class="columnPartial-content">
													<h3><a href="#">www.tumblr.com/sliceoflyfchigga</a></h3>
												</div>
											</div>
										</div>
										
									</div>

								</div>

								<div class="profile-about-column">

									<div class="aboutColumn-section aboutColumn-work">

										<h3>Work Information</h3>

										<div class="aboutColumn-partial">
											<div class="columnPartial-header">
												<h3>List of his/her work</h3>
											</div>
											<div class="columnPartials-columns">
												<div class="columnPartial-column">
													<div class="aboutColumn-data" data-form-profile="data">
														<h3>Current</h3>
														<h3>Sales Clerk</h3>
														<p>Philexcel Inc.</p>
														<p>Clark, Pampanga</p>
														<p>2014 ~ Present</p>
													</div>
												</div>
												<div class="columnPartial-column">
													<div class="aboutColumn-data" data-form-profile="data">
														<h3>Past</h3>
														<h3>Sales Clerk</h3>
														<p>Philexcel Inc.</p>
														<p>Clark, Pampanga</p>
														<p>2010 ~ 2013</p>
													</div>
												</div>
												<div class="columnPartial-column columnPartial-past">
													<div class="aboutColumn-data" data-form-profile="data">
														<h3>Summoner</h3>
														<p>666 T. Rage</p>
														<p>Underworld</p>
														<p>2001 ~ 2009</p>
													</div>
												</div>
											</div>
										</div>

									</div>

									<div class="aboutColumn-section aboutColumn-education">

										<h3>Education</h3>

										<div class="aboutColumn-partial">
											<div class="columnPartial-header">
												<h3>College</h3>
											</div>
											<div class="columnPartials-columns">
												<div class="columnPartial-column">
													<div class="aboutColumn-data" data-form-profile="data">
														<h3>NYU - New York University</h3>
														<p>New York, USA</p>
														<p>BSIT</p>
														<p>2004 ~ 2008</p>
													</div>
												</div>
											</div>
										</div>

										<div class="aboutColumn-partial">
											<div class="columnPartial-header">
												<h3>High School</h3>
											</div>
											<div class="columnPartials-columns">
												<div class="columnPartial-column">
													<div class="aboutColumn-data" data-form-profile="data">
														<h3>PHS - Pampanga High School</h3>
														<p>Pampanga, Philippines</p>
														<p>1997 ~ 2004</p>
													</div>
												</div>
											</div>
										</div>

									</div>

								</div>

							</div>

						</div>
						
					</div>

				</div>

				<div class="profileBody-container profileBody-images" data-profile-section="images">

					<div class="profile-images-content">

						<div class="image-box nsfw">
							<a href="#"><img src="/images/profile/feed-image-01.png"></a>
							<div class="nsfw-wrapper">
								<div class="nsfw-actions">
									<h4><i></i>Sensitive</h4>
									<a href="#">Show Image</a>
								</div>
							</div>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-02.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-03.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-01.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-03.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-02.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-01.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-03.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-02.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-01.png"></a>
						</div>

						<div class="image-box">
							<a href="#"><img src="/images/profile/feed-image-01.png"></a>
						</div>

					</div>

				</div>

				<div class="placeholder-wrapper">
					<div class="placeholder-container ph-profile-private">
						<p>This profile is currently private<br/>Add him/her now!</p>
					</div>
				</div>

			</div>

		</div>

	</div>

	@include('profile::modals._edit-profile-prompt')
	@include('home::partials._report-form')
	@include('home::partials._scroll-top')
	@include('dedicatedcontent::modals._report-profile-modal')

	@include('home::modals._edit-text')
	@include('home::modals._edit-image')
	@include('home::modals._edit-link')
	@include('home::modals._edit-ask')
@stop
