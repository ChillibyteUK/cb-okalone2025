<!-- solution_nav -->
<section class="sector_nav py-5">
    <div class="container">
        <div class="sector_nav__grid">
            <?php
            $parent = get_page_by_path('solutions');
            $q = new WP_Query(array(
                'post_type' => 'page',
                'post_parent' => $parent->ID,
                'posts_per_page' => -1
            ));
            while ($q->have_posts()) {
                $q->the_post();
                $post_slug = get_post_field('post_name', get_the_ID());
				$sector_value = null;
            ?>
                <a href="<?= get_the_permalink() ?>" class="sector_nav__card" data-filter="<?= $sector_value ?>">
                    <div class="sector_nav__image">
                        <?= get_the_post_thumbnail( get_the_ID(), 'large') ?>
                    </div>
                    <div class="sector_nav__container">
                        <?= get_the_title() ?>
                    </div>
                </a>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>