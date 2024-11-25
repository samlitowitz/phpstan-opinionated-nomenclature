<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\Namespace_;

use Opinionated\Nomenclature\PHPStan\Rules\Namespace_\NoDTOSuffix;
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
                3,
            ],
        ]);
    }
}
