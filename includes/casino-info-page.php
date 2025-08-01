<?php
/**
 * Display the Affiliate Tracker Casino Info admin page
 */
function affiliate_tracker_casino_info_page() {
    ?>
    <div class="wrap">
        <h1>Affiliate Tracker - Casino Info</h1>
        <form method="post">
            <?php
            // Get the custom post type from the Casino CPT option
            $casino_cpt = get_option('affiliate_tracker_casino_cpt', '');
            if (!empty($casino_cpt)) {
                $posts = get_posts(array(
                    'post_type' => $casino_cpt,
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'fields' => 'ids'
                ));
                if ($posts) {
                    echo '<h2>Posts in "' . esc_html($casino_cpt) . '"</h2>';
                    echo '<table class="widefat fixed" cellspacing="0" style="max-width:1000px;">';
                    echo '<thead><tr><th>#</th><th>Title</th><th>Custom title</th><th>Casino slugs</th><th>Slug formats</th></tr></thead><tbody>';
                    $order = 1;
                    $slug_formats_array = array();
                    foreach ($posts as $post_id) {
                        $title = get_the_title($post_id);
                        $custom_title = get_option('affiliate_tracker_custom_title_' . $post_id, '');
                        $display_title = $custom_title !== '' ? $custom_title : $title;
                        // Remove ' Casino' from the end of the display title if present
                        if (substr($display_title, -7) === ' Casino') {
                            $display_title = substr($display_title, 0, -7);
                        }
                        $slug = strtolower($display_title);
                        $slug_nospaces = str_replace(' ', '', $slug);
                        $slug_hyphens = str_replace(' ', '-', $slug);
                        if (strpos($slug, ' ') !== false) {
                            $slug_formats_array[] = $slug;
                            $slug_formats_array[] = $slug_nospaces;
                            $slug_formats_array[] = $slug_hyphens;
                            $slug_format = $slug . ', ' . $slug_nospaces . ', ' . $slug_hyphens;
                        } else {
                            $slug_formats_array[] = $slug;
                            $slug_format = $slug;
                        }
                        echo '<tr>';
                        echo '<td>' . $order . '</td>';
                        echo '<td>' . esc_html($title) . '</td>';
                        echo '<td><input type="text" name="affiliate_tracker_custom_title_' . esc_attr($post_id) . '" value="' . esc_attr($custom_title) . '" /></td>';
                        echo '<td>' . esc_html($slug) . '</td>';
                        echo '<td>' . esc_html($slug_format) . '</td>';
                        echo '</tr>';
                        $order++;
                    }
                    echo '</tbody></table>';
                    echo '<br />';
                    echo '<input type="submit" class="button button-primary" value="Save Custom Titles" />';
                    // Display the array at the bottom of the page
                    echo '<h3>Slug Formats Array</h3>';
                    echo '<pre>' . print_r($slug_formats_array, true) . '</pre>';
                } else {
                    echo '<p>No posts found for this custom post type.</p>';
                }
            }
            ?>
        </form>
    </div>
    <?php
}
