=== Nice Portfolio ===
Contributors: nicethemes
Tags: portfolio, projects, widget, shortcode, template-tag, services, responsive, gallery, slide
Requires at least: 3.6
Tested up to: 4.9
Requires PHP: 5.3
Stable tag: 1.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A great portfolio plugin to show your work to the world in your WordPress website.

== Description ==

= The most powerful portfolio plugin you've ever seen =

Nice Portfolio displays your work in a clean, responsive and beautiful way. You can show your projects in a specific page, using a shortcode, widgets or template tags (PHP functions).

This plugin is fully integrated with WordPress. It makes use of its native architecture to show your projects, and includes a huge set of hooks, so you can customize it in any way you need.

Nice Portfolio works right out of the box with any theme.

= Comprehensive settings page =

Define how your projects are displayed without having to code with our intuitive settings page. You can set a specific page for your portfolio, the maximum number of projects to show, the number of columns to use, which fields to display, how items should be ordered, the size of your images, and a lot more.

= Project information =

Full project details such as cover image, project gallery, categories, tags, client details and project URL.

= Project gallery =

Create a gallery for your project with all the images you want.

= Templating system =

Though Nice Portfolio works right out of the box with any theme, you can customize how your projects look even more by using your own template files instead of the default ones. Just drop them into your theme's folder and you're done :)

= Shortcode =

You can use the `portfolio` shortcode to show your projects anywhere you want.

= Widgets =

Display your recent projects and a list of portfolio categories using our widgets.

= Filters for portfolio categories =

Filter projects by just clicking in the name of a category.

= Mobile friendly =

Nice Portfolio includes a responsive layout, and gives you the possibility to define the number of columns you want to show.

= Developer friendly =

Nice Portfolio is developed following the [WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards). It relies on the native templating architecture of WordPress (archives and single pages), and includes a huge set of hooks and pluggable functions and classes, so you can customize it in any way you need.

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the "Add New" link in the plugins dashboard.
2. Search for "Nice Portfolio".
3. Click "Install Now".
4. Activate the plugin on the Plugin dashboard.

= Uploading in WordPress Dashboard =

1. Navigate to the "Add New" in the plugins dashboard.
2. Navigate to the "Upload" area.
3. Select `nice-portfolio.zip` from your computer.
4. Click "Install Now".
5. Activate the plugin in the Plugin dashboard.

= Using FTP =

1. Download `nice-portfolio.zip`.
2. Extract the `nice-portfolio` directory to your computer.
3. Upload the `nice-portfolio` directory to the `/wp-content/plugins/` directory.
4. Activate the plugin in the Plugin dashboard.


== FAQ ==

= How to set up the plugin? =

Once you installed and activated the plugin, you can go to *Portfolio > Settings* and tweak the options there. You can set a custom page for your portfolio, which will display your projects using the settings your enter in that section.

Those settings will also be used as the default ones for the shortcode and template tag when you're not specifying any values for them.

= How to use the shortcode? =

The basic usage of the shortcode is just `[portfolio]`. That will display a list of your projects using the settings you entered in *Portfolio > Settings*.

However, you can specify values for the shortcode using the following fields:

* `columns`: The number of columns to be displayed in a portfolio gallery.
* `limit`: The number of projects to be displayed in a portfolio gallery. A value of zero means nothing will be displayed. Use `-1` for no limit.
* `orderby`: The ordering criteria that will be used to display your projects. Accepted values: `ID`, `title`, `menu_order`, `date`, `random`.
* `order`: The sorting criteria that will be used to display your projects. Accepted values: `asc` (ascendant), `desc` (descendant).
* `category`: Comma-separated numeric IDs of portfolio categories that you want to display. A value of zero means that all categories will be considered.
* `exclude_category`: Comma-separated numeric IDs of portfolio categories that you want to exclude. A value of zero means that no categories will be excluded.
* `tag`: Comma-separated numeric IDs of portfolio tags that you want to display. A value of zero means that all tags will be considered.
* `exclude_tag`: Comma-separated numeric IDs of portfolio tags that you want to exclude. A value of zero means that no tags will be excluded.
* `display_empty_message`: Choose if you want to display a message when the current list has no projects. Accepted values: `1` (show message), `0` (not show message).
* `avoidcss`: Choose if you want to remove the default styles for the current list of projects. Accepted values: `1` (avoid styles), `0` (not avoid styles).

If any of these values is not declared explicitly, the default value will be the one set in *Portfolio > Settings*.

A typical usage of the shortcode with these fields would be the following:

`[portfolio columns="2" limit="5" orderby="date" order="asc" category="20,34"]`

= How to use the template tag (PHP function)? =

You can include projects in your own templates by using our `nice_portfolio()` function. This is a very basic usage example:

```
<?php
if ( function_exists( 'nice_portfolio' ) ) :
	nice_portfolio();
endif;
?>
```

As it happens with the shortcode, that code snippet will display a list of your projects using the settings you entered in *Portfolio > Settings*. However, you can give the function an array of options with specific values on how to show the list of projects:

* `columns`: The number of columns to be displayed in a portfolio gallery.
* `limit`: The number of projects to be displayed in a portfolio gallery. A value of zero means nothing will be displayed. Use `-1` for no limit.
* `orderby`: The ordering criteria that will be used to display your projects. Accepted values: `ID`, `title`, `menu_order`, `date`, `random`.
* `order`: The sorting criteria that will be used to display your projects. Accepted values: `asc` (ascendant), `desc` (descendant).
* `category`: Comma-separated numeric IDs of portfolio categories that you want to display. A value of zero means that all categories will be considered.
* `exclude_category`: Comma-separated numeric IDs of portfolio categories that you want to exclude. A value of zero means that no categories will be excluded.
* `tag`: Comma-separated numeric IDs of portfolio tags that you want to display. A value of zero means that all tags will be considered.
* `exclude_tag`: Comma-separated numeric IDs of portfolio tags that you want to exclude. A value of zero means that no tags will be excluded.
* `display_empty_message`: Choose if you want to display a message when the current list has no projects. Accepted values: `1` (show message), `0` (not show message).
* `avoidcss`: Choose if you want to remove the default styles for the current list of projects. Accepted values: `1` (avoid styles), `0` (not avoid styles).

If any of these values is not declared explicitly, the default value will be the one set in *Portfolio > Settings*.

Using these options, you can have something like this in your code:

```
<?php
if ( function_exists( 'nice_portfolio' ) ) :
	nice_portfolio( array(
		'columns'  => 2,
		'limit'    => 5,
		'orderby'  => 'date',
		'order'    => 'asc',
		'category' => '20,32',
	) );
endif;
?>
```

= How to use the widgets? =

Nice Portfolio includes two widgets: Portfolio Categories and Recent Projects.

Portfolio Categories works pretty much as the default Categories widget: you just need to check if you want to display the categories as a dropdown (the default is a list), the number or projects in each category, and show categories hierarchically as a tree view.

The Recent Projects widget will display your projects by date, from newer to older. It lets you enter the maximum number of projects you want to show, the project's excerpt and the featured image using a specific size.

= How can I resize my images? =

If you go to *Portfolio > Settings > Images*, you can adjust the size of the images that will be displayed within projects there. Once you modified these settings, you may need to regenerate your thumbnails using the [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) plugin.

= How can I change the slug of my projects? =

By default, the links to your projects will look something like `http://my-site.me/portfolio/my-project`. If you want to change that `portfolio` base to something more fit to your needs (for example, `http://my-site.me/paintings/my-project`, in case you're a painter), you can do so going to *Portfolio > Settings > Advanced*, and modifying the "Project Slug" option.

= How can I use my own CSS? =

By default, the links to your projects will look something like `http://my-site.me/portfolio/my-project`. If you want to change that `portfolio` base to something more fit to your needs (for example, `http://my-site.me/paintings/my-project`, if you're a painter), you can do so going to *Portfolio > Settings > Advanced*, and modifying the "Project Slug" option.

= How can I use my custom templates? =

Inside `wp-content/plugins/nice-portfolio/templates` you will find the following default templates:

* `portfolio`: The default template for the page you selected as the portfolio page in *Portfolio > Settings*.
* `portfolio-project`: The default template for all single portfolio projects.
* `portfolio-category`: The default template for a portfolio category index.
* `portfolio-tag`: The default template for a portfolio tag index.
* `portfolio-archive`: The default template for the index of the `portfolio_project` custom post type.

All you need to do is copy these files to `wp-content/themes/my-theme/portfolio`, and modify them to your own needs.

If you want more specific templates, you can take a look at the [Template Hierarchy](http://codex.wordpress.org/Template_Hierarchy) article in the Codex.

== Screenshots ==

1. Portfolio Settings page.
2. Project details and gallery.
3. Project categories and tags.
4. Single project view.
5. Portfolio page view.

== Changelog ==

= 1.0.4 =
* Fix: Filtering issues in project grids.

= 1.0.3 =
* Improvement: Add compatibility with Nice Likes custom post columns.

= 1.0.2 =
* Fix: Obtain admin path using `ABSPATH` constant.

= 1.0.1 =
* Specify thumbnail size when obtaining project images using `nice_image()`.
* Add `nice_portfolio_widget_class()` function and make `nice_portfolio_class()` returnable. Also display a warning in debug mode when these functions are being used in the wrong context.
* Make text domains load on `plugins_loaded`.
* Fix potential edge case concerning current select values not being correctly pre-selected.

= 1.0 =
* First public release.
