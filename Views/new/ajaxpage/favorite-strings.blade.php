<?php if($myprofile) { ?>
    <?php if (count($favorite_strings) > 0) { ?>
        <!-- placeholder if has fav strings -->
        <div class="content-tags content-fav-tags">
            <ul class="tags">
                <?php foreach ($favorite_strings as $string) { ?>
                    <li class="fav-tags has-image toggle-content" style="background-image: url(dedicated-image-01.JPG)">
                        <a href="javascript:void(0)">~<?php echo $string->string_alias ?></a>

                        <div class="fav-tags-action">
                            <div class="btn-tag-edit"><i class="icon i-edit toggle-open"></i></span></div>
                            <div class="btn-tag-delete btn-remove-favorite-string" id="<?php echo $string->id ?>"><i class="icon i-delete"></i></span></div>
                        </div>

                        <div class="fav-tags-search toggle-close">
                            <input type="text" name="" value="" placeholder="Search tags">
                            <ul class="tags-search">
                                <?php if (!empty($string->coverphoto)) { ?>
                                    <li class="has-image" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string->coverphoto ?>')">
                                <?php } else { ?>
                                    <li class="has-image" style="background-color:<?php echo $string->color ?>;">    
                                <?php } ?>
                                    <a href="<?php echo URL::route('view-string', $string->slug) ?>" target="_blank">~<?php echo $string->string_alias ?></a>
                                    <input type="hidden" value="~<?php echo $string->string_alias ?>" name="tags[]">
                                </li>
                            </ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                <?php } ?>
                <?php if (count($favorite_strings) == 1) { ?>    
                    <li class="fav-tags-add toggle-content">
                        <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>
                        <div class="fav-tags-search toggle-close">
                            <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                            <ul class="tags-search"></ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                    <li class="fav-tags-add toggle-content">
                        <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>
                        <div class="fav-tags-search toggle-close">
                            <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                            <ul class="tags-search"></ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                <?php } ?>

                <?php if (count($favorite_strings) == 2) { ?>    
                    <li class="fav-tags-add toggle-content">
                        <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>
                        <div class="fav-tags-search toggle-close">
                            <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                            <ul class="tags-search"></ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                <?php } ?>    
            </ul>
        </div>
    <?php } else { ?>
        <!-- placeholder if no fav strings -->
        <div class="content-tags content-fav-tags">
            <ul class="tags">
                <!-- placeholder only -->
                <li class="fav-tags-add toggle-content">
                    <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>
                    <div class="fav-tags-search toggle-close">
                        <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                        <ul class="tags-search"></ul>
                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                    </div>
                </li>
                <!-- sample fav tags - search -->
                <li class="fav-tags-add toggle-content">
                    <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>

                    <div class="fav-tags-search toggle-close">
                        <input type="text" rel="2" class="search_favorite_strings" placeholder="Search strings">
                        <ul class="tags-search"></ul>
                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                    </div>
                </li>
                <li class="fav-tags-add toggle-content">
                    <a href="javascript:void(0)" class="btn-add-favtag"><i class="icon toggle-open"></i></a>
                    <div class="fav-tags-search toggle-close">
                        <input type="text" rel="3" class="search_favorite_strings" placeholder="Search strings">
                        <ul class="tags-search"></ul>
                        <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                    </div>
                </li>
            </ul>
        </div>  
    <?php } ?>
<?php } else { ?>
    
    <?php if (count($favorite_strings) > 0) { ?>
        <!-- placeholder if has fav strings -->
        <div class="content-tags content-fav-tags">
            <ul class="tags">
                <?php foreach ($favorite_strings as $string) { ?>
                    <li class="fav-tags has-image toggle-content" style="background-image: url(dedicated-image-01.JPG)">
                        <a href="javascript:void(0)">~<?php echo $string->string_alias ?></a>

                        <div class="fav-tags-search toggle-close">
                            <input type="text" name="" value="" placeholder="Search tags">
                            <ul class="tags-search">
                                <?php if (!empty($string->coverphoto)) { ?>
                                    <li class="has-image" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string->coverphoto ?>')">
                                <?php } else { ?>
                                    <li class="has-image" style="background-color:<?php echo $string->color ?>;">    
                                <?php } ?>
                                    <a href="<?php echo URL::route('view-string', $string->slug) ?>" target="_blank">~<?php echo $string->string_alias ?></a>
                                    <input type="hidden" value="~<?php echo $string->string_alias ?>" name="tags[]">
                                </li>
                            </ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                <?php } ?>
                <?php if (count($favorite_strings) == 1) { ?>    
                    <li class="fav-tags-add toggle-content">
                       <div class="fav-tags-search toggle-close">
                            <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                            <ul class="tags-search"></ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                    <li class="fav-tags-add toggle-content">
                        <div class="fav-tags-search toggle-close">
                            <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                            <ul class="tags-search"></ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                <?php } ?>

                <?php if (count($favorite_strings) == 2) { ?>    
                    <li class="fav-tags-add toggle-content">
                        <div class="fav-tags-search toggle-close">
                            <input type="text" rel="1" class="search_favorite_strings" placeholder="Search strings">
                            <ul class="tags-search"></ul>
                            <button type="button" name="button" class="btn-cancel-fav">Cancel</button>
                        </div>
                    </li>
                <?php } ?>    
            </ul>
        </div>
    <?php }  ?>    
        
<?php } ?>
