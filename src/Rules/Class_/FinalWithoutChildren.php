<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\Class_;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\CollectedDataNode;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<CollectedDataNode>
 */
final class FinalWithoutChildren implements Rule
{
    public const ERROR_MESSAGE = 'No non-final classes without children';

    public function getNodeType(): string
    {
        return CollectedDataNode::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $data = $node->get(ClassDeclarationCollector::class);

        $locDataByFQN = [];
        $nonFinalClasses = [];
        $parentClasses = [];

        /**
         * @var string $fqn
         * @var string $parentName
         * @var string $fileName
         * @var int $line
         */
        foreach (
            $data as $fileName => $fileData
        ) {
            foreach ($fileData as [$fqn, $parentName, $line]) {
                $locDataByFQN[$fqn] = [$fileName, $line];
                if (!array_key_exists($fqn, $nonFinalClasses)) {
                    $nonFinalClasses[$fqn] = true;
                }
                $parentName = strtolower($parentName);
                if (!array_key_exists($parentName, $parentClasses)) {
                    $parentClasses[$parentName] = true;
                }
            }
        }

        $errors = [];
        foreach ($nonFinalClasses as $fqn => $unused) {
            if (array_key_exists(strtolower($fqn), $parentClasses)) {
                continue;
            }
            [
                $fileName,
                $line,
            ] = $locDataByFQN[$fqn];
            $errors[] = RuleErrorBuilder::message(self::ERROR_MESSAGE)
                ->identifier('class.finalWithoutChildren')
                ->file($fileName)
                ->line($line)
                ->build();
        }

        return $errors;
    }
}
