<?php declare(strict_types = 1);

// odsl-/home/debian/__dev/devenv-php/src/laravel-starter/tests/Feature/PermissionControllerTest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Tests\Feature\PermissionControllerTest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.65.0.9-8.3.28-46cc61c465105a3e2fff8d5002c6da785f6005cf830e966f09993b072f9e2e07',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Tests\\Feature\\PermissionControllerTest',
        'filename' => '/home/debian/__dev/devenv-php/src/laravel-starter/tests/Feature/PermissionControllerTest.php',
      ),
    ),
    'namespace' => 'Tests\\Feature',
    'name' => 'Tests\\Feature\\PermissionControllerTest',
    'shortName' => 'PermissionControllerTest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 253,
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
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'authUser' => 
      array (
        'name' => 'authUser',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'App\\Models\\User',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an authenticated user for requests.
 */',
        'startLine' => 18,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'aliasName' => NULL,
      ),
      'test_permissions_page_loads' => 
      array (
        'name' => 'test_permissions_page_loads',
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
 * Test that the permissions index page loads successfully.
 */',
        'startLine' => 26,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'aliasName' => NULL,
      ),
      'test_api_lists_users_with_roles_and_permissions' => 
      array (
        'name' => 'test_api_lists_users_with_roles_and_permissions',
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
 * Test that the users API endpoint lists all users with roles and permissions.
 */',
        'startLine' => 38,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'aliasName' => NULL,
      ),
      'test_api_includes_users_without_roles' => 
      array (
        'name' => 'test_api_includes_users_without_roles',
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
 * Test that users without roles are included in the response.
 */',
        'startLine' => 120,
        'endLine' => 141,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'aliasName' => NULL,
      ),
      'test_api_lists_permissions_with_roles' => 
      array (
        'name' => 'test_api_lists_permissions_with_roles',
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
 * Test that the permissions API lists all permissions with roles.
 */',
        'startLine' => 146,
        'endLine' => 167,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'aliasName' => NULL,
      ),
      'test_api_lists_roles_with_permissions' => 
      array (
        'name' => 'test_api_lists_roles_with_permissions',
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
 * Test that the roles API lists all roles with permissions.
 */',
        'startLine' => 172,
        'endLine' => 193,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'aliasName' => NULL,
      ),
      'test_user_with_multiple_roles_shows_all_permissions' => 
      array (
        'name' => 'test_user_with_multiple_roles_shows_all_permissions',
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
 * Test that a user with multiple roles shows all permissions correctly.
 */',
        'startLine' => 198,
        'endLine' => 252,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Tests\\Feature',
        'declaringClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'implementingClassName' => 'Tests\\Feature\\PermissionControllerTest',
        'currentClassName' => 'Tests\\Feature\\PermissionControllerTest',
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