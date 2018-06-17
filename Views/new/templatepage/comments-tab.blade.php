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

        <!-- TAB REQUEST ============================================================== -->
        <div class="panel tab-content-comments tab-active">
            <div id="comments-grid" class="comments-row">
                <?php if(count($comments['user_comments']) > 0) { ?>
                    <?php foreach($comments['user_comments'] as $comment) { ?>
                        <?php if($comment['type'] == "C") { ?>
                                <div class="comments-item-box">
                                    <div class="item-title-row">
                                        <div class="item-title">
                                            Comment on
                                            <?php if($comment['content_type'] == "T") { ?>
                                                <i class="icon i-text"></i>
                                            <?php } else if($comment['content_type'] == "K") { ?>
                                                <i class="icon i-link"></i>
                                            <?php } else if($comment['content_type'] == "F") { ?>
                                                <i class="icon i-image"></i>
                                            <?php } else if($comment['content_type'] == "Q") { ?>
                                                <i class="icon i-question"></i>
                                            <?php } else if($comment['content_type'] == "A") { ?>
                                                <i class="icon i-article"></i>
                                            <?php } else { ?>
                                                <i class="icon i-poll"></i>
                                            <?php } ?>
                                            <a href="<?php echo config('app.url') ?>post/<?php echo $comment['contenttopic_id'] ?>" target='_blank'><?php echo $comment['title_contenttopic'] ?></a> by 
                                            <a href="<?php echo config('app.url') ?>user/<?php echo $comment['profile_code'] ?>" target='_blank'><?php echo $comment['user_name'] ?></a>
                                        </div>
                                        <div class="item-settings toggle-content">
                                            <span>4h</span>

                                            <a href="javascript:void(0)" class="action-nav-btn toggle-open"><i class="icon i-setting"></i></a>
                                            <ul class="action-nav toggle-close">
                                                <li class="action-nav-hide"><a href="javascript:void(0)">Hide</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="item-text">
                                        <p><?php echo $comment['comment'] ?></p>
                                    </div>

                                    <div class="item-footer-row">
                                        <div class="item-left">
                                            <div class="content-tags">
                                                <ul class="tags">
                                                    <?php if(!empty($comment['stringtag_title'])) { ?>
                                                        <?php if (!empty($comment['string_coverphoto'])) { ?>
                                                            <li class="has-image" style="background-image: url('<?php echo config('app.url') . 'upload/topics/thumbs/' . $comment['string_coverphoto'] ?>')">
                                                            <?php } else { ?>
                                                            <li class="has-image" style="background-color:<?php echo $comment['string_color'] ?>;">    
                                                            <?php } ?>
                                                            <a href="<?php echo URL::route('view-string', $comment['string_slug']) ?>" target="_blank">~<?php echo $comment['stringtag_title'] ?></a>
                                                            <input type="hidden" value="~<?php echo $comment['stringtag_title'] ?>" name="tags[]">
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="item-right">

                                            <div class="vote-content">
                                                <div class="vote-content-box">
                                                    <div class="stats-title">
                                                        <div class="vote-link">
                                                            <i class="icon i-rating-default"></i>
                                                            <i class="icon i-rating-negative"></i>
                                                            <i class="icon i-rating-positive"></i>
                                                            <i class="icon i-rating-equal"></i>
                                                        </div>

                                                        <div class="vote-content-emoji">
                                                            <div class="emoji emoji-yea">
                                                                <i class="icon i-emoji-yea"><span>yea</span></i>
                                                            </div>
                                                            <div class="emoji emoji-nay">
                                                                <i class="icon i-emoji-nay"><span>nay</span></i>
                                                            </div>
                                                        </div>

                                                        <div class="stats-after">
                                                            <?php if($comment['total_yay'] > 0) { ?>
                                                                <span class="c-blue"><?php echo $comment['total_yay'] ?></span>
                                                            <?php } ?>
                                                            <?php echo ($comment['total_yay'] > 0 && $comment['total_nay'] > 0) ? "<span>|</span>" : "" ?>
                                                            <?php if($comment['total_nay'] > 0) { ?>
                                                                <span class="c-red"><?php echo $comment['total_nay'] ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                
                            <?php } else { ?>

                                <div class="comments-item-box">
                                    <div class="item-title-row">
                                        <div class="item-title">
                                            Comment on
                                            <a href="<?php echo config('app.url') ?>post/<?php echo $comment['contenttopic_id'] ?>" target="_blank"><?php echo $comment['title_contenttopic'] ?> - Discussion Thread Name</a>
                                        </div>
                                        <div class="item-settings toggle-content">
                                            <span>4h</span>

                                            <a href="javascript:void(0)" class="action-nav-btn toggle-open"><i class="icon i-setting"></i></a>
                                            <ul class="action-nav toggle-close">
                                                <li class="action-nav-hide"><a href="javascript:void(0)">Hide</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="item-text">
                                        <p><?php echo $comment['comment'] ?></p>
                                    </div>

                                    <div class="item-footer-row">
                                        <div class="item-left">
                                            <div class="content-tags">
                                                <ul class="tags">
                                                    <?php if(!empty($comment['stringtag_title'])) { ?>
                                                        <?php if (!empty($comment['string_coverphoto'])) { ?>
                                                            <li class="has-image" style="background-image: url('<?php echo config('app.url') . 'upload/topics/thumbs/' . $comment['string_coverphoto'] ?>')">
                                                            <?php } else { ?>
                                                            <li class="has-image" style="background-color:<?php echo $comment['string_color'] ?>;">    
                                                            <?php } ?>
                                                            <a href="<?php echo URL::route('view-string', $comment['string_slug']) ?>" target="_blank">~<?php echo $comment['stringtag_title'] ?></a>
                                                            <input type="hidden" value="~<?php echo $comment['stringtag_title'] ?>" name="tags[]">
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="item-right">

                                            <div class="vote-content">
                                                <div class="vote-content-box">
                                                    <div class="stats-title">
                                                        <div class="vote-link">
                                                                <!-- <i class="icon i-rating-default"></i> -->
                                                                <!-- <i class="icon i-rating-negative"></i> -->
                                                            <i class="icon i-rating-positive"></i>
                                                            <!-- <i class="icon i-rating-equal"></i> -->
                                                        </div>

                                                        <div class="vote-content-emoji">
                                                            <div class="emoji emoji-yea">
                                                                <i class="icon i-emoji-yea"><span>yea</span></i>
                                                            </div>
                                                            <div class="emoji emoji-nay">
                                                                <i class="icon i-emoji-nay"><span>nay</span></i>
                                                            </div>
                                                        </div>

                                                        <div class="stats-after">
                                                            <?php if($comment['total_yay'] > 0) { ?>
                                                                <span class="c-blue"><?php echo $comment['total_yay'] ?></span>
                                                            <?php } ?>
                                                            <?php echo ($comment['total_yay'] > 0 && $comment['total_nay'] > 0) ? "<span>|</span>" : "" ?>
                                                            <?php if($comment['total_nay'] > 0) { ?>
                                                                <span class="c-red"><?php echo $comment['total_nay'] ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        
        

        <!-- TAB VIEWS ============================================================== -->
        <div class='panel tab-content-replies'>
            <div id="replies-grid" class="comments-row">
                <?php if(count($comments['user_replies']) > 0) { ?>
                    <?php foreach($comments['user_replies'] as $replies) { ?>
                        <div class="comments-item-box">
                            <div class="item-title-row">
                                <div class="item-title">
                                    Reply to
                                    <a href="#"><?php echo $replies['title_parent_transaction'] ?></a> by 
                                    <a href="<?php echo config('app.url') ?>user/<?php echo $comment['profile_code'] ?>" target='_blank'><?php echo $comment['user_name'] ?></a>
                                </div>
                                <div class="item-settings toggle-content">
                                    <span>4h</span>

                                    <a href="javascript:void(0)" class="action-nav-btn toggle-open"><i class="icon i-setting"></i></a>
                                    <ul class="action-nav toggle-close">
                                        <li class="action-nav-hide"><a href="javascript:void(0)">Edit</a></li>
                                        <li class="action-nav-flag "><a href="javascript:void(0)">Delete</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="item-text">
                                <p><?php echo $replies['reply'] ?></p>
                            </div>

                            <div class="item-footer-row">
                                <div class="item-left">
                                    <div class="content-tags">
                                        <ul class="tags">
                                            <li class="has-image" style="background-image: url(http://www.intrepidtravel.com/sites/intrepid/files/styles/low-quality/public/elements/product/hero/japan_tokyo_fluro-advertising-on-buildings.jpg)">
                                                <a href="javascript:void(0)">~Japan Travel</a>
                                                <input type="hidden" value="~Japan Travel" name="tags[]">
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="item-right">

                                    <div class="vote-content">
                                        <div class="vote-content-box">
                                            <div class="stats-title">
                                                <div class="vote-link">
                                                        <!-- <i class="icon i-rating-default"></i> -->
                                                        <!-- <i class="icon i-rating-negative"></i> -->
                                                        <!-- <i class="icon i-rating-positive"></i> -->
                                                    <i class="icon i-rating-equal"></i>
                                                </div>

                                                <div class="vote-content-emoji">
                                                    <div class="emoji emoji-yea">
                                                        <i class="icon i-emoji-yea"><span>yea</span></i>
                                                    </div>
                                                    <div class="emoji emoji-nay">
                                                        <i class="icon i-emoji-nay"><span>nay</span></i>
                                                    </div>
                                                </div>

                                                <div class="stats-after">
                                                    <?php if($comment['total_yay'] > 0) { ?>
                                                        <span class="c-blue"><?php echo $comment['total_yay'] ?></span>
                                                    <?php } ?>
                                                    <?php echo ($comment['total_yay'] > 0 && $comment['total_nay'] > 0) ? "<span>|</span>" : "" ?>
                                                    <?php if($comment['total_nay'] > 0) { ?>
                                                        <span class="c-red"><?php echo $comment['total_nay'] ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

    </div>
</div>