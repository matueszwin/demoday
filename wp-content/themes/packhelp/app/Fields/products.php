<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$cpt = new FieldsBuilder('cpt_product', ['title' => 'Product']);

$cpt
	->setLocation('post_type', '==', 'product');

// Main section
$cpt
	->addTab('Calculator')
	->addGroup('product_calculator', ['label' => 'Kalkulator'])
	->addNumber('product_price', ['label' => 'Cena'])
	->addRepeater('sizes', ['layout' => 'block', 'button_label' => 'Add Size'])
	->addText('name')
	->addText('multiplier')
	->endRepeater()
	->endGroup();

return $cpt;
