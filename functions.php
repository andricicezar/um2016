<?php 

add_action('init', 'register_menus');
add_filter('post_gallery', 'my_post_gallery', 10, 2);
add_action('wp_enqueue_scripts', 'styles_and_scripts');

function register_menus() {
  register_nav_menus( array(
    'main-menu' => 'Meniu Principal'
  ) );
}

function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"gallery\">\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
//      $img = wp_get_attachment_image_src($id, 'medium');
//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, 'medium');
        $img_full = wp_get_attachment_image_src($id, 'large');
		$output .= '<div class="gallery-item"><a href="'.$img_full[0].'" data-lightbox="um2016"><img src="'.$img[0].'"></a></div>';
    }

    $output .= "</ul>\n";
    $output .= "</div>\n";

    return $output;
}

function styles_and_scripts() {
  wp_enqueue_script('jquery');
  wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');

  if (is_front_page()) {
    wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', array(), '1.0.0', true);
  }

  wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array(), '3.3.6', true);

  if (is_page('galerie-foto')) {
    wp_enqueue_script('jquery-masonry');
    wp_enqueue_style('lightbox-css', get_template_directory_uri() . '/vendor/lightbox/lightbox.min.css');
    wp_enqueue_script('lightbox-js', get_template_directory_uri() . '/vendor/lightbox/lightbox.min.js', array(), '1.0.0', true);
  }

  wp_enqueue_style('main-style', get_stylesheet_uri());
  wp_enqueue_script('main-script', get_template_directory_uri() . '/script.js', array(), '1.0.1', true);
}
?>
