<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\Interface_;

use PhpParser\Node\Stmt\Interface_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PhpParser\Node;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Interface_>
 */
final class NoIPrefix implements Rule
{
    public const ERROR_MESSAGE = 'Do not prefix interface names with `I`';

    public function getNodeType(): string
    {
        return Interface_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var Interface_ $node */
        $ident = $node->name;
        if (is_null($ident)) {
            return [];
        }
        $name = $ident->toString();
        $isIPrefixed = preg_match('/^I[A-Z][^A-Z0-9].*/', $name) === 1;
        if (!$isIPrefixed) {
            return [];
        }
        return [
            RuleErrorBuilder::message(self::ERROR_MESSAGE)
                ->identifier('interface.noIPrefix')
                ->build(),
        ];
    }
}
