<?php



function polskaData($time = false, $relative = false) {
	$data = "";
	
	if($time == false) {
		$time = time();
	} else if (!is_int($time)) {
		$time = strtotime($time);
	}
	
	$day = Date("j", $time);
	$year = Date("Y", $time);
	$month = Date("n", $time);
	$week = Date("W", $time);
	$clock = Date("H:i", $time);
	
	$now = time();
	
//	return $relative . "  " . ($now - $time);
	
	if($now > $time and (($relative === true) or #7e7e7e
		(is_int($relative) && ($relative > ($now - $time))))) {
		
		if($now - $time < 10) {
			return "przed chwilą";
		}
	
		if($now - $time < 120) {
			return "około minuty temu";
		}	
		
		if($now - $time < 45 * 60) {
			$minuty = ($now - $time);
			
			$minuta = ($minuty - $minuty % 60) / 60;
			
			if(($minuta < 10) && ($minuta % 10) < 5) return $minuta . " minuty temu";
			
			return $minuta . " minut temu";
		}
		
		if($now - $time < 23 * 3600) {
			$godziny = ($now - $time);

			$godzina = ($godziny - $godziny % 3600) / 3600;
			
			if($godzina < 2) return "godzinę temu";

			if($godzina < 10 && $godzina % 10 < 5) return $godzina . " gdziny temu";

			return $godzina . " godzin temu";
		}
	
		$today = Date("j", $now);
		$currentMonth = Date("n", $now);
		$currentYear = Date("Y");
	
		$weeks = $nowweek;
		
		
		
		if(Date("j:n:Y", $now - 24 * 3600) == Date("j:n:Y", $time)) return "wczoraj, o " . $clock;
		
		if(Date("W:Y", $now - 7 * 24 * 3600) == Date("W:Y", $time)) return "w zeszłym tygodniu";
		
		if($now - $time < 24 * 3600 * 31) {
			
			$dni = ($now - $time - ($now - $time) % (3600 * 24)) / (3600 * 24);
			
			return $dni . " dni temu";
		}
		
		
		
		$monthsToTime = $year * 12 + $month - 13;
		$monthsNow = $currentYear * 12 + $currentMonth - 13;
		
		return $monthsNow - $monthsToTime;
		
		if($monthsNow - $monthsToTime < 2) {
			return "miesiąc temu";
		}
		
		if($monthsNow - $monthsToTime < 12) {
			$miesiecy = $monthsNow - $monthsToTime;
			
			if($miesiecy % 10 < 5) 
				return $miesiecy. "miesiące temu";
			
			return $miesiecy. "miesięcy temu";
		}
		
		if($now - $time < 356 * 3600) return "rok temu";
		
		$lata = ($now - $time - ($now - $time) % 3600) / 356 * 3600;
		
		if($godzina % 10 < 5) return $lata . " lata temu";
		
		return $lata . " lat temu";
	}
	
	 $miesiac=date("m", $time);
	switch($miesiac)
	{
		case '01':$miesiac='stycznia'; break;
		case '02':$miesiac='lutego'; break;
		case '03':$miesiac='marca'; break;
		case '04':$miesiac='kwietnia'; break;
		case '05':$miesiac='maja'; break;
		case '06':$miesiac='czerwca'; break;
		case '07':$miesiac='lipca'; break;
		case '08':$miesiac='sierpnia'; break;
		case '09':$miesiac='września'; break;
		case '10':$miesiac='października'; break;
		case '11':$miesiac='listopada'; break;
		case '12':$miesiac='grudnia'; break;
	}
	
	return date('j', $time) . " " . $miesiac . " " . date("Y", $time);
 
	
}



function hank_comment($comment)
{
	
	$GLOBALS['comment'] = $comment; 
	
	?>
	
	<comment <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<number id="comments-<?php echo $comment -> comment_post_ID; ?>"><?php echo $comment -> comment_post_ID; ?></number>
		<h1>
			<author>
				<name>
					<?php
						if($comment -> comment_author_url) {
							echo "<a href=\"" . $comment -> comment_author_url . "\" title=\"Visit author's page\">";
							echo $comment -> comment_author;
							echo "</a>";
						} else {
							echo $comment -> comment_author; 
						}
					?>
				</name>
				<avator></avator>
			</author>
		</h1>
		
		<time>
			<?php echo polskaData(strtotime($comment -> comment_date_gmt))?>
		</time>
		
		<content></content>
	</comment>
	
	
	
	<?php
}



?>