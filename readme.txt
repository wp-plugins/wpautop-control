=== wpautop control ===

Contributors: bigsmoke
Donate link: http://www.bismoke.us/donate/
Tags: wpautop, filter
Requires at least: 3.0
Tested up to: 3.0.1
Stable tag: 1.0

Adds a global setting to turn the wpautop filter on and off. It also allows you to override this default for any post by adding a wpautop cutom field.

== Description ==

This plugin was born out of a very simple need. Back in the day, when the wpautop filter was really sucky, I got annoyed and turned it off for my [blog](http://blog.bigsmoke.us/). However, years later, me (but mostly my co-author, Halfgaar) got equally annoyed by having to manually type in all the curly braces. I wanted to turn on the filter again, but I didn't want this to affect all my old posts. Hence this plugin. See [this blog post](http://blog.bigsmoke.us/2010/12/09/wpautop) for more history.

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Changelog ==

= 1.0 =

* First release
