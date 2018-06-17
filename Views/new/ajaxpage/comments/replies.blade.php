<?php if (count($comments['user_replies']) > 0) { ?>
    <?php foreach ($comments['user_replies'] as $replies) { ?>
        <div class="comments-item-box">
            <div class="item-title-row">
                <div class="item-title">
                    Reply to
                    <a href="#"><?php echo $replies['title_parent_transaction'] ?></a> by 
                    <a href="<?php echo config('app.url') ?>user/<?php echo $replies['profile_code'] ?>" target='_blank'><?php echo $replies['user_name'] ?></a>
                </div>
                <div class="item-settings toggle-content">
                    <span><?php echo $helpers->change_time_humanize_text($humanize->humanize(1, $replies['created_at'])) ?></span>

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
                                    <?php if ($replies['total_yay'] == 0 && $replies['total_nay'] == 0) { ?>
                                        <i class="icon i-rating-default"></i>
                                    <?php } else if ($replies['total_yay'] > $replies['total_nay']) { ?>
                                        <i class="icon i-rating-positive"></i>
                                    <?php } else if ($replies['total_nay'] > $replies['total_yay']) { ?>
                                        <i class="icon i-rating-negative"></i>
                                    <?php } else { ?>
                                        <i class="icon i-rating-equal"></i>
                                    <?php } ?>
                                </div>

<!--                                <div class="vote-content-emoji">
                                    <div class="emoji emoji-yea">
                                        <i class="icon i-emoji-yea"><span>yea</span></i>
                                    </div>
                                    <div class="emoji emoji-nay">
                                        <i class="icon i-emoji-nay"><span>nay</span></i>
                                    </div>
                                </div>-->

                                <div class="stats-after">
                                    <?php if ($replies['total_yay'] > 0) { ?>
                                        <span class="c-blue"><?php echo $replies['total_yay'] ?></span>
                                    <?php } ?>
                                    <?php echo ($replies['total_yay'] > 0 && $replies['total_nay'] > 0) ? "<span>|</span>" : "" ?>
                                    <?php if ($replies['total_nay'] > 0) { ?>
                                        <span class="c-red"><?php echo $replies['total_nay'] ?></span>
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