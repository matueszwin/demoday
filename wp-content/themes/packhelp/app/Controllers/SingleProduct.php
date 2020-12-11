<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleProduct extends Controller
{

	protected $acf = true;

	public function related_products() {
		global $post;

		$product_cat = get_the_terms($post->ID, 'product_cat');
		$tax_ids = [];

		// get Tax IDs
		foreach ( $product_cat as $cat ) {
			$tax_ids[] = $cat->term_id;
		}

		// args
		return collect(get_posts([
			'post_type' => 'product',
			'posts_per_page' => -1,
			'tax_query' => [
				[
					'taxonomy' => 'product_cat',
					'field' => 'ID',
					'terms' => $tax_ids,
				]
			]
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

	public function sizes() {
		global $post;

		$sizes = get_field('product_calculator', $post->ID)['sizes'];

		return collect($sizes)->map(function ($size) {
			return (object) [
				'name' => $size['name'],
				'multiplier' => $size['multiplier'],
			];
		});
	}
}
