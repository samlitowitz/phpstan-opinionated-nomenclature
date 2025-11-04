<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\Namespace_;

use Opinionated\Nomenclature\PHPStan\Rules\Namespace_\NoDTOSuffix;
use Opinionated\Nomenclature\PHPStan\Rules\Namespace_\NoUtil;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class NoUtilTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoUtil();
    }

    public function testProcessNode()
    {
        $this->analyse([__DIR__ . '/data/noutil.php'], [
            [
                NoUtil::ERROR_MESSAGE,
                3,
            ],
        ]);
    }
}
