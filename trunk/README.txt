=== Run This ===
Tags: code, snippet, sample, execution, program
Contributors: manu
Requires at least: 2.9
Tested up to: 2.9
Stable tag: 0.1

== Description ==

This plugin lets you execute code snippets you post in your blog. You simply add a class "run-this" and a lang attribute to the <pre> tag surrounding the code. 
The lang attribute should have one of the following values : 

ada, assembler, awk, bash, bc, brainf**k, c, c#, c++, c99, clips, clojure, cobol, clisp, d, erlang, forth, fortran, go, haskell, icon, intercal, java, rhino, javascript, lua, nemerle, nice, ocaml, pascal, perl, php, pike, prolog, python, python3, r, ruby, scala, scheme, smalltalk, tcl, unlambda, vbasic, whitespace

The code is sent over to Ideone (http://ideone.com/) to run; results (output, time and language implementation details) are displayed on your blog, in a table underneath the code. 

This plugin is free software released under the GNU General Public License.

== Installation ==

* Unzip the plugin archive in the folder wp-content/plugins.

* Activate the plugin in admin section.

* if you need a spinner different form the one bundled with the plugin, make your own at http://www.ajaxload.info/, rename it spinner.gif and copy it into the plugin folder.

* You are ready to jazz up your code snippets !

== Release Notes ==

* This plugin uses flXHR (http://flxhr.flensed.com/) to send the code source accross to a different domain. flXHR is included in the plugin archive

* This plugin uses jQuery, which is also included in the plugin archive

* This plugin relies on Ideone web services API (http://ideone.com/api)

* This is an alpha release, please send bug reports to runthis.plugin@gmail.com
