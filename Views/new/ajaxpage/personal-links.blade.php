<?php $count_link = 0; ?>
<?php if ($myprofile) { ?>
    <?php if ((empty($user_profile[0]->webtitle1) && empty($user_profile[0]->weblink1))
            || (empty($user_profile[0]->webtitle2) && empty($user_profile[0]->weblink2))
            || (empty($user_profile[0]->webtitle3) && empty($user_profile[0]->weblink3))) { ?>
            <div class="list-item content-media-list item-new-content">
                <div class="content-list-inner">
                    <div class="item-media add-new-content">
                        <div class="add-link" data-target="link">
                            <i class="icon i-add"></i>
                        </div>
                    </div>

                    <div class="item-inner">
                        <div class="stats-title">
                            New
                        </div>
                    </div>
                </div>
            </div><!-- list-item -->

            <div class="list-item content-media-list item-link on-add item-add-link">
                {!! Form::open(['id' => 'save-links', 'rel' => 'save-links']) !!}
                <div class="content-list-add">
                    <div class="cl-add-header">
                        <div class="item-title">Add new link</div>
                        <div class="item-close"><i class="icon i-nclose"></i></div>
                    </div>
                    <div class="cl-add-body">
                        <div class="item-input">
                            <label>Your link title</label><input type="text" name="linktitle"  required placeholder="Link Title">
                        </div>
                        <div class="item-input">
                            <label>Your link url</label><input type="text" name="linkurl" required placeholder="Link URL">
                        </div>
                    </div>
                    <div class="cl-add-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <!-- <button type="button" class="btn" name="button">Remove</button> -->
                            <button type="submit" class="btn-raised" name="button">Save</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
    <?php } ?>
<?php } ?>
            
<?php if (!empty($user_profile[0]->webtitle1) && !empty($user_profile[0]->weblink1)) { ?>
    <?php $count_link++; ?>
    <div id="box-link1" class="list-item content-media-list item-link">
        <div class="content-list-inner">
            <div class="item-inner">
                <div class="stats-title">
                    <?php echo $user_profile[0]->webtitle1 ?>: <a href="<?php echo $user_profile[0]->weblink1 ?>" class="c-link"><?php echo $user_profile[0]->weblink1 ?></a>
                </div>
            </div>
            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="btn-premove"><a href="javascript:void(0)" class="btn-remove-personal" rel="links" data-type="link1">Remove</a></div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($myprofile) { ?>
            <div class="content-list-edit">
                {!! Form::open(['id' => 'link-type-1']) !!}
                    <div class="cl-edit-header">
                        <div class="item-title">Update Link</div>
                        <div class="item-close"><i class="icon i-eclose"></i></div>
                    </div>
                    <div class="cl-edit-body">
                        <div class="item-input">
                            <label>Your link title</label><input type="text" name="linktitle" required value="<?php echo $user_profile[0]->webtitle1 ?>" placeholder="Link Title">
                        </div>
                        <div class="item-input">
                            <label>Your link url</label><input type="text" name="linkurl" required value="<?php echo $user_profile[0]->weblink1 ?>" placeholder="Link URL">
                        </div>
                    </div>
                    <div class="cl-edit-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="submit" class="update-profile-info btn-raised"  name="link-type-1" rel="link-type-1" data-type="link1" data-action="links">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if (!empty($user_profile[0]->webtitle2) && !empty($user_profile[0]->weblink2)) { ?>
    <?php $count_link++; ?>
    <div id="box-link2" class="list-item content-media-list item-link">
        <div class="content-list-inner">
            <div class="item-inner">
                <div class="stats-title">
                    <?php echo $user_profile[0]->webtitle2 ?>: <a href="<?php echo $user_profile[0]->weblink2 ?>" class="c-link"><?php echo $user_profile[0]->weblink2 ?></a>
                </div>
            </div>
            
            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="btn-premove"><a href="javascript:void(0)" class="btn-remove-personal" rel="links" data-type="link2">Remove</a></div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($myprofile) { ?>
            <div class="content-list-edit">
                {!! Form::open(['id' => 'link-type-2']) !!}
                    <div class="cl-edit-header">
                        <div class="item-title">Update Link</div>
                        <div class="item-close"><i class="icon i-eclose"></i></div>
                    </div>
                    <div class="cl-edit-body">
                        <div class="item-input">
                            <label>Your link title</label><input type="text" name="linktitle" value="<?php echo $user_profile[0]->webtitle2 ?>" placeholder="Link Title">
                        </div>
                        <div class="item-input">
                            <label>Your link url</label><input type="text" name="linkurl" value="<?php echo $user_profile[0]->weblink2 ?>" placeholder="Link URL">
                        </div>
                    </div>
                    <div class="cl-edit-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="submit" class="update-profile-info btn-raised"  name="link-type-2" rel="link-type-2" data-type="link2" data-action="links">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if (!empty($user_profile[0]->webtitle3) && !empty($user_profile[0]->weblink3)) { ?>
    <?php $count_link++; ?>
    <div id="box-link3" class="list-item content-media-list item-link">
        <div class="content-list-inner">
            <div class="item-inner">
                <div class="stats-title">
                    <?php echo $user_profile[0]->webtitle3 ?>: <a href="<?php echo $user_profile[0]->weblink3 ?>" class="c-link"><?php echo $user_profile[0]->weblink3 ?></a>
                </div>
            </div>
            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="btn-premove"><a href="javascript:void(0)" class="btn-remove-personal" rel="links" data-type="link3">Remove</a></div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($myprofile) { ?>
            <div class="content-list-edit">
                {!! Form::open(['id' => 'link-type-3']) !!}
                    <div class="cl-edit-header">
                        <div class="item-title">Update Link</div>
                        <div class="item-close"><i class="icon i-eclose"></i></div>
                    </div>
                    <div class="cl-edit-body">
                        <div class="item-input">
                            <label>Your link title</label><input type="text" name="linktitle" value="<?php echo $user_profile[0]->webtitle3 ?>" placeholder="Link Title">
                        </div>
                        <div class="item-input">
                            <label>Your link url</label><input type="text" name="linkurl" value="<?php echo $user_profile[0]->weblink3 ?>" placeholder="Link URL">
                        </div>
                    </div>
                    <div class="cl-edit-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="submit" class="update-profile-info btn-raised"  name="link-type-3" rel="link-type-3" data-type="link3" data-action="links">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        <?php } ?>
    </div>
<?php } ?>