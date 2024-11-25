<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\ClassLike;

use Opinionated\Nomenclature\PHPStan\Rules\ClassLike\NoDTOSuffix;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class NoDTOSuffixTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoDTOSuffix();
    }

    public function testProcessNode()
    {
        $this->analyse([__DIR__ . '/data/nodtosuffix.php'], [
            [
                NoDTOSuffix::ERROR_MESSAGE,
                7,
            ],
            [
                NoDTOSuffix::ERROR_MESSAGE,
                11,
            ],
            [
                NoDTOSuffix::ERROR_MESSAGE,
                19,
            ],
            [
                NoDTOSuffix::ERROR_MESSAGE,
                23,
            ],
            [
                NoDTOSuffix::ERROR_MESSAGE,
                31,
            ],
            [
                NoDTOSuffix::ERROR_MESSAGE,
                35,
            ],
        ]);
    }
}
