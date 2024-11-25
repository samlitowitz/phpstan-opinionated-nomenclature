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
final class NoDTOSuffix implements Rule
{
    public const ERROR_MESSAGE = '';
    private const DTO_SUFFIX = 'DTO';

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
        $suffixLen = strlen(self::DTO_SUFFIX);
        $endsWithSuffix = substr(strtolower($name), -$suffixLen) === strtolower(self::DTO_SUFFIX);
        if (!$endsWithSuffix) {
            return [];
        }
        return [
            RuleErrorBuilder::message(self::ERROR_MESSAGE)
                ->identifier('classLike.noDTOSuffix')
                ->build(),
        ];
    }
}
