<?php

namespace App\Example\Controller;

class Pages extends Base
{
	public function view( $slug )
	{
		$this->tpl->slug = $slug;
		$this->tpl->title = 'Some custom title';
		$this->tpl->render( 'pages/view' );
	}
}