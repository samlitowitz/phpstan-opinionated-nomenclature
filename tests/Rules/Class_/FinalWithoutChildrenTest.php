<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\Class_;

use Opinionated\Nomenclature\PHPStan\Rules\Class_\ClassDeclarationCollector;
use Opinionated\Nomenclature\PHPStan\Rules\Class_\FinalWithoutChildren;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class FinalWithoutChildrenTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new FinalWithoutChildren();
    }

    protected function getCollectors(): array
    {
        return [
            new ClassDeclarationCollector(),
        ];
    }

    public function testProcessNode()
    {
        $this->analyse(
            [
                __DIR__ . '/data/finalwithoutchildren.php',
                __DIR__ . '/data/issue-1.php',
            ],
            [
                [
                    FinalWithoutChildren::ERROR_MESSAGE,
                    9,
                ],
                [
                    FinalWithoutChildren::ERROR_MESSAGE,
                    17,
                ],
            ]
        );
    }
}
