<?php if(count($friends_list) > 0) { ?>
    <?php foreach($friends_list as $list) { ?>
        <div id="friend-box-<?php echo $list['user_id'] ?>" class="connection-card">
                <a href="<?php echo Config::get('app.url') ?>user/<?php echo $list['profile_code'] ?>" target="_blank">
                <?php if (!empty($list['coverphoto'])) { ?>
                    <div class="card-header-pic" style="background-image: url('<?php echo Config::get('app.url') . 'upload/user/cover/original/' . $list['coverphoto'] ?>')">
                <?php } else { ?>
                    <div class="card-header-pic" style="background-image: url('<?php echo Config::get('app.url') . 'images/dedicatedcontent/dedicated-image-01.JPG' ?>')">
                <?php } ?>
                    <div class="card-header-content">
                        <?php if (!empty($list['profilephoto'])) { ?>
                            <div class="card-avatar" style="background-image: url('<?php echo Config::get('app.url') . 'upload/user/profile/thumbs/' . $list['profilephoto'] ?>')"></div>
                        <?php } else { ?>
                            <div class="card-avatar" style="background-image: url('<?php echo Config::get('app.url') . 'images/profile/default-profile-pic.jpg' ?>')"></div>
                        <?php } ?>
                        <div class="card-name"><?php echo $list['first_name'].' '.$list['last_name'] ?></div>
                        <?php if(!empty($list['credential'])) { ?>
                            <div class="card-details">
                                <<?php echo $list['credential'] ?>>
                            </div>
                        <?php } ?>
                    </div>
                </a>            
            </div>

            <div class="card-body">
                <div class="card-stat-content">
                    <div class="card-sc card-sc-rating">
                        <div class="card-sc-title">
                            <!-- <i class="icon icon-g i-equal"></i>
                            <i class="icon icon-g i-negative"></i> -->
                            <i class="icon icon-g i-positive"></i>
                            <!-- <i class="icon icon-g i-default"></i>  -->
                            <?php echo $list['avg_rating'] ?>
                        </div>
                        <div class="card-sc-after">
                            Rating
                        </div>
                    </div>

                    <div class="card-sc card-sc-rating">
                        <div class="card-sc-title">
                            <i class="icon icon-g i-followers"></i> <?php echo $list['followers'] ?>
                        </div>
                        <div class="card-sc-after">
                            Followers
                        </div>
                    </div>

                    <div class="card-sc card-sc-rating">
                        <div class="card-sc-title">
                            <i class="icon icon-g i-following"></i> <?php echo $list['following'] ?>
                        </div>
                        <div class="card-sc-after">
                            Following
                        </div>
                    </div>
                </div>

                <div class="card-social-content">
                    <?php echo $list['mutual_friends'] ?> mutual friends <span>&#9679;</span> <?php echo $list['similar_interest'] ?> similar interests
                </div>
                
                <div class="card-ust-content">
                    <?php if(count($list['fav_strings']) > 0) { ?>
                            <?php foreach($list['fav_strings'] as $string) { ?>
                                    <span class="card-ust">
                                        <?php if (!empty($string['coverphoto'])) { ?>
                                            <a href="javascript:void(0)" class="has-image" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string['coverphoto']?>')">    
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" style="background-color: <?php echo $string['color'] ?>;">
                                        <?php } ?>
                                            <span>~<?php echo $string['string_alias'] ?></span>
                                        </a>
                                    </span>
                            <?php } ?>   
                    <?php } else { ?>
                        <span class="card-ust has-placeholder"></span>
                        <span class="card-ust has-placeholder"></span>
                        <span class="card-ust has-placeholder"></span>
                    <?php } ?>
                 </div> 
                
                <div class="card-socialbutton-content">
                    <div class="socialbutton-content" data-user-id="<?php echo $list['user_id'] ?>" data-client-id="<?php echo $list['profile_code'] ?>">
                        <?php if($active_login_userid != $list['user_id']) { ?>
                            <?php if($list['friend_status'] == 1) { ?>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-friends btn-friends rs-friends" rel="unfriend"><i class="icon i-heart"></i> Friends</button>
                            <?php } else if($list['friend_status'] == 3) { ?>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-friends btn-request-sent rs-action" rel="cancelfriend"><i class="icon i-heart"></i> Request Sent</button>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-friends btn-addfriend hidden-impt" rel="addfriend"><i class="icon i-heart"></i> Add Friend</button> 
                             <?php } else { ?>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-friends btn-request-sent rs-action hidden-impt" rel="cancelfriend"><i class="icon i-heart"></i> Request Sent</button>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-friends btn-addfriend" rel="addfriend"><i class="icon i-heart"></i> Add Friend</button>
                             <?php } ?>
                                
                            <?php if($list['following_status'] == 3 || $list['following_status'] == 1  || $list['following_status'] == 6) { ?>
                                <?php if($list['following_status'] == 1) { ?>
                                    <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-follow" rel="addfollow"><i class="icon i-paw"></i> Follow</button>
                                <?php } else { ?>
                                    <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-following rs-acquaintances" rel="unfollow"><i class="icon i-paw"></i> Following</button>
                                <?php } ?>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-request-sent rs-action hidden-impt" rel="cancelfollow"><i class="icon i-follow"></i> Request Sent</button>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-follow hidden-impt" rel="addfollow"><i class="icon i-paw"></i> Follow</button>
                            <?php } else if($list['following_status'] == 2) { ?>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-follow hidden-impt" rel="addfollow"><i class="icon i-paw"></i> Follow</button>
                                <button type="button" name="button" class="btn btn-con-follow btn-follo" rel="accept_follow_request"><i class="icon i-paw"></i> Accept</button>
                            <?php } else if($list['following_status'] == 4) { ?>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-request-sent rs-aa-action" rel="cancelfollow"><i class="icon i-heart"></i> Request Sent</button>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-follow hidden-impt"><i class="icon i-paw"></i> Follow</button>
                            <?php } else { ?>    
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-request-sent rs-aa-action hidden-impt" rel="cancelfollow"><i class="icon i-heart"></i> Request Sent</button>
                                <button type="button" name="button" data-loc="friend-tab" class="btn btn-con-follow btn-follow" rel="addfollow"><i class="icon i-paw"></i> Follow</button>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
<?php } ?>