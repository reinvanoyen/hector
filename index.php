<?php

ini_set( 'display_errors', 1 );

require __DIR__ . '/vendor/autoload.php';

use \Hector\Core\Db\QueryBuilder\Query;

/*
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

$app->get( '', 'App.Pages.index' );
$app->get( '(?<id>\d+)/', 'App.Pages.view' );
$app->get( 'create/', 'App.Pages.create' );
$app->get( 'delete/(?<id>\d+)/', 'App.Pages.delete' );

$app->start();
*/

$query = Query::select( ['*'], 'page' )->where( [ 'title', 'ok', ] );

echo $query->getQuery()->getQuery();
echo '<br />';
var_dump( $query->getQuery()->getBindings() );