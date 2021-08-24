<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Imgix
 *
 * @package		ExpressionEngine
 * @category	Plugin
 * @author		Andrew Gunstone, Thirst Studios
 * @license		https://opensource.org/licenses/MIT The MIT License (MIT)
 */

class Imgix
{

	/**
	 * Imgix
	 *
	 * This function replaces the image url/path with the Imgix CDN url, and prepends any image adjustments.
	 *
	 * @access  public
	 * @return  string
	 */

	function __construct()
	{
		ee()->load->helper('url');

		$src = ee()->TMPL->fetch_param('src');
		$preset = ee()->TMPL->fetch_param('preset');
		$params = ee()->TMPL->fetch_param('params');

		$imgix_url = rtrim(ee()->config->item('addon:imgix:imgix_url'), "/");
		$imgix_presets = ee()->config->item('addon:imgix:presets');

		if ($imgix_url == '')
			return '';

		if ($preset != '' AND isset($imgix_presets[$preset]))
			$params = $imgix_presets[$preset];

		$params = trim(trim($params, '?'));

		$base_url = rtrim(base_url(), "/");
		$base_path = rtrim(ee()->config->item('base_path'), "/");

		if (strpos($src, 'http') === false)
		{
			$src = str_replace($base_path, $imgix_url, $src)."?".$params;
		}
		else
		{
			$src = str_replace($base_url, $imgix_url, $src)."?".$params;
		}

		$this->return_data = $src;
	}


}