<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.08.2018
 * Time: 12:23
 */

namespace Corp\Themes\RentIt\Http\Controllers;


use Cache;
use Corp\PostTag;

use Corp\Tag;
use Corp\Themes\RentIt\RentItTheme;

class PostTagController extends RentItTheme{

	public function index( $tag_alias = FALSE ) {
		//


			$posts = Cache::remember( 'PostTagController.' . $tag_alias, 10, function () use ($tag_alias)  {



				$category = Tag::with( array(
					'posts' => function ( $query ) {
						$query->with( 'translations','user' )->where( 'published_at', '<', new \DateTime() )->latest( 'published_at' );
					},



				) )->where( 'alias', $tag_alias )->first();


				$posts = $category->posts->load('categories.translations','comments');
				return $posts;
			} );



		$sidebar = $this->getTemplate( 'sidebar' );

		$content = $this->getTemplate( 'posts.posts-content', [ 'posts' => $posts ] );


		$footer = $this->getTemplate( 'footer' );


		$this->vars = array_add( $this->vars, 'content', $content );
		$this->vars = array_add( $this->vars, 'footer', $footer );
		$this->vars = array_add( $this->vars, 'sidebar', $sidebar );

		return $this->renderOutput();
	}
}