<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_enqueue_script("jquery");
         wp_head(); ?>
    <script src="http://dev.lisairwin.com:3000/socket.io/socket.io.js"></script>
    <script type="text/javascript" charset="utf-8">
    jQuery(document).ready(function () {
        var log_chat_message = function  (message, type) {
            var li = jQuery('<li />').text(message);
            
            if (type === 'system') {
                li.css({'font-weight': 'bold'});
            } else if (type === 'leave' || type === 'error') {
                li.css({'font-weight': 'bold', 'color': '#F00'});
            }
                    
            jQuery('#chat_log').append(li);
        };
    
        var socket = io.connect('http://dev.lisairwin.com:3000');
    
        socket.on('entrance', function  (data) {
            log_chat_message(data.message, 'system');
        });
    
        socket.on('exit', function  (data) {
            log_chat_message(data.message, 'leave');
        });
    
        socket.on('chat', function  (data) {
            log_chat_message(data.message, 'normal');
        });
    
        socket.on('error', function  (data) {
            log_chat_message(data.message, 'error');
        });
    
        jQuery('#chat_box').keypress(function (event) {
            if (event.which == 13) {
                socket.emit('chat', {message: jQuery('#chat_box').val()});
                jQuery('#chat_box').val('');
            }
        });
    });
    </script>
    <style type="text/css" media="screen">
        div#chatroom {
            display: block;
            height: 300px;
            border: 1px solid #999;
            overflow: auto;
            width: 100%;
            margin-bottom: 10px;
            position: relative;
        }
    
        ul#chat_log {
            list-style: none;
            position: absolute;
            bottom: 0px;
        }
    
        input#chat_box {
            width: 99%;
        }
    </style>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					<?php get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
