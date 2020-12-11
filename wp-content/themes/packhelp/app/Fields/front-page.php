<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$page = new FieldsBuilder('home', ['hide_on_screen' => ['the_content']]);

$page
	->setLocation('page_type', '==', 'front_page');

// Main section
$page
	->addTab('Hero')
	->addGroup('home_hero', ['label' => 'Hero'])
	->addText('section_title', ['label' => 'Hero Title'])
	->addWysiwyg('text')
	->addRepeater('buttons', ['label' => 'Buttons', 'button_label' => 'Add Button'])
	->addText('button_text', ['label' => 'Button Text'])
	->addPageLink('button_link', ['label' => 'Button Link'])
	->endRepeater()
	->endGroup();

// About us section
$page
	->addTab('About Us')
	->addGroup('home_about', ['label' => 'About Us'])
	->addImage('big_image', ['label' => 'Big Image', 'return_format' => 'url'])
	->addText('section_title', ['label' => 'Section Title'])
	->addWysiwyg('text')
	->addRepeater('Columns', ['label' => 'Top Columns', 'button_label' => 'Add column'])
	->addText('title', ['label' => 'Title'])
	->addWysiwyg('text')
	->endRepeater()
	->addRepeater('Numbers', ['label' => 'Numbers', 'button_label' => 'Add number'])
	->addURL('link', ['label' => 'Link'])
	->addText('number', ['label' => 'Number'])
	->addText('subtitle', ['label' => 'Subtitle'])
	->endRepeater()
	->endGroup();

// About us section
$page
	->addTab('Products')
	->addGroup('home_products', ['label' => 'Products'])
	->addText('section_title', ['label' => 'Section Title'])
	->addNumber('products_number', ['label' => 'Products Number'])
	->endGroup();

return $page;
