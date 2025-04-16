# Taxonomy Ordering

**Contributors:** [vishalpadhariya](https://profiles.wordpress.org/vishalpadhariya)  
**Donate link:** [Buy Me a Coffee](https://buymeacoffee.com/vishalpadhariya)  
**Tags:** taxonomy ordering, drag and drop ordering, custom taxonomy order, term order  
**Tested up to:** 6.8  
**Stable tag:** 1.0.0  
**Requires PHP:** 7.0  
**License:** GPLv2 or later  
**License URI:** [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)

Thanks for using our plugin!

---

## Description

**Taxonomy Ordering** is a simple and intuitive WordPress plugin that allows you to reorder taxonomy terms using a user-friendly drag-and-drop interface. Whether you are working with categories, tags, or custom taxonomies, this plugin makes it easy to manage the display order of terms on the front end of your site.

Great for developers and content managers who want full control over how taxonomy terms are ordered—without writing code.

---

## Features

- Drag and drop interface for ordering terms
- Supports built-in and custom taxonomies
- Easy to use and lightweight
- No coding required
- Seamless integration with WordPress admin

---

## Installation

1. Download the plugin ZIP or install it via the WordPress Plugin Repository.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Navigate to **Taxonomy Ordering** under the WordPress dashboard.
4. Select the taxonomy you want to order and drag terms to reorder them.
5. Save your changes.

---

## Frequently Asked Questions

### Which taxonomies does this plugin support?
It supports all public taxonomies, including default WordPress ones like categories and tags, as well as any custom taxonomies registered in your theme or plugins.

### Will the new term order reflect on the front end?
Yes, the custom order will reflect on the front end as long as your theme or plugin respects the `term_order` when fetching taxonomy terms. You may need to modify your query to include `'orderby' => 'term_order'`.

### Does this plugin work with hierarchical taxonomies?
Yes, it works with both hierarchical (like categories) and non-hierarchical (like tags) taxonomies.

### Can I use this plugin with custom post types?
Yes, as long as the custom taxonomy is registered properly and publicly visible, the plugin will detect and allow you to reorder its terms.

### Will it slow down my site?
No. The plugin is lightweight and only loads its scripts in the admin when needed.

---

## Screenshots

**1. Backend Interface – Drag and Drop UI**  
![Backend Snapshot](https://raw.githubusercontent.com/vishalpadhariya/cf7-spam-filtering/master/screenshots/backend-snapshot.png)

---

## Changelog

### 1.0.0
* Initial release.
* Added drag and drop ordering functionality for taxonomy terms.

---

## License

This plugin is licensed under the GPLv2 or later. See [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html) for details.
