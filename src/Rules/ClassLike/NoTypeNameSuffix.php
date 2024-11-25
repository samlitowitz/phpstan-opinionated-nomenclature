<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\ClassLike;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassLike;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<ClassLike>
 */
final class NoTypeNameSuffix implements Rule
{
    public const ERROR_MESSAGE = '';

    public function getNodeType(): string
    {
        return ClassLike::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var ClassLike $node */
        switch (true) {
            case $node instanceof Node\Stmt\Class_:
                $suffix = 'Class';
                break;
            case $node instanceof Node\Stmt\Interface_:
                $suffix = 'Interface';
                break;
            case $node instanceof Node\Stmt\Trait_:
                $suffix = 'Trait';
                break;
            default:
                return [];
        }

        $ident = $node->name;
        if (is_null($ident)) {
            return [];
        }
        $name = $ident->toString();
        $suffixLen = strlen($suffix);
        $endsWithSuffix = substr($name, -$suffixLen) === $suffix;
        if (!$endsWithSuffix) {
            return [];
        }
        return [
            RuleErrorBuilder::message(self::ERROR_MESSAGE)
                ->identifier('classLike.noTypeNameSuffix')
                ->build(),
        ];
    }
}
