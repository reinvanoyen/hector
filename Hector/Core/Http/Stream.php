<?php

namespace Hector\Core\Http;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
	public $stream;
	private $isSeekable;
	private $isReadable;
	private $isWritable;
	private $size;
	private $uri;
	private $customMetadata;

	private static $readModes = [
		'r', 'w+', 'r+', 'x+', 'c+',
		'rb', 'w+b', 'r+b', 'x+b',
		'c+b', 'rt', 'w+t', 'r+t',
		'x+t', 'c+t', 'a+',
	];

	private static $writeModes = [
		'w', 'w+', 'rw', 'r+', 'x+',
		'c+', 'wb', 'w+b', 'r+b',
		'x+b', 'c+b', 'w+t', 'r+t',
		'x+t', 'c+t', 'a', 'a+',
	];

	public function __construct( $stream )
	{
		$this->attach( $stream );
	}

	public function attach( $stream )
	{
		if( ! is_resource( $stream ) ) {

			throw new \Exception( 'Stream must be a resource' );
		}

		$this->stream = $stream;

		$meta = stream_get_meta_data( $this->stream );
		$this->isSeekable = $meta[ 'seekable' ];

		$this->isReadable = in_array( $meta[ 'mode' ], self::$readModes );
		$this->isWritable = in_array( $meta[ 'mode' ], self::$writeModes );

		$this->uri = $this->getMetadata( 'uri' );
	}

	public function detach()
	{
		$this->stream = $this->size = $this->uri = NULL;
		$this->isReadable = $this->isWritable = $this->isSeekable = FALSE;
	}

	public function close()
	{
		fclose( $this->stream );
		$this->detach();
	}

	public function isSeekable()
	{
		return $this->isSeekable();
	}

	public function isWritable()
	{
		return $this->isWritable;
	}

	public function isReadable()
	{
		return $this->isReadable;
	}

	public function tell()
	{
		$result = ftell( $this->stream );

		if( $result === FALSE ) {

			throw new \Exception( 'Unable to determine stream position' );
		}

		return $result;
	}

	public function getSize()
	{
		if( $this->size !== NULL ) {

			return $this->size;
		}

		if( ! isset( $this->stream ) ) {

			return NULL;
		}

		if( $this->uri ) {

			clearstatcache( TRUE, $this->uri );
		}

		$stats = fstat( $this->stream );

		if( isset( $stats[ 'size' ] ) ) {

			$this->size = $stats[ 'size' ];
			return $this->size;
		}

		return NULL;
	}

	public function read( $length )
	{
		if( ! $this->isReadable ) {

			throw new \Expection( 'Cannot read from non-readable stream' );
		}

		return fread( $this->stream, $length );
	}

	public function write( $string )
	{
		if( ! $this->isWritable || ( ( $result = fwrite( $this->stream, $string ) ) === FALSE ) ) {

			throw new \Exception( 'Unable to write to stream' );
		}

		$this->size = NULL;

		return $result;
	}

	public function seek( $offset, $whence = SEEK_SET )
	{
		if( ! $this->isSeekable ) {

			throw new \Exception( 'Stream is not seekable' );

		} elseif( fseek( $this->stream, $offset, $whence ) === -1 ) {

			throw new \Exception( 'Unable to seek to stream position ' . $offset . ' with whence ' . var_export( $whence, TRUE ) );
		}
	}

	public function rewind()
	{
		$this->seek( 0 );
	}

	public function eof()
	{
		return ! $this->stream || feof( $this->stream );
	}

	public function getContents()
	{
		$this->rewind();

		if( ! $this->isReadable() || ( $contents = stream_get_contents( $this->stream ) ) === FALSE ) {

			throw new \Exception( 'Could not get contents of stream' );
		}

		return $contents;
	}

	public function getMetadata( $key = NULL )
	{
		if( ! isset( $this->stream ) ) {

			return $key ? NULL : [];
		} elseif( ! $key ) {

			return $this->customMetadata + stream_get_meta_data( $this->stream );

		} elseif( isset( $this->customMetadata[ $key ] ) ) {

			return $this->customMetadata[ $key ];
		}

		$meta = stream_get_meta_data( $this->stream );

		return isset( $meta[ $key ] ) ? $meta[ $key ] : NULL;
	}

	public function __toString()
	{
		return $this->getContents();
	}
}