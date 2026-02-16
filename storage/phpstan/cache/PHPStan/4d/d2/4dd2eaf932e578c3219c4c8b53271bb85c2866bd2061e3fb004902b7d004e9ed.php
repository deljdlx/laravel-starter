<?php declare(strict_types = 1);

// osfsl-/home/debian/__dev/devenv-php/src/laravel-starter/app/Http/Controllers/Dev/ModelInspectorController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\Dev\ModelInspectorController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-f5957b58509f9178ebcc74e3d8b73243c43c4e7d14ddff3fbbbdd8ac8cbd2c13-8.3.28-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'filename' => '/home/debian/__dev/devenv-php/src/laravel-starter/app/Http/Controllers/Dev/ModelInspectorController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers\\Dev',
    'name' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
    'shortName' => 'ModelInspectorController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 251,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Http\\Controllers\\Controller',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'index' => 
      array (
        'name' => 'index',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * List all Eloquent models in the application.
 *
 * @return \\Illuminate\\Http\\JsonResponse
 */',
        'startLine' => 20,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'show' => 
      array (
        'name' => 'show',
        'parameters' => 
        array (
          'modelName' => 
          array (
            'name' => 'modelName',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 47,
            'endLine' => 47,
            'startColumn' => 26,
            'endColumn' => 35,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get detailed information about a specific model.
 *
 * @param  string  $modelName  Short class name (e.g., "User")
 * @return \\Illuminate\\Http\\JsonResponse
 */',
        'startLine' => 47,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'discoverModels' => 
      array (
        'name' => 'discoverModels',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Discover all Eloquent models in the app/Models directory.
 */',
        'startLine' => 79,
        'endLine' => 103,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'findModelClass' => 
      array (
        'name' => 'findModelClass',
        'parameters' => 
        array (
          'shortName' => 
          array (
            'name' => 'shortName',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 37,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'string',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Find a model class by its short name.
 */',
        'startLine' => 108,
        'endLine' => 119,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'getModelBasicInfo' => 
      array (
        'name' => 'getModelBasicInfo',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Database\\Eloquent\\Model',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 124,
            'endLine' => 124,
            'startColumn' => 40,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get basic information about a model.
 */',
        'startLine' => 124,
        'endLine' => 134,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'getModelAttributes' => 
      array (
        'name' => 'getModelAttributes',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Database\\Eloquent\\Model',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 139,
            'endLine' => 139,
            'startColumn' => 41,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get model attributes information.
 */',
        'startLine' => 139,
        'endLine' => 147,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'getModelCasts' => 
      array (
        'name' => 'getModelCasts',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Database\\Eloquent\\Model',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 152,
            'endLine' => 152,
            'startColumn' => 36,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get model casts with their types.
 */',
        'startLine' => 152,
        'endLine' => 165,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'getModelRelationships' => 
      array (
        'name' => 'getModelRelationships',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Database\\Eloquent\\Model',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 170,
            'endLine' => 170,
            'startColumn' => 44,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get model relationships.
 */',
        'startLine' => 170,
        'endLine' => 202,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'aliasName' => NULL,
      ),
      'getTableSchema' => 
      array (
        'name' => 'getTableSchema',
        'parameters' => 
        array (
          'model' => 
          array (
            'name' => 'model',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Database\\Eloquent\\Model',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 207,
            'endLine' => 207,
            'startColumn' => 37,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get database table schema.
 */',
        'startLine' => 207,
        'endLine' => 250,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Dev',
        'declaringClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'implementingClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
        'currentClassName' => 'App\\Http\\Controllers\\Dev\\ModelInspectorController',
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