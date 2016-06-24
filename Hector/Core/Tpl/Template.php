<?php

namespace Hector\Core\Tpl;

use Hector\Core\Tpl\Aegis\Lexer\Lexer;
use Hector\Core\Tpl\Aegis\Parser\Parser;
use Hector\Core\Tpl\Aegis\Compiler\Compiler;

class Template
{
	const TPL_EXT = '.tpl';
	
	const TPL_DIR = 'App/Example/View/';
	const CACHE_DIR = 'cache/templates/';

	const HEAD_DIR = 'cache/templates/head/';
	const BODY_DIR = 'cache/templates/body/';

	private $cacheFilename;

	private $variables = [];
	private $blocks = [];

	public function render( $filename )
	{
		$this->cacheFilename = static::CACHE_DIR . urlencode( $filename ) . '.php';

		// Get string to render
		$string = file_get_contents( static::TPL_DIR . $filename . static::TPL_EXT );

		// Tokenize the string
		$lexer = new Lexer();
		$tokenStream = $lexer->tokenize( $string );

		// Parse the token stream to a node tree
		$parser = new Parser();
		$parsedTree = $parser->parse( $tokenStream );

		// Create the compiler
		$compiler = new Compiler( $parsedTree );

		// Compile and save
		file_put_contents( $this->cacheFilename, $compiler->compile() );

		// Execute
		$this->execute();
	}

	public function renderHead( $filename )
	{
		$this->cacheFilename = static::HEAD_DIR . urlencode( $filename ) . '.php';

		// Get string to render
		$string = file_get_contents( static::TPL_DIR . $filename . static::TPL_EXT );

		// Tokenize the string
		$lexer = new Lexer();
		$tokenStream = $lexer->tokenize( $string );

		// Parse the token stream to a node tree
		$parser = new Parser();
		$parsedTree = $parser->parse( $tokenStream );

		// Create the compiler
		$compiler = new Compiler( $parsedTree );

		// Compile
		$compiler->compile();

		// Compile and save
		file_put_contents( $this->cacheFilename, $compiler->getHead() );

		// Execute
		$this->execute();
	}

	public function renderBody( $filename )
	{
		$this->cacheFilename = static::BODY_DIR . urlencode( $filename ) . '.php';

		// Get string to render
		$string = file_get_contents( static::TPL_DIR . $filename . static::TPL_EXT );

		// Tokenize the string
		$lexer = new Lexer();
		$tokenStream = $lexer->tokenize( $string );

		// Parse the token stream to a node tree
		$parser = new Parser();
		$parsedTree = $parser->parse( $tokenStream );

		// Create the compiler
		$compiler = new Compiler( $parsedTree );

		// Compile
		$compiler->compile();

		// Compile and save
		file_put_contents( $this->cacheFilename, $compiler->getBody() );

		// Execute
		$this->execute();
	}

	private function execute()
	{
		require $this->cacheFilename;
	}
	
	// Runtime

	public function __get( $k )
	{
		return $this->variables[ $k ];
	}

	public function __set( $k, $v )
	{
		$this->variables[ $k ] = $v;
	}

	public function setBlock( $id, $callable )
	{
		$this->blocks[ $id ] = [ $callable ];
	}

	public function appendBlock( $id, $callable )
	{
		$this->blocks[ $id ][] = $callable;
	}

	public function prependBlock( $id, $callable )
	{
		array_unshift( $this->blocks[ $id ], $callable );
	}

	public function getBlock( $id )
	{
		foreach( $this->blocks[ $id ] as $callable )
		{
			$callable();
		}
	}
}