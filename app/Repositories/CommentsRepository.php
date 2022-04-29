<?php

namespace Corp\Repositories;

use Corp\Comment;

class CommentsRepository extends Repository {


	public function __construct( Comment $comment ) {
		$this->model = $comment;
	}


	public function updateComment( $request, $comment ) {
		$data = $request->except( '_token', '_method' );
		//	dd($data);
		$comment->fill( $data );
		if ( $comment->update() ) {

			return [ 'status' => __( 'admin.saved' ) ];
		}
	}

	public function delete($comment) {
		$comment->delete();
		return [ 'status' => __( 'admin.comment deleted' ) ];
	}

}

