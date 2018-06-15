<?php

namespace Hector\Form\Node;

use Aegis\Compiler;
use Aegis\CompilerInterface;
use Aegis\ParserInterface;
use Aegis\Node;
use Aegis\Token;
use Aegis\Runtime\Node\ExpressionNode;
use Aegis\Runtime\Node\ConstantNode;

class FormNode extends Node
{
    public static function parse(ParserInterface $parser)
    {
        if ($parser->accept(Token::T_IDENT, 'form')) {
            $parser->insert(new static());
            $parser->advance();
            $parser->traverseUp();
            ExpressionNode::parse($parser);
            $parser->setAttribute();

            if ($parser->accept(Token::T_IDENT, 'autocomplete')) {
                $parser->advance();

                if (ConstantNode::parse($parser)) {
                    $parser->setAttribute();
                }
            }

            $parser->skip(Token::T_CLOSING_TAG);
            $parser->parseOutsideTag();
            $parser->skip(Token::T_OPENING_TAG);
            $parser->skip(Token::T_IDENT, '/form');
            $parser->skip(Token::T_CLOSING_TAG);
            $parser->traverseDown();
            $parser->parseOutsideTag();
            return true;
        }
        return false;
    }

    public function compile(CompilerInterface $compiler)
    {
        $compiler->write('<form method="post"');

        if ($this->getAttribute(1)) {
            $compiler->write(' autocomplete="');
            if ($this->getAttribute(1)->getValue() === 'false') {
                $compiler->write('off');
            } else {
                $compiler->write('on');
            }
            $compiler->write('"');
        }

        $compiler->write(' >');

        $formAttr = $this->getAttribute(0);
        $subcompiler = new Compiler($formAttr);
        $form = $subcompiler->compile();
        $compiler->write('<?php $form = ');
        $compiler->write($form);
        $compiler->write('; ?>');

        $compiler->write('<?php echo $form->get(');
        $compiler->write('\'__csrf\'');
        $compiler->write(')->render(); ?>');

        foreach ($this->getChildren() as $c) {
            $c->compile($compiler);
        }

        $compiler->write('<?php unset($form); ?>');
        $compiler->write('</form>');
    }
}
