<?php

if (!is_admin()) {
    wp_register_script('bootstrap',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'));
    wp_register_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'));
    wp_register_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'));
    wp_register_script('jquery-ui', get_template_directory_uri() . '/js/jquery.ui.js', array('jquery'));
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('owl-carousel');
    wp_enqueue_script('jquery-ui');
    wp_enqueue_script('main');
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_register_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');
    wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_register_style('yamm', get_template_directory_uri() . '/css/yamm.min.css');
    wp_register_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('owl-carousel');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('yamm');
    wp_enqueue_style('style');
}
add_action('widgets_init', 'theme_slug_widgets_init');
function theme_slug_widgets_init()
{
    register_sidebar(array(
        'id' => 'right-block',
        'before_title' => '<div class="left-red-block widget-title">',
        'after_title' => '</div>',
        'name' => __('Right block'),
        'before_widget' => '<div id="%1$s" class="right-block-widget widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'id' => 'top-block',
        'before_title' => '<div class="top-widget-title">',
        'after_title' => '</div>',
        'name' => __('Top mobile/tablet block'),
        'before_widget' => '<div id="%1$s" class="top-block-widget col-sm-4 hidden-md hidden-lg widget %2$s">',
        'after_widget' => '</div>'
    ));
}

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

add_action('add_meta_boxes', 'featured_bg_position');
add_action('save_post', 'featured_bg_position_save');

function featured_bg_position()
{
    add_meta_box('featured_bg_position', __('Featured background top position'), 'featured_bg_position_block', null, 'side', 'low');
}

function featured_bg_position_block($post)
{
    $featured_bg_position = get_post_field('featured_bg_position', $post);
    ?>
    <input class="" type="number" name="featured_bg_position" style="width: 100%" min="0" max="100" value="<?php echo $featured_bg_position ? $featured_bg_position : 50; ?>"/>
    <?php
}

function featured_bg_position_save($post_id)
{
    if (!isset($_POST['featured_bg_position'])) {
        return $post_id;
    } else {
        $featured_bg_position_post_value = 50;
        if (!empty($_POST['featured_bg_position'])) {
            $featured_bg_position_post_value = $_POST['featured_bg_position'];
        }
        update_post_meta($post_id, 'featured_bg_position', $featured_bg_position_post_value);
    }
}

function add_image_class_dimensions($html, $id, $alt, $title)
{
    if (preg_match('/width="(\d+)" height="(\d+)"/', $html, $dimensions)) {
        list(, $width, $height) = $dimensions;
        if ($width >= 451) {
            $html = str_replace(
                'class="',
                'class="full-size-image ',
                $html
            );
        } else if ($width >= 303 && $width <= 450) {
            $html = str_replace(
                'class="',
                'class="short-size-image ',
                $html
            );
        }
    }
    return $html;

}

add_filter('get_image_tag', 'add_image_class_dimensions', 10, 4);


function mce_mod($init)
{


    $style_formats = array(
        array('title' => 'Image Caption', 'inline' => 'span', 'classes' => 'caption'),
        array('title' => 'Text with top space', 'inline' => 'span', 'classes' => 'one-space-text')
    );

    $init['style_formats'] = json_encode($style_formats);

    $init['style_formats_merge'] = true;
    return $init;
}

add_filter('tiny_mce_before_init', 'mce_mod');


//Funcition create shortcode for block Pricing
function create_blockpricing($args, $content)
{
    $displaynone = $args['title_url'] == "" ? 'display: none' : 'display: block';
    $content = '<div class="pricing-adam">';
    //$content = '<div class="pricing-adam"><span class="title">'.$args['title_blockpricing'].'</span><a href="'.$args['url'].'" target="'.$args['target_url'].'" alt="" title=""><img src="'.get_bloginfo('template_url').'/images/dload.png" alt=""/><span class="title-img">'.$args['title_url'].'</span></a></div>';
    if (!empty($args['title_blockpricing'])) {
        $content .= '<span class="title">' . $args['title_blockpricing'] . '</span><br>';
    }
    if (!empty($args['title_url'])) {
        $content .= '<a href="' . $args['url'] . '" target="' . $args['target_url'] . '" alt="" title="">
        <span style="' . $displaynone . '" class="title-img glyphicon glyphicon-download-alt">
        ' . $args['title_url'] . '
        </span>
        </a>';
    }
    $content .= "</div>";
    return $content;
}

add_shortcode('blockpricing', 'create_blockpricing');

//Hook shortcode into TinyMCE - WordPress
add_action('init', 'add_button');
function add_button()
{
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'add_plugin');
        add_filter('mce_buttons', 'register_button');
    }
}

function register_button($buttons)
{
    array_push($buttons, "create_pricing_button");
    return $buttons;
}

function add_plugin($plugin_array)
{
    $path = get_bloginfo('template_url') . '/js/js-adam.js';
    $plugin_array['create_pricing_button'] = $path;
    return $plugin_array;
}

function wpseo_canonical_exclude($canonical)
{
    return false;
}

add_filter('wpseo_canonical', 'wpseo_canonical_exclude');
add_filter('wpseo_next_rel_link', 'wpseo_canonical_exclude');
add_filter('wpseo_prev_rel_link', 'wpseo_canonical_exclude');



/**
 * Set the Attachment Display Settings "Link To" default to "file"
 */
function default_attachment_display_settings() {
    update_option( 'image_default_link_type', 'file' );
}
add_action( 'after_setup_theme', 'default_attachment_display_settings' );

function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '<div style="overflow:hidden;">\1\2\3</div>', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

/**
 * Disable Self Pingbacks
 */
function disable_self_trackback( &$links ) {
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}

add_action( 'pre_ping', 'disable_self_trackback' );

function es_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'es_theme_add_editor_styles' );