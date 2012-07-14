=== Run This! ===
Tags: code, snippet, sample, execution, programming
Contributors: manu
Requires at least: 3.3.1
Tested up to: 3.3.1
Stable tag: 0.2

== Description ==

This plugin lets your readers run snippets of code directly from your blog.

Simply add a class "run-this" and a lang attribute to the PRE tag surrounding the code. 
The lang attribute should have one of the following values : ada, assembler, awk, bash, bc, brainf**k, c, csharp, cpp, c99, clips, clojure, cobol, clisp, d, erlang, forth, fortran, go, haskell, icon, intercal, java, rhino, javascript, lua, nemerle, nice, ocaml, pascal, perl, php, pike, prolog, python, python3, r, ruby, scala, scheme, smalltalk, tcl, unlambda, vbasic, whitespace

The code is sent over to [Ideone](http://ideone.com/) to run; results (output, time and language implementation details) are displayed on your blog, in a table underneath the code. 

This plugin is free software released under the GNU General Public License.

== Installation ==

* Unzip the plugin archive in the folder wp-content/plugins.

* Activate the plugin in admin section.

* if you need a spinner different from the one bundled with the plugin, make your own at http://www.ajaxload.info/, rename it spinner.gif and copy it into the plugin folder.

* You are ready to jazz up your code snippets !

== Release Notes ==

* This plugin depends on the [WP-Syntax plugin](http://wordpress.org/extend/plugins/wp-syntax/) being installed and activated.

* This plugin uses CORS to send the code source accross to a different domain, recent browsers should work fine (See [Browser support](http://en.wikipedia.org/wiki/Cross-origin_resource_sharing#Browser_support))

* This plugin uses jQuery, which is also included in the plugin archive

* This plugin relies on Ideone web services API (http://ideone.com/api)

* This is an alpha release, please send bug reports to runthis.plugin@gmail.com

== Changelog ==

**0.2** : start using CORS instead of a Flash proxy to do cross-domain queries.
