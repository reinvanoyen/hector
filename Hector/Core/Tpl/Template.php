<?php

namespace Hector\Core\Tpl;

use Hector\Core\Bootstrap;
use Hector\Core\Tpl\Modifier\ModifierInterface;
use Hector\Core\Tpl\Modifier\TrumpModifier;

class Template
{
	private $data = [];
	private $modifiers = [];

	public function __construct()
	{
		$this->registerModifier( new TrumpModifier() );
	}

	// Magic setter
	public function __set( $k, $v ) { $this->data[ $k ] = $v; }

	protected function getTemplatePath()
	{
		return 'App/' . Bootstrap::getCurrentApp()->getName() . '/View/';
	}

	protected function getCachePath()
	{
		return 'App/' . Bootstrap::getCurrentApp()->getName() . '/cache/views/';
	}

	public function registerModifier( ModifierInterface $mod )
	{
		$this->modifiers[] = $mod;
	}

	public function render( $filename )
	{
		$source_filename = $this->getTemplatePath() . $filename;
		$cache_filename = $this->getCachePath() . urlencode( $filename ) . '.php';

		if( ! file_exists( $cache_filename ) || filemtime( $cache_filename ) <= filemtime( $source_filename ) )
		{
			if( ! file_exists( $this->getCachePath() ) )
			{
				mkdir( $this->getCachePath(), 0777, TRUE );
			}

			file_put_contents( $cache_filename, $this->compile( file_get_contents( $source_filename ) ) );
		}

		return $this->execute( $cache_filename );
	}

	public function compile( $string )
	{
		foreach( $this->modifiers as $m )
		{
			$m->parse( $string );
		}

		return $string;
	}

	public function execute( $template )
	{
		extract( $this->data );

		ob_start();

		include $template;
		$output = ob_get_clean();

		return $output;
	}
}