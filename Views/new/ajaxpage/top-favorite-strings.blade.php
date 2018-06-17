<?php if (count($top_strings) > 0) { ?>
    <?php foreach ($top_strings as $string) { ?>
        <?php if (!empty($string['coverphoto'])) { ?>
            <div class="ust-item" style="background-image: url('<?php echo Config::get('app.url') . 'upload/topics/thumbs/' . $string['coverphoto'] ?>');">
            <?php } else { ?>
                <div class="ust-item" style="background-color:<?php echo $string['color'] ?>;">    
                <?php } ?>
                <div class="ust-shading"></div>
                <a href='<?php echo URL::route('view-string', $string['slug']) ?>' target="_blank">~<?php echo $string['string_alias'] ?></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>