<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style('chiron-go-round-tc', get_stylesheet_directory_uri() . '/assets/fonts/chiron-go-round-tc/css/vf.css', [], '1.009');
	// wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), CHILD_THEME_ASTRA_CHILD_VERSION );
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
	
	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array(), '', true );
	wp_enqueue_script('main', get_stylesheet_directory_uri().'/assets/js/main.js', array(), '', true);
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


/*新增Google Analytic追蹤碼*/
function insert_google_analytics() {
    ?>
    <!-- Google tag (gtag.js) -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-H3E04MDSH5"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-H3E04MDSH5');
	</script> -->
    <?php
}
add_action('wp_head', 'insert_google_analytics');

/*只給能管理站台的人上傳 SVG*/
add_filter('upload_mimes', function ($mimes) {
  if (current_user_can('manage_options')) {
    $mimes['svg'] = 'image/svg+xml';
  }
  return $mimes;
});

// footer copyright
add_shortcode('copyright', function () {
    $year = date_i18n('Y');
    $name = get_bloginfo('name');

    return
        '<small class="site-copyright">' .
            '<span class="copyright-prefix">' . esc_html("Copyright © {$year} {$name}") . '</span> ' .
            '<span class="line">|</span> ' .
            '<span class="copyright-powered">Powered by Eos</span>' .
        '</small>';
});



