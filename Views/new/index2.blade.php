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
<!-- new class "page-creator" -->
<div id="page-profile" class="page-profile <?php echo ($myprofile) ? "owned" : "view" ?>">
    <div class="p-cover-content"> <!-- new class -->
        <!-- <div class="p-cover-photo" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)"></div> -->
        <?php if (!empty($user->userbasicinfo->coverphoto)) { ?>
            <div class="p-cover-photo" style="background-image: url('<?php echo Config::get('app.url') . 'upload/user/cover/original/' . $user->userbasicinfo->coverphoto ?>')"></div>
        <?php } else { ?>
            <div class="p-cover-photo" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)"></div>
        <?php } ?>
        <div class="p-shading"></div>

        <div class="cp-title-row">

            <div class="cp-profile-content">

                {!! Form::open(['id' => 'upload-profile-container' , 'enctype' => 'multipart/form-data']) !!}
                <div class="cp-profile-picture">
                        <!-- <img class="profile-pic" src="default-profile-pic.jpg"/> -->
                    <img class="profile-pic" src='{{ Config::get('app.url') }}{{ !empty($user->userbasicinfo->profilephoto) && isset($user->userbasicinfo) && $user->userbasicinfo->profilephoto != 'default-profile-pic.jpg' ? "upload/user/profile/thumbs/{$user->userbasicinfo->profilephoto}" : "images/profile/default-profile-pic.jpg" }}' />
                    @if($myprofile)
                    <!-- if owner -->
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
                        <i class="icon i-credentials"></i> Masteral, Web Design & Web Programming, New York University

                        <!-- credentials -->
                        <div class="credentials-content">
                            <!-- personal -->
                            <div class="card card-credential">

                                <div class="card-header-row">
                                    <div class="card-header">
                                        Credential Selector
                                    </div>
                                    <div class="card-header-after">
                                        <i class="icon i-cclose"></i>
                                    </div>
                                </div>

                                <div class="card-content">
                                    <div class="card-content-inner">

                                        <div class="content-list">
                                            <!-- ============ EDUCATION ============ -->
                                            <div class="list-item content-media-list list-credential lc-selected">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-selected"></i><i class="icon i-education"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Masteral, Web Design & Web Programming, 111111111111111
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- list-item -->

                                            <!-- ============ WORK ============ -->
                                            <div class="list-item content-media-list list-credential">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-work"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Designer, Rappler PH, Sta. Rosa, Laguna
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- list-item -->

                                            <!-- ============ GENERAL ============ -->
                                            <div class="list-item content-media-list list-credential">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-general"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Trex, Jungle of the world
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- list-item -->

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- if owner -->

                </div>
            </div>

            <div class="cp-after">

                <div class="content-insights">
                    <div class="ci-action">
                        @if($myprofile)
                        <!-- Edit Button -->
                        {!! Form::open(['id' => 'upload-cover-container' , 'enctype' => 'multipart/form-data']) !!}
                            <button type="button" name="button" class="btn btn-editcover color-black-only upload-cover-profile">Edit Cover </button>
                            <button type="button" name="button" class="btn btn-editprofile color-black-only">Edit Profile </button>
                        {!! Form::close() !!}      
                        @else
                            <!-- disable button -->
                            <!-- <div class="btn btn-disabled"><i class="icon i-follow"></i> Follow </div>-->
                            <!-- <div class="btn btn-disabled"><i class="icon i-addfriend"></i> Add Friend </div>-->

                            <!-- Follow and Add Friend -->
                            <!--
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
                                <button type="button" name="button" class="btn color-black con-add-aa <?php echo count($con_acquaintances) > 0 ? "con-request-aa rs-aa-action" : "" ?>" data-client-id="{{ $user->profile_code }}">
                                    <i class="icon i-follow"></i> <span><?php echo count($con_acquaintances) > 0 ? "Request Sent" : "Follow" ?></span>
                                </button>
                            <?php } ?>
                            -->

                            @if ($connection_status->following_status == 1)
                                    <button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="request"><i></i>Follow</button>
                            @elseif ($connection_status->following_status == 2)
                                    <button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="accept_acquaintance_request"><i></i>Accept</button>
                            @elseif ($connection_status->following_status == 3)
                                    <button href="#" class="userDetails-button userDetails-follow-btn userDetails-following" rel="unfollow"><i></i>Following</button>
                            @elseif ($connection_status->following_status == 4)
                                    <button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="cancel_acquaintance_request"><i></i>Cancel Request</button>
                            @elseif ($connection_status->following_status == 5)
                                    <button href="#" class="userDetails-button userDetails-follow-btn userDetails-follow" rel="request"><i></i>Follow</button>
                            @elseif ($connection_status->following_status == 6)
                                    <button href="#" class="userDetails-button userDetails-follow-btn userDetails-following" rel="unfollow"><i></i>Following</button>
                            @endif
                            
                            
                            <!--
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
                                <button type="button" name="button" class="btn color-black con-add-af <?php echo count($con_friends) > 0 ? "con-request-af rs-action" : "" ?>" data-client-id="{{ $user->profile_code }}">
                                    <i class="icon i-addfriend"></i> <span><?php echo count($con_friends) > 0 ? "Request Sent" : "Add Friend" ?></span>
                                </button>
                            <?php } ?>
                            -->

                            @if ($connection_status->friend_status == 1)
                                        <button href="#" class="userDetails-button userDetails-add-btn userDetails-friends" rel="unfriend"><i></i>Friends</button>
                                @elseif ($connection_status->friend_status == 2)
                                        <button href="#" class="userDetails-button userDetails-add-btn userDetails-add" rel="accept_friend_request"><i></i>Accept</button>
                                @elseif ($connection_status->friend_status == 3)
                                        <button href="#" class="userDetails-button userDetails-add-btn userDetails-add" rel="cancel_friend_request"><i></i>Cancel Request</button>
                                @elseif ($connection_status->friend_status == 4)
                                        <button href="#" class="userDetails-button userDetails-add-btn userDetails-add" rel="add"><i></i>Add Friend</button>
                                @endif

                            @endif
                    </div>

                    <div class="ci-rating">
                        <div class="rating-icon">
                            <i class="icon i-default"></i>
                            <i class="icon i-positive"></i>
                            <i class="icon i-negative"></i>
                            <i class="icon i-equal"></i>
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
    <div class="tabbar-container"><!-- new class -->

        <div class="tabbar-header">

            <!-- Tab link -->
            <div id="tabbar" class="tabbar">
                <div class="tabbar-link active" data-tab="tab-about" title="" aria-selected="true"><i class="icon i-about"></i> ABOUT</div>
                <div class="tabbar-link" data-tab="tab-feed" title=""><i class="icon i-feed"></i> CONTENT FEED</div>
                <div class="tabbar-link" data-tab="tab-comments" title=""><i class="icon i-comments"></i> COMMENTS</div>
                <div class="tabbar-link" data-tab="tab-connections" title=""><i class="icon i-connections"></i> CONNECTIONS</div>
                <div class="tabbar-link" data-tab="tab-images" title=""><i class="icon i-images"></i> IMAGES</div>
                <span class="tabbar-link-highlight"></span>
            </div>

            <!-- UST -->
            <div class="content-ust">
                <?php if (count($top_strings) > 0) { ?>
                    <?php foreach ($top_strings as $string) { ?>

                        <?php if (!empty($string['coverphoto'])) { ?>
                            <div class="ust-item" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string['coverphoto'] ?>');">
                            <?php } else { ?>
                                <div class="ust-item" style="background-color:<?php echo $string['color'] ?>;">    
                                <?php } ?>
                                <div class="ust-shading"></div>
                                <a href='<?php echo URL::route('view-string', $string['slug']) ?>' target="_blank">~<?php echo $string['string_alias'] ?></a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>

            </div>
            <!-- .tabbar-header -->

            <div class="tab-wrap">

                <!-- Tab1 Content ABOUT -->
                <div id="tab-about" class="tab-content active">
                    <!-- content tab - INFO -->
                    <div class="content-tab-about">

                        <div class="content-tab-column">
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
                                                Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>
                                                <ul class="global-action-nav toggle-close">
                                                    <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                    <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                    <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                    <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                </ul>

                                            </div>
                                            <a href="javascript:void(0)">Edit</a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="card-content">
                                    <div class="card-content-inner">
                                        <p><?php echo $user_profile[0]->bio_info ?></p>

                                        <p class="content-footer">User since <?php echo \Carbon::parse($user_profile[0]->register_date)->format('F d, Y') ?></p>
                                    </div>
                                </div>
                            </div>

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
                                                    <i class="icon i-rating-negative"></i><span class="txt-yea">9.9k</span> <span>|</span> <span class="txt-nay">9.9k</span>
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
                                                    Articles
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
                                            <!-- ============ NEW ============ -->
                                            <div class="list-item content-media-list item-new-content">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-add"></i>

                                                        <div class="add-new-content">
                                                            <div class="add-link" data-target="location">
                                                                <div class="add-icon"><i class="icon i-location"></i></div>
                                                                Location
                                                            </div>
                                                            
                                                            <?php if(empty($user->userbasicinfo->politics)) { ?>
                                                                <div class="add-link" data-target="political">
                                                                    <div class="add-icon"><i class="icon i-political-view"></i></div>
                                                                    Political views
                                                                </div>
                                                            <?php } ?>
                                                            
                                                            <?php if(empty($user->userbasicinfo->religion)) { ?>
                                                                <div class="add-link" data-target="religion">
                                                                    <div class="add-icon"><i class="icon i-religion"></i></div>
                                                                    Religion
                                                                </div>
                                                            <?php } ?>
                                                            
                                                            <?php if(empty($user->userbasicinfo->bloodtype)) { ?>
                                                                <div class="add-link" data-target="bloodtype">
                                                                    <div class="add-icon"><i class="icon i-bloodtype"></i></div>
                                                                    Bloodtype
                                                                </div>
                                                            <?php } ?>
                                                            
                                                            <div class="add-link" data-target="contact">
                                                                <div class="add-icon"><i class="icon i-contact"></i></div>
                                                                Contact
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            New
                                                        </div>
                                                        <!-- <div class="item-after">
                                                                Followers
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div><!-- list-item -->

                                            <!-- ============ ADD LOCATION ============ -->
                                            <div class="list-item content-media-list item-location on-add item-add-location">
                                                <!-- if add -->
                                                <div class="content-list-add">
                                                    <form>
                                                        <div class="cl-add-header">
                                                            <div class="item-title">Add your location</div>
                                                            <div class="item-close"><i class="icon i-nclose"></i></div>
                                                        </div>
                                                        <div class="cl-add-body">
                                                            <div class="item-input">
                                                                <label>Your location</label><input type="text" name="" value="" placeholder="Where do you live?">
                                                            </div>
                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <!-- <button type="button" class="btn" name="button">Remove</button> -->
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if add -->
                                            </div>

                                            <?php if(empty($user->userbasicinfo->politics)) { ?>
                                                <!-- ============ ADD POLITICAL VIEW ============ -->
                                                {!! Form::open(['id' => 'save-political', 'rel' => 'save-political']) !!}
                                                    <div class="list-item content-media-list item-location on-add item-add-political">
                                                        <!-- if add -->
                                                        <div class="content-list-add">
                                                            <form>
                                                                <div class="cl-add-header">
                                                                    <div class="item-title">Add your political view</div>
                                                                    <div class="item-close"><i class="icon i-nclose"></i></div>
                                                                </div>
                                                                <div class="cl-add-body">
                                                                    <div class="item-input">
                                                                        <label>Your view</label><input type="text" name="my-politics" required value="" placeholder="Your political view">
                                                                    </div>
                                                                </div>
                                                                <div class="cl-add-footer">
                                                                    <div class="item-title"></div>
                                                                    <div class="item-after">
                                                                        <button type="submit" class="btn-raised" name="button">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div><!-- if add -->
                                                    </div>
                                                {!! Form::close() !!}
                                            <?php } ?>
                                                
                                            <?php if(empty($user->userbasicinfo->religion)) { ?>
                                                <!-- ============ ADD RELIGION ============ -->
                                                {!! Form::open(['id' => 'save-religion', 'rel' => 'save-religion']) !!}    
                                                    <div class="list-item content-media-list item-location on-add item-add-religion">
                                                        <!-- if add -->
                                                        <div class="content-list-add">
                                                            <form>
                                                                <div class="cl-add-header">
                                                                    <div class="item-title">Add your religion</div>
                                                                    <div class="item-close"><i class="icon i-nclose"></i></div>
                                                                </div>
                                                                <div class="cl-add-body">
                                                                    <div class="item-input">
                                                                        <label>Your religion</label><input type="text" name="my-religion" required value="" placeholder="Your religion">
                                                                    </div>
                                                                </div>
                                                                <div class="cl-add-footer">
                                                                    <div class="item-title"></div>
                                                                    <div class="item-after">
                                                                        <button type="submit" class="btn-raised" name="button">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div><!-- if add -->
                                                    </div>
                                                {!! Form::close() !!}
                                            <?php } ?>    

                                            <?php if(empty($user->userbasicinfo->bloodtype)) { ?>
                                                <!-- ============ ADD BLOODTYPE ============ -->
                                                {!! Form::open(['id' => 'save-blood-type', 'rel' => 'save-blood-type']) !!}
                                                    <div class="list-item content-media-list item-location on-add item-add-bloodtype">
                                                        <!-- if add -->
                                                        <div class="content-list-add">
                                                            <form>
                                                                <div class="cl-add-header">
                                                                    <div class="item-title">Add your bloodtype</div>
                                                                    <div class="item-close"><i class="icon i-nclose"></i></div>
                                                                </div>
                                                                <div class="cl-add-body">
                                                                    <div class="item-input">
                                                                        <label>Your bloodtype</label>
                                                                        <select class="txt-bloodtype" name="my-bloodtype" required>
                                                                            <option value="" disabled selected>Select your bloodtype</option>
                                                                            <?php foreach(Config::get('helper.bloodtype') as $bloodtype) { ?>
                                                                                <option value="<?php echo $bloodtype ?>" ><?php echo $bloodtype ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="cl-add-footer">
                                                                    <div class="item-title"></div>
                                                                    <div class="item-after">
                                                                        <button type="submit" class="btn-raised" name="save-blood-type">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div><!-- if add -->
                                                    </div>
                                                {!! Form::close() !!}
                                            <?php } ?>
                                                
                                            <!-- ============ ADD CONTACT ============ -->
                                            <div class="list-item content-media-list item-location on-add item-add-contact">
                                                <!-- if add -->
                                                <div class="content-list-add">
                                                    <form>
                                                        <div class="cl-add-header">
                                                            <div class="item-title">Add your contact</div>
                                                            <div class="item-close"><i class="icon i-nclose"></i></div>
                                                        </div>
                                                        <div class="cl-add-body">
                                                            <div class="item-input">
                                                                <label>Your contact(s)</label>
                                                                <div class="contact-content">

                                                                    <div class="contact-text">
                                                                        <input type="text" name="" value="" placeholder="Contact number / telephone">
                                                                    </div>
                                                                    <!-- <div class="contact-text">
                                                                            <input type="text" name="" value="" placeholder="Contact number / telephone">
                                                                            <input type="button" value="Remove" class="btn-removecontact">
                                                                    </div>
                                                                    <div class="contact-text">
                                                                            <input type="text" name="" value="" placeholder="Contact number / telephone">
                                                                            <input type="button" value="Remove" class="btn-removecontact">
                                                                    </div> -->

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn btn-addcontact" name="button">Add contact field</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if add -->
                                            </div>


                                            <!-- ============ FULLNAME ============ -->
                                            <div class="list-item content-media-list item-fullname">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-fullname"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div id="basic-info-text" class="stats-title">
                                                            <?php echo $user->first_name .' '. (isset($user->userbasicinfo) && !empty($user->userbasicinfo->middlename) ? $user->userbasicinfo->middlename : "") .' '. $user->last_name  ?>
                                                        </div>
                                                        <!-- <div class="item-after">
                                                                Followers
                                                        </div> -->
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    {!! Form::open(['id' => 'basic-info']) !!}
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your name</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>First Name</label><input type="text" name="first_name" value="<?php echo $user->first_name ?>">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Middle Name</label><input type="text" name="middle_name" value="<?php echo (isset($user->userbasicinfo) && !empty($user->userbasicinfo->middlename) ? $user->userbasicinfo->middlename : "") ?>">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Last Name</label><input type="text" name="last_name" value="<?php echo $user->last_name ?>">
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title">You can only change your name in the next 90 days</div>
                                                            <div class="item-after">
                                                                <button type="button" class="update-profile-info" name="basic-info" rel="basic-info"> Save</button>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ LOCATION ============ -->
                                            <div class="list-item content-media-list item-location">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-location"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            The Enclave, Angeles
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="toggle-content">
                                                            Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                            <ul class="global-action-nav toggle-close">
                                                                <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-premove">
                                                            Remove
                                                        </div>
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your location</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Your location</label><input type="text" name="" value="">
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn" name="button">Remove</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ GENDER ============ -->
                                            <div class="list-item content-media-list item-gender">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-gender"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div id="gender-info-text" class="stats-title">
                                                            <?php echo $user->gender == "N" ? "Others, {$user->gender_custom}" : ($user->gender == "M" ? "Male" : "Female") ?>
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="toggle-content">
                                                            Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                            <ul class="global-action-nav toggle-close">
                                                                <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-premove">
                                                            Remove
                                                        </div>
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    {!! Form::open(['id' => 'gender-info']) !!}
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your gender</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Your gender</label>
                                                                <select class="txt-gender" name="gender">
                                                                    <option value="M" <?php echo $user->gender == "M" ? "selected" : "" ?>>Male</option>
                                                                    <option value="F" <?php echo $user->gender == "F" ? "selected" : "" ?>>Female</option>
                                                                    <option value="N" <?php echo $user->gender == "N" ? "selected" : "" ?>>Others</option>
                                                                </select>
                                                                <input type="text" name="custom-gender" value="<?php echo $user->gender_custom ?>" class="txt-custom-gender" placeholder="Custom gender"
                                                                    <?php echo $user->gender == "N" ? 'style=display:inline-block' : "" ?>>
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title">You can change your gender only once</div>
                                                            <div class="item-after">
                                                                <button type="button" class="update-profile-info btn-raised" name="gender-info" rel="gender-info">Save</button>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ BIRTHDATE ============ -->
                                            <div class="list-item content-media-list item-birthdate">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-birthdate"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div id="birthdate-text" class="stats-title">
                                                            <?php echo Config::get('helper.months')[$user->userbasicinfo->birthmonth].' '.$user->userbasicinfo->birthday .', '.$user->birthyear ?>
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="toggle-content">
                                                            Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                            <ul class="global-action-nav toggle-close">
                                                                <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                            </ul>

                                                        </div>
                                                        <div class="btn-premove">
                                                            Remove
                                                        </div>
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    {!! Form::open(['id' => 'birthdate']) !!}
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your birthdate</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Birthday</label>
                                                                <div class="birthdate-content">
                                                                    <?php
                                                                        $current_day    = Carbon::today();
                                                                        $current_year   = date('Y', strtotime($current_day));
                                                                        $last_day       = date('t', strtotime($current_day));
                                                                    ?>
                                                                    <select class="txt-month" name="month">
                                                                        <?php for($i = 1; $i <= 12; $i++) { ?>
                                                                            <?php $month = $i < 10 ? "0".$i : $i ?>
                                                                            <option value="<?php echo $i ?>" <?php echo $user->userbasicinfo->birthmonth == $month ? "selected" : "" ?>><?php echo Config::get('helper.months')[$i] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <select class="txt-day" name="day">
                                                                        
                                                                        <?php for($i = 1; $i <= $last_day; $i++) { ?>
                                                                            <?php $day = $i < 10 ? "0".$i : $i ?>
                                                                            <option value="<?php echo $day ?>" <?php echo $user->userbasicinfo->birthday == $day ? "selected" : "" ?>><?php echo $day ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <select class="txt-year" name="year">
                                                                        <?php for($i = $current_year; $i >= 1970; $i--) { ?>
                                                                            <option value="<?php echo $i ?>" <?php echo $user->birthyear == $i ? "selected" : "" ?>><?php echo $i ?></option>
                                                                        <?php } ?>    
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title">You can change your gender only once</div>
                                                            <div class="item-after">
                                                                <button type="button" class="update-profile-info btn-raised" name="birthdate" rel="birthdate">Save</button>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <?php if(!empty($user->userbasicinfo->politics)) { ?>
                                                <!-- ============ POLITICAL VIEW ============ -->
                                                <div class="list-item content-media-list item-political-view">
                                                    <div class="content-list-inner">
                                                        <div class="item-media">
                                                            <i class="icon i-political-view"></i>
                                                        </div>

                                                        <div class="item-inner">
                                                            <div id="politics-text" class="stats-title">
                                                                <?php echo $user->userbasicinfo->politics ?>
                                                            </div>
                                                        </div>

                                                        <div class="content-action">
                                                            <div class="toggle-content">
                                                                Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                                <ul class="global-action-nav toggle-close">
                                                                    <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                                </ul>

                                                            </div>

                                                            <div class="btn-premove">
                                                                Remove
                                                            </div>
                                                            <div class="btn-pedit">
                                                                Edit
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- if edit -->
                                                    <div class="content-list-edit">
                                                        {!! Form::open(['id' => 'politics']) !!}
                                                            <div class="cl-edit-header">
                                                                <div class="item-title">Edit your political view</div>
                                                                <div class="item-close"><i class="icon i-eclose"></i></div>
                                                            </div>
                                                            <div class="cl-edit-body">
                                                                <div class="item-input">
                                                                    <label>Your view</label><input type="text" name="politics-view" value="<?php echo $user->userbasicinfo->politics ?>">
                                                                </div>
                                                            </div>
                                                            <div class="cl-edit-footer">
                                                                <div class="item-title"></div>
                                                                <div class="item-after">
                                                                    <button type="button" class="update-profile-info btn-raised" name="politics" rel="politics">Save</button>
                                                                </div>
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div><!-- if edit -->

                                                </div><!-- list-item -->
                                            <?php } ?>
                                                
                                            <?php if(!empty($user->userbasicinfo->religion)) { ?>
                                                <!-- ============ RELIGION ============ -->
                                                <div class="list-item content-media-list item-religion">
                                                    <div class="content-list-inner">
                                                        <div class="item-media">
                                                            <i class="icon i-religion"></i>
                                                        </div>

                                                        <div class="item-inner">
                                                            <div id="religion-text" class="stats-title">
                                                                <?php echo $user->userbasicinfo->religion ?>
                                                            </div>
                                                        </div>

                                                        <div class="content-action">
                                                            <div class="toggle-content">
                                                                Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                                <ul class="global-action-nav toggle-close">
                                                                    <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                                </ul>

                                                            </div>

                                                            <div class="btn-premove">
                                                                Remove
                                                            </div>
                                                            <div class="btn-pedit">
                                                                Edit
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- if edit -->
                                                    <div class="content-list-edit">
                                                        {!! Form::open(['id' => 'religion']) !!}
                                                            <div class="cl-edit-header">
                                                                <div class="item-title">Edit your religion</div>
                                                                <div class="item-close"><i class="icon i-eclose"></i></div>
                                                            </div>
                                                            <div class="cl-edit-body">
                                                                <div class="item-input">
                                                                    <label>Your religion</label><input type="text" name="my-religion" value="<?php echo $user->userbasicinfo->religion ?>">
                                                                </div>
                                                            </div>
                                                            <div class="cl-edit-footer">
                                                                <div class="item-title"></div>
                                                                <div class="item-after">
                                                                    <button type="button" class="update-profile-info btn-raised" name="religion" rel="religion">Save</button>
                                                                </div>
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div><!-- if edit -->

                                                </div><!-- list-item -->
                                            <?php } ?>
                                                
                                            <?php if(!empty($user->userbasicinfo->bloodtype)) { ?>
                                                <!-- ============ BLOODTYPE ============ -->
                                                <div class="list-item content-media-list item-bloodtype">
                                                    <div class="content-list-inner">
                                                        <div class="item-media">
                                                            <i class="icon i-bloodtype"></i>
                                                        </div>

                                                        <div class="item-inner">
                                                            <div id="bloodtype-text" class="stats-title">
                                                                Bloodtype <?php echo $user->userbasicinfo->bloodtype ?>
                                                            </div>
                                                        </div>

                                                        <div class="content-action">
                                                            <div class="toggle-content">
                                                                Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                                <ul class="global-action-nav toggle-close">
                                                                    <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                    <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                                </ul>

                                                            </div>

                                                            <div class="btn-premove">
                                                                Remove
                                                            </div>
                                                            <div class="btn-pedit">
                                                                Edit
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- FOR EDIT BLOODTYPE -->
                                                    <div class="content-list-edit">
                                                        {!! Form::open(['id' => 'bloodtype']) !!}
                                                            <div class="cl-edit-header">
                                                                <div class="item-title">Edit your bloodtype</div>
                                                                <div class="item-close"><i class="icon i-eclose"></i></div>
                                                            </div>
                                                            <div class="cl-edit-body">
                                                                <div class="item-input">
                                                                    <label>Your bloodtype</label>
                                                                    <select class="txt-bloodtype" name="my-bloodtype">
                                                                        <?php foreach(Config::get('helper.bloodtype') as $bloodtype) { ?>
                                                                            <option value="<?php echo $bloodtype ?>" <?php echo $bloodtype == $user->userbasicinfo->bloodtype ?>><?php echo $bloodtype ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="cl-edit-footer">
                                                                <div class="item-title"></div>
                                                                <div class="item-after">
                                                                    <button type="button" class="update-profile-info btn-raised" name="bloodtype" rel="bloodtype">Save</button>
                                                                </div>
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div><!-- list-item -->
                                            <?php } ?>
                                            
                                            <!-- ============ CONTACT ============ -->
                                            <div class="list-item content-media-list item-contact">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-contact"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            + 552 552 4444 <br>
                                                            + 885 223 <br>
                                                            email@emailurl.com
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="toggle-content">
                                                            Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                                            <ul class="global-action-nav toggle-close">
                                                                <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                                <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                                <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                                <li class=""><a href="javascript:void(0)">Only me</a></li>
                                                            </ul>

                                                        </div>

                                                        <div class="btn-premove">
                                                            Remove
                                                        </div>
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your contact</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Your contact(s)</label>
                                                                <div class="contact-content">
                                                                    <div class="contact-text">
                                                                        <input type="text" name="" value="" placeholder="Contact number / telephone">
                                                                    </div>
                                                                    <div class="contact-text">
                                                                        <input type="text" name="" value="" placeholder="Contact number / telephone">
                                                                        <input type="button" value="Remove" class="btn-removecontact">
                                                                    </div>
                                                                    <div class="contact-text">
                                                                        <input type="text" name="" value="" placeholder="Contact number / telephone">
                                                                        <input type="button" value="Remove" class="btn-removecontact">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- credentials -->
                            <div class="card card-credentials">
                                <div class="card-header-row">
                                    <div class="card-header">
                                        Credentials
                                    </div>
                                    <div class="card-header-after">
                                        <div class="toggle-content">
                                            Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                            <ul class="global-action-nav toggle-close">
                                                <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                <li class=""><a href="javascript:void(0)">Only me</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-content-inner">

                                        <div class="content-list">
                                            <!-- ============ NEW ============ -->
                                            <div class="list-item content-media-list item-new-content">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-add"></i>

                                                        <div class="add-content add-new-content">
                                                            <div class="add-link" data-target="general">
                                                                <div class="add-icon"><i class="icon i-general"></i></div>
                                                                General
                                                            </div>
                                                            <div class="add-link" data-target="education">
                                                                <div class="add-icon"><i class="icon i-education"></i></div>
                                                                Education
                                                            </div>
                                                            <div class="add-link" data-target="work">
                                                                <div class="add-icon"><i class="icon i-work"></i></div>
                                                                Work
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            New
                                                        </div>
                                                        <!-- <div class="item-after">
                                                                Followers
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div><!-- list-item -->

                                            <!-- ============ ADD GENERAL ============ -->
                                            <div class="list-item content-media-list item-general on-add item-add-general">
                                                <!-- if add -->
                                                <div class="content-list-add">
                                                    <form>
                                                        <div class="cl-add-header">
                                                            <div class="item-title">Add general information</div>
                                                            <div class="item-close"><i class="icon i-nclose"></i></div>
                                                        </div>
                                                        <div class="cl-add-body">
                                                            <div class="item-input">
                                                                <label>Information</label><input type="text" name="" value="" placeholder="Describe your credential">
                                                            </div>
                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <!-- <button type="button" class="btn" name="button">Remove</button> -->
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if add -->
                                            </div>

                                            <!-- ============ ADD EDUCATION ============ -->
                                            <div class="list-item content-media-list item-education on-add item-add-education">
                                                <!-- if add -->
                                                <div class="content-list-add">
                                                    <form>
                                                        <div class="cl-add-header">
                                                            <div class="item-title">Add your education</div>
                                                            <div class="item-close"><i class="icon i-nclose"></i></div>
                                                        </div>
                                                        <div class="cl-add-body">
                                                            <div class="item-input">
                                                                <label>School name</label><input type="text" name="" value="" placeholder="Name of your school">
                                                            </div>
                                                            <div class="item-input item-input-educ">
                                                                <label>Educational level</label>
                                                                <div class="item-input-radio">
                                                                    <label>
                                                                        <input type="radio" id="txt_highschool" name="radio" />
                                                                        <label for="txt_highschool"><span></span>Highschool</label>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" id="txt_college" name="radio" />
                                                                        <label for="txt_college"><span></span>College</label>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Major / Course</label><input type="text" name="" value="" placeholder="What’s your course?">
                                                            </div>

                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title">
                                                                <div class="item-input item-input-fromto">
                                                                    <label>School year</label>
                                                                    <div class="item-input-row">
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="From">
                                                                        </div>
                                                                        <span class="dash"> - </span>
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="To">
                                                                        </div>

                                                                        <div class="item-input-radio">
                                                                            <label>
                                                                                <input type="checkbox" checked="" value="" id="" name="education"> Graduated?
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if add -->
                                            </div>

                                            <!-- ============ ADD WORK ============ -->
                                            <div class="list-item content-media-list item-work on-add item-add-work">
                                                <!-- if add -->
                                                <div class="content-list-add">
                                                    <form>
                                                        <div class="cl-add-header">
                                                            <div class="item-title">Add your work</div>
                                                            <div class="item-close"><i class="icon i-nclose"></i></div>
                                                        </div>
                                                        <div class="cl-add-body">
                                                            <div class="item-input">
                                                                <label>Company</label><input type="text" name="" value="" placeholder="Name of your company">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Position</label><input type="text" name="" value="" placeholder="Your position (optional)">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Company’s location</label><input type="text" name="" value="" placeholder="Address of the company (optional)">
                                                            </div>

                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title">
                                                                <div class="item-input item-input-fromto">
                                                                    <label>Duration</label>
                                                                    <div class="item-input-row">
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="From">
                                                                        </div>
                                                                        <span class="dash"> - </span>
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="To">
                                                                        </div>

                                                                        <div class="item-input-radio">
                                                                            <label>
                                                                                <input type="checkbox" checked="" value="" id="" name="education"> Working here?
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if add -->
                                            </div>

                                            <!-- ============ EDUCATION ============ -->
                                            <div class="list-item content-media-list item-education">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-education"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Masteral, Web Design & Web Programming, New York University
                                                        </div>
                                                        <!-- <div class="item-after">
                                                                Followers
                                                        </div> -->
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your education</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>School name</label><input type="text" name="" value="" placeholder="Name of your school">
                                                            </div>
                                                            <div class="item-input item-input-educ">
                                                                <label>Educational level</label>
                                                                <div class="item-input-radio">
                                                                    <label>
                                                                        <input type="radio" id="txt_highschool" name="radio" />
                                                                        <label for="txt_highschool"><span></span>Highschool</label>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" id="txt_college" name="radio" />
                                                                        <label for="txt_college"><span></span>College</label>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Major / Course</label><input type="text" name="" value="" placeholder="What’s your course?">
                                                            </div>

                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title">
                                                                <div class="item-input item-input-fromto">
                                                                    <label>School year</label>
                                                                    <div class="item-input-row">
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="From">
                                                                        </div>
                                                                        <span class="dash"> - </span>
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="To">
                                                                        </div>

                                                                        <div class="item-input-radio">
                                                                            <label>
                                                                                <input type="checkbox" checked="" value="" id="" name="education"> Graduated?
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ WORK ============ -->
                                            <div class="list-item content-media-list item-work">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-work"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Designer, Rappler PH, Sta. Rosa, Laguna
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your work</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Company</label><input type="text" name="" value="" placeholder="Name of your company">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Position</label><input type="text" name="" value="" placeholder="Your position (optional)">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Company’s location</label><input type="text" name="" value="" placeholder="Address of the company (optional)">
                                                            </div>

                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title">
                                                                <div class="item-input item-input-fromto">
                                                                    <label>Duration</label>
                                                                    <div class="item-input-row">
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="From">
                                                                        </div>
                                                                        <span class="dash"> - </span>
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="To">
                                                                        </div>

                                                                        <div class="item-input-radio">
                                                                            <label>
                                                                                <input type="checkbox" checked="" value="" id="" name="education"> Working here?
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn" name="button">Remove</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ GENERAL ============ -->
                                            <div class="list-item content-media-list item-general">
                                                <div class="content-list-inner">
                                                    <div class="item-media">
                                                        <i class="icon i-general"></i>
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Trex, The Fernbus Coach Simulator
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit general information</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Information</label><input type="text" name="" value="">
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn" name="button">Remove</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- link -->
                            <div class="card card-link">
                                <div class="card-header-row">
                                    <div class="card-header">
                                        Links
                                    </div>
                                    <div class="card-header-after">
                                        <div class="toggle-content">
                                            Privacy: Anyone <i class="icon i-dropdown toggle-open"></i>

                                            <ul class="global-action-nav toggle-close">
                                                <li class=""><a href="javascript:void(0)">Anyone</a></li>
                                                <li class=""><a href="javascript:void(0)">Followers & Friends</a></li>
                                                <li class=""><a href="javascript:void(0)">Friends only</a></li>
                                                <li class=""><a href="javascript:void(0)">Only me</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-content-inner">

                                        <div class="content-list">
                                            <!-- ============ NEW ============ -->
                                            <div class="list-item content-media-list item-new-content">
                                                <div class="content-list-inner">
                                                    <div class="item-media add-new-content">

                                                        <div class="add-link" data-target="link">
                                                            <i class="icon i-add"></i>
                                                        </div>

                                                        <!-- <div class="add-content add-new-content">
                                                               <div class="add-link" data-target="general">
                                                                       <div class="add-icon"><i class="icon i-general"></i></div>
                                                                       General
                                                               </div>
                                                               <div class="add-link" data-target="education">
                                                                       <div class="add-icon"><i class="icon i-education"></i></div>
                                                                       Education
                                                               </div>
                                                               <div class="add-link" data-target="work">
                                                                       <div class="add-icon"><i class="icon i-work"></i></div>
                                                                       Work
                                                               </div>
                                                       </div> -->
                                                    </div>

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            New
                                                        </div>
                                                        <!-- <div class="item-after">
                                                                Followers
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div><!-- list-item -->

                                            <!-- ============ ADD LINK ============ -->
                                            <div class="list-item content-media-list item-link on-add item-add-link">
                                                <!-- if add -->
                                                <div class="content-list-add">
                                                    <form>
                                                        <div class="cl-add-header">
                                                            <div class="item-title">Add new link</div>
                                                            <div class="item-close"><i class="icon i-nclose"></i></div>
                                                        </div>
                                                        <div class="cl-add-body">
                                                            <div class="item-input">
                                                                <label>Your link title</label><input type="text" name="" value="" placeholder="Link Title">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Your link url</label><input type="text" name="" value="" placeholder="Link URL">
                                                            </div>
                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <!-- <button type="button" class="btn" name="button">Remove</button> -->
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if add -->
                                            </div>

                                            <!-- ============ LINK 1 ============ -->
                                            <div class="list-item content-media-list item-link">
                                                <div class="content-list-inner">
                                                    <!-- <div class="item-media">
                                                            <i class="icon i-education"></i>
                                                    </div> -->

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Facebook: <a href="www.fb.me/Myprofilehere" class="c-link"> www.fb.me/Myprofilehere </a>
                                                        </div>
                                                        <!-- <div class="item-after">
                                                                Followers
                                                        </div> -->
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-premove">
                                                            <a href="javascript:void(0)">Remove</a>
                                                        </div>
                                                        <div class="btn-pedit">
                                                            Edit
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Add new link</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Your link title</label><input type="text" name="" value="" placeholder="Link Title">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Your link url</label><input type="text" name="" value="" placeholder="Link URL">
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn" name="button">Remove</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ LINK 2 ============ -->
                                            <div class="list-item content-media-list item-work">
                                                <div class="content-list-inner">
                                                    <!-- <div class="item-media">
                                                            <i class="icon i-work"></i>
                                                    </div> -->

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            Twitter: <a href="www.fb.me/Myprofilehere" class="c-link"> www.fb.me/Myprofilehere </a>
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-premove">
                                                            <a href="javascript:void(0)">Remove</a>
                                                        </div>
                                                        <div class="btn-pedit">
                                                            <a href="javascript:void(0)">Edit</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit your work</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Your link title</label><input type="text" name="" value="" placeholder="Link Title">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Your link url</label><input type="text" name="" value="" placeholder="Link URL">
                                                            </div>
                                                        </div>
                                                        <div class="cl-add-footer">
                                                            <div class="item-title">
                                                                <div class="item-input item-input-fromto">
                                                                    <label>Duration</label>
                                                                    <div class="item-input-row">
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="From">
                                                                        </div>
                                                                        <span class="dash"> - </span>
                                                                        <div class="item-input">
                                                                            <input type="text" name="" value="" placeholder="To">
                                                                        </div>

                                                                        <div class="item-input-radio">
                                                                            <label>
                                                                                <input type="checkbox" checked="" value="" id="" name="education"> Working here?
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn" name="button">Remove</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                            <!-- ============ LINK 3 ============ -->
                                            <div class="list-item content-media-list item-general">
                                                <div class="content-list-inner">
                                                    <!-- <div class="item-media">
                                                            <i class="icon i-general"></i>
                                                    </div> -->

                                                    <div class="item-inner">
                                                        <div class="stats-title">
                                                            LinkedIn: <a href="www.fb.me/Myprofilehere" class="c-link"> www.fb.me/Myprofilehere </a>
                                                        </div>
                                                    </div>

                                                    <div class="content-action">
                                                        <div class="btn-premove">
                                                            <a href="javascript:void(0)">Remove</a>
                                                        </div>
                                                        <div class="btn-pedit">
                                                            <a href="javascript:void(0)">Edit</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- if edit -->
                                                <div class="content-list-edit">
                                                    <form>
                                                        <div class="cl-edit-header">
                                                            <div class="item-title">Edit general information</div>
                                                            <div class="item-close"><i class="icon i-eclose"></i></div>
                                                        </div>
                                                        <div class="cl-edit-body">
                                                            <div class="item-input">
                                                                <label>Your link title</label><input type="text" name="" value="" placeholder="Link Title">
                                                            </div>
                                                            <div class="item-input">
                                                                <label>Your link url</label><input type="text" name="" value="" placeholder="Link URL">
                                                            </div>
                                                        </div>
                                                        <div class="cl-edit-footer">
                                                            <div class="item-title"></div>
                                                            <div class="item-after">
                                                                <button type="button" class="btn" name="button">Remove</button>
                                                                <button type="button" class="btn-raised" name="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!-- if edit -->

                                            </div><!-- list-item -->

                                        </div>

                                    </div>
                                </div>
                            </div>


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

                                        <div class="card-title-block">
                                            Favorite Strings
                                        </div>


                                        <!-- ================================= New added. ================================= -->
                                        <!-- placeholder if no fav strings -->
                                        <div class="content-tags content-fav-tags">
                                            <ul class="tags">

                                                <!-- placeholder only -->
                                                <li class="fav-tags-add toggle-content">
                                                    <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>

                                                    <div class="fav-tags-search toggle-close">
                                                        <input type="text" name="" value="" placeholder="Search tags">
                                                        <ul class="tags-search">
                                                            <li class="fav-placeholder"></li>
                                                            <li class="fav-placeholder"></li>
                                                            <li class="fav-placeholder"></li>
                                                        </ul>
                                                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                                                    </div>
                                                </li>

                                                <!-- sample fav tags - search -->
                                                <li class="fav-tags-add toggle-content">
                                                    <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>

                                                    <div class="fav-tags-search toggle-close">
                                                        <input type="text" name="" value="" placeholder="Search tags">
                                                        <ul class="tags-search">
                                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                                <a href="javascript:void(0)">~Japan Moon side111</a>
                                                                <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                            </li>
                                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                                <a href="javascript:void(0)">~Japan Moon side111</a>
                                                                <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                            </li>
                                                        </ul>
                                                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                                                    </div>
                                                </li>
                                                <li class="fav-tags-add toggle-content">
                                                    <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>

                                                    <div class="fav-tags-search toggle-close">
                                                        <input type="text" name="" value="" placeholder="Search tags">
                                                        <ul class="tags-search">
                                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                                <a href="javascript:void(0)">~Japan Moon side111</a>
                                                                <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                            </li>
                                                        </ul>
                                                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                                                    </div>
                                                </li>
                                        </div>

                                        <!-- placeholder if has fav strings -->
                                        <div class="content-tags content-fav-tags">
                                            <ul class="tags">
                                                <li class="fav-tags has-image toggle-content" style="background-image: url(dedicated-image-01.JPG)">
                                                    <a href="javascript:void(0)">~Japan Moon side111</a>

                                                    <div class="fav-tags-action">
                                                        <div class="btn-tag-edit"><i class="icon i-edit toggle-open"></i></span></div>
                                                        <div class="btn-tag-delete"><i class="icon i-delete"></i></span></div>
                                                    </div>

                                                    <div class="fav-tags-search toggle-close">
                                                        <input type="text" name="" value="" placeholder="Search tags">
                                                        <ul class="tags-search">
                                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                                <a href="javascript:void(0)">~Japan Moon side111</a>
                                                                <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                            </li>
                                                        </ul>
                                                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                                                    </div>

                                                </li>

                                                <li class="fav-tags has-image toggle-content" style="background-image: url(dedicated-image-01.JPG)">
                                                    <a href="javascript:void(0)">~Japan Moon side111</a>
                                                    <input type="hidden" value="~Japan Moon side111" name="tags[]">

                                                    <div class="fav-tags-action">
                                                        <div class="btn-tag-edit"><i class="icon i-edit toggle-open"></i></span></div>
                                                        <div class="btn-tag-delete"><i class="icon i-delete"></i></span></div>
                                                    </div>

                                                    <div class="fav-tags-search toggle-close">
                                                        <input type="text" name="" value="" placeholder="Search tags">
                                                        <ul class="tags-search">
                                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                                <a href="javascript:void(0)">~Japan Moon side111</a>
                                                                <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                            </li>
                                                        </ul>
                                                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                                                    </div>

                                                </li>

                                                <li class="fav-tags has-image toggle-content" style="background-image: url(dedicated-image-01.JPG)">
                                                    <a href="javascript:void(0)">~Japan Moon side111</a>
                                                    <input type="hidden" value="~Japan Moon side111" name="tags[]">

                                                    <div class="fav-tags-action">
                                                        <div class="btn-tag-edit"><i class="icon i-edit toggle-open"></i></span></div>
                                                        <div class="btn-tag-delete"><i class="icon i-delete"></i></span></div>
                                                    </div>

                                                    <div class="fav-tags-search toggle-close">
                                                        <input type="text" name="" value="" placeholder="Search tags">
                                                        <ul class="tags-search">
                                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                                <a href="javascript:void(0)">~Japan Moon side111</a>
                                                                <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                            </li>
                                                        </ul>
                                                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                                                    </div>

                                                </li>


                                        </div>

                                        <!-- ================================= END New added. ================================= -->

                                        <div class="card-title-block">
                                            Created Strings <span>95</span>
                                        </div>
                                        <div class="content-tags">
                                            <ul class="tags" >
                                                <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                    <a href="javascript:void(0)">~Japan Moon side111</a>
                                                    <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #13562f">
                                                    <a href="javascript:void(0)">#Japan1</a>
                                                    <input type="hidden" value="#Japan1" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                    <a href="javascript:void(0)">~Japan Moon side11</a>
                                                    <input type="hidden" value="~Japan Moon side11" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #400083">
                                                    <a href="javascript:void(0)">#Japanswealthy1</a>
                                                    <input type="hidden" value="#Japanswealthy1" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                    <a href="javascript:void(0)">~Japan Moon side22</a>
                                                    <input type="hidden" value="~Japan Moon side22" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #13562f">
                                                    <a href="javascript:void(0)">#Japanswealthy11</a>
                                                    <input type="hidden" value="#Japanswealthy11" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                    <a href="javascript:void(0)">~Japan Moon side33</a>
                                                    <input type="hidden" value="~Japan Moon side33" name="tags[]">
                                                </li>
                                            </ul>

                                            <button type="button" class="btn-more">21 <i class="icon i-more"></i></button>
                                        </div>

                                        <div class="card-title-block">
                                            Followed Strings <span>235</span>
                                        </div>
                                        <div class="content-tags">
                                            <ul class="tags" >
                                                <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                    <a href="javascript:void(0)">~Japan Moon side111</a>
                                                    <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #7f3f04">
                                                    <a href="javascript:void(0)">#Japan1</a>
                                                    <input type="hidden" value="#Japan1" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                    <a href="javascript:void(0)">~Japan Moon side11</a>
                                                    <input type="hidden" value="~Japan Moon side11" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #7f3f04">
                                                    <a href="javascript:void(0)">#Japanswealthy1</a>
                                                    <input type="hidden" value="#Japanswealthy1" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                    <a href="javascript:void(0)">~Japan Moon side22</a>
                                                    <input type="hidden" value="~Japan Moon side22" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #7f3f04">
                                                    <a href="javascript:void(0)">#Japanswealthy11</a>
                                                    <input type="hidden" value="#Japanswealthy11" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                    <a href="javascript:void(0)">~Japan Moon side33</a>
                                                    <input type="hidden" value="~Japan Moon side33" name="tags[]">
                                                </li>
                                            </ul>

                                            <button type="button" class="btn-more">21 <i class="icon i-more"></i></button>
                                        </div>

                                        <div class="card-title-block">
                                            Top Tags
                                        </div>
                                        <div class="content-tags">
                                            <ul class="tags" >
                                                <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                    <a href="javascript:void(0)">~Japan Moon side111</a>
                                                    <input type="hidden" value="~Japan Moon side111" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #400083">
                                                    <a href="javascript:void(0)">#Japan1</a>
                                                    <input type="hidden" value="#Japan1" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                    <a href="javascript:void(0)">~Japan Moon side11</a>
                                                    <input type="hidden" value="~Japan Moon side11" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #6f121d">
                                                    <a href="javascript:void(0)">#Japanswealthy1</a>
                                                    <input type="hidden" value="#Japanswealthy1" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                    <a href="javascript:void(0)">~Japan Moon side22</a>
                                                    <input type="hidden" value="~Japan Moon side22" name="tags[]">
                                                </li>
                                                <li class="" style="background-color: #74721f">
                                                    <a href="javascript:void(0)">#Japanswealthy11</a>
                                                    <input type="hidden" value="#Japanswealthy11" name="tags[]">
                                                </li>
                                                <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                    <a href="javascript:void(0)">~Japan Moon side33</a>
                                                    <input type="hidden" value="~Japan Moon side33" name="tags[]">
                                                </li>
                                            </ul>

                                            <button type="button" class="btn-more">21 <i class="icon i-more"></i></button>
                                        </div>

                                    </div>
                                </div>

                            </div> <!-- end tags -->

                        </div>
                        <!-- END content-tab-left -->

                    </div>
                    <!-- END content-tab-info -->

                </div>

                <!-- Tab2 Content CONTENT FEED -->
                <div id="tab-feed" class="tab-content">
                    <div class="content-tab-feed">

                        <!-- ===== CONTENT HERE ==== -->

                    </div>
                </div>

                <!-- Tab3 Content - COMMENTS -->
                <div id="tab-comments" class="tab-content">
                    <div class="content-tab-comments">

                        <!-- ===== CONTENT HERE ==== -->

                    </div>
                </div>

                <!-- Tab4 Content - CONNECTINS -->
                <div id="tab-connections" class="tab-content">
                    <div class="content-tab-connections">

                        <!-- ===== CONTENT HERE ==== -->

                        <div class='toggle-tab'>
                            <div class='tabs'>
                                <div class='tab active'>8 Friends</div>
                                <div class='tab'>22 Followers</div>
                                <div class='tab'>22 Following</div>
                                <div class='tab'>3 Request</div>
                                <div class='tab'>3 Views</div>
                            </div>
                            <div class='panels'>

                                <!-- TAB FRIENDS ============================================================== -->
                                <div class='panel'>

                                    <!-- 1. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i>
            <i class="icon icon-g i-negative"></i> -->
                                                        <i class="icon icon-g i-positive"></i>
                                                        <!-- <i class="icon icon-g i-default"></i>  -->
                                                        5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <div class="card-ust-content">
                                                <span class="card-ust">
                                                    <a href="javascript:void(0)" class="has-image" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                                        <span>~WKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKW</span>
                                                    </a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)" style="background-color: #ff7e00;"><span>~WKWKW</span></a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)"><span>~WKWKW</span></a>
                                                </span>
                                            </div>

                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 2. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 3. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 4. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 5. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-color: #d32f2f;">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-request-sent"><i class="icon i-heart"></i> Request Sent</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <!-- TAB FOLLOWERS ============================================================== -->
                                <div class='panel'>
                                    <!-- 1. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i>
            <i class="icon icon-g i-negative"></i> -->
                                                        <i class="icon icon-g i-positive"></i>
                                                        <!-- <i class="icon icon-g i-default"></i>  -->
                                                        5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <div class="card-ust-content">
                                                <span class="card-ust">
                                                    <a href="javascript:void(0)" class="has-image" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                                        <span>~WKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKW</span>
                                                    </a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)" style="background-color: #ff7e00;"><span>~WKWKW</span></a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)"><span>~WKWKW</span></a>
                                                </span>
                                            </div>

                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 2. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 3. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                    <button type="button" name="button" class="btn btn-addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 4. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 5. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-color: #d32f2f;">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-request-sent"><i class="icon i-heart"></i> Request Sent</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <!-- 6. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-color: #d32f2f;">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-request-sent"><i class="icon i-heart"></i> Request Sent</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>


                                <!-- TAB FOLLOWING ============================================================== -->
                                <div class='panel'>

                                    <!-- 1. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i>
            <i class="icon icon-g i-negative"></i> -->
                                                        <i class="icon icon-g i-positive"></i>
                                                        <!-- <i class="icon icon-g i-default"></i>  -->
                                                        5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <div class="card-ust-content">
                                                <span class="card-ust">
                                                    <a href="javascript:void(0)" class="has-image" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                                        <span>~WKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKW</span>
                                                    </a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)" style="background-color: #ff7e00;"><span>~WKWKW</span></a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)"><span>~WKWKW</span></a>
                                                </span>
                                            </div>

                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 2. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 3. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 4. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 5. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-color: #d32f2f;">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                    <button type="button" name="button" class="btn btn-addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <!-- TAB REQUEST ============================================================== -->
                                <div class='panel'>

                                    <!-- 1. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i>
            <i class="icon icon-g i-negative"></i> -->
                                                        <i class="icon icon-g i-positive"></i>
                                                        <!-- <i class="icon icon-g i-default"></i>  -->
                                                        5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <div class="card-ust-content">
                                                <span class="card-ust">
                                                    <a href="javascript:void(0)" class="has-image" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                                        <span>~WKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKWKW</span>
                                                    </a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)" style="background-color: #ff7e00;"><span>~WKWKW</span></a>
                                                </span>
                                                <span class="card-ust"><a href="javascript:void(0)"><span>~WKWKW</span></a>
                                                </span>
                                            </div>

                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                    <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 2. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                                    <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- 3. ITEM -->
                                    <div class="connection-card">
                                        <div class="card-header-pic" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)">
                                            <div class="card-header-content">
                                                <div class="card-avatar" style="background-image: url(/images/search/background-topic-01.png)"></div>
                                                <div class="card-name">First Name Last Name</div>
                                                <div class="card-details">
                                                    < Credential>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <!-- stats -->
                                            <div class="card-stat-content">
                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                            <!-- <i class="icon icon-g i-equal"></i> -->
                                                            <!-- <i class="icon icon-g i-negative"></i>
            <i class="icon icon-g i-positive"></i> -->
                                                        <i class="icon icon-g i-default"></i> 5.2k
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Rating
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-followers"></i> 289
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Followers
                                                    </div>
                                                </div>

                                                <div class="card-sc card-sc-rating">
                                                    <div class="card-sc-title">
                                                        <i class="icon icon-g i-following"></i> 524
                                                    </div>
                                                    <div class="card-sc-after">
                                                        Following
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- social -->
                                            <div class="card-social-content">
                                                252 mutual friends <span>&#9679;</span> 85 similar interests
                                            </div>

                                            <!-- ust -->
                                            <div class="card-ust-content">
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                                <span class="card-ust has-placeholder"></span>
                                            </div>

                                            <!-- social button -->
                                            <div class="card-socialbutton-content">
                                                <div class="socialbutton-content">
                                                    <button type="button" name="button" class="btn btn-addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                                    <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                                <!-- TAB VIEWS ============================================================== -->
                                <div class='panel tab-content-views'>

                                    <div class="list-block view-list">
                                        <ul>
                                            <li>
                                                <div class="item-content">
                                                    <div class="item-media">
                                                        <a href="/user/!!!!!!!!!!!!!!!!!!" style="background-image: url(images.jpg)"></a>
                                                    </div>
                                                    <div class="item-inner">
                                                        <div class="item-title-row">
                                                            <div class="item-title">
                                                                <a href="#!" class="item-title">Sample Name Sample Long Last Name</a>
                                                            </div>
                                                        </div>
                                                        <div class="item-after">
                                                            BS Accountancy, Instructor<br/> Cambridge University
                                                        </div>
                                                    </div>
                                                    <div class="item-button">
                                                        <div class="item-details">
                                                            Viewed your profile 8 mins ago
                                                        </div>
                                                        <div class="socialbutton-content">
                                                            <button type="button" name="button" class="btn btn-friends"><i class="icon i-heart"></i> Friends</button>
                                                            <button type="button" name="button" class="btn btn-addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                                            <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                            <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>

                                            <li>
                                                <div class="item-content">
                                                    <div class="item-media">
                                                        <a href="/user/!!!!!!!!!!!!!!!!!!" style="background-image: url(images.jpg)"></a>
                                                    </div>
                                                    <div class="item-inner">
                                                        <div class="item-title-row">
                                                            <div class="item-title">
                                                                <a href="#!" class="item-title">Sample Name Sample Long Last Name</a>
                                                            </div>
                                                        </div>
                                                        <div class="item-after">
                                                            BS Accountancy, Instructor<br/> Cambridge University
                                                        </div>
                                                    </div>
                                                    <div class="item-button">
                                                        <div class="item-details">
                                                            Viewed your profile 8 mins ago
                                                        </div>
                                                        <div class="socialbutton-content">
                                                            <button type="button" name="button" class="btn btn-request-sent"><i class="icon i-heart"></i> Request Sent</button>
                                                            <button type="button" name="button" class="btn btn-following"><i class="icon i-paw"></i> Following</button>
                                                            <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                            <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>

                                            <li>
                                                <div class="item-content">
                                                    <div class="item-media">
                                                        <a href="/user/!!!!!!!!!!!!!!!!!!" style="background-image: url(images.jpg)"></a>
                                                    </div>
                                                    <div class="item-inner">
                                                        <div class="item-title-row">
                                                            <div class="item-title">
                                                                <a href="#!" class="item-title">Sample Name Sample Long Last Name</a>
                                                            </div>
                                                        </div>
                                                        <div class="item-after">
                                                            BS Accountancy, Instructor<br/> Cambridge University
                                                        </div>
                                                    </div>
                                                    <div class="item-button">
                                                        <div class="item-details">
                                                            Viewed your profile 8 mins ago
                                                        </div>
                                                        <div class="socialbutton-content">
                                                            <button type="button" name="button" class="btn btn-disabled"><i class="icon i-paw"></i> Follow</button>
                                                            <button type="button" name="button" class="btn btn-disabled"><i class="icon i-heart"></i> Add Friend</button>
                                                            <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                            <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>

                                            <li>
                                                <div class="item-content">
                                                    <div class="item-media">
                                                        <a href="/user/!!!!!!!!!!!!!!!!!!" style="background-image: url(images.jpg)"></a>
                                                    </div>
                                                    <div class="item-inner">
                                                        <div class="item-title-row">
                                                            <div class="item-title">
                                                                <a href="#!" class="item-title">Sample Name Sample Long Last Name</a>
                                                            </div>
                                                        </div>
                                                        <div class="item-after">
                                                            BS Accountancy, Instructor<br/> Cambridge University
                                                        </div>
                                                    </div>
                                                    <div class="item-button">
                                                        <div class="item-details">
                                                            Viewed your profile 8 mins ago
                                                        </div>
                                                        <div class="socialbutton-content">
                                                            <button type="button" name="button" class="btn btn-follow"><i class="icon i-paw"></i> Follow</button>
                                                            <button type="button" name="button" class="btn btn-remove">Remove</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>
                </div>

                <!-- Tab5 Content - IMAGES -->
                <div id="tab-images" class="hidden tab-content">
                    <div class="content-tab-images">

                        <!-- ===== CONTENT HERE ==== -->

                    </div>
                </div>

            </div>

        </div>

    </div>

@include('profile::new.modals._crop-profile-image')

@include('home::partials._report-form')
@include('topics::modals._strings-modal')

@stop