<?php if($myprofile) { ?>
    <?php if (empty($user_profile[0]->address)
            || empty($user->userbasicinfo->politics)
            || empty($user->userbasicinfo->religion)
            || empty($user->userbasicinfo->bloodtype)
            || (empty($user_profile[0]->contact1)
            || empty($user_profile[0]->contact2)
            || empty($user_profile[0]->contact3))) { ?>
        <div class="list-item content-media-list item-new-content">
            <div class="content-list-inner">
                <div class="item-media">
                    <i class="icon i-add"></i>

                    <div class="add-new-content">
                        <?php if (empty($user_profile[0]->address)) { ?>
                            <div class="add-link" data-target="location">
                                <div class="add-icon"><i class="icon i-location"></i></div>
                                Location
                            </div>
                        <?php } ?>
                        <?php if (empty($user->userbasicinfo->politics)) { ?>
                            <div class="add-link" data-target="political">
                                <div class="add-icon"><i class="icon i-political-view"></i></div>
                                Political views
                            </div>
                        <?php } ?>

                        <?php if (empty($user->userbasicinfo->religion)) { ?>
                            <div class="add-link" data-target="religion">
                                <div class="add-icon"><i class="icon i-religion"></i></div>
                                Religion
                            </div>
                        <?php } ?>

                        <?php if (empty($user->userbasicinfo->bloodtype)) { ?>
                            <div class="add-link" data-target="bloodtype">
                                <div class="add-icon"><i class="icon i-bloodtype"></i></div>
                                Bloodtype
                            </div>
                        <?php } ?>

                        <?php if(empty($user_profile[0]->contact1)
                                || empty($user_profile[0]->contact2)
                                || empty($user_profile[0]->contact3)) { ?>
                            <div class="add-link" data-target="contact">
                                <div class="add-icon"><i class="icon i-contact"></i></div>
                                Contact
                            </div>
                        <?php } ?>
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
    <?php } ?>    
    <?php if (empty($user->userbasicinfo->address)) { ?>
        {!! Form::open(['id' => 'save-location', 'rel' => 'save-location']) !!}
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
                            <label>Your location</label><input type="text" name="location" value="" placeholder="Where do you live?">
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

    <?php if (empty($user->userbasicinfo->politics)) { ?>
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

    <?php if (empty($user->userbasicinfo->religion)) { ?>
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

    <?php if (empty($user->userbasicinfo->bloodtype)) { ?>
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
                                <?php foreach (Config::get('helper.bloodtype') as $bloodtype) { ?>
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

    <?php if(empty($user_profile[0]->contact1)
                        || empty($user_profile[0]->contact2)
                        || empty($user_profile[0]->contact3)) { ?>
        <!-- ============ ADD CONTACT ============ -->
        <div class="list-item content-media-list item-location on-add item-add-contact">
            <!-- if add -->
            <div class="content-list-add">
                {!! Form::open(['id' => 'save-contact', 'rel' => 'save-contact']) !!}
                    <div class="cl-add-header">
                        <div class="item-title">Add your contact</div>
                        <div class="item-close"><i class="icon i-nclose"></i></div>
                    </div>
                    <div class="cl-add-body">
                        <div class="item-input">
                            <label>Your contact(s)</label>
                            <div class="contact-content">
                                <div class="contact-text">
                                    <input type="text" name="contact" value="" placeholder="Contact number / telephone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cl-add-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="button" class="btn btn-addcontact" name="button">Add contact field</button>
                            <button type="submit" class="btn-raised" name="button">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div><!-- if add -->
        </div>
    <?php } ?>
<?php } ?>