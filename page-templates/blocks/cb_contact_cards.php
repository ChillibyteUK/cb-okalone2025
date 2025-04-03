<section class="contact">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-4">
                <div class="contact__card contact__card--white">
                    <h2 class="h3"><?= esc_html( get_field( 'title_1' ) ); ?></h2>
                    <div><?= wp_kses_post( get_field( 'content_1' ) ); ?></div>
                    <div>
                        <span class="button button-yellow" role="button" data-bs-toggle="modal" data-bs-target="#newModal">
                            <span><?= esc_html( get_field( 'button_title' ) ); ?></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact__card contact__card--white">
					<h2 class="h3"><?= esc_html( get_field( 'title_2' ) ); ?></h2>
					<div><?= wp_kses_post( get_field( 'content_2' ) ); ?></div>
                    <div>
                        <a class="button button-yellow" href="<?= esc_url( get_field( 'help_center_link' ) ); ?>" target="_blank">
							<span><?= esc_html( get_field( 'help_center_button' ) ); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact__card contact__card--blue">
					<h2 class="h3"><?= esc_html( get_field( 'title_3' ) ); ?></h2>
					<div><?= wp_kses_post( get_field( 'content_3' ) ); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-center mx-auto" id="newLabel">
                    <div class="h3 text-black">Contact Us</div>
                </div>
                <button type="button" class="btn-modal btn-close align-self-start" style="background:none;border:none" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div><?= wp_kses_post( get_field( 'form_intro' ) ); ?></div>
                <iframe style="border: 0;" src="<?= esc_url( get_field( 'form_url' ) ); ?>" width="100%" height="1600" frameborder="0" scrolling="auto"></iframe>
            </div>
        </div>
    </div>
</div>