<?php
/*
Plugin Name: Run This
Description: This plugin lets you execute code snippets you post in your blog. You simply add a class "run-this" to the <pre> tag surrounding the code and a lang attribute matching the programming language used. The code is sent over to Ideone (http://ideone.com/) to run; results are displayed on your blog, underneath the code. Languages supported are: C, C++, D, Haskell, Javascript, Lua, OCaml, PHP, Perl, Python, Ruby, Scheme, Tcl and many more...
Version: 0.2
Author: Emmanuel Delaborde
*/

if (!defined("WP_RUN_THIS")) define("WP_RUN_THIS", "run-this");
if (!defined("WP_CONTENT_URL")) define("WP_CONTENT_URL", get_option("siteurl") . "/wp-content");
if (!defined("WP_PLUGIN_URL"))  define("WP_PLUGIN_URL",  WP_CONTENT_URL        . "/plugins");



function run_this_head()
{
  $css_url = WP_PLUGIN_URL . "/run-this/run_this.css";
  $jquery_url = WP_PLUGIN_URL . "/run-this/jquery-1.3.2.js";
  $js_url = WP_PLUGIN_URL . "/run-this/run_this.js";

  echo "\n".'<link rel="stylesheet" href="' . $css_url . '" type="text/css" media="screen" />'."\n";
  echo "\n".'<script type="text/javascript" src="'. $jquery_url .'"></script>'."\n";
  echo "\n".'<script type="text/javascript" src="'. $js_url .'"></script>'."\n";

}

function code_trim($code)
{
    // special ltrim b/c leading whitespace matters on 1st line of content
    $code = preg_replace("/^\s*\n/siU", "", $code);
    $code = rtrim($code);
    return $code;
}

function run_this_before_filter($content)
{
    $output1 = preg_replace_callback(
        "/\s*<pre(?:lang=[\"']([\w-]+)[\"']|class=[\"']([\w-\s]*)[\"']|line=[\"']\d*[\"']|\s)+>(.*)<\/pre>\s*/siU",
        "run_this_callback",
        $content
    );
   return $output1;
}

// extract lang and program source
// insert HTML with base64-encoded program source 
function run_this_callback($match)
{
    $language = strtolower(trim($match[1]));
    $class = trim($match[2]);

    $code = code_trim($match[3]);
    //$code = str_replace("<" , "&lt;" , $code);
    //$code = str_replace(">" , "&gt;" , $code);

    // no class WP_RUN_THIS : do nothing
    if(!preg_match('/'.WP_RUN_THIS .'/', $class, $matches)){
      return $match[0];
    }
    else {
      $output = '<pre lang="'.$language.'">'.$code.'</pre>';

      //// if class contains only "run-this", remove attribute
      //if(preg_match('/^\s*'. WP_RUN_THIS .'\s*$/', $class, $matches)){
      //  $output = preg_replace("/class\s*=\s*[\"'][\w-\s]*[\"']/",'', $output);
      //}
      // class contains WP_RUN_THIS, remove it
      //// if it is used in another attribute, it will be removed too !
      //else if(preg_match('/\s*'. WP_RUN_THIS .'\s*/', $class, $matches)){
      //  $output = preg_replace("/(class\s*=\s*[\"'][\w-\s]*)(".WP_RUN_THIS.")([\w-\s]*[\"'])/",'$1$3', $output);
      //}
      // we encode the code source to evade Wordpress rich text formatting 
      // the actual HTML will be generated in the after_filter
      //$output .=  '<p>'.$code.'</p>';
      $output .=  '<p class="source" lang="'.$language.'">'.base64_encode(html_entity_decode($code, ENT_NOQUOTES)) ."</p>";
      return $output;
    }
}






function run_this_after_filter($content)
{
    $output1 =  preg_replace_callback(
        "/\s*<p class=\"source\" lang=\"(.*)\">(.*)<\/p>\s*/siU",
        "run_this_after_callback",
        $content
    );
    $output2 = preg_replace_callback(
        // <textarea class="run-this-input"> 
        "/\s*<textarea(?:class=[\"']([\w-\s]*)[\"']|\s)+>(.*)<\/textarea>\s*/siU",
        "run_this_after_input",
        $output1
    );
    return $output2;
}

// Insert 'Run' button to submit the code to IdeOne
function run_this_after_callback($match)
{
    $output = '<div class="run-this-button">
                  <input type="button" value="Run" onclick="run_this(this, \''.$match[1].'\', \'' . $match[2]   . '\');"/>
                  <img class="run-this-spinner" src="'.WP_PLUGIN_URL . '/run-this/spinner.gif"/>
                </div>
                <div class="run-this-details"></div>';

    return $output;

}

// Remove <br /> from input textarea
function run_this_after_input($match)
{
  return str_replace("<br />" , "" , $match[0]);
}



// Add css and js files
add_action('wp_head', 'run_this_head');
add_filter('the_content', 'run_this_before_filter', -1);
add_filter('the_content', 'run_this_after_filter', 100);

?>