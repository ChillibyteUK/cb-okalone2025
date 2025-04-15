<section class="author py-5">
	<div class="container-xl p-4 has-light-background-color">
		<div class="row g-5 justify-content-center">
			<div class="col-6 col-md-2">
				<?= wp_get_attachment_image( get_field( 'stacey_image', 'option' ), 'full', false, array( 'class' => 'img-fluid rounded-circle' ) ); ?>
			</div>
			<div class="col-12 col-md-10">
				<h2>Stacey Manclark</h2>
				<p><?= get_field( 'stacey_bio', 'option' ); ?></p>
				<?= get_field( 'stacey_page', 'option' ); ?>
			</div>
		</div>
	</div>
</section>