<?php
/**
 * SimplePie Add-on for Digg
 *
 * Copyright (c) 2004-2007, Ryan Parman and Geoffrey Sneddon
 * All rights reserved. License matches the current SimplePie license.
 */
 
if (!defined('SIMPLEPIE_NAMESPACE_DIGG'))
{
	define('SIMPLEPIE_NAMESPACE_DIGG', 'http://digg.com/docs/diggrss/');
}
 
class SimplePie_Item_Digg extends SimplePie_Item
{
	// New method
	function get_digg_count()
	{
		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'diggCount');
		return $data[0]['data'];
	}
 
	// New method
	function get_submitter_username()
	{
		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'submitter');
		$data = $data[0]['child'][SIMPLEPIE_NAMESPACE_DIGG]['username'];
		return $data[0]['data'];
	}
 
	// New method
	function get_submitter_image()
	{
		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'submitter');
		$data = $data[0]['child'][SIMPLEPIE_NAMESPACE_DIGG]['userimage'];
		return $data[0]['data'];
	}
 
	// New method
	function get_comment_count()
	{
		$data = $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'commentCount');
		return $data[0]['data'];
	}
 
	// Overloading an existing method.
	function get_categories()
	{
		$categories = array();
 
		foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_DIGG, 'category') as $category)
		{
			$categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
		}
		foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'category') as $category)
		{
			$term = null;
			$scheme = null;
			$label = null;
			if (isset($category['attribs']['']['term']))
			{
				$term = $this->sanitize($category['attribs']['']['term'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($category['attribs']['']['scheme']))
			{
				$scheme = $this->sanitize($category['attribs']['']['scheme'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			if (isset($category['attribs']['']['label']))
			{
				$label = $this->sanitize($category['attribs']['']['label'], SIMPLEPIE_CONSTRUCT_TEXT);
			}
			$categories[] =& new $this->feed->category_class($term, $scheme, $label);
		}
		foreach ((array) $this->get_item_tags('', 'category') as $category)
		{
			$categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
		}
		foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_DC_11, 'subject') as $category)
		{
			$categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
		}
		foreach ((array) $this->get_item_tags(SIMPLEPIE_NAMESPACE_DC_10, 'subject') as $category)
		{
			$categories[] =& new $this->feed->category_class($this->sanitize($category['data'], SIMPLEPIE_CONSTRUCT_TEXT), null, null);
		}
 
		if (!empty($categories))
		{
			return SimplePie_Misc::array_unique($categories);
		}
		else
		{
			return null;
		}
	}
}
 
?>