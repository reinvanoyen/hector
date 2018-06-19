<?php

namespace Hector\Core\Provider;

use Hector\Core\Application;

class AegisServiceProvider extends ServiceProvider
{
	protected $isLazy = true;

	public function register(Application $app)
	{
		$app->set('tpl', function() use ($app) {

			$tpl = new \Aegis\Template(new \Aegis\Runtime\DefaultRuntime(new \Aegis\Runtime\DefaultNodeCollection()));
			$tpl->setLexer(new \Aegis\Lexer());
			$tpl->setParser(new \Aegis\Parser());
			$tpl->setCompiler(new \Aegis\Compiler());

			return $tpl;
		});
	}

	public function boot(Application $app)
	{
		\Aegis\Template::$templateDirectory = $app->get('config')['tpl']['dir'];
	}

	public function provides(): array
	{
		return ['tpl'];
	}
}