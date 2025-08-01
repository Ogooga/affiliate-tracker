<?php
// Admin page for Affiliate Tracker plugin

// Load the settings page function from a separate file
require_once plugin_dir_path(__FILE__) . 'settings-page.php';
// Load the casino info page function from a separate file
require_once plugin_dir_path(__FILE__) . 'casino-info-page.php';

/**
 * Display the Affiliate Tracker admin page
 * Includes search, pagination, and custom value saving for each link
 */
function affiliate_tracker_options_page() {
    ?>
    <div class="wrap">
        <!-- Affiliate Tracker Admin Page -->

        <!-- Search Form -->
        <form method="get" style="margin-bottom:20px;">
            <input type="hidden" name="page" value="affiliate-tracker" />
            <input type="text" name="affiliate_search" value="<?php echo isset($_GET['affiliate_search']) ? esc_attr($_GET['affiliate_search']) : ''; ?>" placeholder="Name, URL, or Slug" />
            <input type="submit" class="button" value="Search" />
        </form>

        <?php
        // --- Handle saving extra slug formats ---
        $extra_slug_formats_option = get_option('affiliate_tracker_extra_slug_formats', '');
        if (isset($_POST['casino_array_values'])) {
            $extra_slug_formats_post = trim($_POST['casino_array_values']);
            // Overwrite the option with the new value (removal supported)
            $extra_slug_formats_option = $extra_slug_formats_post;
            update_option('affiliate_tracker_extra_slug_formats', $extra_slug_formats_option);
        }
        ?>

        <?php
        // --- Build $slug_formats_array from casino CPT and extra values ---
        $slug_formats_array = array();
        $casino_cpt = get_option('affiliate_tracker_casino_cpt', '');
        if (!empty($casino_cpt)) {
            // Get all casino posts
            $posts = get_posts(array(
                'post_type' => $casino_cpt,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'fields' => 'ids'
            ));
            if ($posts) {
                foreach ($posts as $post_id) {
                    $title = get_the_title($post_id);
                    $custom_title = get_option('affiliate_tracker_custom_title_' . $post_id, '');
                    $display_title = $custom_title !== '' ? $custom_title : $title;
                    // Remove trailing ' Casino' if present
                    if (substr($display_title, -7) === ' Casino') {
                        $display_title = substr($display_title, 0, -7);
                    }
                    $slug = strtolower($display_title);
                    $slug_nospaces = str_replace(' ', '', $slug);
                    $slug_hyphens = str_replace(' ', '-', $slug);
                    // Add all slug formats
                    if (strpos($slug, ' ') !== false) {
                        $slug_formats_array[] = $slug;
                        $slug_formats_array[] = $slug_nospaces;
                        $slug_formats_array[] = $slug_hyphens;
                    } else {
                        $slug_formats_array[] = $slug;
                    }
                }
            }
        }
        // Add extra slug formats from option (user input)
        if (!empty($extra_slug_formats_option)) {
            $extra = explode(',', $extra_slug_formats_option);
            foreach ($extra as $val) {
                $val = trim($val);
                if ($val !== '') {
                    $slug_formats_array[] = strtolower($val);
                }
            }
        }

        // --- Display $slug_formats_array for debugging/visibility ---
        /*
        if (!empty($slug_formats_array)) {
            echo '<div style="margin-top:30px;">';
            echo '<h3>Slug Formats Array (from Casino Info)</h3>';
            echo '<pre>' . esc_html(print_r($slug_formats_array, true)) . '</pre>';
            echo '</div>';
        }
        */
        ?>

        <!-- Affiliate Links Table -->
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Slug</th>
                    <th>Affiliate cazino</th>
                    <th>Type of offer</th>
                    <th>Shortcode</th>
                    <th>Created At</th>
                    <th>Updated At</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                // --- Get search and pagination parameters ---
                $search = isset($_GET['affiliate_search']) ? sanitize_text_field($_GET['affiliate_search']) : '';
                $page_num = isset($_GET['affiliate_page']) ? max(1, intval($_GET['affiliate_page'])) : 1;
                $limit = 100;
                $offset = ($page_num - 1) * $limit;
                $where = '';
                $params = array();
                // Build WHERE clause for search
                if ($search) {
                    $where = "WHERE name LIKE %s OR url LIKE %s OR slug LIKE %s";
                    $like = '%' . $wpdb->esc_like($search) . '%';
                    $params = array($like, $like, $like);
                }
                // Query for paginated affiliate links, sorted by latest created_at
                $query = "SELECT id, name, url, slug, created_at, updated_at FROM {$wpdb->prefix}prli_links $where ORDER BY created_at DESC LIMIT %d OFFSET %d";
                $params[] = $limit;
                $params[] = $offset;
                $links = $wpdb->get_results($wpdb->prepare($query, ...$params));

                // --- Display each link row ---
                if ($links) {
                    // Get offer types from settings
                    $offer_types_array = array(
                        'With Deposit' => get_option('affiliate_tracker_label_with_deposit', ''),
                        'No Deposit'   => get_option('affiliate_tracker_label_no_deposit', ''),
                        'Live'         => get_option('affiliate_tracker_label_live', ''),
                        'Sport'        => get_option('affiliate_tracker_label_sport', ''),
                        'Custom'       => get_option('affiliate_tracker_label_custom', ''),
                    );
                    foreach ($links as $link) {
                        $custom_value = get_option('affiliate_tracker_custom_' . $link->id, '');
                        echo '<tr class="id-' . esc_attr($link->id) . '" id="id-' . esc_attr($link->id) . '">';
                        echo '<td class="col-id">' . esc_html($link->id) . '</td>';
                        echo '<td class="col-name">' . esc_html($link->name) . '</td>';
                        echo '<td class="col-url">' . esc_html($link->url) . '</td>';
                        echo '<td class="col-slug">' . esc_html($link->slug) . '</td>';
                        // --- Custom column: affiliate cazino ---
                        $affiliate_cazino_matches = array();
                        if (!empty($slug_formats_array)) {
                            foreach ($slug_formats_array as $slug_val) {
                                if (stripos($link->url, $slug_val) !== false) {
                                    $affiliate_cazino_matches[] = $slug_val;
                                }
                            }
                            // If no matches in slug, check url
                            if (empty($affiliate_cazino_matches)) {
                                foreach ($slug_formats_array as $slug_val) {
                                    if (stripos($link->slug, $slug_val) !== false) {
                                        $affiliate_cazino_matches[] = $slug_val;
                                    }
                                }
                            }
                        }
                        $affiliate_cazino_value = '';
                        if (!empty($affiliate_cazino_matches)) {
                            $affiliate_cazino_value = $affiliate_cazino_matches[0];
                        }
                        echo '<td class="col-affiliate-cazino">' . esc_html($affiliate_cazino_value) . '</td>';

                        // --- Type of offer column ---
                        $type_of_offer_label = '';
                        foreach ($offer_types_array as $label => $value) {
                            if (!empty($value) && strpos($link->slug, 'goaffcas/' . $value . '-') === 0) {
                                $type_of_offer_label = $label;
                                break;
                            }
                        }
                        if (empty($type_of_offer_label)) {
                            $type_of_offer_label = 'Custom';
                        }
                        echo '<td class="col-type-of-offer">' . esc_html($type_of_offer_label) . '</td>';

                        // Shortcode column
                        $shortcode = '[affiliate_link url="' . esc_attr($link->slug) . '" type_offer="' . esc_attr($type_of_offer_label) . '" casino="' . esc_attr($affiliate_cazino_value) . '" position="1"]LINK ANCHOR[/affiliate_link]';
                        echo '<td class="col-shortcode">' . $shortcode . '</td>';

                        echo '<td class="col-created-at">' . esc_html($link->created_at) . '</td>';
                        echo '<td class="col-updated-at">' . esc_html($link->updated_at) . '</td>';
                        // ...existing code...
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No affiliate links found.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- Add extra slug formats (persisted) -->
        <form method="post" style="margin-top:30px;">
            <label for="casino_array_values"><strong>Add extra slug formats</strong> (comma separated):</label>
            <input type="text" name="casino_array_values" id="casino_array_values" value="<?php echo esc_attr($extra_slug_formats_option); ?>" style="width:300px;" />
            <input type="submit" class="button" value="Add Slug Formats" />
        </form>

        <?php
        // --- Pagination logic ---
        $count_query = "SELECT COUNT(*) FROM {$wpdb->prefix}prli_links $where";
        $total_links = $where ? $wpdb->get_var($wpdb->prepare($count_query, ...$params)) : $wpdb->get_var($count_query);
        $total_pages = ceil($total_links / $limit);
        // Display pagination buttons if needed
        if ($total_pages > 1) {
            echo '<div style="margin-top:20px;">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $url = add_query_arg(array('affiliate_page' => $i, 'affiliate_search' => $search));
                $class = ($i == $page_num) ? 'button-primary' : 'button';
                echo '<a class="' . $class . '" href="' . esc_url($url) . '">' . $i . '</a> ';
            }
            echo '</div>';
        }
        ?>

    </div>

    <?php
}
