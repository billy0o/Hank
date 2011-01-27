<?php
/**
 * The Header for our theme.
 *
 * Head section
 *
 * @package Hank Of Bullshits
 * @subpackage Hank
 * @since Hanm 0.1b
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	global $page, $paged;
	
	bloginfo( 'name' );
	
	wp_title( ' :: ', true, 'left' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/reset.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/main.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
</head>

<body <?php body_class(); ?>>
	<padding></padding>
	<header>
		<left>
			<h1>hank of bullshits</h1>
			
			<ul id="head-menu">
				<?php wp_list_pages(array(
			    'depth'        => 0,
			    'show_date'    => false,
			    'child_of'     => 0,
			    'exclude'      => 0,
			    'include'      => 0,
			    'title_li'     => 0,
			    'echo'         => 1,
			    'authors'      => 0,
			    'sort_column'  => 'menu_order, post_title',
			    'link_before'  => "",
			    'link_after'   => "",
			    'walker' =>  0)); ?>
			</ul>
		
			<info class="author">by billy</info>
			
		
			<info class="selected-category">frontend web techniques</info>
			
			<!--
			<menu class="select-category">
				<case>
					<a href="/category/frontend-techniques">frontend web techniques</a>
				</case>
				<case>
					<a href="#about-blog">o blogu</a>
				</case>
			</menu> -->
		</left>
		<right>
		 	<div id="last-tweet">
		 		<p>
		 			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pretium cursus leo at ornare. Fusce sagittis magna vel eros ornare eget metus. </p>
		 	</div>
				 	<div id="last-song">
				 		<p>
							<strong>A.J.K.S.</strong> - Wszyscy Prawdziwi Chcą Mnie Zajebać
				 		</p>
				 	</div>
		</right>
	</header>