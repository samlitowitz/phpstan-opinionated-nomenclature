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
final class NoHelper implements Rule
{
    public const ERROR_MESSAGE = 'No `Helper`';
    private const HELPER = 'Helper';

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
            $isHelper = strtolower($piece) === strtolower(self::HELPER);
            if ($isHelper) {
                return [
                    RuleErrorBuilder::message(self::ERROR_MESSAGE)
                        ->identifier('namespace.noHelper')
                        ->build(),
                ];
            }
        }
        return [];
    }
}
