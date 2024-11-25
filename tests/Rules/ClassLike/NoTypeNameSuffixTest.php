<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\ClassLike;

use Opinionated\Nomenclature\PHPStan\Rules\ClassLike\NoTypeNameSuffix;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class NoTypeNameSuffixTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoTypeNameSuffix();
    }

    public function testProcessNode()
    {
        $this->analyse([__DIR__ . '/data/notypenamesuffix.php'], [
            [
                NoTypeNameSuffix::ERROR_MESSAGE,
                7,
            ],
            [
                NoTypeNameSuffix::ERROR_MESSAGE,
                15,
            ],
            [
                NoTypeNameSuffix::ERROR_MESSAGE,
                23,
            ],
        ]);
    }
}
