<?php if ($myprofile) { ?>
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
            </div>
        </div>
    </div>

    <!-- ============ ADD GENERAL ============ -->
    <div class="list-item content-media-list item-general on-add item-add-general">
        <!-- if add -->
        <div class="content-list-add">
            {!! Form::open(['id' => 'save-general-history', 'rel' => 'save-general-history']) !!}
                <div class="cl-add-header">
                    <div class="item-title">Add general information</div>
                    <div class="item-close"><i class="icon i-nclose"></i></div>
                </div>
                <div class="cl-add-body">
                    <div class="item-input">
                        <label>Information</label><input type="text" name="general_info" required value="" placeholder="Describe your credential">
                    </div>
                </div>
                <div class="cl-add-footer">
                    <div class="item-title"></div>
                    <div class="item-after">
                        <!-- <button type="button" class="btn" name="button">Remove</button> -->
                        <button type="submit" class="btn-raised" name="button">Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- ============ ADD EDUCATION ============ -->
    <div class="list-item content-media-list item-education on-add item-add-education">
        <!-- if add -->
        <div class="content-list-add">
            {!! Form::open(['id' => 'save-education-history', 'rel' => 'save-education-history']) !!}
                <div class="cl-add-header">
                    <div class="item-title">Add your education</div>
                    <div class="item-close"><i class="icon i-nclose"></i></div>
                </div>
                <div class="cl-add-body">
                    <div class="item-input">
                        <label>School name</label><input type="text" name="schoolname" required placeholder="Name of your school">
                    </div>
                    <div class="item-input item-input-educ">
                        <label>Educational level</label>
                        <div class="item-input-radio">
                            <label>
                                <input type="radio" required id="txt_highschool" value="hs" name="school_type" />
                                <label for="txt_highschool"><span></span>Highschool</label>
                            </label>
                            <label>
                                <input type="radio" id="txt_college" value="college" name="school_type" />
                                <label for="txt_college"><span></span>College</label>
                            </label>
                        </div>
                    </div>
                    <div class="item-input">
                        <label>Major / Course</label><input type="text" name="course"  placeholder="What’s your course?">
                    </div>

                </div>
                <div class="cl-add-footer">
                    <div class="item-title">
                        <div class="item-input item-input-fromto">
                            <label>School year</label>
                            <div class="item-input-row">
                                <div class="item-input">
                                    <input type="text" name="yearstarted" required placeholder="From">
                                </div>
                                <span class="dash"> - </span>
                                <div class="item-input">
                                    <input type="text" name="yearended" placeholder="To">
                                </div>

                                <div class="item-input-radio">
                                    <label>
                                        <input type="checkbox" checked="" value="1" name="is_graduated"> Graduated?
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="item-after">
                        <button type="submit" class="btn-raised" name="button">Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div><!-- if add -->
    </div>

    <!-- ============ ADD WORK ============ -->
    <div class="list-item content-media-list item-work on-add item-add-work">
        <!-- if add -->
        <div class="content-list-add">
            {!! Form::open(['id' => 'save-work-history', 'rel' => 'save-work-history']) !!}
                <div class="cl-add-header">
                    <div class="item-title">Add your work</div>
                    <div class="item-close"><i class="icon i-nclose"></i></div>
                </div>
                <div class="cl-add-body">
                    <div class="item-input">
                        <label>Company</label><input type="text" name="companyname" required value="" placeholder="Name of your company">
                    </div>
                    <div class="item-input">
                        <label>Position</label><input type="text" name="position" value="" placeholder="Your position (optional)">
                    </div>
                    <div class="item-input">
                        <label>Company’s location</label><input type="text" name="location" value="" placeholder="Address of the company (optional)">
                    </div>

                </div>
                <div class="cl-add-footer">
                    <div class="item-title">
                        <div class="item-input item-input-fromto">
                            <label>Duration</label>
                            <div class="item-input-row">
                                <div class="item-input">
                                    <input type="text" name="yearstarted" required value="" placeholder="From">
                                </div>
                                <span class="dash"> - </span>
                                <div class="item-input">
                                    <input type="text" name="yearended" value="" placeholder="To">
                                </div>

                                <div class="item-input-radio">
                                    <label>
                                        <input type="checkbox" checked="" value="1" id="" name="is_current"> Working here?
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="item-after">
                        <button type="submit" class="btn-raised" name="button">Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div><!-- if add -->
    </div>
<?php } ?>
    
<?php if(count($credentials) > 0) { ?>
    <?php foreach($credentials as $credential) { ?>
        <?php if($credential->credential_type == 2) { ?>
            <!-- ============ EDUCATION ============ -->
            <div id="box-education-<?php echo $credential->id ?>"class="list-item content-media-list item-education">
                <div class="content-list-inner">
                    <div class="item-media">
                        <i class="icon i-education"></i>
                    </div>

                    <div class="item-inner">
                        <div class="stats-title">
                            <?php echo $credential->credential ?>
                        </div>
                    </div>
                    
                    <?php if ($myprofile) { ?>
                        <div class="content-action">
                            <div class="btn-premove"><a href="javascript:void(0)" id="<?php echo $credential->id ?>" class="btn-remove-personal" rel="credentials" data-type="education">Remove</a></div>
                            <div class="btn-pedit">
                                Edit
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($myprofile) { ?>
                    <div class="content-list-edit">
                        {!! Form::open(['id' => "education-form-{$credential->id}"]) !!}
                            <div class="cl-edit-header">
                                <div class="item-title">Edit your education</div>
                                <div class="item-close"><i class="icon i-eclose"></i></div>
                            </div>
                            <div class="cl-edit-body">
                                <div class="item-input">
                                    <label>School name</label><input type="text" name="schoolname" value="<?php echo $credential->column_1 ?>" placeholder="Name of your school">
                                </div>
                                <div class="item-input item-input-educ">
                                    <label>Educational level</label>
                                    <div class="item-input-radio">
                                        <label>
                                            <input type="radio" id="txt_highschool" value="hs" required name="school_type" />
                                            <label for="txt_highschool"><span></span>Highschool</label>
                                        </label>
                                        <label>
                                            <input type="radio" id="txt_college" value="college" name="school_type" />
                                            <label for="txt_college"><span></span>College</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="item-input">
                                    <label>Major / Course</label><input type="text" name="course" value="<?php echo $credential->column_2 ?>" placeholder="What’s your course?">
                                </div>

                            </div>
                            <div class="cl-add-footer">
                                <div class="item-title">
                                    <div class="item-input item-input-fromto">
                                        <label>School year</label>
                                        <div class="item-input-row">
                                            <div class="item-input">
                                                <input type="text" name="yearstarted" value="<?php echo $credential->column_4 ?>" placeholder="From">
                                            </div>
                                            <span class="dash"> - </span>
                                            <div class="item-input">
                                                <input type="text" name="yearended" value="<?php echo ($credential->column_5 > 0) ? $credential->column_5 : "" ?>" placeholder="To">
                                            </div>

                                            <div class="item-input-radio">
                                                <label>
                                                    <input type="checkbox" checked="" value="1" <?php echo ($credential->column_5 == 0) ? "checked" : "" ?> id="" name="is_graduated"> Graduated?
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item-after">
                                    <button type="button" id="<?php echo $credential->id ?>" class="update-profile-info btn-raised" rel="education-form-<?php echo $credential->id ?>" data-type="education" data-action="credentials">Save</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if($credential->credential_type == 3) { ?>    
            <div id="box-work-<?php echo $credential->id ?>" class="list-item content-media-list item-work">
                <div class="content-list-inner">
                    <div class="item-media">
                        <i class="icon i-work"></i>
                    </div>

                    <div class="item-inner">
                        <div class="stats-title">
                            <?php echo $credential->credential ?>
                        </div>
                    </div>

                    <?php if ($myprofile) { ?>
                        <div class="content-action">
                            <div class="btn-premove"><a href="javascript:void(0)" id="<?php echo $credential->id ?>" class="btn-remove-personal" rel="credentials" data-type="work">Remove</a></div>
                            <div class="btn-pedit">
                                Edit
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($myprofile) { ?>
                    <div class="content-list-edit">
                        {!! Form::open(['id' => "work-form-{$credential->id}"]) !!}
                            <div class="cl-edit-header">
                                <div class="item-title">Edit your work</div>
                                <div class="item-close"><i class="icon i-eclose"></i></div>
                            </div>
                            <div class="cl-edit-body">
                                <div class="item-input">
                                    <label>Company</label><input type="text" name="companyname" value="<?php echo $credential->column_1 ?>" placeholder="Name of your company">
                                </div>
                                <div class="item-input">
                                    <label>Position</label><input type="text" name="position" value="<?php echo $credential->column_2 ?>" placeholder="Your position (optional)">
                                </div>
                                <div class="item-input">
                                    <label>Company’s location</label><input type="text" name="location" value="<?php echo $credential->column_3 ?>" placeholder="Address of the company (optional)">
                                </div>

                            </div>
                            <div class="cl-add-footer">
                                <div class="item-title">
                                    <div class="item-input item-input-fromto">
                                        <label>Duration</label>
                                        <div class="item-input-row">
                                            <div class="item-input">
                                                <input type="text" name="yearstarted" value="<?php echo $credential->column_4 ?>" placeholder="From">
                                            </div>
                                            <span class="dash"> - </span>
                                            <div class="item-input">
                                                <input type="text" name="yearended" value="<?php echo ($credential->column_5 > 0) ? $credential->column_5 : "" ?>" placeholder="To">
                                            </div>

                                            <div class="item-input-radio">
                                                <label>
                                                    <input type="checkbox" checked="" value="1" <?php echo ($credential->column_5 == 0) ? "checked" : "" ?> name="is_current"> Working here?
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item-after">
                                    <button type="button" id="<?php echo $credential->id ?>" class="update-profile-info btn-raised" rel="work-form-<?php echo $credential->id ?>" data-type="work" data-action="credentials">Save</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if($credential->credential_type == 1) { ?>        
            <div id="box-general-<?php echo $credential->id ?>"class="list-item content-media-list item-general">
                <div class="content-list-inner">
                    <div class="item-media">
                        <i class="icon i-general"></i>
                    </div>

                    <div class="item-inner">
                        <div class="stats-title"><?php echo $credential->credential ?></div>
                    </div>

                    <?php if ($myprofile) { ?>
                        <div class="content-action">
                            <div class="btn-premove"><a href="javascript:void(0)" id="<?php echo $credential->id ?>" class="btn-remove-personal" rel="credentials" data-type="general">Remove</a></div>
                            <div class="btn-pedit">
                                Edit
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($myprofile) { ?>
                    <div class="content-list-edit">
                        {!! Form::open(['id' => "general-form-{$credential->id}"]) !!}
                            <div class="cl-edit-header">
                                <div class="item-title">Edit general information</div>
                                <div class="item-close"><i class="icon i-eclose"></i></div>
                            </div>
                            <div class="cl-edit-body">
                                <div class="item-input">
                                    <label>Information</label><input type="text" name="general_info" value="<?php echo $credential->credential ?>">
                                </div>
                            </div>
                            <div class="cl-edit-footer">
                                <div class="item-title"></div>
                                <div class="item-after">
                                    <button type="button" id="<?php echo $credential->id ?>" class="update-profile-info btn-raised" rel="general-form-<?php echo $credential->id ?>" data-type="general" data-action="credentials">Save</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                <?php } ?>
            </div>
        <?php } ?>    
    <?php } ?>
<?php } ?>