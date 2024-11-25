# PHPStan Opinionated Nomenclature

Opinionated PHPStan rules for naming things.

## Table of Contents

1. [Installation](#installation)
	1. [PHPStan Extension Installer](#phpstan-extension-installer)
	2. [Manual Installation](#manual-installation)
2. [Rules](#rules)

## Installation

Install the extension via [Composer](https://getcomposer.org/).

```shell
composer require --dev samlitowitz/phpstan-opinionated-nomenclature
```

This extension requires [PHPStan](https://github.com/phpstan/phpstan) to use.

### PHPStan Extension Installer

Use the [PHPStan Extension Installer](https://github.com/phpstan/extension-installer) to automatically install PHPStan
extensions.

### Manual Installation

Add `vendor/samlitowitz/phpstan-opinionated-nomenclature/extension.neon` to the `includes` section of
your `phpstan.neon` or `phpstan.neon.dist` file, i.e.

```neon
includes:
    - vendor/samlitowitz/phpstan-opinionated-nomenclature/extension.neon
```

## Rules
