<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.08.2018
 * Time: 16:37
 */

namespace Corp\Repositories;


class Dependencies {
	private $_items;
	private $_dependencies;

	public function add($item, $dependencies = array())
	{
		$this->_items[$item] = (count($dependencies) > 0) ? $dependencies : null;

		foreach($dependencies as $dependency)
		{
			$this->_dependencies[$dependency][] = $item;
		}
	}

	public function get_load_order()
	{
		$load_order = array();
		$seen       = array();

		foreach($this->_items as $item => $dependencies)
		{
			$tmp = $this->get_dependents($item, $seen);

			//dump($tmp);
			if($tmp[2] === false)
			{
				$load_order = array_merge($load_order, $tmp[0]);
				$seen       = $tmp[1];
			}
		}

		return $load_order;
	}

	public function get_failed_items()
	{
		$failed = array();
		$seen   = array();

		foreach($this->_items as $item => $dependencies)
		{
			$tmp = $this->get_dependents($item, $seen);

			if($tmp[2] !== false)
			{
				$failed[] = $item;
				continue;
			}

			$seen = $tmp[1];
		}

		return $failed;
	}

	private function get_dependents($item, $seen = array())
	{
		if(array_key_exists($item, $seen))
		{
			return array(array(), $seen, false);
		}

		if($this->item_exists($item))
		{
			$order          = array();
			$failed         = array();
			$seen[$item]    = true;

			if($this->has_dependents($item))
			{
				foreach($this->_items[$item] as $dependency)
				{
					$tmp = $this->get_dependents($dependency, $seen);

					$order  = array_merge($tmp[0], $order);
					$seen   = $tmp[1];

					if($tmp[2] !== false)
					{
						$failed = array_merge($tmp[2], $failed);
					}
				}
			}

			$order[]    = $item;
			$failed     = (count($failed) > 0) ? $failed : false;

			return array($order, $seen, $failed);
		}

		return array(array(), array(), array($item));
	}

	private function item_exists($item)
	{
		if(array_key_exists($item, $this->_items))
		{
			return true;
		}

		return false;
	}

	private function has_dependents($item)
	{
		if($this->item_exists($item) AND is_array($this->_items[$item]))
		{
			return true;
		}

		return false;
	}
}