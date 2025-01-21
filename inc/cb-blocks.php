<?php
function acf_blocks()
{
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'                => 'cb_homepage_hero',
            'title'                => __('CB Homepage Hero'),
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'render_template'    => 'page-templates/blocks/cb_homepage_hero.php',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_top_tab_group',
            'title'                => __('CB Top Tab Group'),
            'render_template'    => 'page-templates/blocks/cb_top_tab_group.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_text_video',
            'title'                => __('CB Text Video'),
            'render_template'    => 'page-templates/blocks/cb_text_video.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_text_image',
            'title'                => __('CB Text Image'),
            'render_template'    => 'page-templates/blocks/cb_text_image.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'CB Logo Slider',
            'title'                => __('CB Logo Slider'),
            'description'        => __(''),
            'render_template'    => 'page-templates/blocks/cb_logo_slider.php',
            'category'            => 'layout',
            'icon'                => 'slides',
            'keywords'            => array('logo', 'slider'),
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_case_study_quotes',
            'title'                => __('CB Case Study / Quotes'),
            'render_template'    => 'page-templates/blocks/cb_case_study_quotes.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_spinner',
            'title'                => __('CB Stat Spinner'),
            'render_template'    => 'page-templates/blocks/cb_spinner.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_app_cta',
            'title'                => __('CB App CTA'),
            'render_template'    => 'page-templates/blocks/cb_app_cta.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_gradient_cta',
            'title'                => __('CB Gradient CTA'),
            'render_template'    => 'page-templates/blocks/cb_gradient_cta.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_sector_slider',
            'title'                => __('CB Sector Slider'),
            'render_template'    => 'page-templates/blocks/cb_sector_slider.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block(array(
            'name'                => 'cb_faqs',
            'title'                => __('CB FAQs'),
            'render_template'    => 'page-templates/blocks/cb_sector_slider.php',
            'category'            => 'layout',
            'icon'                => 'cover-image',
            'mode'    => 'edit',
            'supports' => array('mode' => false),
        ));
    }
}
add_action('acf/init', 'acf_blocks');

// Gutenburg core modifications
add_filter('register_block_type_args', 'core_image_block_type_args', 10, 3);
function core_image_block_type_args($args, $name)
{
    if ($name == 'core/paragraph') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/heading') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/list') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    // if ($name == 'yoast-seo/breadcrumbs') {
    //     $args['render_callback'] = 'modify_core_add_container';
    // }
    return $args;
}

function modify_core_add_container($attributes, $content)
{
    ob_start();
    // $class = $block['className'];
?>
    <div class="container-xl">
        <?= $content ?>
    </div>
<?php
    $content = ob_get_clean();
    return $content;
}
