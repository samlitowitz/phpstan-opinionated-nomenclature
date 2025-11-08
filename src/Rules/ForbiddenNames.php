<?php

namespace Opinionated\Nomenclature\PHPStan\Rules;

trait ForbiddenNames
{
    private bool $caseSensitive;
    /** @var array<string> */
    private array $actualForbiddenNames = [];
    /** @var array<string, bool> */
    private array $forbiddenNames;

    /**
     * @param array<string> $forbiddenNames
     */
    private function setForbiddenNames(array $forbiddenNames): void
    {
        $this->actualForbiddenNames = $forbiddenNames;
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

    /**
     * @return array<string>
     */
    public function getForbiddenNames(): array
    {
        return array_keys($this->actualForbiddenNames);
    }
}
