<?php

namespace Hector\Form\Node;

use Aegis\CompilerInterface;
use Aegis\ParserInterface;
use Aegis\Node;
use Aegis\Token;
use Aegis\Runtime\Node\ExpressionNode;

class InputNode extends Node
{
    public static function parse(ParserInterface $parser)
    {
        if ($parser->accept(Token::T_IDENT, 'input')) {
            $parser->insert(new static());
            $parser->advance();
            $parser->traverseUp();
            if (ExpressionNode::parse($parser)) {
                $parser->setAttribute();
            }

            // @TODO named attributes for cases like this placeholder
            if ($parser->accept(Token::T_IDENT, 'placeholder')) {
                $parser->advance();

                if (ExpressionNode::parse($parser)) {
                    $parser->setAttribute();
                }
            }

            $parser->skip(Token::T_CLOSING_TAG);
            $parser->traverseDown();
            $parser->parseOutsideTag();
            return true;
        }
        return false;
    }

    public function compile(CompilerInterface $compiler)
    {
        if ($this->getAttribute(0)) {
            $compiler->write('<?php echo $form->get(');
            $this->getAttribute(0)->compile($compiler);
            $compiler->write(')->render(');

            if ($this->getAttribute(1)) {
                $compiler->write('[ \'placeholder\' => ');
                $this->getAttribute(1)->compile($compiler);
                $compiler->write(']');
            }

            $compiler->write('); ?>');
        }
    }
}
