<?php 
    $is_acquaintances = false; 
    $is_friends       = false;

    if(count($con_acquaintances) > 0) { 
        if($con_acquaintances->status) { 
            $is_acquaintances = true;
        }
    }

    if(count($con_friends) > 0) {
        if($con_friends->status) {
            $is_friends = true;
        }
    }

    /**
     * Condition will go here 
     */
    $show_address = $helpers->privacy_profile_check([
        'is_friends'        => $is_friends,
        'is_acquaintances'  => $is_acquaintances,
        'needle'            => $profile_settings->address,
        'owner'             => $myprofile
    ]);
?>

<?php if (!empty($user_profile[0]->address) && $show_address) { ?>
    <div class="list-item content-media-list item-location">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-location"></i>
            </div>

            <div class="item-inner">
                <div id="location-info-text" class="stats-title"><?php echo $user_profile[0]->address ?></div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_address_text = "Anyone";
                            if($profile_settings->address == 1) {
                                $active_address_text = "Followers & Friends";
                            } else if($profile_settings->address == 2) {
                                $active_address_text = "Friends only";
                            } else if($profile_settings->address == 3) {
                                $active_address_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-address"><?php echo $active_address_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->address == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="address" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->address == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="address" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->address == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="address" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->address == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="address" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div class="btn-premove btn-remove-location" rel="location">Remove</div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Location</div>
                </div>
            <?php } ?>
        </div>

        <?php if ($myprofile) { ?>
            <!-- if edit -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'location-info']) !!}
                    <div class="cl-edit-header">
                        <div class="item-title">Edit your location</div>
                        <div class="item-close"><i class="icon i-eclose"></i></div>
                    </div>
                    <div class="cl-edit-body">
                        <div class="item-input">
                            <label>Your location</label><input type="text" name="location" value="<?php echo $user_profile[0]->address ?>">
                        </div>
                    </div>
                    <div class="cl-edit-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="button" class="update-profile-info btn-raised" name="location-info" rel="location-info">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div><!-- if edit -->
        <?php } ?>
            
    </div>
<?php } ?>


<?php 

$show_gender = $helpers->privacy_profile_check([
    'is_friends'        => $is_friends,
    'is_acquaintances'  => $is_acquaintances,
    'needle'            => $profile_settings->gender,
    'owner'             => $myprofile
]);

?>

<?php if($show_gender) { ?>
    <div class="list-item content-media-list item-gender">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-gender"></i>
            </div>

            <div class="item-inner">
                <div id="gender-info-text" class="stats-title">
                    <?php echo $user->gender == "N" ? "Others, {$user->gender_custom}" : ($user->gender == "M" ? "Male" : "Female") ?>
                </div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_gender_text = "Anyone";
                            if($profile_settings->gender == 1) {
                                $active_gender_text = "Followers & Friends";
                            } else if($profile_settings->gender == 2) {
                                $active_gender_text = "Friends only";
                            } else if($profile_settings->gender == 3) {
                                $active_gender_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-gender"><?php echo $active_gender_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->gender == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="gender" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->gender == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="gender" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->gender == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="gender" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->gender == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="gender" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Gender</div>
                </div>
            <?php } ?>
        </div>

        <?php if ($myprofile) { ?>
            <!-- if edit -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'gender-info']) !!}
                <div class="cl-edit-header">
                    <div class="item-title">Edit your gender</div>
                    <div class="item-close"><i class="icon i-eclose"></i></div>
                </div>
                <div class="cl-edit-body">
                    <div class="item-input">
                        <label>Your gender</label>
                        <select class="txt-gender" name="gender">
                            <option value="M" <?php echo $user->gender == "M" ? "selected" : "" ?>>Male</option>
                            <option value="F" <?php echo $user->gender == "F" ? "selected" : "" ?>>Female</option>
                            <option value="N" <?php echo $user->gender == "N" ? "selected" : "" ?>>Others</option>
                        </select>
                        <input type="text" name="custom-gender" value="<?php echo $user->gender_custom ?>" class="txt-custom-gender" placeholder="Custom gender"
                               <?php echo $user->gender == "N" ? 'style=display:inline-block' : "" ?>>
                    </div>
                </div>
                <div class="cl-edit-footer">
                    <div class="item-title">You can change your gender only once</div>
                    <div class="item-after">
                        <button type="button" class="update-profile-info btn-raised" name="gender-info" rel="gender-info">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div><!-- if edit -->
        <?php } ?>

    </div><!-- list-item -->
<?php } ?>
 
<?php 

$show_bdate = $helpers->privacy_profile_check([
    'is_friends'        => $is_friends,
    'is_acquaintances'  => $is_acquaintances,
    'needle'            => $profile_settings->birthdate,
    'owner'             => $myprofile
]);

?>

<?php if($show_bdate) { ?>    
    <!-- ============ BIRTHDATE ============ -->
    <div class="list-item content-media-list item-birthdate">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-birthdate"></i>
            </div>

            <div class="item-inner">
                <div id="birthdate-text" class="stats-title">
                    <?php echo Config::get('helper.months')[$user->userbasicinfo->birthmonth] . ' ' . $user->userbasicinfo->birthday . ', ' . $user->birthyear ?>
                </div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_birthdate_text = "Anyone";
                            if($profile_settings->birthdate == 1) {
                                $active_birthdate_text = "Followers & Friends";
                            } else if($profile_settings->birthdate == 2) {
                                $active_birthdate_text = "Friends only";
                            } else if($profile_settings->birthdate == 3) {
                                $active_birthdate_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-birthdate"><?php echo $active_birthdate_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->birthdate == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="birthdate" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->birthdate == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="birthdate" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->birthdate == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="birthdate" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->birthdate == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="birthdate" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Birthdate</div>
                </div>
            <?php } ?>
        </div>

        <?php if ($myprofile) { ?>
            <!-- if edit -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'birthdate']) !!}
                <div class="cl-edit-header">
                    <div class="item-title">Edit your birthdate</div>
                    <div class="item-close"><i class="icon i-eclose"></i></div>
                </div>
                <div class="cl-edit-body">
                    <div class="item-input">
                        <label>Birthday</label>
                        <div class="birthdate-content">
                            <?php
                            $current_day = Carbon::today();
                            $current_year = date('Y', strtotime($current_day));
                            $last_day = date('t', strtotime($current_day));
                            ?>
                            <select class="txt-month" name="month">
                                <?php for ($i = 1; $i <= 12; $i++) { ?>
                                    <?php $month = $i < 10 ? "0" . $i : $i ?>
                                    <option value="<?php echo $i ?>" <?php echo $user->userbasicinfo->birthmonth == $month ? "selected" : "" ?>><?php echo Config::get('helper.months')[$i] ?></option>
                                <?php } ?>
                            </select>
                            <select class="txt-day" name="day">

                                <?php for ($i = 1; $i <= $last_day; $i++) { ?>
                                    <?php $day = $i < 10 ? "0" . $i : $i ?>
                                    <option value="<?php echo $day ?>" <?php echo $user->userbasicinfo->birthday == $day ? "selected" : "" ?>><?php echo $day ?></option>
                                <?php } ?>
                            </select>
                            <select class="txt-year" name="year">
                                <?php for ($i = $current_year; $i >= 1970; $i--) { ?>
                                    <option value="<?php echo $i ?>" <?php echo $user->birthyear == $i ? "selected" : "" ?>><?php echo $i ?></option>
                                <?php } ?>    
                            </select>
                        </div>

                    </div>
                </div>
                <div class="cl-edit-footer">
                    <div class="item-title">You can change your brithdate only once</div>
                    <div class="item-after">
                        <button type="button" class="update-profile-info btn-raised" name="birthdate" rel="birthdate">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div><!-- if edit -->
        <?php } ?>    
    </div>
<?php } ?>

<?php 

$show_political_view = $helpers->privacy_profile_check([
    'is_friends'        => $is_friends,
    'is_acquaintances'  => $is_acquaintances,
    'needle'            => $profile_settings->political_view,
    'owner'             => $myprofile
]);

?>
  
<?php if (!empty($user->userbasicinfo->politics) && $show_political_view) { ?>
    <!-- ============ POLITICAL VIEW ============ -->
    <div id="box-politics" class="list-item content-media-list item-political-view">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-political-view"></i>
            </div>

            <div class="item-inner">
                <div id="politics-text" class="stats-title">
                    <?php echo $user->userbasicinfo->politics ?>
                </div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_political_view_text = "Anyone";
                            if($profile_settings->political_view == 1) {
                                $active_political_view_text = "Followers & Friends";
                            } else if($profile_settings->political_view == 2) {
                                $active_political_view_text = "Friends only";
                            } else if($profile_settings->political_view == 3) {
                                $active_political_view_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-political_view"><?php echo $active_political_view_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->political_view == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="political_view" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->political_view == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="political_view" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->political_view == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="political_view" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->political_view == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="political_view" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div class="btn-premove btn-remove-personal" rel="politics">Remove</div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Political Views</div>
                </div>
            <?php } ?>
        </div>

        <?php if ($myprofile) { ?>
            <!-- if edit -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'politics']) !!}
                <div class="cl-edit-header">
                    <div class="item-title">Edit your political view</div>
                    <div class="item-close"><i class="icon i-eclose"></i></div>
                </div>
                <div class="cl-edit-body">
                    <div class="item-input">
                        <label>Your view</label><input type="text" name="politics-view" value="<?php echo $user->userbasicinfo->politics ?>">
                    </div>
                </div>
                <div class="cl-edit-footer">
                    <div class="item-title"></div>
                    <div class="item-after">
                        <button type="button" class="update-profile-info btn-raised" name="politics" rel="politics">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div><!-- if edit -->
        <?php } ?>    
    </div><!-- list-item -->
<?php } ?>

<?php 

$show_religion = $helpers->privacy_profile_check([
    'is_friends'        => $is_friends,
    'is_acquaintances'  => $is_acquaintances,
    'needle'            => $profile_settings->religion,
    'owner'             => $myprofile
]);

?>
<?php if (!empty($user->userbasicinfo->religion) && $show_religion) { ?>
    <!-- ============ RELIGION ============ -->
    <div id="box-religion" class="list-item content-media-list item-religion">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-religion"></i>
            </div>

            <div class="item-inner">
                <div id="religion-text" class="stats-title">
                    <?php echo $user->userbasicinfo->religion ?>
                </div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_religion_text = "Anyone";
                            if($profile_settings->religion == 1) {
                                $active_religion_text = "Followers & Friends";
                            } else if($profile_settings->religion == 2) {
                                $active_religion_text = "Friends only";
                            } else if($profile_settings->religion == 3) {
                                $active_religion_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-religion"><?php echo $active_religion_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->religion == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="religion" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->religion == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="religion" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->religion == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="religion" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->religion == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="religion" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div class="btn-premove btn-remove-personal" rel="religion">Remove</div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Religion</div>
                </div>
            <?php } ?>
        </div>

        <?php if ($myprofile) { ?>
            <!-- if edit -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'religion']) !!}
                <div class="cl-edit-header">
                    <div class="item-title">Edit your religion</div>
                    <div class="item-close"><i class="icon i-eclose"></i></div>
                </div>
                <div class="cl-edit-body">
                    <div class="item-input">
                        <label>Your religion</label><input type="text" name="my-religion" value="<?php echo $user->userbasicinfo->religion ?>">
                    </div>
                </div>
                <div class="cl-edit-footer">
                    <div class="item-title"></div>
                    <div class="item-after">
                        <button type="button" class="update-profile-info btn-raised" name="religion" rel="religion">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        <?php } ?>    
    </div><!-- list-item -->
<?php } ?>

<?php 

$show_blood_type = $helpers->privacy_profile_check([
    'is_friends'        => $is_friends,
    'is_acquaintances'  => $is_acquaintances,
    'needle'            => $profile_settings->blood_type,
    'owner'             => $myprofile
]);

?>    
<?php if (!empty($user->userbasicinfo->bloodtype) && $show_blood_type) { ?>
    <!-- ============ BLOODTYPE ============ -->
    <div id="box-bloodtype" class="list-item content-media-list item-bloodtype">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-bloodtype"></i>
            </div>

            <div class="item-inner">
                <div id="bloodtype-text" class="stats-title">
                    Bloodtype <?php echo $user->userbasicinfo->bloodtype ?>
                </div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_blood_type_text = "Anyone";
                            if($profile_settings->blood_type == 1) {
                                $active_blood_type_text = "Followers & Friends";
                            } else if($profile_settings->blood_type == 2) {
                                $active_blood_type_text = "Friends only";
                            } else if($profile_settings->blood_type == 3) {
                                $active_blood_type_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-blood_type"><?php echo $active_blood_type_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->blood_type == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="blood_type" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->blood_type == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="blood_type" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->blood_type == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="blood_type" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->blood_type == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="blood_type" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div class="btn-premove btn-remove-personal" rel="bloodtype">Remove</div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Bloodtype</div>
                </div>
            <?php } ?>
        </div>
        
        <?php if ($myprofile) { ?>
            <!-- FOR EDIT BLOODTYPE -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'bloodtype']) !!}
                    <div class="cl-edit-header">
                        <div class="item-title">Edit your bloodtype</div>
                        <div class="item-close"><i class="icon i-eclose"></i></div>
                    </div>
                    <div class="cl-edit-body">
                        <div class="item-input">
                            <label>Your bloodtype</label>
                            <select class="txt-bloodtype" name="my-bloodtype">
                                <?php foreach (Config::get('helper.bloodtype') as $bloodtype) { ?>
                                    <option value="<?php echo $bloodtype ?>" <?php echo $bloodtype == $user->userbasicinfo->bloodtype ?>><?php echo $bloodtype ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="cl-edit-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="button" class="update-profile-info btn-raised" name="bloodtype" rel="bloodtype">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        <?php } ?>
    </div><!-- list-item -->
<?php } ?>

<?php 

$show_contacts = $helpers->privacy_profile_check([
    'is_friends'        => $is_friends,
    'is_acquaintances'  => $is_acquaintances,
    'needle'            => $profile_settings->contacts,
    'owner'             => $myprofile
]);

?>    
<?php if((!empty($user_profile[0]->contact1)
        || !empty($user_profile[0]->contact2)
        || !empty($user_profile[0]->contact3)) && $show_contacts) { ?>
    <!-- ============ CONTACT ============ -->
    <div id="box-contact" class="list-item content-media-list item-contact">
        <div class="content-list-inner">
            <div class="item-media">
                <i class="icon i-contact"></i>
            </div>

            <div class="item-inner">
                <div class="stats-title">
                    <span>
                        <?php echo !empty($user_profile[0]->contact1) ? $user_profile[0]->contact1 ." <br>" : "" ?>
                        <?php echo !empty($user_profile[0]->contact2) ? $user_profile[0]->contact2 ." <br>" : "" ?>
                        <?php echo !empty($user_profile[0]->contact3) ? $user_profile[0]->contact3 ." <br>" : "" ?>
                    </span> 
                </div>
            </div>

            <?php if ($myprofile) { ?>
                <div class="content-action">
                    <div class="toggle-content">
                        <?php
                            $active_contacts_text = "Anyone";
                            if($profile_settings->contacts == 1) {
                                $active_contacts_text = "Followers & Friends";
                            } else if($profile_settings->contacts == 2) {
                                $active_contacts_text = "Friends only";
                            } else if($profile_settings->contacts == 3) {
                                $active_contacts_text = "Only me";
                            }
                        ?>
                        Privacy: <span class="profile-settings-contacts"><?php echo $active_contacts_text ?></span> <i class="icon i-dropdown toggle-open"></i>
                        <ul class="global-action-nav toggle-close profile-settings">
                            <li <?php echo $profile_settings->contacts == 0 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="contacts" data-value="0">Anyone</a></li>
                            <li <?php echo $profile_settings->contacts == 1 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="contacts" data-value="1">Followers & Friends</a></li>
                            <li <?php echo $profile_settings->contacts == 2 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="contacts" data-value="2">Friends only</a></li>
                            <li <?php echo $profile_settings->contacts == 3 ? "class='active'" : ""?>><a href="javascript:void(0)" data-type="contacts" data-value="3">Only me</a></li>
                        </ul>
                    </div>
                    <div style="display:<?php echo (empty($user_profile[0]->contact2) && empty($user_profile[0]->contact3)) ? "block" : "none" ?>" class="btn-premove btn-remove-personal btn-contact-remove-link" rel="contact">Remove</div>
                    <div class="btn-pedit">
                        Edit
                    </div>
                </div>
            <?php } else { ?>
                <div class="content-action">
                    <div>Contacts</div>
                </div>
            <?php } ?>
        </div>

        <?php if ($myprofile) { ?>
            <!-- if edit -->
            <div class="content-list-edit">
                {!! Form::open(['id' => 'contacts']) !!}
                    <div class="cl-edit-header">
                        <div class="item-title">Edit your contact</div>
                        <div class="item-close"><i class="icon i-eclose"></i></div>
                    </div>
                    <div class="cl-edit-body">
                        <div class="item-input">
                            <label>Your contact(s)</label>
                            <div class="contact-content">
                                <?php if(!empty($user_profile[0]->contact1)) { ?>
                                    <div class="contact-text">
                                        <input type="text" class="contact-input" name="contact1" value="<?php echo $user_profile[0]->contact1 ?>" placeholder="Contact number / telephone">
                                    </div>
                                <?php } ?>
                                <?php if(!empty($user_profile[0]->contact2)) { ?>
                                    <div class="contact-text">
                                        <input type="text" class="contact-input" name="contact2" value="<?php echo $user_profile[0]->contact2 ?>" placeholder="Contact number / telephone">
                                        <input type="button" value="Remove" class="btn-remove-personal btn-removecontact" rel="contacts" data-type="contact2">
                                    </div>
                                <?php } ?>
                                <?php if(!empty($user_profile[0]->contact3)) { ?>
                                    <div class="contact-text">
                                        <input type="text" class="contact-input" name="contact3" value="<?php echo $user_profile[0]->contact3 ?>" placeholder="Contact number / telephone">
                                        <input type="button" value="Remove" class="btn-remove-personal btn-removecontact" rel="contacts" data-type="contact3">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="cl-edit-footer">
                        <div class="item-title"></div>
                        <div class="item-after">
                            <button type="button" class="update-profile-info btn-raised" name="contacts" rel="contacts">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div><!-- if edit -->
        <?php } ?>
    </div>
<?php } ?>