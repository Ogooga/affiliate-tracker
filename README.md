# Affiliate Tracker

Affiliate Tracker is a WordPress plugin designed to help you track, manage, and display affiliate links, especially those created with the Pretty Link plugin. It provides a robust admin interface for searching, filtering, and managing affiliate links, as well as custom options for casino-related offers and dynamic shortcode generation.

## Features
- Admin dashboard for viewing, searching, and paginating affiliate links from Pretty Link.
- Custom columns: ID, Name, URL, Slug, Affiliate Casino, Type of Offer, Shortcode, Created/Updated At.
- Slug formats management: Add and manage custom slug formats for casino offers.
- Offer type labels: Configure custom labels for different offer types (With Deposit, No Deposit, Live, Sport, Custom).
- Shortcode generator: Instantly generate a WordPress shortcode for any affiliate link, with all relevant parameters pre-filled.
- Shortcode template: Use the `[affiliate_link]` shortcode anywhere on your site to display affiliate links with customizable attributes.
- Automatic context: The shortcode can auto-detect the page type and location where it is rendered.

## File Overview

- `affiliate-tracker.php`: Main plugin file. Registers admin menus, settings, handles saving custom values, and loads all other components.
- `includes/admin-page.php`: Contains the logic for the main Affiliate Tracker admin page, including table rendering, search, pagination, and shortcode generation for each link.
- `includes/settings-page.php`: Settings page for configuring casino CPT and offer type labels. Handles saving and displaying these options.
- `includes/casino-info-page.php`: Displays casino info, manages custom titles, and outputs slug formats for use in matching affiliate links.
- `includes/shortcode-template.php`: Registers and renders the `[affiliate_link]` shortcode. Outputs a link with all relevant data attributes and auto-detects page context.
- `README.md`: This file. Explains plugin features, usage, and file structure.

## Usage
1. Install & activate the plugin.
2. Configure settings in Affiliate Tracker > Settings.
3. Manage links in the Affiliate Tracker admin page. Add custom slug formats as needed.
4. Copy shortcodes for any link and use them in posts, pages, or widgets.
5. Use the `[affiliate_link]` shortcode to display affiliate links with custom attributes.

### Shortcode Example
```
[affiliate_link url="https://example.com" casino="CasinoName" type_offer="With Deposit" position="1"]Visit Affiliate[/affiliate_link]
```

### Shortcode Parameters
- `url`: The affiliate link URL (required)
- `casino`: The casino name or slug
- `type_offer`: The type of offer (e.g., With Deposit, No Deposit)
- `location`: (optional) The page URL where the shortcode is rendered
- `position`: (optional) Position identifier
- `page_type`: (optional) The type of WordPress page (auto-detected if not set)
- `class`: (optional) Custom CSS class for the link

## Requirements
- WordPress 5.0+
- Pretty Link plugin (for link integration)

## Support
For questions or support, contact the plugin author or open an issue on the plugin repository.
