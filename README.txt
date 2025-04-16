=== Taxonomy Ordering ===
Contributors: vishalpadhariya
Donate link: https://buymeacoffee.com/vishalpadhariya
Tags: taxonomy ordering, drag and drop, term ordering, custom taxonomy order, reorder terms
Requires at least: 5.0
Tested up to: 6.8
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Drag and drop taxonomy term ordering for categories, tags, and custom taxonomies. A simple and intuitive interface for reordering taxonomy terms in WordPress.

== Description ==

**Taxonomy Ordering** is a lightweight and easy-to-use plugin that allows you to reorder taxonomy terms (like categories, tags, or any custom taxonomy) using a simple drag-and-drop interface.

No more hacking code or trying to reorder terms with complicated settings. Just drag, drop, and save — it’s that easy!

Great for developers, designers, and site owners who need full control over the term display order on the frontend.

= Features =

* Drag and drop interface to reorder terms
* Works with all public taxonomies — including custom ones
* Lightweight and optimized for performance
* No coding required
* Supports hierarchical and non-hierarchical taxonomies

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/taxonomy-ordering` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to **Taxonomy Ordering** in your dashboard to begin reordering terms.

== Frequently Asked Questions ==

= Which taxonomies does this plugin support? =  
It supports all public taxonomies, including default WordPress ones like categories and tags, as well as custom taxonomies registered by themes or plugins.

= Will the new term order reflect on the front end? =  
Yes. If your theme or plugin uses `get_terms()` or `wp_get_object_terms()` with `orderby => 'term_order'`, the custom order will be used.

= Does this plugin work with hierarchical taxonomies? =  
Yes, it works with both hierarchical (e.g., categories) and flat (e.g., tags) taxonomies.

= Can I use this with custom post types? =  
Absolutely! As long as the custom taxonomy is registered properly and is public, the plugin will recognize it.

= Does this plugin slow down the site? =  
Not at all. It's lightweight and loads scripts only when needed in the admin.

== Screenshots ==

1. Drag-and-drop interface in the WordPress admin.

== Changelog ==

= 1.0.0 =
* Initial release.
* Added drag-and-drop support for reordering taxonomy terms.

== Upgrade Notice ==

= 1.0.0 =
Initial stable release of Taxonomy Ordering plugin. Allows drag-and-drop sorting of taxonomy terms.

== License ==

This plugin is licensed under the GPLv2 or later. See [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html) for full license details.
