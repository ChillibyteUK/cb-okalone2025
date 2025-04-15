<?php
$author_page = get_field( 'stacey_page', 'option' );
?>
<section class="author py-5">
	<div class="container-xl p-4 has-light-background-color">
		<div class="row g-5 justify-content-center">
			<div class="col-6 col-md-2">
				<?= wp_get_attachment_image( get_field( 'stacey_photo', 'option' ), 'full', false, array( 'class' => 'img-fluid rounded-circle' ) ); ?>
			</div>
			<div class="col-12 col-md-10">
				<h3>Stacey Manclark</h3>
				<p><?= get_field( 'stacey_bio', 'option' ); ?></p>
				<a href="<?= $author_page['url']; ?>"><?= $author_page['title']; ?></a>		
			</div>
		</div>
	</div>
</section>