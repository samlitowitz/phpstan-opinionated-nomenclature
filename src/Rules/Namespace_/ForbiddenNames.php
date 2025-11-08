<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\Namespace_;

use Opinionated\Nomenclature\PHPStan\Rules\ForbiddenNames as ForbiddenNamesTrait;
use PhpParser\Node;
use PhpParser\Node\Stmt\Namespace_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Namespace_>
 */
final class ForbiddenNames implements Rule
{
    use ForbiddenNamesTrait;

    public const DEFAULT_FORBIDDEN_NAMES = [
        'Helper',
        'Util',
    ];
    private const ERROR_MESSAGE = 'Forbidden name `%s`';
    private const RULE_IDENTIFIER = 'namespace.forbiddenName.%s';

    /**
     * @param array<string> $forbiddenNames
     */
    public function __construct(
        bool $caseSensitive = false,
        array $forbiddenNames = self::DEFAULT_FORBIDDEN_NAMES
    ) {
        $this->caseSensitive = $caseSensitive;
        $this->setForbiddenNames($forbiddenNames);
    }

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
            if (!$this->isForbidden($piece)) {
                continue;
            }
            return [
                RuleErrorBuilder::message(self::errorMessage($piece))
                    ->identifier(self::ruleIdentifier($piece))
                    ->build(),
            ];
        }
        return [];
    }

    public static function errorMessage(string $name): string
    {
        return sprintf(self::ERROR_MESSAGE, $name);
    }

    public static function ruleIdentifier(string $name): string
    {
        return sprintf(self::RULE_IDENTIFIER, $name);
    }
}
