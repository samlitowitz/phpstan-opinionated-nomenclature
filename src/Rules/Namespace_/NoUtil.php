<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\Namespace_;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Namespace_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Namespace_>
 */
final class NoUtil implements Rule
{
    public const ERROR_MESSAGE = 'No `Util`';
    private const UTIL = 'Util';

    public function getNodeType(): string
    {
        return Namespace_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var Namespace_ $node */
        $ident = $node->name;
        if (is_null($ident)) {
            return [];
        }
        $name = $ident->toString();
        $pieces = explode('\\', $name);
        foreach ($pieces as $piece) {
            $isUtil = strtolower($piece) === strtolower(self::UTIL);
            if ($isUtil) {
                return [
                    RuleErrorBuilder::message(self::ERROR_MESSAGE)
                        ->identifier('namespace.noUtil')
                        ->build(),
                ];
            }
        }
        return [];
    }
}
