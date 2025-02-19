<section class="pricing-plans pb-5">
    <div class="container-xl">
        <div class="row d-none d-md-flex justify-content-center g-4">
            <?php 
            if (have_rows('plans')) {
                while (have_rows('plans')) {
                    the_row();
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $cta = get_sub_field('cta');
                    $cta_text = $cta['title'];
                    $cta_url = $cta['url'];
                    $features = get_sub_field('features');
                    $features_intro = get_sub_field('features_intro');
                    $highlighted = get_sub_field('highlight'); 
                    $button = $highlighted ? 'button-yellow' : 'button-outline';
            ?>
                <div class="col-md-6 col-lg-3 <?=$highlighted ? '' : 'pt-2rem' ?>">
                    <div class="card pricing-card h-100 <?= $highlighted ? 'border-highlight' : '' ?>">
                        <h4 class="card-title">
                            <?php
                            if ($highlighted) {
                                ?>
                                <div class="pill">
                                    Recommended Plan
                                </div>
                                <?php 
                            } 
                            ?>
                            <?= esc_html($title) ?>
                        </h4>
                        <div class="card-body text-center">
                            <div class="card-text"><?= $description ?></div>
                            <a href="<?= esc_url($cta_url) ?>" class="button <?=$button?> d-block mb-2"><span><?= esc_html($cta_text) ?></span></a>
                            <hr>
                            <?php if ($features) { ?>
                                <p class="text-start fs-300"><?=$features_intro?></p>
                                <ul class="fa-ul text-start mt-3">
                                    <?php 
                                    foreach ($features as $feature) { 
                                        echo '<li><span class="fa-li"><i class="fa-solid fa-check"></i></span> ' . esc_html($feature['feature_text']) . "</li>";
                                    } 
                                    ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php 
                } 
            } 
            ?>
        </div>

        <!-- Mobile Accordion -->
        <div class="accordion d-md-none" id="pricingAccordion">
            <?php 
            if (have_rows('plans')) {
                $index = 0;
                while (have_rows('plans')) {
                    the_row();
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $cta = get_sub_field('cta');
                    $cta_text = $cta['title'];
                    $cta_url = $cta['url'];
                    $features = get_sub_field('features');
                    $features_intro = get_sub_field('features_intro');
                    $highlighted = get_sub_field('highlight'); 
                    $button = $highlighted ? 'button-yellow' : 'button-outline';
                    $collapse_id = 'collapse' . $index;

            ?>
                <div class="accordion-item <?=$highlighted ? 'accordion-highlighted' : '' ?>">
                    <h2 class="accordion-header" id="heading<?= $index ?>">
                        <button class="accordion-button <?= $highlighted ? '' : 'collapsed' ?>" 
                                type="button" data-bs-toggle="collapse" 
                                data-bs-target="#<?= $collapse_id ?>" 
                                aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" 
                                aria-controls="<?= $collapse_id ?>">
                            <?= esc_html($title) ?>
                        </button>
                    </h2>
                    <div id="<?= $collapse_id ?>" class="accordion-collapse collapse <?= $highlighted ? 'show' : '' ?>" 
                         aria-labelledby="heading<?= $index ?>" data-bs-parent="#pricingAccordion">
                        <div class="accordion-body text-center">
                            <?php
                            if ($highlighted) {
                                ?>
                            <div class="pill">
                                Recommended Plan
                            </div>

                                <?php
                            }
                            ?>
                            <div class="accordion-text"><?= $description ?></div>
                            <a href="<?= esc_url($cta_url) ?>" class="d-block button <?=$button?>"><span><?= esc_html($cta_text) ?></span></a>
                            <hr>
                            <?php if ($features) { ?>
                                <p class="text-start fs-300"><?=$features_intro?></p>
                                <ul class="fa-ul text-start mt-3">
                                    <?php 
                                    foreach ($features as $feature) { 
                                        echo '<li><span class="fa-li"><i class="fa-solid fa-check"></i></span> ' . esc_html($feature['feature_text']) . "</li>";
                                    } 
                                    ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php 
                $index++;
                } 
            } 
            ?>
        </div>
    </div>
</section>
