<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\Interface_;

use Opinionated\Nomenclature\PHPStan\Rules\Interface_\NoIPrefix;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class NoIPrefixTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoIPrefix();
    }

    public function testProcessNode()
    {
        $this->analyse([__DIR__ . '/data/noiprefix.php'], [
            [
                NoIPrefix::ERROR_MESSAGE,
                15,
            ],
        ]);
    }
}
