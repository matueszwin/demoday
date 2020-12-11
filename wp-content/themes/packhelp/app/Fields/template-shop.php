<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$page = new FieldsBuilder('shop', ['hide_on_screen' => ['the_content']]);

$page
	->setLocation('page_template', '==', 'views/template-shop.blade.php');

// Slider section
$page
	->addTab('Slider')
	->addGroup('shop_slider', ['label' => 'Slider'])
	->addRepeater('slides', ['layout' => 'block', 'button_label' => 'Add Slide'])
	->addText('title')
	->addImage('image', ['return_format' => 'id'])
	->endRepeater()
	->endGroup();

// Featured section
$page
	->addTab('Featured')
	->addGroup('shop_featured', ['label' => 'Featured Products'])
	->addRepeater('products', ['layout' => 'block', 'button_label' => 'Add Product'])
	->addPostObject('Product', ['label' => 'Product', 'post_type' => 'product', 'multiple' => 1, 'return_format' => 'id'])
	->endRepeater()
	->endGroup();

return $page;