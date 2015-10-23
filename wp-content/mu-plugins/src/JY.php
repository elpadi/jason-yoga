<?php
use Functional as F;

class JY extends App {

	protected static $SITE_PREFIX = 'jy_';
	
	protected function siteInit() {
		$this->registerPostType('testimonials', '', '', array(), array('menu_icon' => 'dashicons-format-quote'));
	}

	public function testimonials() {
		$posts = get_posts(['post_type' => self::prefix('testimonials'), 'posts_per_page' => -1]);
		$ids = F\pluck($posts, 'ID');
		$featured_id = get_option('featured_testimonial_id', 2094);
		$data = $this->customPostsQuery($ids, ['text' => ['testimonial_quote','author_info'], 'attachments' => ['thumb']], 'posts.`post_date` DESC');
		array_walk($data, array($this, 'hydrateTestimonial'), $featured_id);
		foreach ($data as $post) $by_type[$post->quote_type][] = $post;
		return $by_type;
	}

	protected function hydrateTestimonial(&$post, $index, $featured_id) {
		$post->quote_type = $post->ID == $featured_id ? 'featured' : (
			empty($post->author_info) ? 'short' : 'long'
		); 
		$post->author_name = get_the_title($post);
		$post->author_info_parts = explode("\n", $post->author_info);
		if ($post->author_name === 'Jason Crandell') $post->quote_type = 'jason';
		if (!empty($post->thumb_serialized)) {
			$upload_dir = wp_upload_dir();
			$data = unserialize($post->thumb_serialized);
			$post->thumb = "$upload_dir[baseurl]/$data[file]";
		}
	}

}
