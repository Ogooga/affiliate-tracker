<?php
/**
 * Register [affiliate_link] shortcode directly from this file
 */
function affiliate_tracker_shortcode($atts = array(), $content = null) {
    ob_start();
    $atts = shortcode_atts(array(
        'casino'    => '',
        'type_offer'=> '',
        'url'       => '',
        'position'  => '',
        'page_type' => '',
        'class'      => '',
    ), $atts);
    // If location is not set, use the current page URL
    if (empty($atts['location'])) {
        $atts['location'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    // If page_type is not set, detect WordPress page type
    if (empty($atts['page_type'])) {
        if (is_front_page()) {
            $atts['page_type'] = 'front_page';
        } elseif (is_home()) {
            $atts['page_type'] = 'blog_home';
        } elseif (is_singular('post')) {
            $atts['page_type'] = 'single_post';
        } elseif (is_singular('page')) {
            $atts['page_type'] = 'single_page';
        } elseif (is_archive()) {
            $atts['page_type'] = 'archive';
        } elseif (is_search()) {
            $atts['page_type'] = 'search';
        } elseif (is_404()) {
            $atts['page_type'] = '404';
        } else {
            $atts['page_type'] = 'other';
        }
    }
    $link_text = $content ? $content : 'Affiliate Link';
    ?>

        <?php
        // Ensure the URL contains the domain
        $full_url = $atts['url'];
        if (!empty($full_url) && strpos($full_url, 'http') !== 0) {
            // If not absolute, prepend site URL
            $site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
            if (substr($full_url, 0, 1) !== '/') {
                $full_url = '/' . $full_url;
            }
            $full_url = $site_url . $full_url;
        }
        ?>
        <a class="<?php echo esc_attr($atts['class']); ?>" href="<?php echo esc_url($full_url); ?>" target="_blank" rel="noopener"
            data-casino="<?php echo esc_attr($atts['casino']); ?>"
            data-type-offer="<?php echo esc_attr($atts['type_offer']); ?>"
            data-location="<?php echo esc_attr($atts['location']); ?>"
            data-position="<?php echo esc_attr($atts['position']); ?>"
            data-page-type="<?php echo esc_attr($atts['page_type']); ?>"
        >
            <?php echo esc_html($link_text); ?>
        </a>
    <?php
    return ob_get_clean();
}
add_shortcode('affiliate_link', 'affiliate_tracker_shortcode');
