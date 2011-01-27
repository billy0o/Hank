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

function chlimit($text, $limit) {
	if(strlen($text) <= $limit) 
		return $text;
		
	return substr($text, 0, $limit - 3) . "...";
}
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
			<h1><a href="<?php bloginfo('url'); ?>">hank of bullshits</a></h1>
			
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
				<a href="http://twitter.com/billy0o"></a>
		 		<p>
		 			<?php 
					$username='billy0o'; // set user name
					$format='json'; // set format
					$tweet=json_decode(file_get_contents("http://api.twitter.com/1/statuses/user_timeline/{$username}.{$format}")); // get tweets and decode them into a variable

					echo chlimit($tweet[0]->text, 140);
					?>
				</p>
			</div>
				 	<div id="last-song">
						<a href="http://www.lastfm.pl/user/billy0o"></a>
				 		<p>
					<?php
					$user = "billy0o";	
					$data = file_get_contents("http://www.lastfm.pl/user/{$user}");
					
					if(preg_match('/<table class="tracklist withimages" id="recentTracks">.*?<td class="subjectCell.*?<a href="(.*?)">(.*?)<\\/a>.*?<a href="(.*?)">(.*?)<\\/a>[\s\t\r\n]*<\/td>[\s\t\r\n]*<td class="lovedCell[^>]*>[\s\t\r\n]*(<img)?/s', $data, $match)) {
						
						
						echo "<strong><a href=\"http://www.last.fm/".$match[1]."\">".$match[2]."</a></strong> &ndash; <a href=\"http://www.last.fm/".$match[3]."\">".$match[4]."</a>";
						
						if($match[5] != null) {
							echo "<img src=\"";
							bloginfo( 'template_directory' );
							echo "/images/header-music-like.png\" alt=\"Lubię ten utwór!\"/>";
						}
						/*<td class="lovedCell">
						                            <img*/
						//echo preg_replace("/(.*?)\&ndash;/", "<strong>\\1</strong> &ndash;", chlimit($artist[1]." &ndash; ".$name[1], 75));
					}
					
					else
						echo "<strong>Error getting the current song</strong>"
					
					?>
				 		</p>
				 	</div>
		</right>
	</header>