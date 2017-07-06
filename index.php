<?php

ini_set( 'display_errors', 1 );

require __DIR__ . '/vendor/autoload.php';

\Aegis\Template::$templateDirectory = 'App/View/';

$app = new Hector\Core\Application( 'App' );

\Hector\Core\Db\ConnectionManager::create('localhost', 'root', 'root', 'test');

$app->container->factory( 'Template', function() {

	$tpl = new \Aegis\Template(new \Aegis\Runtime\DefaultRuntime(new \Aegis\Runtime\DefaultNodeCollection()));
	$tpl->setLexer(new \Aegis\Lexer());
	$tpl->setParser(new \Aegis\Parser());
	$tpl->setCompiler(new \Aegis\Compiler());

	return $tpl;
} );

$app->get( '(?<id>\d+)/', 'App.MyController.index' );

$app->start();