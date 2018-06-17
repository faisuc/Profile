<div class="profileBody-container profileBody-feeds" data-profile-section="feeds">
	{{--*/ $profile_photo = !empty($userActive->userbasicinfo->profilephoto) && isset($userActive->userbasicinfo)  ? "/upload/user/profile/thumbs/{$userActive->userbasicinfo->profilephoto}" : "/images/profile/default-profile-pic.jpg" /*--}}

	
	<input type="hidden" readonly value="{{count($view_nsfw) ? $view_nsfw->view_nsfw : 1}}" autocomplete="off" id="view_nsfw" />
	<input type="hidden" readonly autocomplete="off" id="selected_cluster" />

	<!--
	<div class="profile-feeds-filter">
		<ul class="profile-filter-button">
			<li>
				<a href="#" class="filter-all"><i></i><span>All contents</span></a>
			</li>
		</ul>
		<div class="profile-filter-container">
			<h3>Feed filters</h3>
			<ul class="profile-filter-list">
				<li rel="all"><a href="#all" class="filter-all"><i></i><span>All contents</span></a></li>
				<li rel="top_rated"><a href="#top_rated" class="filter-top"><i></i><span>Top Rated</span></a></li>
				<li rel="text"><a href="#text" class="filter-text"><i></i><span>Text</span></a></li>
				<li rel="images"><a href="#images" class="filter-image"><i></i><span>Image</span></a></li>
				<li rel="links"><a href="#links" class="filter-link"><i></i><span>Link</span></a></li>
				<li rel="questions"><a href="#questions" class="filter-ask"><i></i><span>Question</span></a></li>
				<li rel="articles"><a href="#articles" class="filter-article"><i></i><span>Article</span></a></li>
				<li rel="lists"><a href="#lists" class="filter-list"><i></i><span>Poll</span></a></li>
			</ul>
		</div>
	</div>

	<div class="profile-feeds-content feeds-container">

		

	</div>
-->

	
		

		<div class="content-feed-block">

						<div class="modal-box modal-window" id="popupOne">  
					        <div class="modal-wrapper"></div>
					    </div>
					    <div class="modal-box overlay"></div>

					  <!-- Put the profile photo in variables to be use in content creator -->
					  {{--*/ $profile_photo = !empty($userActive->userbasicinfo->profilephoto) && isset($userActive->userbasicinfo)  ? "/upload/user/profile/thumbs/{$userActive->userbasicinfo->profilephoto}" : "/images/profile/default-profile-pic.jpg" /*--}}
					 <div class="page-comment page-feeds">
					      <div class="content-feed-block">

					      	@if ($myprofile && $mask_status == 0)
					      	
					        <ul class="feed-creator">
					          <li class="feed-profile-img">
					            <a href="#" class="btn-creator-profile">
					              <i class="icon" style="background-image: url('{{ $default_image }}')"></i>
					            </a>
					          </li>
					          <li>
					            <a href="javacript:void(0)" class="btn-creator-text cc-links" data-cc="text" rel="feed-editor-text">
					              <i class="icon"></i>
					              <div>Text</div>
					            </a>
					          </li>
					          <li>
					            <a href="javacript:void(0)" class="btn-creator-link cc-links" data-cc="link" rel="feed-editor-link">
					              <i class="icon"></i>
					              <div>Link</div>
					            </a>
					          </li>
					          <li>
					            <a href="javacript:void(0)" class="btn-creator-image cc-links" data-cc="image" rel="feed-editor-image">
					              <i class="icon"></i>
					              <div>Image</div>
					            </a>
					          </li>
					          <li>
					            <a href="javacript:void(0)" class="btn-creator-ask btn-cc-disabled" data-cc="ask" rel="feed-editor-ask">
					              <i class="icon"></i>
					              <div style="font-size:12px;color:#555;">Coming Soon</div>
					            </a>
					          </li>
					          <li>
					            <a href="javacript:void(0)" data-cc="article" class="btn-creator-article btn-cc-disabled">
					              <i class="icon"></i>
					              <div style="font-size:12px;color:#555;">Coming Soon</div>
					            </a>
					          </li>
					          <li>
					            <a href="javacript:void(0)" class="btn-creator-poll btn-cc-disabled" data-cc="poll" rel="feed-editor-poll">
					              <i class="icon"></i>
					              <div style="font-size:12px;color:#555;">Coming Soon</div>
					            </a>
					          </li>
					        </ul>

					        @endif


					        <!-- feeds content-->
					        <!-- Start Feed Container -->
					        <div class="feed-content">
					          <!-- Start Content Creator -->
					          <!-- ============= FEEDS PLACEMENT ============= -->
					          @include('dedicatedcontent::newtemplates.cc', [$profile_photo])
					          <!-- End Content Creator Layout -->
					          <!-- End Content Creator Layout -->

					          <!--
					          ==========================================================================
					          =====================================FEEDS================================
					          ==========================================================================
					          -->
					          <!-- Set a container to be used on when rendering -->
					          <div id="feed-container-box" class='1'>
					              <!-- This where the feeds will be rendered -->
								  
								
					          </div>
							 
					        </div>
					        <!-- End Feed Content Container -->
					      </div>
					    </div>

					    @include('home::partials.imageoverlay')
						@include('home::partials._report-form')
						@include('topics::modals._strings-modal')

					</div>
			

	

</div>