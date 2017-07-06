<?php

namespace app;

use App\Model\Page;
use Hector\Core\Db\Orm\ModelStack;
use Hector\Core\Http\Response;

class MyController extends \Hector\Core\Controller
{
	public function index( $id )
	{
		$pages = Page::all();

		echo count( $pages ) . '<br /><br />';

		foreach( $pages as $p )
		{
			echo $p->title . '<br />';
		}

		echo '<br />';

		$tpl = $this->app->container->get('Template');
		$tpl->test = 'ok';
		return $tpl->render('index');
	}
}