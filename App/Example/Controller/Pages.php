<?php

namespace App\Example\Controller;

use Hector\Core\Http\Psr\Response;
use Hector\Core\Http\Psr\Stream;

class Pages extends Base
{
	public function view( $slug )
	{
		$stream = new Stream( fopen( 'php://temp', 'r+' ) );

		$stream->write( 'my string should be written' );

		return (string) $stream;

//		$response = new Response();
//
//		$this->tpl->slug = $slug;
//		$this->tpl->title = 'Some custom title';
//		$this->tpl->render( 'pages/view' );
	}
}