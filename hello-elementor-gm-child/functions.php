<?php defined( 'ABSPATH' ) || die( 'This script cannot be accessed directly.' );

// Fix Rest Endpoint
add_filter( 'rest_url', 'tawkify_rest_url', 0);
function tawkify_rest_url() {
	return get_site_url() . '/' . rest_get_url_prefix() . '/';
}

if ( ! function_exists( 'gm_child_enqueue_styles' ) ) {

	add_action( 'wp_enqueue_scripts', 'gm_child_enqueue_styles' );

	/**
	 * Loads child themes' style.css
	 */
	function gm_child_enqueue_styles() {

		$version = '1.0.2';

		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'hello-elementor' ), $version );
	}
}


// ------------------------------------------------------
//         Groovy Menu plugin integration
// ------------------------------------------------------
if ( ! function_exists( 'gm_child_show_groovy_menu' ) ) {
	function gm_child_show_groovy_menu() {
		if ( function_exists( 'groovy_menu' ) ) {
			groovy_menu();
		}
	}
}

add_action( 'wp_body_open', 'gm_child_show_groovy_menu', 1 );


add_action('wp_head', 'analytics_code');

function analytics_code() {
  echo '
  <script>
	  !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics._writeKey="TIONjZMb2tNmdK1N2su6uV3a4sZOOTd7";;analytics.SNIPPET_VERSION="4.15.3";
	  analytics.load("TIONjZMb2tNmdK1N2su6uV3a4sZOOTd7");
	  analytics.page();
	  }}();
	</script>
  ';
}


add_action('wp_footer', 'customJsScript');

function customJsScript() {
  echo '
  <script>
  console.log("Test");
 	jQuery(document).ready(function($){
		if( $(".favorite-menu .elementor-column:nth-child(2)").find(".elementor-widget-nav-menu").length !== 0 ){
			$(".favorite-menu").show();
		}
		
        $(".gm-logo a").attr("href", "https://tawkify.com/home");
		$(".gm-logo a").attr("target", "_blank");
		$("style:nth-child(3)").detach();
	});
  </script>
  ';
}
