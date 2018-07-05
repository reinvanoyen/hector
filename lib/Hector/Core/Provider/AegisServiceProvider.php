<?php

namespace Hector\Core\Provider;

use Hector\Core\Container\Container;

class AegisServiceProvider extends ServiceProvider
{
    protected $isLazy = true;

    public function register(Container $app)
    {
        $app->set('tpl', function () use ($app) {
            $tpl = new \Aegis\Template(new \Aegis\Runtime\DefaultRuntime(new \Aegis\Runtime\DefaultNodeCollection()));
            $tpl->setLexer(new \Aegis\Lexer());
            $tpl->setParser(new \Aegis\Parser());
            $tpl->setCompiler(new \Aegis\Compiler());

            return $tpl;
        });
    }

    public function boot(Container $app)
    {
        \Aegis\Template::$templateDirectory = $app->get('config')->get('TPL_DIR');
    }

    public function provides(): array
    {
        return ['tpl'];
    }
}
