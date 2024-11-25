<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\ClassLike;

use Opinionated\Nomenclature\PHPStan\Rules\ClassLike\NoHelper;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class NoHelperTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoHelper();
    }

    public function testProcessNode()
    {
        $this->analyse([__DIR__ . '/data/nohelper.php'], [
            [
                NoHelper::ERROR_MESSAGE,
                3,
            ],
        ]);
    }
}