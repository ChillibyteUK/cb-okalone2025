<?php
/**
* Template Name: Author Template
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
<main id="main" class="single-author mt-5">
    <section class="breadcrumbs container-xl">
        <?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
		}
		?>
    </section>
    <div class="container-xl">
		<h1 class="h2"><?= get_the_title(); ?></h1>
		<?= get_the_post_thumbnail(get_the_ID(), 'medium', array( 'class' => 'd-block mx-auto mb-4 single-author__image' ) ); ?>
		<?=get_the_content()?>
		<h2>Latest Posts</h2>
		<?php
		$latest_posts = new WP_Query(
			array(
				'post_type' => 'post',
				'posts_per_page' => 5,
			)
		);
		if ( $latest_posts->have_posts() ) {
			echo '<ul class="list-unstyled">';
			while ( $latest_posts->have_posts() ) {
				$latest_posts->the_post();
				echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
			}
			echo '</ul>';
		} else {
			echo '<p>No posts found.</p>';
		}
		?>
	</div>
</main>
<?php
get_footer();
?>