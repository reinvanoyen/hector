<?php

namespace App\ExampleApp\Controller;

use App\ExampleApp\Model\BlogPost;
use Hector\Core\Controller;
use Hector\Core\Http\Response;
use Hector\Core\Routing\NotFound;
use Hector\Core\Db\FetchException;
use Hector\Core\Tpl\Template;

class Blog extends Controller
{
	private $tpl;

	public function beforeExecuteRoute()
	{
		$this->tpl = new Template();
		$this->tpl->blogposts = BlogPost::all();
	}

	public function viewIndex()
	{
		try
		{
			$blogpost = BlogPost::one();

			return $this->viewPost( $blogpost->id, $blogpost->slug );
		}
		catch( FetchException $e )
		{
			throw new NotFound();
		}
	}

	public function viewPost( $id, $slug )
	{
		try
		{
			$this->tpl->blogpost = BlogPost::load( [
				'id' => $id,
				'slug' => $slug,
			] );

			return new Response( $this->tpl->render( 'blog/view.php' ) );
		}
		catch( FetchException $e )
		{
			throw new NotFound();
		}
	}
}