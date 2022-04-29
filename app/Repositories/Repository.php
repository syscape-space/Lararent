<?php

namespace Corp\Repositories;

use Config;
use App;
abstract class Repository {

	protected $model = FALSE;


	public function get( $select = '*', $take = FALSE, $pagination = FALSE, $where = FALSE ) {


		$builder = $this->model->select( $select );

		if ( $take ) {
			$builder->take( $take );
		}

		if ( $where ) {
			$builder->where( $where[0], $where[1] );
		}


		if ( $pagination ) {
			return $this->check( $builder->paginate( Config::get( 'settings.paginate' ) ) );
		}

		return $this->check( $builder->get() );
	}

	protected function check( $result ) {

		if ( $result->isEmpty() ) {
			return FALSE;
		}

		$result->transform( function ( $item, $key ) {

			if ( is_string( $item->img ) && is_object( json_decode( $item->img ) ) && ( json_last_error() == JSON_ERROR_NONE ) ) {
				$item->img = json_decode( $item->img );
			}


			return $item;

		} );

		return $result;

	}

	public function one( $alias, $attr = array() ) {
		$result = $this->model->where( 'alias', $alias )->first();

		return $result;
	}

	/**
	 * get post by id an get translations for id after this we merge it
	 * @param $id
	 * @return mixed
	 */
	public function getOneById( $id ) {
		$post = $this->model->where( 'id', $id )->first();

		if ( ( method_exists( $post, 'translate' ) ) ) {
			$post_t = $post->translate( App::getlocale(), true );


			if ( $post_t ) {
				foreach ( $post_t->getAttributes() as $k => $v ) {

					if ( $k != 'id' ) {
						$post->$k = $v;
					}
				}
			}
		}

		return $post;


	}

	public function transliterate( $string ) {
		$str = mb_strtolower( $string, 'UTF-8' );

		$leter_array = array(
			'a' => 'а',
			'b' => 'б',
			'v' => 'в',
			'g' => 'г,ґ',
			'd' => 'д',
			'e' => 'е,є,э',
			'jo' => 'ё',
			'zh' => 'ж',
			'z' => 'з',
			'i' => 'и,і',
			'ji' => 'ї',
			'j' => 'й',
			'k' => 'к',
			'l' => 'л',
			'm' => 'м',
			'n' => 'н',
			'o' => 'о',
			'p' => 'п',
			'r' => 'р',
			's' => 'с',
			't' => 'т',
			'u' => 'у',
			'f' => 'ф',
			'kh' => 'х',
			'ts' => 'ц',
			'ch' => 'ч',
			'sh' => 'ш',
			'shch' => 'щ',
			'' => 'ъ',
			'y' => 'ы',
			'' => 'ь',
			'yu' => 'ю',
			'ya' => 'я',
		);

		foreach ( $leter_array as $leter => $kyr ) {
			$kyr = explode( ',', $kyr );

			$str = str_replace( $kyr, $leter, $str );

		}

		//  A-Za-z0-9-
		$str = preg_replace( '/(\s|[^A-Za-z0-9\-])+/', '-', $str );

		$str = trim( $str, '-' );

		return $str;
	}


	/**
	 * @param $alias
	 * @param int $i
	 * @return string
	 */
	public function generateAlias( $alias, $i =1 ) {

		if(preg_match('#\d+$#',$alias, $math)){
			$alias =  preg_replace('#\d+$#',$math[0] + $i,$alias);
		} else {
			$alias = $alias . '-'.$i;
		}


		$result = $this->model->withTrashed()->where( 'alias', $alias )->first();

		if ( isset( $result->id ) ) {
			$alias = $alias . '-' . $i;
			$i ++;
			$this->generateAlias( $alias, $i );


		}
		return [$alias,$i];
	}

}

