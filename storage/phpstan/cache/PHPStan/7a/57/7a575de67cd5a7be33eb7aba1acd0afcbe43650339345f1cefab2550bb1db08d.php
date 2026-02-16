<?php declare(strict_types = 1);

// osfsl-/home/debian/__dev/devenv-php/src/laravel-starter/tests/Feature/UlidTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Feature\UlidTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-9cb4ffbbfed5953bd579f15612192674478677c35378fd147d30d3e1f0d18489-8.3.28-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Feature\\UlidTest',
        'filename' => '/home/debian/__dev/devenv-php/src/laravel-starter/tests/Feature/UlidTest.php',
      ),
    ),
    'namespace' => 'Tests\\Feature',
    'name' => 'Tests\\Feature\\UlidTest',
    'shortName' => 'UlidTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 88,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Tests\\TestCase',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Foundation\\Testing\\RefreshDatabase',
    ),
    'immediateConstants' => 
    array (
      'ULID_PATTERN' => 
      array (
        'declaringClassName' => 'Tests\\Feature\\UlidTest',
        'implementingClassName' => 'Tests\\Feature\\UlidTest',
        'name' => 'ULID_PATTERN',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'/^[0-9a-hjkmnp-tv-z]{26}$/\'',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 52,
            'startFilePos' => 342,
            'endTokenPos' => 52,
            'endFilePos' => 369,
          ),
        ),
        'docComment' => '/**
 * ULID regex pattern (26 lowercase alphanumeric characters, Crockford\'s Base32).
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 62,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'test_user_model_uses_ulid' => 
      array (
        'name' => 'test_user_model_uses_ulid',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Test that User model uses ULID.
 */',
        'startLine' => 22,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\UlidTest',
        'implementingClassName' => 'Tests\\Feature\\UlidTest',
        'currentClassName' => 'Tests\\Feature\\UlidTest',
        'aliasName' => NULL,
      ),
      'test_task_model_uses_ulid' => 
      array (
        'name' => 'test_task_model_uses_ulid',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Test that Task model uses ULID.
 */',
        'startLine' => 35,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\UlidTest',
        'implementingClassName' => 'Tests\\Feature\\UlidTest',
        'currentClassName' => 'Tests\\Feature\\UlidTest',
        'aliasName' => NULL,
      ),
      'test_task_user_relationship_uses_ulid' => 
      array (
        'name' => 'test_task_user_relationship_uses_ulid',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Test that Task\'s user_id foreign key uses ULID.
 */',
        'startLine' => 48,
        'endLine' => 61,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\UlidTest',
        'implementingClassName' => 'Tests\\Feature\\UlidTest',
        'currentClassName' => 'Tests\\Feature\\UlidTest',
        'aliasName' => NULL,
      ),
      'test_ulids_are_sortable' => 
      array (
        'name' => 'test_ulids_are_sortable',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Test that ULIDs are lexicographically sortable.
 */',
        'startLine' => 66,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\UlidTest',
        'implementingClassName' => 'Tests\\Feature\\UlidTest',
        'currentClassName' => 'Tests\\Feature\\UlidTest',
        'aliasName' => NULL,
      ),
      'test_ulids_are_unique' => 
      array (
        'name' => 'test_ulids_are_unique',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Test that ULIDs are unique.
 */',
        'startLine' => 79,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\UlidTest',
        'implementingClassName' => 'Tests\\Feature\\UlidTest',
        'currentClassName' => 'Tests\\Feature\\UlidTest',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));