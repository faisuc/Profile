<?php if(count($views_list) > 0) { ?>
    <?php foreach($views_list as $list) { ?>
        <div class="list-block view-list">
            <ul>
                <li id='viewer-box-<?php echo $list['id'] ?>'>
                    <div class="item-content">
                        <div class="item-media">
                            <?php if(!empty($list['profilephoto'])) { ?>
                                <a target="_blank" href="<?php echo Config::get('app.url') ?>user/<?php echo $list['profile_code'] ?>" style="background-image: url('<?php echo Config::get('app.url') ?>upload/user/profile/thumbs/<?php echo $list['profilephoto'] ?>')"></a>
                            <?php } else { ?>
                                <a target="_blank" href="<?php echo Config::get('app.url') ?>user/<?php echo $list['profile_code'] ?>" style="background-image: url('<?php echo Config::get('app.url') ?>images/profile/default-profile-pic.jpg')"></a>
                            <?php } ?>
                        </div>
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title">
                                    <a target="_blank" href="<?php echo Config::get('app.url') ?>user/<?php echo $list['profile_code'] ?>" class="item-title"><?php echo $list['first_name'].' '.$list['last_name'] ?></a>
                                </div>
                            </div>
                            <div class="item-after">
                                <?php echo $list['occupation'] ?> <?php echo (!empty($list['occupation']) && !empty($list['schoolname'])) ? "<br/>" : "" ?> <?php echo $list['schoolname'] ?>
                            </div>
                        </div>
                        <div class="item-button">
                            <div class="item-details">
                                Viewed your profile <?php echo $helpers->change_time_humanize_text($humanize->humanize(1, $list['date'])) ?>
                            </div>
                            <div class="socialbutton-content" data-user-id="0" data-client-id="<?php echo $list['profile_code'] ?>">
                                <?php if($list['friend_status'] == 1) { ?>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-friends rs-friends " rel="unfriend"><i class="icon i-heart"></i> Friends</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-request-sent rs-action hidden-impt" rel="cancelfriend"><i class="icon i-heart"></i> Request Sent</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-addfriend hidden-impt" rel="addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                <?php } else if($list['friend_status'] == 3) { ?>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-request-sent rs-action" rel="cancelfriend"><i class="icon i-heart"></i> Request Sent</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-addfriend hidden-impt" rel="addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                <?php } else { ?>    
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-request-sent rs-action hidden-impt" rel="cancelfriend"><i class="icon i-heart"></i> Request Sent</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-friends btn-addfriend" rel="addfriend"><i class="icon i-heart"></i> Add Friend</button>
                                <?php } ?>
                                    
                                <?php if($list['following_status'] == 3) { ?>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-friends rs-acquaintances" rel="unfollow"><i class="icon i-heart"></i> Following</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-request-sent rs-action hidden-impt" rel="cancelfollow"><i class="icon i-follow"></i> Request Sent</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-follow hidden-impt" rel="addfollow"><i class="icon i-paw"></i> Follow</button>
                                <?php } else if($list['following_status'] == 4) { ?>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-request-sent rs-aa-action" rel="cancelfollow"><i class="icon i-heart"></i> Request Sent</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-follow hidden-impt"><i class="icon i-paw"></i> Follow</button>
                                <?php } else { ?>    
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-request-sent rs-aa-action hidden-impt" rel="cancelfollow"><i class="icon i-heart"></i> Request Sent</button>
                                    <button type="button" name="button" data-loc="view-tab" class="btn btn-con-follow btn-follow" rel="addfollow"><i class="icon i-paw"></i> Follow</button>
                                <?php } ?>    
                                
                                <button type="button" name="button" class="btn btn-remove btn-remove-viewer" data-type="viewer" rel="viewer-box" data-id="<?php echo $list['id'] ?>">Remove</button>
                            </div>
                        </div>

                    </div>
                </li>
            </ul>
        </div>
    <?php } ?>
<?php } ?>
<!--<div class="list-block view-list">
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
</div>-->