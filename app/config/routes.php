<?php

namespace app\packages\main\config;

\hector\core\Router::register( '', 'pages::home' );
\hector\core\Router::register( 'nogiets/', 'pages::nogiets' );
\hector\core\Router::register( 'over-ons/', 'pages::about_us' );