<?php

namespace App\Backend\Modules;

use Hector\Backend\Action\Create;
use Hector\Backend\Module;

class BlogModule extends Module
{
	public function build()
	{
		$this->addAction( 'create', new Create() );
	}
}