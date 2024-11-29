<?php

namespace Opinionated\Nomenclature\PHPStan\Rules\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Collectors\Collector;
use PHPStan\Node\InClassNode;

/**
 * @implements Collector<InClassNode, array{non-empty-string, non-empty-string|null, -1|positive-int}>
 */
final class ClassDeclarationCollector implements Collector
{
    public function getNodeType(): string
    {
        return InClassNode::class;
    }

    public function processNode(Node $node, Scope $scope)
    {
        /** @var InClassNode $node */
        $originalNode = $node->getOriginalNode();
        if (get_class($originalNode) !== Class_::class) {
            return null;
        }

        if ($node->getClassReflection()->isFinal()) {
            return null;
        }

        $fqn = '';
        $namespace = $scope->getNamespace();
        if (!is_null($namespace)) {
            $fqn = $namespace . '\\';
        }

        $ident = $node->getOriginalNode()->name;
        if (is_null($ident)) {
            return null;
        }
        $name = $ident->toString();
        $fqn .= $name;

        $parentName = null;
        if (!is_null($originalNode->extends)) {
            $parentName = $originalNode->extends->toString();
        }

        return [
            $fqn,
            $parentName,
            $node->getLine(),
        ];
    }
}
