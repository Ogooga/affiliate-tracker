<?php
/**
 * Register [affiliate_link] shortcode directly from this file
 */

// Include casino-variations.php for $casino_variants
require_once plugin_dir_path(__FILE__) . 'casino-variations.php';

function affiliate_tracker_shortcode($atts = array(), $content = null) {
    ob_start();
    $atts = shortcode_atts(array(
        'casino'    => '',
        'type_offer'=> '',
        'url'       => '',
        'position'  => '0',
        'page_type' => '',
        'class'      => '',
        'offer-location'  => '',
        'id'        => '',
    ), $atts);

    // Set id to aff-<current page ID> if not provided
    if (empty($atts['id'])) {
        $current_id = get_queried_object_id();
        if ($current_id) {
            $atts['id'] = 'aff-' . $current_id;
        }
    }
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

    // Map type_offer based on url patterns
    if (strpos($atts['url'], 'tc-') !== false) {
        $atts['type_offer'] = 'With deposit';
    } elseif (strpos($atts['url'], 'bn-') !== false) {
        $atts['type_offer'] = 'No deposit';
    } elseif (strpos($atts['url'], 'cp-') !== false) {
        $atts['type_offer'] = 'Sport';
    } elseif (strpos($atts['url'], 'lc-') !== false) {
        $atts['type_offer'] = 'Live';
    }
    
    global $casino_variants;
    $casino_input = $atts['casino'];
    $atts['casino'] = isset($casino_variants[$casino_input]) ? $casino_variants[$casino_input] : $casino_input;

    $link_text = $content ? $content : 'Affiliate Link';
    ?>

        <?php
        // Ensure the URL contains the domain
        $full_url = $atts['url'];
        /*if (!empty($full_url) && strpos($full_url, 'http') !== 0) {
            // If not absolute, prepend site URL
            $site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
            if (substr($full_url, 0, 1) !== '/') {
                $full_url = '/' . $full_url;
            }
            $full_url = $site_url . $full_url;
        }*/
        ?>
        <a id="<?php echo esc_attr($atts['id']); ?>" class="affiliate-meta-link referral <?php echo esc_attr($atts['class']); ?>" href="<?php echo esc_url($full_url); ?>" target="_blank" rel="noopener noindex nofollow"
            data-casino="<?php echo esc_attr($atts['casino']); ?>"
            data-type-offer="<?php echo esc_attr($atts['type_offer']); ?>"
            data-location="<?php echo esc_attr($atts['location']); ?>"
            data-position="<?php echo esc_attr($atts['position']); ?>"
            data-page-type="<?php echo esc_attr($atts['page_type']); ?>"
            data-offer-location="<?php echo esc_attr($atts['offer-location']); ?>"
        >
            <?php echo $link_text; ?>
        </a>
    <?php
    return ob_get_clean();
}
add_shortcode('affiliate_link', 'affiliate_tracker_shortcode');
