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
                    echo '<thead><tr><th>#</th><th>Title</th><th>Casino short</th><th>Custom title</th><th>Casino slugs</th><th>Slug formats</th></tr></thead><tbody>';
                    $order = 1;
                    $slug_formats_array = array();
                    foreach ($posts as $post_id) {
                        $title = get_the_title($post_id);
                        $title_link = get_edit_post_link($post_id);
                        $custom_title = get_option('affiliate_tracker_custom_title_' . $post_id, '');
                        $display_title = $custom_title !== '' ? $custom_title : $title;
                        // Remove ' Casino' from the end of the display title if present
                        if (substr($display_title, -7) === ' Casino') {
                            $display_title = substr($display_title, 0, -7);
                        }
                        $casino_short = get_post_field('casino_name', $post_id);
                        if (empty($casino_short)) {
                            $casino_short = $title;
                        }
                        $slug = strtolower($casino_short);
                        $slug_nospaces = str_replace(' ', '', $slug);
                        $slug_hyphens = str_replace(' ', '-', $slug);
                        if (strpos($slug, ' ') !== false) {
                            // Add each format as a separate key, but value is always no-space
                            $slug_formats_array[$slug] = $slug_nospaces;
                            $slug_formats_array[$slug_nospaces] = $slug_nospaces;
                            $slug_formats_array[$slug_hyphens] = $slug_nospaces;
                            $slug_format = $slug . ', ' . $slug_nospaces . ', ' . $slug_hyphens;
                        } else {
                            $slug_format = $slug;
                            $slug_formats_array[$slug_format] = $slug_nospaces;
                        }
                        $casino_short = get_post_field('casino_name', $post_id);
                        if (empty($casino_short)) {
                            $casino_short = $title;
                        }
                        echo '<tr>';
                        echo '<td>' . $order . '</td>';
                        echo '<td><a href="' . esc_url($title_link) . '" target="_blank">' . esc_html($title) . '</a></td>';
                        echo '<td>' . esc_html($casino_short) . '</td>';
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

                    // Create array: Title => slug (no spaces for multi-word slugs)
                    $title_slug_array = array();
                    foreach ($posts as $post_id) {
                        $title = get_the_title($post_id);
                        $custom_title = get_option('affiliate_tracker_custom_title_' . $post_id, '');
                        $display_title = $custom_title !== '' ? $custom_title : $title;
                        // Remove suffixes from the key only
                        $key_title = $display_title;
                        $remove_suffixes = array(' Casino', ' casino', ' Cazino', ' cazino');
                        foreach ($remove_suffixes as $suffix) {
                            if (substr($key_title, -strlen($suffix)) === $suffix) {
                                $key_title = substr($key_title, 0, -strlen($suffix));
                                break;
                            }
                        }
                        $slug = strtolower($display_title);
                        // Remove whitespace for multi-word slugs
                        $slug_nospaces = str_replace(' ', '', $slug);
                        // Remove 'casino' (case-insensitive) from the end of the slug
                        if (preg_match('/casino$/i', $slug_nospaces)) {
                            $slug_nospaces = preg_replace('/casino$/i', '', $slug_nospaces);
                        }
                        $title_slug_array[$key_title] = $slug_nospaces;
                    }
                    echo '<h3>Title => Slug (no spaces)</h3>';
                    echo '<pre>' . print_r($title_slug_array, true) . '</pre>';
                    
                } else {
                    echo '<p>No posts found for this custom post type.</p>';
                }
            }
            ?>
        </form>
    </div>
    <?php
}
