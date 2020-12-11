<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Returns $value if it is set, otherwise returns $default.
 *
 * @param mixed $value Value.
 * @param mixed $default Default value.
 * @return mixed
 */
function hyd_value_or_default( &$value, $default = false ) {
	return isset( $value ) ? $value : $default;
}

/**
 * A wrapper for stella_value_or_default that checks if multiple values are set.
 *
 * @param array $default_values Values to check.
 * @param array $defined_vars   List of already defined variables.
 * @return array
 */

function hyd_defaults( array $default_values, array $defined_vars ) : array {
	// If the default values array or defined variables array is null, return an empty array.
	if ( is_null( $default_values ) || is_null( $defined_vars ) ) {
		return [];
	}

	// Create empty array that will be returned.
	$return_values = [];

	// Loop through array of default values.
	foreach ( $default_values as $key => $value ) {
		if ( ! is_string( $key ) && ! is_string( $value ) ) {
			// Skip when we don't have a valid variable name.
			continue;
		}
		// Whether we have the variable name in the key.
		$is_key_var_name = is_string( $key );

		// If the key is a string, use the default key for the returned key. Otherwise, use the value for the returned key.
		$return_key = $is_key_var_name ? $key : $value;

		// Assign default return value.
		$return_value = false;

		// If the value is a function, invoke it!
		if ( $is_key_var_name && is_callable( $value ) ) {
			// Pass real value (if defined, otherwise pass false), pass all of the returned values up to this point, and pass all of the defined variables.
			$return_value = call_user_func_array(
				$value,
				[
					$defined_vars[ $return_key ] ?? false,
					$return_values,
					$defined_vars,
				]
			);
		} elseif ( isset( $defined_vars[ $return_key ] ) ) { // Else, if the needed variable exists in the scope, return that.
			$return_value = $defined_vars[ $return_key ];
		} elseif ( $is_key_var_name ) { // Else, the variable is not defined; return the default value.
			$return_value = $value;
		}

		// Add key and value to the return array.
		$return_values[ $return_key ] = $return_value;
	}

	return $return_values;
}
