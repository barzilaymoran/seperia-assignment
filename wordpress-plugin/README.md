# Compare Assignment — WordPress Plugin

A WordPress plugin that automatically creates a page displaying a product table fetched from the DummyJSON API
with search, pagination and a product image gallery.


## Features

- Auto Page Creation: automatically creates a "Compare Assignment" page upon activation
- Product Table displays: Title, Brand, Description, Category, Rating, Stock, Price and Thumbnail (as an image)
- Search: search products by keyword, handled server-side via PHP
- Pagination: navigate through all products, 30 per page
- Gallery: expand any product row to view up to 3 product images


## Requirements

- WordPress 6.0 or higher
- PHP 8.0 or higher


## Installation

1. Copy the `compare-assignment` folder into your WordPress plugins directory:
	- wp-content/plugins/compare-assignment/

2. Log in to your WordPress dashboard

3. Go to Plugins and activate Compare Assignment

4. The plugin automatically creates a page titled "Compare Assignment", visit it to see the product table


## How It Works

- WordPress page contains [product_table] shortcode
- WordPress calls ca_product_table_shortcode()
- calls ca_render_table() in templates/table.php
- calls ca_get_products() in includes/api.php
- fetches DummyJSON API
- returns fully rendered HTML table to the page


### Key Concepts

Activation Hook
When the plugin is activated, `ca_activate()` runs once and automatically creates the "Compare Assignment" page with the `[product_table]` shortcode as its content.

Shortcode
`[product_table]` can be placed on any WordPress page to render the product table. It is added automatically to the "Compare Assignment" page on activation.

Assets
CSS and JS are loaded via `wp_enqueue_style()` and `wp_enqueue_script()` - the WordPress standard for loading assets safely without conflicts.


## API

This plugin uses the DummyJSON API (https://dummyjson.com/docs/products).

Endpoint: `GET /products` | Usage: Fetch all products with pagination

Endpoint: `GET /products/search?q=` | Usage: Search products by keyword


## Edge Cases Handled

- Empty search: falls back to full product listing
- No results: displays a friendly message
- API failure: catches error and displays message to the user
- Invalid page number: falls back to page 1
- Missing brand field: displays an empty string as fallback
- Products with fewer than 3 images: gallery shows available images up to a maximum of 3
- Duplicate page: checks if "Compare Assignment" page already exists before creating it


## Assumptions

- DummyJSON API structure remains stable
- All products have an `images` array
- PAGE_SIZE is fixed at 30 products per page
- DummyJSON handles all search logic
- The `[product_table]` shortcode block type is set correctly in the WordPress block editor
