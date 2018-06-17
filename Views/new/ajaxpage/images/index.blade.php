<?php if(count($images_list) > 0) { ?>
    <?php foreach($images_list as $image) { ?>
       <div class="image-item-box">
            <a href="<?php echo Config::get("app.url") ?>post/<?php echo $image["content_id"] ?>" target="_blank" class="image-item-content">
                <?php if(stripos($image["photo"], "http") !== false) { ?>
                    <img src="<?php echo $image["photo"]; ?>" alt="#">
                <?php } else { ?>
                    <img src="<?php echo Config::get('app.url'); ?>upload/posts/original/<?php echo $image["photo"].".".$image["reference"]; ?>" alt="#">
                <?php } ?>
            </a>

            <div class="image-item-footer">
                <div class="item-left">
                    <div class="icon-view">
                        <i class="icon i-view"></i> <?php echo $image["view"] ?>
                    </div>
                </div>
                <div class="item-right">

                    <div class="icon-comment">
                        <a href="#"><i class="icon i-comment"></i> <?php echo $image["comment"] ?></a>
                    </div>
                    <div class="vote-content">
                        <div class="vote-content-box">

                            <div class="vote-link vote-link-<?php echo $image["content_id"] ?>">
                                <?php if ($image['yay'] == 0 && $image['nay'] == 0) { ?>
                                    <i class="icon i-rating-default"></i>
                                <?php } else if ($image['yay'] > $image['nay']) { ?>
                                    <i class="icon i-rating-positive"></i>
                                <?php } else if ($image['nay'] > $image['yay']) { ?>
                                    <i class="icon i-rating-negative"></i>
                                <?php } else { ?>
                                    <i class="icon i-rating-equal"></i>
                                <?php } ?>
                            </div>

                            <div class="vote-content-emoji" data-content-id="<?php echo $image["content_id"] ?>">
                                <div class="emoji set-approval-rate emoji-yea set-yae-rate-<?php echo $image["content_id"] ?> <?php echo $image["approval_rate"] == "Yae" ? "unapprove" : ""  ?>" data-status="Y">
                                    <i class="icon i-emoji-yea <?php echo $image["approval_rate"] == "Yae" ? "active" : ""  ?>"><span>yea</span></i>
                                </div>
                                <div class="emoji set-approval-rate set-nay-rate-<?php echo $image["content_id"] ?> emoji-nay <?php echo $image["approval_rate"] == "Nay" ? "unapprove" : ""  ?>" data-status="N">
                                    <i class="icon i-emoji-nay <?php echo $image["approval_rate"] == "Nay" ? "active" : ""  ?>"><span>nay</span></i>
                                </div>
                            </div>

                            <div class="stats-after stats-after-<?php echo $image["content_id"] ?>">
                                <span class="c-blue"><?php echo $image["yay"] ?></span>
                                <span>|</span>
                                <span class="c-red"><?php echo $image["nay"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($image["nsfw"]) { ?>
                <div class="image-item-sensitive">
                    <div class="sensitive-icon">
                            <i class="icon i-sensitive"></i>
                    </div>
                    <div class="sensitive-text">
                            Sensitive content
                    </div>
                    <button type="button" class="btn btn-view-image">View image</button>
                </div>     
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>
        

    <!-- 2. item -->
<!--    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/settings/default-mask-pic.jpg" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="image-item-sensitive">
                <div class="sensitive-icon">
                        <i class="icon i-sensitive"></i>
                </div>
                <div class="sensitive-text">
                        Sensitive content
                </div>
                <button type="button" class="btn btn-view-image">View image</button>
        </div> 
    </div>

     3. item 
    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/settings/default-mask-pic.jpg" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="image-item-sensitive">
            <div class="sensitive-icon">
                <i class="icon i-sensitive"></i>
            </div>
            <div class="sensitive-text">
                Sensitive content
            </div>
            <button type="button" class="btn btn-view-image">View image</button>
        </div>
    </div>

     4. item 
    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/settings/default-mask-pic.jpg" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="image-item-sensitive">
                <div class="sensitive-icon">
                        <i class="icon i-sensitive"></i>
                </div>
                <div class="sensitive-text">
                        Sensitive content
                </div>
                <button type="button" class="btn btn-view-image">View image</button>
        </div> 
    </div>

     5. item 
    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/search/background-topic-02.png" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="image-item-sensitive">
                <div class="sensitive-icon">
                        <i class="icon i-sensitive"></i>
                </div>
                <div class="sensitive-text">
                        Sensitive content
                </div>
                <button type="button" class="btn btn-view-image">View image</button>
        </div> 
    </div>

     6. item 
    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/search/background-topic-01.png" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="image-item-sensitive">
                <div class="sensitive-icon">
                        <i class="icon i-sensitive"></i>
                </div>
                <div class="sensitive-text">
                        Sensitive content
                </div>
                <button type="button" class="btn btn-view-image">View image</button>
        </div> 
    </div>

     7. item 
    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/dedicatedcontent/dedicated-image-04.JPG" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="image-item-sensitive">
                <div class="sensitive-icon">
                        <i class="icon i-sensitive"></i>
                </div>
                <div class="sensitive-text">
                        Sensitive content
                </div>
                <button type="button" class="btn btn-view-image">View image</button>
        </div> 
    </div>

     8. item 
    <div class="image-item-box">
        <a href="#" class="image-item-content">
            <img src="/images/system/signupBG.jpg" alt="">
        </a>

        <div class="image-item-footer">
            <div class="item-left">
                <div class="icon-view">
                    <i class="icon i-view"></i> 5245
                </div>
            </div>
            <div class="item-right">

                <div class="icon-comment">
                    <a href="#"><i class="icon i-comment"></i> 5245</a>
                </div>
                <div class="vote-content">
                    <div class="vote-content-box">

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
                            <span class="c-blue">400</span>
                            <span>|</span>
                            <span class="c-red">450</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="image-item-sensitive">
                <div class="sensitive-icon">
                        <i class="icon i-sensitive"></i>
                </div>
                <div class="sensitive-text">
                        Sensitive content
                </div>
                <button type="button" class="btn btn-view-image">View image</button>
        </div> 
    </div>-->