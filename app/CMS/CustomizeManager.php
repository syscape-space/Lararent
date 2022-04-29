<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.08.2018
 * Time: 19:05
 */

namespace Corp\CMS;

use Illuminate\Support\Collection;

/**
 *
 * Class CustomizeManager
 * @package Corp\CMS
 */
class CustomizeManager {

	/**
	 * @var Collection
	 */
	protected $panels;

	/**
	 * @var Collection
	 */
	protected $section;


	/**
	 * @var Collection
	 */
	protected $setting;

	protected $control;

	protected $previewing = false;
//	protected $options;

	/**
	 * CustomizeManager constructor.
	 */
	public function __construct() {

		//$this->panels = new Collection();
		//	$this->section = new Collection();
		//	$this->setting = new Collection();
		//	$this->control = new Collection();
	}


	/**
	 * @return mixed
	 */
	public function getPanels() {
		return $this->panels;
	}

	/**
	 * @param mixed $panels
	 */
	public function setPanels( $panels, $arr ) {

		$this->panels[$panels] = $arr;

		return $this;
	}

	/**
	 * @param mixed $section
	 * @return CustomizeManager
	 */
	public function setSection( $section, $obj ) {

		if ( !isset( $obj['priority'] ) ) {
			$obj['priority'] = 30;
		}

		if ( isset( $obj['panel'] ) && isset( $this->panels[$obj['panel']] ) ) {
			//	$this->panels[$obj['panel']]['section'][] =  $obj;
		}
		if ( !isset( $obj['panel'] ) ) {
			$this->setPanels( $section, $obj );
		}


		$this->section[$section] = $obj;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSection() {
		return $this->section;
	}

	/**
	 * @return Collection
	 */
	public function getSetting() {
		return $this->setting;
	}

	/**
	 * @param Collection $setting
	 */
	public function setSetting( $setting, $obj ) {

		if ( !isset( $obj['priority'] ) ) {
			$obj['priority'] = 30;
		}
		$this->setting[$setting] = $obj;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getControl() {
		return $this->control;
	}


	/**
	 * @param $control
	 * @param array $obj
	 * @return $this
	 */
	public function setControl( $control, $obj = [] ) {

		// if this new class
		if($control instanceof CustomizeControl){
			$control_obj =  $control;

			$obj= $control_obj->args ?? [];
		//	dump($obj);
			$control = $control_obj->id ?? '';

		} else {
			$control_obj = new CustomizeControl( $this, $control, $obj );

		}

		if ( isset( $obj['section'] ) ) {
			if ( !isset( $this->section[$obj['section']]['panel'] ) ) {
				//	set controls class
				$this->panels[$obj['section']]['controls'][] = $control_obj;
			}
			if ( isset( $obj['section'] ) && isset( $this->section[$obj['section']] ) ) {

				$this->section[$obj['section']]['controller'][$control] = $control_obj;

				if ( isset( $this->section[$obj['section']]['panel'] ) && isset( $this->panels[$this->section[$obj['section']]['panel']] ) ) {


					$this->panels[$this->section[$obj['section']]['panel']]['section'][$obj['section']] = $this->section[$obj['section']];



				}

			}
			//	set controls class
		} elseif ( isset( $obj['panel'] ) && isset( $this->panels[$obj['panel']] ) ) {
			$this->panels[$obj['panel']]['controls'][$control] = $control_obj;
		}
		$this->control[$control] = $obj;
		return $this;
	}

	public function startPreview() {
		$this->previewing = true;
	}

	public function is_preview() {
		return $this->previewing;
	}




}