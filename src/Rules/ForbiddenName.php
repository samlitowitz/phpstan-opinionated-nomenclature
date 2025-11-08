<?php

namespace Opinionated\Nomenclature\PHPStan\Rules;

trait ForbiddenName
{
    private bool $caseSensitive;
    /** @var array<string, bool> */
    private array $forbiddenNames;

    /**
     * @param array<string> $forbiddenNames
     */
    private function setForbiddenNames(array $forbiddenNames): void
    {
        $this->forbiddenNames = [];
        foreach ($forbiddenNames as $name) {
            if ($this->caseSensitive) {
                $this->forbiddenNames[$name] = true;
                continue;
            }
            $this->forbiddenNames[strtolower($name)] = true;
        }
    }

    private function isForbidden(string $name): bool
    {
        $name = $this->caseSensitive ? $name : strtolower($name);
        return array_key_exists($name, $this->forbiddenNames);
    }
}
