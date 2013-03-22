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
	    if(strpos($arr[0], 'http://') !== 0)
	    {
	        $arr[0] = 'http://' . $arr[0];
	    }
	    $url = parse_url($arr[0]);

	    // images
	    if(preg_match('#\.(png|jpg|gif)$#', $url['path']))
	    {
	        return '<img src="'. $arr[0] . '" />';
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
	    return sprintf('<a href="%1$s">%1$s</a>', $arr[0]);
	}, $string);
    return $string;
}
?>