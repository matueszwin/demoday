<?php

namespace App;

use StoutLogic\AcfBuilder\FieldsBuilder;

$theme_options = new FieldsBuilder('Theme options');

$theme_options
	->setLocation('options_page', '==', 'theme-general-settings');

$theme_options
	->addTab('General')
	->addGroup('general_settings', ['label' => 'General'])
	->addImage('logo', ['label' => 'Logo', 'return_format' => 'id'])
	->endGroup();

$theme_options
	->addTab('Social media')
	->addGroup('social_media', ['label' => 'Social Media'])
	->addUrl('facebook')
	->addUrl('twitter')
	->addUrl('instagram')
	->addUrl('linkedin')
	->endGroup();

return $theme_options;
