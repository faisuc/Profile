@extends('layouts.new-profile')

@section('title')
@parent
{{ $user->first_name .' '. $user->last_name }}
@stop

@section('meta')
@parent
	<meta name="bruii_active_user" content="{{ $active_id }}">
	<meta name="bruii_viewing_user" content="{{ $user->id }}">
@stop

@section('content')
<style type="text/css">
    .loader-cover {
        position: absolute;
        z-index: 101;
        top: 50%;
        margin: 0 auto;
        left: 50%;
        display: none;
    }
    
    .loader-profile {
        position: absolute;
        top: 33%;
        z-index: 101;
        left: 33%;
        display: none;
    }
    
    .loader-profile img,
    .loader-cover img {
        border:0;
        outline: 0;
    }
</style>
<!-- new class "page-creator" -->
<div id="page-profile" data-profile-id="<?php echo $profile_code ?>" class="page-profile <?php echo ($myprofile) ? "owned" : "view" ?>">
    {{--*/ $profile_photo = !empty($userActive->userbasicinfo->profilephoto) && isset($userActive->userbasicinfo)  ? "/upload/user/profile/thumbs/{$userActive->userbasicinfo->profilephoto}" : "/images/profile/default-profile-pic.jpg" /*--}}
    <div class="p-cover-content">
        <?php if (!empty($user->userbasicinfo->coverphoto)) { ?>
            <div class="p-cover-photo" style="background-image: url('<?php echo Config::get('app.url') . 'upload/user/cover/original/' . $user->userbasicinfo->coverphoto ?>')"></div>
        <?php } else { ?>
            <div class="p-cover-photo" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)"></div>
        <?php } ?>
        <div class="p-shading"></div>
        <div class="loader-cover">
            <img src='<?php echo Config::get('app.url') ?>images/loaders/uploader.svg'/>
        </div>
        
        <div class="cp-title-row">

            <div class="cp-profile-content">

                {!! Form::open(['id' => 'upload-profile-container' , 'enctype' => 'multipart/form-data']) !!}
                <div class="cp-profile-picture">
                        <!-- <img class="profile-pic" src="default-profile-pic.jpg"/> -->
                    <img class="profile-pic" src='{{ Config::get('app.url') }}{{ !empty($user->userbasicinfo->profilephoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? "upload/user/profile/thumbs/{$user->userbasicinfo->profilephoto}" : "images/profile/default-profile-pic.jpg" }}' />
                    @if($myprofile)
                    <!-- if owner -->
                    <div class="loader-profile">
                        <img src='<?php echo Config::get('app.url') ?>images/loaders/uploader.svg'/>
                    </div>
                    <div id="upload-profile-photo" class="edit-pp">
                        <span>Edit Profile Picture</span>
                    </div> 
                    @endif    
                </div>
                {!! Form::close() !!}  


                <div class="cp-title">
                    {{ $user->first_name .' '. $user->last_name }}
                    <!-- if owner -->
                    <div class="cp-credentials">
                        @if($myprofile)
                            <div id="credentials-selector"></div>
                        @else 
                        <i class="icon i-credentials"></i> <span id="credential-active"><?php echo $user_profile[0]->credential ?></span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="cp-after">

                <div class="content-insights">
                    <div class="ci-action">
                        @if($myprofile)
                            {!! Form::open(['id' => 'upload-cover-container' , 'enctype' => 'multipart/form-data']) !!}
                                <button type="button" name="button" class="btn btn-editcover color-black-only upload-cover-profile">Edit Cover </button>
                            {!! Form::close() !!}      
                        @endif
                            <!-- Follow and Add Friend -->
                            <?php if(count($con_acquaintances) > 0) { ?>
                                <?php if($con_acquaintances->status) { ?>
                                    <button type="button" name="button" class="btn color-white con-add-aa rs-acquaintances" data-client-id="{{ $user->profile_code }}">
                                        <i class="icon i-following"></i> <span>Following </span>
                                    </button>
                                <?php } else { ?>
                                    <button type="button" name="button" class="btn color-black con-add-aa <?php echo count($con_acquaintances) > 0 ? "con-request-aa rs-aa-action" : "" ?>" data-client-id="{{ $user->profile_code }}">
                                        <i class="icon i-follow"></i> <span><?php echo count($con_acquaintances) > 0 ? "Request Sent" : "Follow" ?></span>
                                    </button>
                                <?php } ?>
                            <?php } else { ?>
                                @if(!$myprofile)
                                    <button type="button" name="button" class="btn color-black con-add-aa <?php echo count($con_acquaintances) > 0 ? "con-request-aa rs-aa-action" : "" ?>" data-client-id="{{ $user->profile_code }}">
                                        <i class="icon i-follow"></i> <span><?php echo count($con_acquaintances) > 0 ? "Request Sent" : "Follow" ?></span>
                                    </button>
                                @endif
                            <?php } ?>

                            
                            <?php if(count($con_friends) > 0) { ?>
                                <?php if($con_friends->status) { ?>
                                    <button type="button" name="button" class="btn color-white con-add-af rs-friends" data-client-id="{{ $user->profile_code }}">
                                        <i class="icon i-friends"></i> <span>Friends</span>
                                    </button>
                                <?php } else { ?>
                                    <button type="button" name="button" class="btn color-black con-add-af <?php echo count($con_friends) > 0 ? "con-request-af rs-action" : "" ?>" data-client-id="{{ $user->profile_code }}">
                                        <i class="icon i-addfriend"></i> <span><?php echo count($con_friends) > 0 ? "Request Sent" : "Add Friend" ?></span>
                                    </button>
                                <?php } ?>
                            <?php } else { ?>
                                @if(!$myprofile)
                                    <button type="button" name="button" class="btn color-black con-add-af <?php echo count($con_friends) > 0 ? "con-request-af rs-action" : "" ?>" data-client-id="{{ $user->profile_code }}">
                                        <i class="icon i-addfriend"></i> <span><?php echo count($con_friends) > 0 ? "Request Sent" : "Add Friend" ?></span>
                                    </button>
                                @endif
                            <?php } ?>
                    </div>

                    <div class="ci-rating">
                        <div class="rating-icon">
                            <i class="icon i-positive"></i>
                        </div>
                        <div class="rating-title">
                            <?php echo $user_numbers[0]->avg_rating  ?>
                        </div>
                    </div>

                    <div class="ci-followers">
                        <div class="ci-followers-title">
                            <?php echo $user_numbers[0]->followers ?>
                        </div>
                        <div class="ci-followers-after">
                            Follower<?php echo ($user_numbers[0]->followers > 1) ? "s" : "" ?>
                        </div>
                    </div>

                    <div class="ci-following">
                        <div class="ci-following-title">
                            <?php echo $user_numbers[0]->following ?>
                        </div>
                        <div class="ci-following-after">
                            Following
                        </div>
                    </div>

                    <div class="ci-settings">
                        <button type="button" name="button"><i class="icon"></i></button>
                        <div class="ci-settings-content">
                            <a href="javascript:void(0)">Report String</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -->
    <div class="tabbar-container">
        
        <div class="tabbar-header">
            <?php
                $is_acquaintances = false; 
                $is_friends       = false;

                if(count($con_acquaintances) > 0) { 
                    if($con_acquaintances->status) { 
                        $is_acquaintances = true;
                    }
                }

                if(count($con_friends) > 0) {
                    if($con_friends->status) {
                        $is_friends = true;
                    }
                }

                $comment_tab_privacy = $helpers->privacy_profile_check([
                    'is_friends'        => $is_friends,
                    'is_acquaintances'  => $is_acquaintances,
                    'needle'            => $profile_settings->comment_tab,
                    'owner'             => $myprofile
                ]);


                $show_friends_tab = $helpers->privacy_profile_check([
                    'is_friends'        => $is_friends,
                    'is_acquaintances'  => $is_acquaintances,
                    'needle'            => $profile_settings->friends,
                    'owner'             => $myprofile
                ]);

                $show_following_tab = $helpers->privacy_profile_check([
                    'is_friends'        => $is_friends,
                    'is_acquaintances'  => $is_acquaintances,
                    'needle'            => $profile_settings->following,
                    'owner'             => $myprofile
                ]);

                $show_followers_tab = $helpers->privacy_profile_check([
                    'is_friends'        => $is_friends,
                    'is_acquaintances'  => $is_acquaintances,
                    'needle'            => $profile_settings->followers,
                    'owner'             => $myprofile
                ]);

                $image_tab_privacy = $helpers->privacy_profile_check([
                    'is_friends'        => $is_friends,
                    'is_acquaintances'  => $is_acquaintances,
                    'needle'            => $profile_settings->image_tab,
                    'owner'             => $myprofile
                ]);
            
            ?>
            <!-- Tab link -->
            <div id="tabbar" class="tabbar">
                <div class="tabbar-link active" data-tab="tab-about" title="" aria-selected="true"><i class="icon i-about"></i> ABOUT</div>
                <div class="tabbar-link" data-tab="tab-feed" title=""><i class="icon i-feed"></i> CONTENT FEED</div>
                <?php if($comment_tab_privacy) { ?>
                    <div class="tabbar-link" data-tab="tab-comments" title=""><i class="icon i-comments"></i> COMMENTS</div>
                <?php } ?>
                <?php if($show_friends_tab
                        || $show_following_tab
                        || $show_followers_tab) { ?>    
                    <div class="tabbar-link" data-tab="tab-connections" title=""><i class="icon i-connections"></i> CONNECTIONS</div>
                <?php } ?>
                <div class="tabbar-link" data-tab="tab-images" title=""><i class="icon i-images"></i> IMAGES</div>
                <span class="tabbar-link-highlight"></span>
            </div>

            <!-- UST -->
            <div id="favorite-strings-header" class="content-ust"></div>
            <!-- .tabbar-header -->
        </div>
        
            <div class="tab-wrap">

                <!-- Tab1 Content ABOUT -->
                <div id="tab-about" class="tab-content active">
                    <!-- content tab - INFO -->
                    <div class="content-tab-about">

                        <div class="content-tab-column">
                            <?php 
                                
                                /**
                                 * Condition will go here 
                                 */
                                $show_bio = $helpers->privacy_profile_check([
                                    'is_friends'        => $is_friends,
                                    'is_acquaintances'  => $is_acquaintances,
                                    'needle'            => $profile_settings->bio,
                                    'owner'             => $myprofile
                                ]);
                            ?>
                            
                            <?php
                                //check if we need to show the bio
                                if($show_bio) {
                            ?>
                                <!-- about -->
                                <div class="card card-about">
                                    <div class="card-header-row">
                                        <div class="card-header">
                                            Bio
                                        </div>
                                        <?php if($myprofile) { ?>
                                            <div class="card-header-after">
                                                <div class="ch-privacy toggle-content">
                                                    <!-- adding class "toggle-open" -->
                                                    <?php
                                                        $active_bio_text = "Anyone";
                                                        if($profile_settings->bio == 1) {
                                                            $active_bio_text = "Followers & Friends";
                                                        } else if($profile_settings->bio == 2) {
                                                            $active_bio_text = "Friends only";
                                                        } else if($profile_settings->bio == 3) {
                                                            $active_bio_text = "Only me";
                                                        }
                                                    ?>
                                                    Privacy: <span class="profile-settings-bio"><?php echo $active_bio_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                                                    <ul class="global-action-nav toggle-close profile-settings">
                                                        <li <?php echo $profile_settings->bio == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="bio" data-value="0">Anyone</a></li>
                                                        <li <?php echo $profile_settings->bio == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="bio" data-value="1">Followers & Friends</a></li>
                                                        <li <?php echo $profile_settings->bio == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="bio" data-value="2">Friends only</a></li>
                                                        <li <?php echo $profile_settings->bio == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="bio" data-value="3">Only me</a></li>
                                                    </ul>

                                                </div>
                                                <a href="javascript:void(0)" class="btn-about-edit on-add">Edit</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-content-inner">
                                            <div class="content-about-add">
                                                <p id="bio-info"><?php echo !empty($user_profile[0]->bio_info) ? $user_profile[0]->bio_info : "-" ?></p>

                                                <p class="content-footer">User since <?php echo \Carbon::parse($user_profile[0]->register_date)->format('F d, Y') ?></p>
                                            </div>
                                            <?php if($myprofile) { ?>
                                                <div class="content-about-edit">
                                                    {!! Form::open(['id' => "bio-form"]) !!}
                                                        <div class="cl-edit-body">
                                                                <div class="item-input">
                                                                    <span class="bio-count" style="display: none">&nbsp;</span>
                                                                    <textarea name="bio" class="count-char in-limit" maxlength="300" rel="bio-count" required><?php echo !empty($user_profile[0]->bio_info) ? str_replace("<br>", "\r\n", $user_profile[0]->bio_info) : "" ?></textarea>
                                                                </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                                <div class="item-title"></div>
                                                                <div class="item-after">
                                                                   <button type="submit" class="update-profile-info btn-raised" rel="bio-form">Save</button>
                                                                </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>    
                                
                            <!-- insights -->
                            <div class="card card-insights">
                                <div class="card-header-row">
                                    <div class="card-header">
                                        Insights
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-content-inner">

                                        <div class="content-stats">
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <?php if ($user_profile[0]->totalyayreceived == 0 && $user_profile[0]->totalnayreceived == 0) { ?>
                                                        <i class="icon i-rating-default"></i><span class="txt-yea">0</span> <span>|</span> <span class="txt-nay">0</span>
                                                    <?php } else if ($user_profile[0]->totalyayreceived  > $user_profile[0]->totalnayreceived) { ?>
                                                        <i class="icon i-rating-positive"></i><span class="txt-yea"><?php echo $user_profile[0]->totalyayreceived ?></span> <span>|</span> <span class="txt-nay"><?php echo $user_profile[0]->totalnayreceived ?></span>
                                                    <?php } else if ($user_profile[0]->totalnayreceived > $user_profile[0]->totalyayreceived ) { ?>
                                                        <i class="icon i-rating-negative"></i><span class="txt-yea"><?php echo $user_profile[0]->totalyayreceived ?></span> <span>|</span> <span class="txt-nay"><?php echo $user_profile[0]->totalnayreceived ?></span>
                                                    <?php } else { ?>
                                                        <i class="icon i-rating-equal"></i><span class="txt-yea"><?php echo $user_profile[0]->totalyayreceived ?></span> <span>|</span> <span class="txt-nay"><?php echo $user_profile[0]->totalnayreceived ?></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="item-after">
                                                    Rating
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-comments"></i> <?php echo $user_profile[0]->total_comments ?>
                                                </div>
                                                <div class="item-after">
                                                    Comments
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-friends"></i> <?php echo $user_profile[0]->total_friends ?>
                                                </div>
                                                <div class="item-after">
                                                    Friends
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-followers"></i> <?php echo $user_profile[0]->total_followers ?>
                                                </div>
                                                <div class="item-after">
                                                    Followers
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-following"></i> <?php echo $user_profile[0]->total_following ?>
                                                </div>
                                                <div class="item-after">
                                                    Followings
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-posts"></i> <?php echo $user_profile[0]->total_post ?>
                                                </div>
                                                <div class="item-after">
                                                    Posts
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <!-- <div class="item-media">
                                                    <i class="icon i-images"></i>
                                            </div> -->
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-images"></i> <?php echo $user_profile[0]->total_images ?>
                                                </div>
                                                <div class="item-after">
                                                    Images
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <!-- <div class="item-media">
                                                    <i class="icon i-questions"></i>
                                            </div> -->
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-questions"></i> <?php echo $user_profile[0]->total_question ?>
                                                </div>
                                                <div class="item-after">
                                                    Questions
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <!-- <div class="item-media">
                                                    <i class="icon i-article"></i>
                                            </div> -->
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-article"></i> <?php echo $user_profile[0]->total_article ?>
                                                </div>
                                                <div class="item-after">
                                                    Stories
                                                </div>
                                            </div>
                                        </div>

                                        <div class="content-stats">
                                            <!-- <div class="item-media">
                                                    <i class="icon i-polls"></i>
                                            </div> -->
                                            <div class="item-inner">
                                                <div class="stats-title">
                                                    <i class="icon i-polls"></i> <?php echo $user_profile[0]->total_poll ?>
                                                </div>
                                                <div class="item-after">
                                                    Polls
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- personal -->
                            <div class="card card-personal">
                                <div class="card-header-row">
                                    <div class="card-header">
                                        Personal
                                    </div>
                                    <!-- <div class="card-header-after">
                                            <a href="javascript:void(0)">Edit</a>
                                    </div> -->
                                </div>
                                <div class="card-content">
                                    <div class="card-content-inner">
                                        <div class="content-list">
                                            <!-- Append the option list -->
                                            <div id="personal-personal-list"></div>
                                            <!-- Append the list -->
                                            <div id="personal-info-list"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php 

                            $show_credentials = $helpers->privacy_profile_check([
                                'is_friends'        => $is_friends,
                                'is_acquaintances'  => $is_acquaintances,
                                'needle'            => $profile_settings->credentials,
                                'owner'             => $myprofile
                            ]);

                            ?>
                            
                            <?php if($show_credentials) { ?>
                                <!-- credentials -->
                                <div class="card card-credentials">
                                    <div class="card-header-row">
                                        <div class="card-header">
                                            Credentials
                                        </div>
                                        <?php if ($myprofile) { ?>
                                            <div class="ch-privacy toggle-content">
                                                <!-- adding class "toggle-open" -->
                                                <?php
                                                    $active_credentials_text = "Anyone";
                                                    if($profile_settings->credentials == 1) {
                                                        $active_credentials_text = "Followers & Friends";
                                                    } else if($profile_settings->credentials == 2) {
                                                        $active_credentials_text = "Friends only";
                                                    } else if($profile_settings->credentials == 3) {
                                                        $active_credentials_text = "Only me";
                                                    }
                                                ?>
                                                Privacy: <span class="profile-settings-credentials"><?php echo $active_credentials_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                                                <ul class="global-action-nav toggle-close profile-settings">
                                                    <li <?php echo $profile_settings->credentials == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="credentials" data-value="0">Anyone</a></li>
                                                    <li <?php echo $profile_settings->credentials == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="credentials" data-value="1">Followers & Friends</a></li>
                                                    <li <?php echo $profile_settings->credentials == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="credentials" data-value="2">Friends only</a></li>
                                                    <li <?php echo $profile_settings->credentials == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="credentials" data-value="3">Only me</a></li>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-content-inner">
                                            <div class="content-list">
                                                <!-- Append data here -->
                                                <div id="about-info-credentials"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                                
                            <?php 

                            $show_links = $helpers->privacy_profile_check([
                                'is_friends'        => $is_friends,
                                'is_acquaintances'  => $is_acquaintances,
                                'needle'            => $profile_settings->links,
                                'owner'             => $myprofile
                            ]);

                            ?>
                            
                            <?php if($show_links) { ?>    
                                <!-- link -->
                                <div class="card card-link">
                                    <div class="card-header-row">
                                        <div class="card-header">
                                            Links
                                        </div>
                                        <?php if($myprofile) { ?>
                                            <div class="card-header-after">
                                                <div class="ch-privacy toggle-content">
                                                    <!-- adding class "toggle-open" -->
                                                    <?php
                                                        $active_links_text = "Anyone";
                                                        if($profile_settings->links == 1) {
                                                            $active_links_text = "Followers & Friends";
                                                        } else if($profile_settings->links == 2) {
                                                            $active_links_text = "Friends only";
                                                        } else if($profile_settings->links == 3) {
                                                            $active_links_text = "Only me";
                                                        }
                                                    ?>
                                                    Privacy: <span class="profile-settings-links"><?php echo $active_links_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                                                    <ul class="global-action-nav toggle-close profile-settings">
                                                        <li <?php echo $profile_settings->links == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="links" data-value="0">Anyone</a></li>
                                                        <li <?php echo $profile_settings->links == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="links" data-value="1">Followers & Friends</a></li>
                                                        <li <?php echo $profile_settings->links == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="links" data-value="2">Friends only</a></li>
                                                        <li <?php echo $profile_settings->links == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="links" data-value="3">Only me</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-content-inner">

                                            <div class="content-list">
                                                <!-- Append the list -->
                                                <div id="personal-info-links"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php 

                            $favorite_strings_privacy = $helpers->privacy_profile_check([
                                'is_friends'        => $is_friends,
                                'is_acquaintances'  => $is_acquaintances,
                                'needle'            => $profile_settings->favorite_strings,
                                'owner'             => $myprofile
                            ]);
                            
                            $created_strings_privacy = $helpers->privacy_profile_check([
                                'is_friends'        => $is_friends,
                                'is_acquaintances'  => $is_acquaintances,
                                'needle'            => $profile_settings->created_strings,
                                'owner'             => $myprofile
                            ]);
                            
                            $followed_strings_privacy = $helpers->privacy_profile_check([
                                'is_friends'        => $is_friends,
                                'is_acquaintances'  => $is_acquaintances,
                                'needle'            => $profile_settings->followed_strings,
                                'owner'             => $myprofile
                            ]);

                            $top_tags_privacy = $helpers->privacy_profile_check([
                                'is_friends'        => $is_friends,
                                'is_acquaintances'  => $is_acquaintances,
                                'needle'            => $profile_settings->top_tags,
                                'owner'             => $myprofile
                            ]);
                            ?>
                            <?php if($favorite_strings_privacy
                                    || $created_strings_privacy
                                    || $followed_strings_privacy
                                    || $top_tags_privacy) { ?>    
                                <div class="card card-tags">
                                    <div class="card-header-row">
                                        <div class="card-header">
                                            Active Strings
                                        </div>
                                        <!--div class="card-header-after">
                                                <a href="javascript:void(0)">Edit</a>
                                        </div-->
                                    </div>

                                    <div class="card-content">
                                        <div class="card-content-inner">

                                            <?php if($favorite_strings_privacy) { ?>
                                                <div class="card-title-block">
                                                    Favorite Strings
                                                    <?php if ($myprofile) { ?>
                                                        <div class="toggle-content">
                                                            <?php
                                                                $active_fs_text = "Anyone";
                                                                if($profile_settings->favorite_strings == 1) {
                                                                    $active_fs_text = "Followers & Friends";
                                                                } else if($profile_settings->favorite_strings == 2) {
                                                                    $active_fs_text = "Friends only";
                                                                } else if($profile_settings->favorite_strings == 3) {
                                                                    $active_fs_text = "Only me";
                                                                }
                                                            ?>
                                                            Privacy: <span class="profile-settings-favorite_strings" style="left: 0;"><?php echo $active_fs_text ?></span><i class="icon i-dropdown toggle-open"></i>
                                                            <ul class="global-action-nav toggle-close profile-settings">
                                                                <li <?php echo $profile_settings->favorite_strings == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="favorite_strings" data-value="0">Anyone</a></li>
                                                                <li <?php echo $profile_settings->favorite_strings == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="favorite_strings" data-value="1">Followers & Friends</a></li>
                                                                <li <?php echo $profile_settings->favorite_strings == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="favorite_strings" data-value="2">Friends only</a></li>
                                                                <li <?php echo $profile_settings->favorite_strings == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="favorite_strings" data-value="3">Only me</a></li>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <div id="parse_favorite_strings"></div> 
                                            <?php } ?>

                                            <?php if($created_strings_privacy) { ?>    
                                                <div class="card-title-block">
                                                    Created Strings <span><?php echo $created_strings['count'][0]->totalstrings ?></span>
                                                    <?php if ($myprofile) { ?>
                                                        <div class="toggle-content">
                                                            <?php
                                                                $active_cs_text = "Anyone";
                                                                if($profile_settings->created_strings == 1) {
                                                                    $active_cs_text = "Followers & Friends";
                                                                } else if($profile_settings->created_strings == 2) {
                                                                    $active_cs_text = "Friends only";
                                                                } else if($profile_settings->created_strings == 3) {
                                                                    $active_cs_text = "Only me";
                                                                }
                                                            ?>
                                                            Privacy: <span class="profile-settings-created_strings" style="left: 0;"><?php echo $active_cs_text ?></span><i class="icon i-dropdown toggle-open"></i>
                                                            <ul class="global-action-nav toggle-close profile-settings">
                                                                <li <?php echo $profile_settings->created_strings == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="created_strings" data-value="0">Anyone</a></li>
                                                                <li <?php echo $profile_settings->created_strings == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="created_strings" data-value="1">Followers & Friends</a></li>
                                                                <li <?php echo $profile_settings->created_strings == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="created_strings" data-value="2">Friends only</a></li>
                                                                <li <?php echo $profile_settings->created_strings == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="created_strings" data-value="3">Only me</a></li>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="content-tags">
                                                    <?php if(count($created_strings['list']) > 0) { ?>
                                                        <ul class="tags" >
                                                            <?php foreach ($created_strings['list'] as $string) { ?>
                                                                <?php if (!empty($string->coverphoto)) { ?>
                                                                <li class="has-image" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string->coverphoto ?>')">
                                                                <?php } else { ?>
                                                                <li class="has-image" style="background-color:<?php echo $string->color ?>;">    
                                                                <?php } ?>
                                                                    <a href="<?php echo URL::route('view-string', $string->slug) ?>" target="_blank">~<?php echo $string->string_alias ?></a>
                                                                    <input type="hidden" value="~<?php echo $string->string_alias ?>" name="tags[]">
                                                                </li>
                                                            <?php } ?>    
                                                        </ul>
                                                        <button type="button" class="btn-more">21 <i class="icon i-more"></i></button>
                                                    <?php } ?>    
                                                </div>
                                            <?php } ?>

                                            <?php if($followed_strings_privacy) { ?>    
                                                <div class="card-title-block">
                                                    Followed Strings <span><?php echo $followed_strings['count'][0]->totaltracked ?></span>
                                                    <?php if ($myprofile) { ?>
                                                        <div class="toggle-content">
                                                            <?php
                                                                $active_fos_text = "Anyone";
                                                                if($profile_settings->followed_strings == 1) {
                                                                    $active_fos_text = "Followers & Friends";
                                                                } else if($profile_settings->followed_strings == 2) {
                                                                    $active_fos_text = "Friends only";
                                                                } else if($profile_settings->followed_strings == 3) {
                                                                    $active_fos_text = "Only me";
                                                                }
                                                            ?>
                                                            Privacy: <span class="profile-settings-followed_strings" style="left: 0;"><?php echo $active_fos_text ?></span><i class="icon i-dropdown toggle-open"></i>
                                                            <ul class="global-action-nav toggle-close profile-settings">
                                                                <li <?php echo $profile_settings->followed_strings == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followed_strings" data-value="0">Anyone</a></li>
                                                                <li <?php echo $profile_settings->followed_strings == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followed_strings" data-value="1">Followers & Friends</a></li>
                                                                <li <?php echo $profile_settings->followed_strings == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followed_strings" data-value="2">Friends only</a></li>
                                                                <li <?php echo $profile_settings->followed_strings == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followed_strings" data-value="3">Only me</a></li>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="content-tags">
                                                    <?php if(count($followed_strings['list']) > 0) { ?>
                                                        <ul class="tags" >
                                                            <?php foreach ($followed_strings['list'] as $string) { ?>
                                                                <?php if (!empty($string->coverphoto)) { ?>
                                                                <li class="has-image" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string->coverphoto ?>')">
                                                                <?php } else { ?>
                                                                <li style="background-color:<?php echo $string->color ?>;">    
                                                                <?php } ?>
                                                                    <a href="<?php echo URL::route('view-string', $string->slug) ?>" target="_blank">~<?php echo $string->string_alias ?></a>
                                                                    <input type="hidden" value="~<?php echo $string->string_alias ?>" name="tags[]">
                                                                </li>
                                                            <?php } ?>    
                                                        </ul>
                                                        <button type="button" class="btn-more">21 <i class="icon i-more"></i></button>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if($top_tags_privacy) { ?>
                                                <div class="card-title-block">
                                                    Top Tags
                                                    <?php if ($myprofile) { ?>
                                                        <div class="toggle-content">
                                                            <?php
                                                                $active_tt_text = "Anyone";
                                                                if($profile_settings->top_tags == 1) {
                                                                    $active_tt_text = "Followers & Friends";
                                                                } else if($profile_settings->top_tags == 2) {
                                                                    $active_tt_text = "Friends only";
                                                                } else if($profile_settings->top_tags == 3) {
                                                                    $active_tt_text = "Only me";
                                                                }
                                                            ?>
                                                            Privacy: <span class="profile-settings-top_tags" style="left: 0;"><?php echo $active_tt_text ?></span><i class="icon i-dropdown toggle-open"></i>
                                                            <ul class="global-action-nav toggle-close profile-settings">
                                                                <li <?php echo $profile_settings->top_tags == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="top_tags" data-value="0">Anyone</a></li>
                                                                <li <?php echo $profile_settings->top_tags == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="top_tags" data-value="1">Followers & Friends</a></li>
                                                                <li <?php echo $profile_settings->top_tags == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="top_tags" data-value="2">Friends only</a></li>
                                                                <li <?php echo $profile_settings->top_tags == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="top_tags" data-value="3">Only me</a></li>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="content-tags">
                                                    <?php if(count($top_tags) > 0) { ?>
                                                        <ul class="tags" >
                                                            <?php foreach ($top_tags as $tag) { ?>
                                                                <li style="background-color:<?php echo $tag->color ?>;">  
                                                                    <a href="javascript:void(0)">#<?php echo $tag->tagname ?></a>
                                                                </li>
                                                            <?php } ?>    
                                                        </ul>
                                                    <?php } ?>
        <!--                                            <button type="button" class="btn-more">21 <i class="icon i-more"></i></button>-->
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div> <!-- end tags -->
                            <?php } ?>
                        </div>
                        <!-- END content-tab-left -->

                    </div>
                    <!-- END content-tab-info -->

                </div>

                <!-- Tab2 Content CONTENT FEED -->
                <div id="tab-feed" class="tab-content page-feeds">
                    <div class="content-tab-feed">
                        
                        <div class="content-feed-block" style="position:relative; right:0">
                            <!-- Start Feed Container -->
                            <div class="feed-content">
                              <!-- Start Content Creator -->
                              @include('dedicatedcontent::newtemplates.cc', [$profile_photo])
                              <!-- End Content Creator Layout -->
                              <!-- Set a container to be used on when rendering -->
                              <div id="feed-container-box" class='1'>
                                  <!-- This where the feeds will be rendered -->
                              </div>
                            </div>
                            
                        </div>

                    </div>
                </div>

                
                <?php if($comment_tab_privacy) { ?>
                    <!-- Tab3 Content - COMMENTS -->
                    <div id="tab-comments" class="tab-content">
                        <div class="content-tab-comments">
                        <!-- ===== CONTENT HERE ==== -->
                            <div class="toggle-tab toggle-tab-comment">
                                <div class="tabs">
                                    <div class="tab active"><?php echo $comments['total_comments'][0]->comments ?> Comments</div>
                                    <div class="tab"><?php echo $comments['total_replies'][0]->replies ?> Replies</div>

                                    <div class="tabs-right-content">
                                        <?php if ($myprofile) { ?>
                                            <div class="comments-privacy toggle-content">
                                                <?php
                                                    $active_ct_text = "Anyone";
                                                    if($profile_settings->comment_tab == 1) {
                                                        $active_ct_text = "Followers & Friends";
                                                    } else if($profile_settings->comment_tab == 2) {
                                                        $active_ct_text = "Friends only";
                                                    } else if($profile_settings->comment_tab == 3) {
                                                        $active_ct_text = "Only me";
                                                    }
                                                ?>
                                                Privacy: <span class="profile-settings-comment_tab" style="left: 0;"><?php echo $active_ct_text ?></span><i class="icon i-dropdown toggle-open"></i>

                                                <ul class="global-action-nav toggle-close profile-settings">
                                                    <li <?php echo $profile_settings->comment_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="comment_tab" data-value="0">Anyone</a></li>
                                                    <li <?php echo $profile_settings->comment_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="comment_tab" data-value="1">Followers &amp; Friends</a></li>
                                                    <li <?php echo $profile_settings->comment_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="comment_tab" data-value="2">Friends only</a></li>
                                                    <li <?php echo $profile_settings->comment_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="comment_tab" data-value="3">Only me</a></li>
                                                </ul>	
                                            </div>
                                        <?php } ?>

                                        <div id="comments_filter" class="comments-filter toggle-content">
                                            <!-- adding class "toggle-open" -->
                                            <span class="active_comments_filter_text">Show all</span> <i class="icon i-dropdown toggle-open"></i>
                                            <ul class="global-action-nav toggle-close w185" data-filter="comments">
                                                <li class=""><a href="javascript:void(0)" class="comments_filter_action" rel="Z">Show all</a></li>
                                                <li class=""><a href="javascript:void(0)" class="comments_filter_action" rel="T">Text</a></li>
                                                <li class=""><a href="javascript:void(0)" class="comments_filter_action" rel="F">Image</a></li>
                                                <li class=""><a href="javascript:void(0)" class="comments_filter_action" rel="K">Link</a></li>
                                                <li class=""><a href="javascript:void(0)" class="comments_filter_action" rel="SD">String discussions</a></li>
                                            </ul>	
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panels">
                                    <div class="panel tab-content-comments tab-active">
                                        <!-- Parse Comments Here -->
                                        <div class="loader-content" style="text-align: center;"></div>
                                        <div id="comments-grid" class="comments-row"></div>
                                    </div>
                                    
                                    <div class='panel tab-content-replies'>
                                        <div class="loader-content" style="text-align: center;"></div>
                                        <!-- Parse Replies Here -->
                                        <div id="replies-grid" class="comments-row"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                

                <!-- Tab4 Content - CONNECTINS -->
                <div id="tab-connections" class="tab-content">
                    <div class="content-tab-connections">
                        <div class='toggle-tab toggle-tab-connections'>
                            <div id="connections_count" class='tabs'>
                                <?php if($show_friends_tab || $myprofile) { ?>
                                    <div class='tab active'><span class="c_friends"><?php echo $connections_total[0]['friends'] ?></span> Friends</div>
                                <?php } ?>
                                <?php if($show_following_tab || $myprofile) { ?>
                                    <div class='tab <?php echo (!$show_friends_tab && !$myprofile) ? "active" : "" ?>'><span class="c_followers"><?php echo $connections_total[0]['followers'] ?></span> Followers</div>
                                <?php } ?>
                                <?php if($show_followers_tab || $myprofile) { ?>    
                                    <div class='tab <?php echo (!$show_friends_tab && !$show_following_tab && !$myprofile) ? "active" : "" ?>'><span class="c_following"><?php echo $connections_total[0]['following'] ?></span> Following</div>
                                <?php } ?>   
                                    
                                <?php if($myprofile) { ?>    
                                    <div class='tab'><span class="c_requests"><?php echo $connections_total[0]['request'] ?></span> Request</div>
                                    <div class='tab'><span class="c_views"><?php echo $connections_total[0]['profileview'] ?></span> Views</div>
                                <?php } ?>
                            </div>
                            <div class='panels'>
                                <div class="tabs-right-content">
                                    <?php if($myprofile) { ?>
                                        <div class="connection-privacy-option connection-privacy-friends">
                                            <div class="connections-privacy toggle-content">
                                                    <?php
                                                        $active_friends_text = "Anyone";
                                                        if($profile_settings->friends == 1) {
                                                            $active_friends_text = "Followers & Friends";
                                                        } else if($profile_settings->friends == 2) {
                                                            $active_friends_text = "Friends only";
                                                        } else if($profile_settings->friends == 3) {
                                                            $active_friends_text = "Only me";
                                                        }
                                                    ?>
                                                    Privacy: <span class="profile-settings-friends"><?php echo $active_friends_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                                                    <ul class="global-action-nav toggle-close profile-settings">
                                                            <li <?php echo $profile_settings->friends == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="friends" data-value="0">Anyone</a></li>
                                                            <li <?php echo $profile_settings->friends == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="friends" data-value="1">Followers & Friends</a></li>
                                                            <li <?php echo $profile_settings->friends == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="friends" data-value="2">Friends only</a></li>
                                                            <li <?php echo $profile_settings->friends == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="friends" data-value="3">Only me</a></li>
                                                    </ul>	
                                            </div>
                                        </div>

                                        <div class="connection-privacy-option connection-privacy-followers" style="display:none">
                                            <div class="connections-privacy toggle-content">
                                                    <?php
                                                        $active_followers_text = "Anyone";
                                                        if($profile_settings->followers == 1) {
                                                            $active_followers_text = "Followers & Friends";
                                                        } else if($profile_settings->followers == 2) {
                                                            $active_followers_text = "Friends only";
                                                        } else if($profile_settings->followers == 3) {
                                                            $active_followers_text = "Only me";
                                                        }
                                                    ?>
                                                    Privacy: <span class="profile-settings-followers"><?php echo $active_followers_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                                                    <ul class="global-action-nav toggle-close profile-settings">
                                                            <li <?php echo $profile_settings->followers == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followers" data-value="0">Anyone</a></li>
                                                            <li <?php echo $profile_settings->followers == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followers" data-value="1">Followers & Friends</a></li>
                                                            <li <?php echo $profile_settings->followers == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followers" data-value="2">Friends only</a></li>
                                                            <li <?php echo $profile_settings->followers == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="followers" data-value="3">Only me</a></li>
                                                    </ul>	
                                            </div>
                                        </div>

                                        <div class="connection-privacy-option connection-privacy-following" style="display:none"> 
                                            <div class="connections-privacy toggle-content">
                                                   <?php
                                                        $active_following_text = "Anyone";
                                                        if($profile_settings->following == 1) {
                                                            $active_following_text = "Followers & Friends";
                                                        } else if($profile_settings->following == 2) {
                                                            $active_following_text = "Friends only";
                                                        } else if($profile_settings->following == 3) {
                                                            $active_following_text = "Only me";
                                                        }
                                                    ?>
                                                    Privacy: <span class="profile-settings-following"><?php echo $active_following_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                                                    <ul class="global-action-nav toggle-close profile-settings">
                                                            <li <?php echo $profile_settings->following == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="following" data-value="0">Anyone</a></li>
                                                            <li <?php echo $profile_settings->following == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="following" data-value="1">Followers & Friends</a></li>
                                                            <li <?php echo $profile_settings->following == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="following" data-value="2">Friends only</a></li>
                                                            <li <?php echo $profile_settings->following == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="following" data-value="3">Only me</a></li>
                                                    </ul>	
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="connections-filter toggle-content connection-filter-friends"  style="display:block">
                                        <!-- adding class "toggle-open" -->
                                        <span class="active_connection_filter_text">Most recent</span><i class="icon i-dropdown toggle-open"></i>
                                        <ul class="global-action-nav toggle-close w185" data-filter="friends">
                                                <li class="active"><a href="javascript:void(0)" class="connection_filter_action" rel="0">Most recent</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="1">Alphabetical</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="2">By number of followers</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="3">By number of mutual friends</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="4">By number of similar interests</a></li>
                                        </ul>	
                                    </div>
                                    <div class="connections-filter toggle-content connection-filter-followers" style="display:none">
                                        <!-- adding class "toggle-open" -->
                                        <span class="active_connection_filter_text">Most recent</span><i class="icon i-dropdown toggle-open"></i>
                                        <ul class="global-action-nav toggle-close w185" data-filter="followers">
                                                <li class="active"><a href="javascript:void(0)" class="connection_filter_action" rel="0">Most recent</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="1">Alphabetical</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="2">By number of followers</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="3">By number of mutual friends</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="4">By number of similar interests</a></li>
                                        </ul>	
                                    </div>
                                    <div class="connections-filter toggle-content connection-filter-following" style="display:none">
                                        <!-- adding class "toggle-open" -->
                                        <span class="active_connection_filter_text">Most recent</span><i class="icon i-dropdown toggle-open"></i>
                                        <ul class="global-action-nav toggle-close w185" data-filter="following">
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="0">Most recent</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="1">Alphabetical</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="2">By number of followers</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="3">By number of mutual friends</a></li>
                                                <li class=""><a href="javascript:void(0)" class="connection_filter_action" rel="4">By number of similar interests</a></li>
                                        </ul>	
                                    </div>
                                    
                            </div>
                                <?php if($show_friends_tab || $myprofile) { ?>
                                    <!-- TAB FRIENDS ============================================================== -->
                                    <div id="friends-connections-tab" class='panel' style="display:block"></div>
                                <?php } ?>    
                                    
                                <?php if($show_followers_tab || $myprofile) { ?>    
                                    <!-- TAB FOLLOWERS ============================================================== -->
                                    <div id="followers-connections-tab" class='panel' style="display:<?php echo (!$show_friends_tab && !$myprofile) ? "block" : "none" ?>"></div>
                                <?php } ?>    

                                <?php if($show_following_tab || $myprofile) { ?>    
                                    <!-- TAB FOLLOWING ============================================================== -->
                                    <div id="following-connections-tab" class='panel' style="display:<?php echo (!$show_friends_tab && !$show_followers_tab && !$myprofile) ? "block" : "none" ?>"></div>
                                <?php } ?>
                                
                                <?php if($myprofile) { ?>
                                    <!-- TAB REQUEST ============================================================== -->
                                    <div id="requests-connections-tab" class='panel'></div>

                                    <!-- TAB VIEWS ============================================================== -->
                                    <div id="views-connections-tab" class='panel tab-content-views'></div>
                                <?php } ?>    
                            </div>
                        </div>



                    </div>
                </div>

                <?php if($image_tab_privacy) { ?>
                    <!-- Tab5 Content - IMAGES -->
                    <div id="tab-images" class="tab-content">
                        <div class="content-tab-images">
                            <!-- ===== CONTENT HERE ==== -->
                            <div class="image-row content-flex">
                                <div><?php echo $images[0]['total_image'] ?> Images</div>
                                <div class="image-privacy toggle-content">
                                    <?php if ($myprofile) { ?>
                                        <div class="comments-privacy toggle-content">
                                            <?php
                                                $active_imt_text = "Anyone";
                                                if($profile_settings->image_tab == 1) {
                                                    $active_imt_text = "Followers & Friends";
                                                } else if($profile_settings->image_tab == 2) {
                                                    $active_imt_text = "Friends only";
                                                } else if($profile_settings->image_tab == 3) {
                                                    $active_imt_text = "Only me";
                                                }
                                            ?>
                                            Privacy: <span class="profile-settings-image_tab" style="left: 0;"><?php echo $active_imt_text ?></span><i class="icon i-dropdown toggle-open"></i>

                                            <ul class="global-action-nav toggle-close profile-settings">
                                                <li <?php echo $profile_settings->image_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="image_tab" data-value="0">Anyone</a></li>
                                                <li <?php echo $profile_settings->image_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="image_tab" data-value="1">Followers &amp; Friends</a></li>
                                                <li <?php echo $profile_settings->image_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="image_tab" data-value="2">Friends only</a></li>
                                                <li <?php echo $profile_settings->image_tab == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="image_tab" data-value="3">Only me</a></li>
                                            </ul>	
                                        </div>
                                    <?php } ?>	
                                </div>
                            </div>

                            <!-- ===== Put Container Here ==== -->
                            <div id="image-row" class="image-row"></div>
                            <div class="loader-content-image" style="text-align:center"></div>
                        </div>
                    </div>
                <?php } ?>    
            </div>

        </div>
</div>

@include('profile::new.modals._crop-profile-image')

@include('home::partials._report-form')
@include('topics::modals._strings-modal')

@stop