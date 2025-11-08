<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\ClassLike;

use Opinionated\Nomenclature\PHPStan\Rules\ClassLike\ForbiddenNames;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class ForbiddenNamesTest extends RuleTestCase
{
    private bool $caseSensitive;
    private array $forbiddenNames;

    protected function getRule(): Rule
    {
        return new ForbiddenNames(
            $this->caseSensitive,
            $this->forbiddenNames
        );
    }

    public static function processNodeProvider(): array
    {
        $testCases = [];
        foreach (ForbiddenNames::DEFAULT_FORBIDDEN_NAMES as $name) {
            $filename = strtolower($name) . '.php';

            $expectedErrors = [
                [
                    ForbiddenNames::errorMessage($name),
                    3,
                ],
            ];


            // case-sensitive, always match when the case is the same
            $forbid = $name;
            $desc = sprintf(
                'Forbid `%s`: case-sensitive',
                $forbid
            );
            $testCases[$desc] = [
                $filename,
                true,
                [$forbid],
                $expectedErrors
            ];

            // case-sensitive, never match when the case is the different
            $forbid = strtolower($name);
            $desc = sprintf(
                'Forbid `%s`: case-sensitive',
                $forbid
            );
            $testCases[$desc] = [
                $filename,
                true,
                [$forbid],
                []
            ];

            // case-insensitive, always match when the case is the same
            $forbid = $name;
            $desc = sprintf(
                'Forbid `%s`: case-insensitive',
                $forbid
            );
            $testCases[$desc] = [
                $filename,
                false,
                [$forbid],
                $expectedErrors
            ];

            // case-insensitive, always match when the case is the different
            $forbid = strtolower($name);
            $desc = sprintf(
                'Forbid `%s`: case-insensitive',
                $forbid
            );
            $testCases[$desc] = [
                $filename,
                false,
                [$forbid],
                $expectedErrors
            ];
        }

        return $testCases;
    }

    /**
     * @dataProvider processNodeProvider
     */
    public function testProcessNode(
        string $filename,
        bool $caseSensitive,
        array $forbiddenNames,
        array $expectedErrors
    ): void {
        $this->caseSensitive = $caseSensitive;
        $this->forbiddenNames = $forbiddenNames;
        $this->analyse([__DIR__ . '/data/forbiddenNames/' . $filename], $expectedErrors);
    }
}
