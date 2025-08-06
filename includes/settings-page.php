<?php
/**
 * Display the Affiliate Tracker Settings admin page
 */
// Register settings for all label fields
function affiliate_tracker_register_settings() {
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_casino_cpt');
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_label_with_deposit');
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_label_no_deposit');
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_label_live');
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_label_sport');
    register_setting('affiliate_tracker_options_group', 'affiliate_tracker_label_custom');
}
add_action('admin_init', 'affiliate_tracker_register_settings');

function affiliate_tracker_settings_page() {
    ?>
    <div class="wrap">
        <h1>Affiliate Tracker - Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('affiliate_tracker_options_group');
            do_settings_sections('affiliate-tracker');
            $casino_cpt = get_option('affiliate_tracker_casino_cpt', '');
            // Get label values from options
            $label_with_deposit = get_option('affiliate_tracker_label_with_deposit', '');
            $label_no_deposit = get_option('affiliate_tracker_label_no_deposit', '');
            $label_live = get_option('affiliate_tracker_label_live', '');
            $label_sport = get_option('affiliate_tracker_label_sport', '');
            $label_custom = get_option('affiliate_tracker_label_custom', '');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="affiliate_tracker_casino_cpt">Casino CPT</label></th>
                    <td>
                        <input type="text" id="affiliate_tracker_casino_cpt" name="affiliate_tracker_casino_cpt" value="<?php echo esc_attr($casino_cpt); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="affiliate_tracker_label_with_deposit">With Deposit</label></th>
                    <td>
                        <input type="text" id="affiliate_tracker_label_with_deposit" name="affiliate_tracker_label_with_deposit" value="<?php echo esc_attr($label_with_deposit); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="affiliate_tracker_label_no_deposit">No Deposit</label></th>
                    <td>
                        <input type="text" id="affiliate_tracker_label_no_deposit" name="affiliate_tracker_label_no_deposit" value="<?php echo esc_attr($label_no_deposit); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="affiliate_tracker_label_live">Live</label></th>
                    <td>
                        <input type="text" id="affiliate_tracker_label_live" name="affiliate_tracker_label_live" value="<?php echo esc_attr($label_live); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="affiliate_tracker_label_sport">Sport</label></th>
                    <td>
                        <input type="text" id="affiliate_tracker_label_sport" name="affiliate_tracker_label_sport" value="<?php echo esc_attr($label_sport); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="affiliate_tracker_label_custom">Custom</label></th>
                    <td>
                        <input type="text" id="affiliate_tracker_label_custom" name="affiliate_tracker_label_custom" value="<?php echo esc_attr($label_custom); ?>" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

        <?php
        // Build array of label => value
        $offer_types_array = array(
            'With deposit' => $label_with_deposit,
            'No deposit'   => $label_no_deposit,
            'Live'         => $label_live,
            'Sport'        => $label_sport,
            'Custom'       => $label_custom,
        );
        // Print the array for debugging/visibility
        echo '<div style="margin-top:30px;">';
        echo '<h3>Offer types array</h3>';
        echo '<pre>' . esc_html(print_r($offer_types_array, true)) . '</pre>';
        echo '</div>';
        ?>
    </div>
    <?php
}
