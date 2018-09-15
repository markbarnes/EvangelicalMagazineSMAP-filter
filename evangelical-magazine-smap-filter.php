<?php
/**
Plugin Name: Evangelical Magazine SMAP filter
Description: Filters the content of the Social Media Auto Poster text, for the Evangelical Magazine website
Plugin URI: http://www.evangelicalmagazine.com/
Version: 0.1
Author: Mark Barnes
Author URI: http://www.markbarnes.net/
*/

add_filter ('option_xyz_smap_message', 'mb_emsmapf_filter_smap_message');

/**
* put your comment there...
*
* @param mixed $message
*/
function mb_emsmapf_filter_smap_message ($message) {
	global $post;
	if (class_exists('evangelical_magazine_articles_and_reviews') && $post) {
		if (!(isset($post->post_status) && $post->post_status == 'auto-draft')) {
			if (isset($_POST['xyz_smap_message'])) {
				unset ($_POST['xyz_smap_message']);
			}
			/**
			* @var evangelical_magazine_articles_and_reviews
			*/
			$object = evangelical_magazine::get_object_from_post($post);
			if ($object && $object->is_article_or_review()) {
				$message = $object->get_name().$object->get_author_names(false, false, ' — by ');
			}
		}
	}
    return $message;
}

?>
