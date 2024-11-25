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
final class NoDTOSuffix implements Rule
{
    public const ERROR_MESSAGE = 'No `DTO` suffix';
    private const DTO_SUFFIX = 'DTO';

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
        $suffixLen = strlen(self::DTO_SUFFIX);
        foreach ($pieces as $piece) {
            $endsWithSuffix = substr(strtolower($piece), -$suffixLen) === strtolower(self::DTO_SUFFIX);
            if ($endsWithSuffix) {
                return [
                    RuleErrorBuilder::message(self::ERROR_MESSAGE)
                        ->identifier('namespace.noDTOSuffix')
                        ->build(),
                ];
            }
        }
        return [];
    }
}
