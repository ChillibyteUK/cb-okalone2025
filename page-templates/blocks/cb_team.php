<?php

$show_bios = get_field('show_bios') ?? null;
$full = (!empty($show_bios) && is_array($show_bios) && $show_bios[0] === 'Yes') ? true : null;

$cols = $full === true ? 'col-md-6' : 'col-md-3';

$teams = get_field('team') ?? null;

?>
<section class="team">
    <div class="container-xl">
        <div class="row g-4">
            <?php
            $q = new WP_Query(array(
                'post_type'      => 'person',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'team',
                        'field'    => 'term_id',
                        'terms'    => $teams, // Replace with your ACF checkbox value
                        'operator' => 'IN', // Matches any of the selected terms
                    ),
                ),
            ));
            if ($q->have_posts()) {
                while ($q->have_posts()) {
                    $q->the_post();
                    ?>
                <div class="<?=$cols?>">
                    <div class="team__card">
                        <?=get_the_post_thumbnail(get_the_ID(),'large',['class' => 'team__image'])?>
                        <h3 class="team__name"><?=get_the_title()?></h3>
                        <div class="team__role"><?=get_field('role',get_the_ID())?></div>
                        <?php
                        if ($full) {
                            ?>
                            <div class="team__bio"><?=get_the_content()?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                    <?php
                }
            }   
            ?>
        </div>        
    </div>
</section>