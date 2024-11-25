<?php

namespace Opinionated\Nomenclature\PHPStan\Tests\Rules\ClassLike;

use Opinionated\Nomenclature\PHPStan\Rules\ClassLike\NoStutter;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class NoStutterTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoStutter();
    }

    public function testProcessNode()
    {
        $this->analyse([__DIR__ . '/data/nostutter.php'], [
            [
                NoStutter::ERROR_MESSAGE,
                5,
            ],
            [
                NoStutter::ERROR_MESSAGE,
                9,
            ],
            [
                NoStutter::ERROR_MESSAGE,
                13,
            ],
        ]);
    }
}
