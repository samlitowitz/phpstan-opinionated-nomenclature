<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\ClassLike;

use PhpParser\Node;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Namespace_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<ClassLike>
 */
final class NoStutter implements Rule
{
    public const ERROR_MESSAGE = 'No stutter';

    public function getNodeType(): string
    {
        return ClassLike::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $namespace = $scope->getNamespace();
        if (is_null($namespace)) {
            return [];
        }

        /** @var ClassLike $node */
        $ident = $node->name;
        if (is_null($ident)) {
            return [];
        }
        $name = $ident->toString();

        $namespace = explode('\\', $namespace);
        $last = end($namespace);
        // @phpstan-ignore-next-line
        if ($last === false) {
            return [];
        }
        $isStutter = substr($name, 0, strlen($last)) === $last;
        if (!$isStutter) {
            return [];
        }

        return [
            RuleErrorBuilder::message(self::ERROR_MESSAGE)
                ->identifier('classLike.noStutter')
                ->build(),
        ];
    }
}
