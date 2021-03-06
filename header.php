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
	<script src="<?php bloginfo( 'template_directory' ); ?>/javascript/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/javascript/snaps.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/javascript/hank.js" type="text/javascript" charset="utf-8"></script>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script type="text/javascript" charset="utf-8">
		document.createElement("header");
		document.createElement("padding");
		document.createElement("left");
		document.createElement("menu");
		document.createElement("case");
		document.createElement("info");
		document.createElement("post");
		document.createElement("date");
	</script>
</head>

<body <?php body_class(); ?>>
	<padding></padding>
	<header>
		<left>
			<h1><a href="<?php bloginfo('url'); ?>">hank of bullshits</a></h1>
			
			<ul id="head-menu">
				<?php $pages = get_pages();
				
				global $_page; 
			  foreach ($pages as $page) {
			  	$option = '<li><a href="'.get_page_link($page->ID);
				if($page->ID == $_GET['page_id']) {
					$option .= "\" class=\"active\"";
				}
				$option .= '">';
				$option .= $page->post_title;
				$option .= '</a></li>';
				echo $option;
			  }
			  ?>
			</ul>
		
			<info class="author">by billy</info>
			
		
			<info class="selected-category">webdeveloping <small> > publikacje</small></info>
			
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
						$cache = new HankCache();
						
						$cached =  $cache -> get("last-tweet");
						
						if($cached) {
							$tweet_formated = $cached;
						} else {
							$username='billy0o'; // set user name
							$format='json'; // set format
							$tweet=json_decode(file_get_contents("http://api.twitter.com/1/statuses/user_timeline/{$username}.{$format}")); // get tweets and decode them into a variable

							$tweet_formated = chlimit($tweet[0]->text, 140);
					
							$cache -> set("last-tweet", $tweet_formated, 10 * 60 * 60); // temp too
							
						}
						
						echo $tweet_formated;
					?>
				</p>
			</div>
				 	<div id="last-song">
						<a href="http://www.lastfm.pl/user/billy0o"></a>
				 		<p>
					<?php
					$isLoved = false;
					$cached =  $cache -> get("last-song");
					
					if($cached) {
						$song = $cached[0];
						$isLoved = $cached[1];
					} else {
						
						$user = "billy0o";	
						$data = file_get_contents("http://www.lastfm.pl/user/{$user}");
						if(preg_match('/<table class="tracklist withimages" id="recentTracks">.*?<td class="subjectCell.*?<a href="(.*?)">(.*?)<\\/a>.*?<a href="(.*?)">(.*?)<\\/a>[\s\t\r\n]*<\/td>[\s\t\r\n]*<td class="lovedCell[^>]*>[\s\t\r\n]*(<img)?/su', $data, $match)) {
							$artist = $match[2];
							$artistURI = $match[1];
							$song = $match[4];
							$songURI = $match[3];
							
							$song = strip_tags($song); // rids auto-correct information
							
							
							$artist = chlimit($artist, 30);
							
							if(strlen($artist) + strlen($song) > 65) {
								$song = chlimit($song, 65 - strlen($artist));
							}
							
							
							$song = "<strong><a href=\"http://www.last.fm/".$artistURI."\">".$artist."</a></strong> &ndash; <a href=\"http://www.last.fm/".$songURI."\">".$song."</a>";
						
							if($match[5] != false)
								$isLoved = true;
							
							/*<td class="lovedCell">
							                            <img*/
							//echo preg_replace("/(.*?)\&ndash;/", "<strong>\\1</strong> &ndash;", chlimit($artist[1]." &ndash; ".$name[1], 75));
						}
						
						else
							$song = "<strong>Error getting the current song</strong>";
						
						$cache -> set("last-song", array($song, $isLoved), 60 * 60 * 24); // just temporarily
					}
					
					echo $song;
				
					if($isLoved == "loved") {
						echo "<img src=\"";
						bloginfo( 'template_directory' );
						echo "/images/header-music-like.png\" alt=\"Lubię ten utwór!\"/>";
					}
					?>
				 		</p>
				 	</div>
		</right>
	</header>