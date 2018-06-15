<?php

namespace Hector\Core\Http;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private $scheme = '';
    private $userInfo = '';
    private $host = '';
    private $port;
    private $path = '';
    private $query = '';
    private $fragment = '';

    private static $standardPorts = [
        'http'  => 80,
        'https' => 443,
    ];

    private static $charUnreserved = 'a-zA-Z0-9_\-\.~';
    private static $charSubDelims = '!\$&\'\(\)\*\+,;=';

    public function __construct($uri = '')
    {
        if ($uri != '') {
            $parts = parse_url($uri);

            if ($parts === false) {
                throw new \InvalidArgumentException('Unable to parse URI: $uri');
            }

            $this->applyParts($parts);
        }
    }

    public function __toString()
    {
        return self::createUriString(
            $this->scheme,
            $this->getAuthority(),
            $this->path,
            $this->query,
            $this->fragment
        );
    }

    public function getScheme()
    {
        return $this->scheme;
    }

    public function getUserInfo()
    {
        return $this->userInfo;
    }
    public function getHost()
    {
        return $this->host;
    }
    public function getPort()
    {
        return $this->port;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getQuery()
    {
        return $this->query;
    }
    public function getFragment()
    {
        return $this->fragment;
    }

    public function getAuthority()
    {
        if ($this->host == '') {
            return '';
        }

        $authority = $this->host;

        if ($this->userInfo != '') {
            $authority = $this->userInfo . '@' . $authority;
        }

        if ($this->port !== null) {
            $authority .= ':' . $this->port;
        }

        return $authority;
    }

    private static function createUriString($scheme, $authority, $path, $query, $fragment)
    {
        $uri = '';

        if ($scheme != '') {
            $uri .= $scheme . ':';
        }

        if ($authority != '') {
            $uri .= '//' . $authority;
        }

        if ($path != '') {
            if ($path[0] !== '/') {
                if ($authority != '') {

                    // If the path is rootless and an authority is present, the path MUST be prefixed by "/"
                    $path = '/' . $path;
                }
            } elseif (isset($path[ 1 ]) && $path[ 1 ] === '/') {
                if ($authority == '') {

                    // If the path is starting with more than one "/" and no authority is present, the
                    // starting slashes MUST be reduced to one.
                    $path = '/' . ltrim($path, '/');
                }
            }

            $uri .= $path;
        }

        if ($query != '') {
            $uri .= '?' . $query;
        }

        if ($fragment != '') {
            $uri .= '#' . $fragment;
        }

        return $uri;
    }

    public function withScheme($scheme)
    {
        $scheme = $this->filterScheme($scheme);

        if ($this->scheme === $scheme) {
            return $this;
        }

        $new = clone $this;
        $new->scheme = $scheme;
        $new->port = $new->filterPort($new->port);
        return $new;
    }

    public function withUserInfo($user, $password = null)
    {
        $info = $user;

        if ($password != '') {
            $info .= ':' . $password;
        }

        if ($this->userInfo === $info) {
            return $this;
        }

        $new = clone $this;
        $new->userInfo = $info;
        return $new;
    }

    public function withHost($host)
    {
        $host = $this->filterHost($host);

        if ($this->host === $host) {
            return $this;
        }

        $new = clone $this;
        $new->host = $host;
        return $new;
    }

    public function withPort($port)
    {
        $port = $this->filterPort($port);

        if ($this->port === $port) {
            return $this;
        }

        $new = clone $this;
        $new->port = $port;
        return $new;
    }

    public function withPath($path)
    {
        $path = $this->filterPath($path);

        if ($this->path === $path) {
            return $this;
        }

        $new = clone $this;
        $new->path = $path;
        return $new;
    }

    public function withQuery($query)
    {
        $query = $this->filterQueryAndFragment($query);

        if ($this->query === $query) {
            return $this;
        }

        $new = clone $this;
        $new->query = $query;
        return $new;
    }

    public function withFragment($fragment)
    {
        $fragment = $this->filterQueryAndFragment($fragment);

        if ($this->fragment === $fragment) {
            return $this;
        }

        $new = clone $this;
        $new->fragment = $fragment;
        return $new;
    }

    private function applyParts(array $parts)
    {
        $this->scheme = isset($parts[ 'scheme' ]) ? $this->filterScheme($parts[ 'scheme' ]) : '';
        $this->userInfo = isset($parts[ 'user' ]) ? $parts[ 'user' ] : '';
        $this->host = isset($parts[ 'host' ]) ? $this->filterHost($parts[ 'host' ]) : '';
        $this->port = isset($parts[ 'port' ]) ? $this->filterPort($parts[ 'port' ]) : null;
        $this->path = isset($parts[ 'path' ]) ? $this->filterPath($parts[ 'path' ]) : '';
        $this->query = isset($parts[ 'query' ]) ? $this->filterQueryAndFragment($parts[ 'query' ]) : '';
        $this->fragment = isset($parts[ 'fragment' ]) ? $this->filterQueryAndFragment($parts[ 'fragment' ]) : '';

        if (isset($parts[ 'pass' ])) {
            $this->userInfo .= ':' . $parts[ 'pass' ];
        }
    }

    private function filterScheme($scheme)
    {
        if (!is_string($scheme)) {
            throw new \InvalidArgumentException('Scheme must be a string');
        }

        return strtolower($scheme);
    }

    private function filterHost($host)
    {
        if (! is_string($host)) {
            throw new \InvalidArgumentException('Host must be a string');
        }

        return strtolower($host);
    }

    private function filterPort($port)
    {
        if ($port === null) {
            return null;
        }

        $port = (int) $port;

        if (1 > $port || 0xffff < $port) {
            throw new \InvalidArgumentException(sprintf('Invalid port: %d. Must be between 1 and 65535', $port));
        }

        return self::isNonStandardPort($this->scheme, $port) ? $port : null;
    }

    private function filterPath($path)
    {
        if (! is_string($path)) {
            throw new \InvalidArgumentException('Path must be a string');
        }

        return preg_replace_callback(
            '/(?:[^' . self::$charUnreserved . self::$charSubDelims . '%:@\/]++|%(?![A-Fa-f0-9]{2}))/',
            [ $this, 'rawurlencodeMatchZero' ],
            $path
        );
    }

    private function filterQueryAndFragment($str)
    {
        if (!is_string($str)) {
            throw new \InvalidArgumentException('Query and fragment must be a string');
        }

        return preg_replace_callback(
            '/(?:[^' . self::$charUnreserved . self::$charSubDelims . '%:@\/\?]++|%(?![A-Fa-f0-9]{2}))/',
            [ $this, 'rawurlencodeMatchZero' ],
            $str
        );
    }

    private function rawurlencodeMatchZero(array $matches)
    {
        return rawurlencode($matches[ 0 ]);
    }

    private static function isNonStandardPort($scheme, $port)
    {
        return ! isset(self::$standardPorts[ $scheme ]) || $port !== self::$standardPorts[ $scheme ];
    }
}
