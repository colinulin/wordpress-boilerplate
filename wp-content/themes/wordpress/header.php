<?php
/**
 * Default Page Header
 *
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

        <!-- favicon -->
        <?=cu_get_favicon_html(get_template_directory_uri().'/library/images/favicons/')?>

        <title><?=wp_title('')?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="MobileOptimized" content="320">
        <meta name="HandheldFriendly" content="True">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXXX-XX"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-XXXXXX-XX');
        </script>

        <?php // wordpress head functions ?>
        <?php wp_head(); ?>

        <noscript><link rel="stylesheet" media="screen" href="<?= get_template_directory_uri(); ?>/library/css/no-js.css"></noscript>
    </head>
    <body <?php body_class(); ?>>

    <div class="page">

        <?php get_template_part('partials/head');