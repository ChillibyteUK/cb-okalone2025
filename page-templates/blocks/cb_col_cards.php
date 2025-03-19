<?php
$cols = get_field('columns');
$columns = 'col-md-6 col-lg-4';

if ($cols === '2') {
    $columns = 'col-md-6';    
    $resetAfter = 2; // Reset after 2 cards
} else {
    $resetAfter = 3; // Reset after 3 cards
}


$d = 0;
$count = 0;
?>
<section class="col_cards">
    <div class="container-xl py-5">
        <div class="row g-5 justify-content-center">
            <?php
            while (have_rows('cards')) {
                the_row();
                $l = get_sub_field('link') ?? null;
                ?>
            <div class="<?=$columns?>" data-aos="fade" data-aos-delay="<?=$d?>">
                <div class="col_cards__card">
                    <?=wp_get_attachment_image(get_sub_field('image'),'large',false,['class' => 'col_cards__image'])?>
                    <h2 class="col_cards__title mb-0"><?=get_sub_field('title')?></h2>
                    <div class="col_cards__content fs-300 text--mid-grey p-3"><?php
                    $content = get_sub_field('content');
                    
                    // Remove unwanted <br> before and after list tags
                    $content = preg_replace('/(<br\s*\/?>\s*)?(<\/?(ul|ol|li)>)(\s*<br\s*\/?>)?/i', '$2', $content);
                    
                    echo $content;
                    ?></div>
                    <?php
                    if (!empty($l)) {
                        ?>
                    <a href="<?=$l['url']?>" target="<?=$l['target']?>" class="col_cards__button button button-yellow"><?=$l['title']?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>  
                <?php
                $count++;
                if ($count % $resetAfter === 0) {
                    $d = 0; // Reset delay
                } else {
                    $d += 200;
                }
            }
            ?>   
        </div>
    </div>
</section>