# PHPStan Opinionated Nomenclature

Opinionated PHPStan rules for naming things.

## Table of Contents

1. [Installation](#installation)
	1. [PHPStan Extension Installer](#phpstan-extension-installer)
	2. [Manual Installation](#manual-installation)
2. [Rules](#rules)
	1. [Namespace](#namespace)
	2. [Class Like (Class, Interface, Trait)](#class-like-class-interface-trait)
	3. [Class](#class)
	4. [Interface](#interface)

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

### Namespace

1. Namespace names MUST NOT be equal to or end in `DTO` of any case (case-insensitive)

   ```php
   <?php
   namespace DTO; // bad
   namespace Client\Dto; // bad
   ```

2. Namespace names MUST NOT be equal to `Helper` of any case (case-insensitive)

   ```php
   <?php
   namespace Helper; // bad
   namespace Client\helper; // bad
   ```

### Class Like (Class, Interface, Trait)

1. Class like names MUST NOT be equal to or end in `DTO` of any case (case-insensitive)

   ```php
   <?php
   class DTO {} // bad
   class ClientDTO {} // bad
   ```

2. Class like names MUST NOT be equal to `Helper` of any case (case-insensitive)

   ```php
   <?php
   class Helper {} // bad
   class helper {} // bad
   ```

3. Class like names MUST NOT be equal to or start with any case (case-insensitive) of the namespace name it resides in

   ```php
   <?php
   namespace Client;
   class ClientRequest {} // bad

   namespace Client\Request;
   class Request {} // bad
   ```

4. Class like names MUST NOT end with their type name of any case (case-insensitive)

   ```php
   <?php
   class ClientClass {} // bad
   interface FileInterface {} // bad
   trait TransactionTrait {} // bad
   ```

### Class

1. No non-final classes without children

   ```php
   <?php
   class NonFinalNoChildren {} // bad
   ```

### Interface

1. Interface names MUST NOT be prefixed with `I`

   ```php
   <?php
   interface IWriter {} // bad
   ```
