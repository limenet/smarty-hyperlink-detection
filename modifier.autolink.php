<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.autolink.php
 * Type:     modifier
 * Name:     autolink
 * Purpose:  recognizes links in a string and creates anchor tags around it
 * -------------------------------------------------------------
 */
function smarty_modifier_autolink($string)
{
	$string = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(?:\S+\.\S+)#', function($arr)
	{
	    $email = filter_var($arr[0], FILTER_VALIDATE_EMAIL) === $arr[0] ? true : false;
	    $origArr0 = $arr[0];
	    if(strpos($arr[0], 'http://') !== 0 && strpos($arr[0], 'https://') !== 0)
	    {
	        $arr[0] = 'http://' . $arr[0];
	    }
	    $url = parse_url($arr[0]);
	    // images
	    if(isset($url['path'])){
		    if(preg_match('#\.(png|jpg|gif)$#', $url['path']))
		    {
		        return '<img src="'. $arr[0] . '" />';
		    }
		}
	    // youtube
	    if(in_array($url['host'], array('www.youtube.com', 'youtube.com'))
	      && $url['path'] == '/watch'
	      && isset($url['query']))
	    {
	        parse_str($url['query'], $query);
	        return sprintf('<iframe class="embedded-video" src="http://www.youtube.com/embed/%s" allowfullscreen></iframe>', $query['v']);
	    }
	    //links
	    if($email){
	    	return sprintf('<a href="mailto:%1$s">%1$s</a>', $origArr0);
	    }else{
	    	return sprintf('<a href="%1$s">%2$s</a>', $arr[0], str_replace($url['scheme'].'://', '', $arr[0]));
	    }
	}, $string);
    return $string;
}
?>