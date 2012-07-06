<?php
// Change these two variables:
$seconds_of_caching = 60*60*24*7; // 7 days.
$ip_of_this_website = '173.0.54.198';
 
/*
- This file is written by Jim Westergren, copyright all rights reserved.
- See more here: www.jimwestergren.com/wordpress-with-redis-as-a-frontend-cache/
- The code is free for everyone to use how they want but please mention my name and link to my article when writing about this.
- Change $ip_of_this_website to the IP of your website above.
- Add ?refresh=yes to the end of a URL to refresh it's cache
- You can also enter the redis client via the command prompt with the command "redis-cli" and then remove all cache with the command "flushdb".
*/
 
// Very necessary if you use Cloudfare:
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}
 
// This is from WordPress:
define('WP_USE_THEMES', true);
 
// Start the timer:
function getmicrotime($t) {
	list($usec, $sec) = explode(" ",$t);
	return ((float)$usec + (float)$sec);
}
$start = microtime();
 
// Initiate redis and the PHP client for redis:
include("./hi/predis.php");
$redis = new Predis\Client('');
 
// few variables:
$current_page_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$current_page_url = str_replace('?refresh=yes', '', $current_page_url);
$redis_key = md5($current_page_url);
 
// This first case is either manual refresh cache by adding ?refresh=yes after the URL or somebody posting a comment
if (isset($_GET['refresh']) || substr($_SERVER['REQUEST_URI'], -12) == '?refresh=yes' || ($_SERVER['HTTP_REFERER'] == $current_page_url && $_SERVER['REQUEST_URI'] != '/' && $_SERVER['REMOTE_ADDR'] != $ip_of_this_website)) {
	require('./hi/wp-blog-header.php');
	$redis->del($redis_key);
 
// Second case: cache exist in redis, let's display it
} else if ($redis->exists($redis_key)) {
	$html_of_current_page = $redis->get($redis_key);
	echo $html_of_current_page;
	echo "<!-- This is cache -->";
 
// third: a normal visitor without cache. And do not cache a preview page from the wp-admin:
} else if ($_SERVER['REMOTE_ADDR'] != $ip_of_this_website && strstr($current_page_url, 'preview=true') == false) {
	require('./hi/wp-blog-header.php');
	$html_of_current_page = file_get_contents($current_page_url);
	$redis->setex($redis_key, $seconds_of_caching, $html_of_current_page);
	echo "<!-- Cache has been set -->";
 
// last case: the normal WordPress. Should only be called with file_get_contents:
} else {
	require('./hi/wp-blog-header.php');
}
 
 
// Let's display some page generation time (note: CloudFlare may strip out comments):
$end = microtime();
$t2 = (getmicrotime($end) - getmicrotime($start));
if ($_SERVER['REMOTE_ADDR'] != $ip_of_this_website) {
	echo "<!-- Cache system by Redis. Page generated in ".round($t2,5)." seconds. -->";
}
?>
