<i class="icon i-credentials"></i> <span id="credential-active"><?php echo !empty($user_profile[0]->credential) ? $user_profile[0]->credential : "-" ?></span>

<?php if(count($credentials) > 0) { ?>
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
                            <?php foreach($credentials as $credential) { ?>
                                <?php if($credential->credential_type == 2) { ?>
                                    <div class="list-item content-media-list list-credential <?php echo ($user_profile[0]->credential_refid == $credential->id) ? "lc-selected" : "" ?>" id="<?php echo $credential->id ?>" data-type="<?php echo $credential->credential_type ?>">
                                        <div class="content-list-inner">
                                            <div class="item-media">
                                                <?php if($user_profile[0]->credential_refid == $credential->id) { ?>
                                                    <i class="icon i-selected"></i><i class="icon i-education"></i>
                                                <?php } else { ?>
                                                    <i class="icon i-education"></i>
                                                <?php } ?>
                                            </div>
                                            <div class="item-inner">
                                               <div class="stats-title"><?php echo $credential->credential ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($credential->credential_type == 3) { ?>
                                    <div class="list-item content-media-list list-credential <?php echo ($user_profile[0]->credential_refid == $credential->id) ? "lc-selected" : "" ?>" id="<?php echo $credential->id ?>" data-type="<?php echo $credential->credential_type ?>">
                                        <div class="content-list-inner">
                                            <div class="item-media">
                                                <?php if($user_profile[0]->credential_refid == $credential->id) { ?>
                                                    <i class="icon i-selected"></i><i class="icon i-work"></i>
                                                <?php } else { ?>
                                                    <i class="icon i-work"></i>
                                                <?php } ?>
                                            </div>
                                            <div class="item-inner">
                                                <div class="stats-title"><?php echo $credential->credential ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($credential->credential_type == 1) { ?>
                                    <div class="list-item content-media-list list-credential <?php echo ($user_profile[0]->credential_refid == $credential->id) ? "lc-selected" : "" ?>" id="<?php echo $credential->id ?>" data-type="<?php echo $credential->credential_type ?>">
                                        <div class="content-list-inner">
                                            <div class="item-media">
                                                <?php if($user_profile[0]->credential_refid == $credential->id) { ?>
                                                    <i class="icon i-selected"></i><i class="icon i-general"></i>
                                                <?php } else { ?>
                                                    <i class="icon i-general"></i>
                                                <?php } ?>
                                            </div>
                                            <div class="item-inner">
                                                <div class="stats-title"><?php echo $credential->credential ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?> 
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
