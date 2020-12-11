<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{

	protected $acf = true;

	public function products() {


		$post_number = get_field('home_products')['products_number'];

		// args
		return collect(get_posts([
			'post_type' => 'product',
			'posts_per_page' => $post_number,
		]))->map(function ($post) {
			return (object) [
				'title' => get_the_title($post),
				'url' => get_permalink($post),
				'image' => get_the_post_thumbnail_url($post->ID),
				'content' => apply_filters('the_content', $post->post_content),
				'price' => get_field('product_price', $post->ID),
			];
		});
	}
}
