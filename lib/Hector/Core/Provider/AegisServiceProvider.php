<?php

namespace Hector\Core\Provider;

class AegisServiceProvider implements \Hector\Core\Provider\ServiceProviderInterface
{
	public function register(\Hector\Core\Application $app)
	{
		$app->set('tpl', function() use( $app ) {

			\Aegis\Template::$templateDirectory = $app->getNamespace() . '/View/';

			$tpl = new \Aegis\Template(new \Aegis\Runtime\DefaultRuntime(new \Aegis\Runtime\DefaultNodeCollection()));
			$tpl->setLexer(new \Aegis\Lexer());
			$tpl->setParser(new \Aegis\Parser());
			$tpl->setCompiler(new \Aegis\Compiler());

			return $tpl;
		});
	}
}