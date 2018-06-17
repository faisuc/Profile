@extends('layouts.new-profile')

@section('title')
@parent
{{ $user->first_name .' '. $user->last_name }}
@stop

@section('content')
<!-- new class "page-creator" -->
<div class="page-profile">
    <div class="p-cover-content"> <!-- new class -->
        <!-- <div class="p-cover-photo" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)"></div> -->
        <div class="p-cover-photo" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG)"></div>

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

                                                    <!-- <div class="content-action">
                                                            <div class="btn-pedit">
                                                                    Edit
                                                            </div>
                                                    </div> -->
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

                                                    <!-- <div class="content-action">
                                                            <div class="btn-pedit">
                                                                    Edit
                                                            </div>
                                                    </div> -->
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

                                                    <!-- <div class="content-action">
                                                            <div class="btn-pedit">
                                                                    Edit
                                                            </div>
                                                    </div> -->
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
                        <!-- disable button -->
<!--							<div class="btn btn-disabled"><i class="icon i-follow"></i> Follow </div>
                        <div class="btn btn-disabled"><i class="icon i-addfriend"></i> Add Friend </div>

                         frieads and following 
                        <button type="button" name="button" class="btn btn-following color-white"><i class="icon i-following"></i> Following </button>
                        <button type="button" name="button" class="btn btn-friends color-white"><i class="icon i-friends"></i> Friends </button>-->

                        <!-- follow and Add Friend -->
                        <button type="button" name="button" class="btn btn-follow color-black"><i class="icon i-follow"></i> Follow</button>
                        <button type="button" name="button" data-action="add" data-user-id="{{ $user->id }}" class="btn btn-addfriend color-black"><i class="icon i-addfriend"></i> Add Friend </button>

                    </div>

                    <div class="ci-rating">
                        <div class="rating-icon">
                            <i class="icon i-default"></i>
                            <i class="icon i-positive"></i>
                            <i class="icon i-negative"></i>
                            <i class="icon i-equal"></i>
                        </div>
                        <div class="rating-title">
                            5.7K
                        </div>
                    </div>

                    <div class="ci-followers">
                        <div class="ci-followers-title">
                            2243
                        </div>
                        <div class="ci-followers-after">
                            Followers
                        </div>
                    </div>

                    <div class="ci-following">
                        <div class="ci-following-title">
                            2345
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
                <div class="ust-item" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG);">
                    <div class="ust-shading"></div>
                    <a href="javascript:void(0)">~USTName1</a>
                </div>

                <div class="ust-item" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG);">
                    <div class="ust-shading"></div>
                    <a href="javascript:void(0)">~USTName2</a>
                </div>

                <div class="ust-item" style="background-image: url(/images/dedicatedcontent/dedicated-image-01.JPG);">
                    <div class="ust-shading"></div>
                    <a href="javascript:void(0)">~USTName3</a>
                </div>
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
                                <div class="card-header-after">
                                    <a href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <p>Like any other social media site Facebook has length requirements when it comes to
                                        writing on the wall, providing status, messaging and commenting. Understanding
                                        how many characters you can use, enables you to more effectively use Facebook as
                                        a business or campaign tool. Private messaging is one of the main ways that people
                                        interact on Facebook. This type of direct messaging can be either an instant
                                        message (chat), or a regular email-type message.</p>

                                    <p class="content-footer">User since September 11, 2017</p>
                                </div>
                            </div>
                        </div>

                        <!-- insights -->
                        <div class="card card-insights">
                            <div class="card-header-row">
                                <div class="card-header">
                                    Insights
                                </div>
                                <!-- <div class="card-header-after">
                                        <a href="javascript:void(0)">Edit</a>
                                </div> -->
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">

                                    <div class="content-stats">
                                        <!-- <div class="item-media"> -->
                                                <!-- <i class="icon i-rating-default"></i>
                                                <i class="icon i-rating-positive"></i> -->
                                                <!-- <i class="icon i-rating-negative"></i>
                                        </div> -->
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
                                        <!-- <div class="item-media">
                                                <i class="icon i-comments"></i>
                                        </div> -->
                                        <div class="item-inner">
                                            <div class="stats-title">
                                                <i class="icon i-comments"></i> 999,999
                                            </div>
                                            <div class="item-after">
                                                Comments
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-stats">
                                        <!-- <div class="item-media">
                                                <i class="icon i-friends"></i>
                                        </div> -->
                                        <div class="item-inner">
                                            <div class="stats-title">
                                                <i class="icon i-friends"></i> 999,999
                                            </div>
                                            <div class="item-after">
                                                Friends
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-stats">
                                        <!-- <div class="item-media">
                                                <i class="icon i-followers"></i>
                                        </div> -->
                                        <div class="item-inner">
                                            <div class="stats-title">
                                                <i class="icon i-followers"></i> 999,999
                                            </div>
                                            <div class="item-after">
                                                Followers
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-stats">
                                        <!-- <div class="item-media">
                                                <i class="icon i-following"></i>
                                        </div> -->
                                        <div class="item-inner">
                                            <div class="stats-title">
                                                <i class="icon i-following"></i> 999,999
                                            </div>
                                            <div class="item-after">
                                                Followings
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-stats">
                                        <!-- <div class="item-media">
                                                <i class="icon i-posts"></i>
                                        </div> -->
                                        <div class="item-inner">
                                            <div class="stats-title">
                                                <i class="icon i-posts"></i> 999,999
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
                                                <i class="icon i-images"></i> 999,999
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
                                                <i class="icon i-questions"></i> 999,999
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
                                                <i class="icon i-article"></i> 999,999
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
                                                <i class="icon i-polls"></i> 999,999
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
                                                        <div class="add-link" data-target="political">
                                                            <div class="add-icon"><i class="icon i-political-view"></i></div>
                                                            Political views
                                                        </div>
                                                        <div class="add-link" data-target="political">
                                                            <div class="add-icon"><i class="icon i-religion"></i></div>
                                                            Religion
                                                        </div>
                                                        <div class="add-link" data-target="bloodtype">
                                                            <div class="add-icon"><i class="icon i-bloodtype"></i></div>
                                                            Bloodtype
                                                        </div>
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

                                        <!-- ============ ADD POLITICAL VIEW ============ -->
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
                                                            <label>Your view</label><input type="text" name="" value="" placeholder="Your political view">
                                                        </div>
                                                    </div>
                                                    <div class="cl-add-footer">
                                                        <div class="item-title"></div>
                                                        <div class="item-after">
                                                            <button type="button" class="btn-raised" name="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- if add -->
                                        </div>

                                        <!-- ============ ADD RELIGION ============ -->
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
                                                            <label>Your religion</label><input type="text" name="" value="" placeholder="Your religion">
                                                        </div>
                                                    </div>
                                                    <div class="cl-add-footer">
                                                        <div class="item-title"></div>
                                                        <div class="item-after">
                                                            <button type="button" class="btn-raised" name="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- if add -->
                                        </div>

                                        <!-- ============ ADD BLOODTYPE ============ -->
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
                                                            <select class="txt-bloodtype" name="">
                                                                <option value="" disabled selected>Select your bloodtype</option>
                                                                <option value="O+">O+</option>
                                                                <option value="A+">A+</option>
                                                                <option value="B+">B+</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="O-">O-</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B-">B-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="cl-add-footer">
                                                        <div class="item-title"></div>
                                                        <div class="item-after">
                                                            <button type="button" class="btn-raised" name="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- if add -->
                                        </div>

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
                                                    <div class="stats-title">
                                                        John Clay Doe
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
                                                        <div class="item-title">Edit your name</div>
                                                        <div class="item-close"><i class="icon i-eclose"></i></div>
                                                    </div>
                                                    <div class="cl-edit-body">
                                                        <div class="item-input">
                                                            <label>First Name</label><input type="text" name="" value="">
                                                        </div>
                                                        <div class="item-input">
                                                            <label>Middle Name</label><input type="text" name="" value="">
                                                        </div>
                                                        <div class="item-input">
                                                            <label>Last Name</label><input type="text" name="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="cl-edit-footer">
                                                        <div class="item-title">You can only change your name in the next 90 days</div>
                                                        <div class="item-after">
                                                            <button type="button" name="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
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
                                                    <div class="stats-title">
                                                        Other, Custom field
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
                                                        <div class="item-title">Edit your gender</div>
                                                        <div class="item-close"><i class="icon i-eclose"></i></div>
                                                    </div>
                                                    <div class="cl-edit-body">
                                                        <div class="item-input">
                                                            <label>Your gender</label>
                                                            <select class="txt-gender" name="">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                            <input type="text" name="" value="" class="txt-custom-gender" placeholder="Custom gender">
                                                        </div>
                                                    </div>
                                                    <div class="cl-edit-footer">
                                                        <div class="item-title">You can change your gender only once</div>
                                                        <div class="item-after">
                                                            <button type="button" class="btn-raised" name="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- if edit -->

                                        </div><!-- list-item -->

                                        <!-- ============ BIRTHDATE ============ -->
                                        <div class="list-item content-media-list item-birthdate">
                                            <div class="content-list-inner">
                                                <div class="item-media">
                                                    <i class="icon i-birthdate"></i>
                                                </div>

                                                <div class="item-inner">
                                                    <div class="stats-title">
                                                        January 1, 1992
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
                                                        <div class="item-title">Edit your birthdate</div>
                                                        <div class="item-close"><i class="icon i-eclose"></i></div>
                                                    </div>
                                                    <div class="cl-edit-body">
                                                        <div class="item-input">
                                                            <label>Birthday</label>
                                                            <div class="birthdate-content">
                                                                <select class="txt-month" name="">
                                                                    <option value="January">January</option>
                                                                    <option value="Febuary">Febuary</option>
                                                                    <option value="March">March</option>
                                                                </select>
                                                                <select class="txt-day" name="">
                                                                    <option value="31">31</option>
                                                                    <option value="30">30</option>
                                                                    <option value="29">29</option>
                                                                </select>
                                                                <select class="txt-year" name="">
                                                                    <option value="2017">2017</option>
                                                                    <option value="2016">2016</option>
                                                                    <option value="2015">2015</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="cl-edit-footer">
                                                        <div class="item-title">You can change your gender only once</div>
                                                        <div class="item-after">
                                                            <button type="button" class="btn-raised" name="button">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- if edit -->

                                        </div><!-- list-item -->

                                        <!-- ============ POLITICAL VIEW ============ -->
                                        <div class="list-item content-media-list item-political-view">
                                            <div class="content-list-inner">
                                                <div class="item-media">
                                                    <i class="icon i-political-view"></i>
                                                </div>

                                                <div class="item-inner">
                                                    <div class="stats-title">
                                                        Yet another corrupt government
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
                                                        <div class="item-title">Edit your political view</div>
                                                        <div class="item-close"><i class="icon i-eclose"></i></div>
                                                    </div>
                                                    <div class="cl-edit-body">
                                                        <div class="item-input">
                                                            <label>Your view</label><input type="text" name="" value="">
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

                                        <!-- ============ RELIGION ============ -->
                                        <div class="list-item content-media-list item-religion">
                                            <div class="content-list-inner">
                                                <div class="item-media">
                                                    <i class="icon i-religion"></i>
                                                </div>

                                                <div class="item-inner">
                                                    <div class="stats-title">
                                                        Pastafarian
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
                                                        <div class="item-title">Edit your religion</div>
                                                        <div class="item-close"><i class="icon i-eclose"></i></div>
                                                    </div>
                                                    <div class="cl-edit-body">
                                                        <div class="item-input">
                                                            <label>Your religion</label><input type="text" name="" value="">
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

                                        <!-- ============ RELIGION ============ -->
                                        <div class="list-item content-media-list item-bloodtype">
                                            <div class="content-list-inner">
                                                <div class="item-media">
                                                    <i class="icon i-bloodtype"></i>
                                                </div>

                                                <div class="item-inner">
                                                    <div class="stats-title">
                                                        Bloodtype AB-
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
                                                        <div class="item-title">Edit your bloodtype</div>
                                                        <div class="item-close"><i class="icon i-eclose"></i></div>
                                                    </div>
                                                    <div class="cl-edit-body">
                                                        <div class="item-input">
                                                            <label>Your bloodtype</label>
                                                            <select class="txt-bloodtype" name="">
                                                                <option value="O+">O+</option>
                                                                <option value="A+">A+</option>
                                                                <option value="B+">B+</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="O-">O-</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B-">B-</option>
                                                            </select>
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
                                                                    <input type="radio" checked="" value="" id="" name="education"> Highschool
                                                                </label>
                                                                <label>
                                                                    <input type="radio" checked="" value="" id="" name="education"> College
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
                                        Related Strings
                                    </div>

                                    <div class="content-tags">
                                        <ul class="tags">
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
                                            <li class="" style="background-color: #400083">
                                                <a href="javascript:void(0)">#Japanswealthy1</a>
                                                <input type="hidden" value="#Japanswealthy1" name="tags[]">
                                            </li>
                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                <a href="javascript:void(0)">~Japan Moon side22</a>
                                                <input type="hidden" value="~Japan Moon side22" name="tags[]">
                                            </li>
                                            <li class="" style="background-color: #400083">
                                                <a href="javascript:void(0)">#Japanswealthy11</a>
                                                <input type="hidden" value="#Japanswealthy11" name="tags[]">
                                            </li>
                                            <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                <a href="javascript:void(0)">~Japan Moon side33</a>
                                                <input type="hidden" value="~Japan Moon side33" name="tags[]">
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="card-title-block">
                                        Related Tags
                                    </div>
                                    <div class="content-tags">
                                        <ul class="tags">
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
                                            <li class="" style="background-color: #400083">
                                                <a href="javascript:void(0)">#Japanswealthy1</a>
                                                <input type="hidden" value="#Japanswealthy1" name="tags[]">
                                            </li>
                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                <a href="javascript:void(0)">~Japan Moon side22</a>
                                                <input type="hidden" value="~Japan Moon side22" name="tags[]">
                                            </li>
                                            <li class="" style="background-color: #400083">
                                                <a href="javascript:void(0)">#Japanswealthy11</a>
                                                <input type="hidden" value="#Japanswealthy11" name="tags[]">
                                            </li>
                                            <li class="has-image" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOhoiVi0IFVGpP-wQQB8eIFd6Z7VtzRVHrzw_EiHFVNEsVV8a6w)">
                                                <a href="javascript:void(0)">~Japan Moon side33</a>
                                                <input type="hidden" value="~Japan Moon side33" name="tags[]">
                                            </li>

                                        </ul>
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