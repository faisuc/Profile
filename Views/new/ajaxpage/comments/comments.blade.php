<?php if (count($comments['user_comments']) > 0) { ?>
    <?php foreach ($comments['user_comments'] as $comment) { ?>
        <?php if ($comment['type'] == "C") { ?>
            <div class="comments-item-box">
                <div class="item-title-row">
                    <div class="item-title">
                        Comment on
                        <?php if ($comment['content_type'] == "T") { ?>
                            <i class="icon i-text"></i>
                        <?php } else if ($comment['content_type'] == "K") { ?>
                            <i class="icon i-link"></i>
                        <?php } else if ($comment['content_type'] == "F") { ?>
                            <i class="icon i-image"></i>
                        <?php } else if ($comment['content_type'] == "Q") { ?>
                            <i class="icon i-question"></i>
                        <?php } else if ($comment['content_type'] == "A") { ?>
                            <i class="icon i-article"></i>
                        <?php } else { ?>
                            <i class="icon i-poll"></i>
                        <?php } ?>
                        <a href="<?php echo config('app.url') ?>post/<?php echo $comment['contenttopic_id'] ?>" target='_blank'><?php echo $comment['title_contenttopic'] ?></a> by 
                        <a href="<?php echo config('app.url') ?>user/<?php echo $comment['profile_code'] ?>" target='_blank'><?php echo $comment['user_name'] ?></a>
                    </div>
                    <div class="item-settings toggle-content">
                        <span><?php echo $helpers->change_time_humanize_text($humanize->humanize(1, $comment['created_at'])) ?></span>

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
                                <?php if (!empty($comment['stringtag_title'])) { ?>
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
                                        <?php if ($comment['total_yay'] == 0 && $comment['total_nay'] == 0) { ?>
                                            <i class="icon i-rating-default"></i>
                                        <?php } else if ($comment['total_yay'] > $comment['total_nay']) { ?>
                                            <i class="icon i-rating-positive"></i>
                                        <?php } else if ($comment['total_nay'] > $comment['total_yay']) { ?>
                                            <i class="icon i-rating-negative"></i>
                                        <?php } else { ?>
                                            <i class="icon i-rating-equal"></i>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="stats-after">
                                        <?php if ($comment['total_yay'] > 0) { ?>
                                            <span class="c-blue"><?php echo $comment['total_yay'] ?></span>
                                        <?php } ?>
                                        <?php echo ($comment['total_yay'] > 0 && $comment['total_nay'] > 0) ? "<span>|</span>" : "" ?>
                                        <?php if ($comment['total_nay'] > 0) { ?>
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
                        <a href="<?php echo config('app.url') ?><?php echo $comment['string_slug'] ?>" target="_blank"><?php echo $comment['title_contenttopic'] ?> - <?php echo $comment['thread_name'] ?></a>
                    </div>
                    <div class="item-settings toggle-content">
                        <span><?php echo $helpers->change_time_humanize_text($humanize->humanize(1, $comment['created_at'])) ?></span>

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
                                <?php if (!empty($comment['stringtag_title'])) { ?>
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
                                        <?php if ($comment['active_login_user_vote'] == "Y") { ?>
                                            <i class="icon i-rating-positive"></i>
                                        <?php } else if ($comment['active_login_user_vote'] == "N") { ?>
                                            <i class="icon i-rating-negative"></i>
                                        <?php } else { ?>
                                            <i class="icon i-rating-default"></i>
                                        <?php } ?>
                                    </div>

                                    <div class="stats-after">
                                        <?php if($comment['total_yay'] > 0 && $comment['total_nay'] > 0) { ?>
                                            <?php echo ($comment['total_yay'] > 0 && $comment['total_nay'] > 0) ? "<span>{$comment['total_yay']} | {$comment['total_nay']}</span>" : "" ?>
                                        <?php } else if ($comment['total_yay'] > 0) { ?>
                                            <span class="c-blue"><?php echo $comment['total_yay'] ?></span>
                                        <?php  } else if ($comment['total_nay'] > 0) { ?>
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