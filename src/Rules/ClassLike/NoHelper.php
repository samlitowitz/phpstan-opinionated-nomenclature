<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\ClassLike;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Namespace_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<ClassLike>
 */
final class NoHelper implements Rule
{
    public const ERROR_MESSAGE = 'No `Helper`';
    private const HELPER = 'Helper';

    public function getNodeType(): string
    {
        return ClassLike::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var ClassLike $node */
        $ident = $node->name;
        if (is_null($ident)) {
            return [];
        }
        $name = $ident->toString();
        $isHelper = strtolower($name) === strtolower(self::HELPER);
        if (!$isHelper) {
            return [];
        }
        return [
            RuleErrorBuilder::message(self::ERROR_MESSAGE)
                ->identifier('classLike.noHelper')
                ->build(),
        ];
    }
}
