<?php
/**
 * Travelify defining constants, adding files and WordPress core functionality.
 *
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700;


if ( ! function_exists( 'travelify_setup' ) ):

add_filter('widget_text', 'do_shortcode');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
add_action( 'after_setup_theme', 'travelify_setup' );

 /**
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 */

function travelify_setup() {
	/**
	 * travelify_add_files hook
	 *
	 * Adding other addtional files if needed.
	 */
	do_action( 'travelify_add_files' );

	/* Travelify is now available for translation. */
	require( get_template_directory() . '/library/functions/i18n.php' );

	/** Load functions */
	require( get_template_directory() . '/library/functions/functions.php' );

	/** Load WP backend related functions */
	require( get_template_directory() . '/library/panel/themeoptions-defaults.php' );
	require( get_template_directory() . '/library/panel/theme-options.php' );
	require( get_template_directory() . '/library/panel/metaboxes.php' );
	require( get_template_directory() . '/library/panel/show-post-id.php' );

	/** Load Shortcodes */
	require( get_template_directory() . '/library/functions/shortcodes.php' );

	/** Load WP Customizer */
	require( get_template_directory() . '/library/functions/customizer.php' );

	/** Load Structure */
	require( get_template_directory() . '/library/structure/header-extensions.php' );
	require( get_template_directory() . '/library/structure/sidebar-extensions.php' );
	require( get_template_directory() . '/library/structure/footer-extensions.php' );
	require( get_template_directory() . '/library/structure/content-extensions.php' );

	/**
	 * travelify_add_functionality hook
	 *
	 * Adding other addtional functionality if needed.
	 */
	do_action( 'travelify_add_functionality' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in header menu location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'travelify' ) );

	// Add Travelify custom image sizes
	add_image_size( 'featured', 670, 300, true );
	add_image_size( 'featured-medium', 230, 230, true );
	add_image_size( 'slider', 1018, 460, true ); 		// used on Featured Slider on Homepage Header
	add_image_size( 'gallery', 474, 342, true ); 				// used to show gallery all images

	// This feature enables WooCommerce support for a theme.
	add_theme_support( 'woocommerce' );

	/**
	 * This theme supports custom background color and image
	 */
	$args = array(
		'default-color' => '#d3d3d3',
		'default-image' => get_template_directory_uri() . '/images/background.png',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * This theme supports add_editor_style
	 */
	add_editor_style();
}
endif; // travelify_setup

?>

<?php
register_post_type('videoyoutube', 
    array(  
        'label' => 'Видео',
        'public' => TRUE,
        'supports'=>array('custom-fields','title'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'video'),
        'labels'=> array(
		'name'=>'Видео!', //Переопределяет название в меню, а также, если есть таксономия, то отображается на странице таксономии как заголовок к графе с количеством постов в терме таксономии
		'singular_name'=>'Видео', //Название одного экземпляра этого поста
		'add_new'=>'Добавить видео', //Название меню для добавления нового поста данного типа
		'add_new_item'=>'Страница добавления нового видео', //Заголовок страницы, на которой добавляются новые посты
		'edit_item'=>'Редактировать видео', //Заголовок страницы, на которой посты редактируются
		'new_item'=>'Новое видео', //Не найдено
		'view_item'=>'Смотреть видео', //При редактировании записи вверху есть кнопка, позволяющая посмотреть её на сайте. Это текст кнопки.
		'search_items'=>'Искать видео', //Текст кнопки на странице просмотра записей, расположенной вверху справа. Обычно там текст "Поиск записей"
		'not_found'=>'Видео не найдено', //Текст на странице с постами, когда не найдено ни одного поста
		'not_found_in_trash'=>'Видео в корзине не найдено', //Текст в корзине в случае, если не найдено ни одного поста
		'menu_name'=>'Видео', //Текст переопределяет текст внутри элемента с ключом 'name',

)
        ) 
    );

// Теперь регистрируем новую иерархичную таксономию

	register_taxonomy('videos', 'videoyoutube', array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_tagcloud' => false,
			'show_admin_column' => true,
			//'meta_box_cb' => 'post_categories_meta_box',
		)
	);
?>