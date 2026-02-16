<?php declare(strict_types = 1);

// osfsl-/home/debian/__dev/devenv-php/src/laravel-starter/app/Models/Task.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Task
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-2f8a9b577ea8c0270ca145179457e9c29e45aa9b3b98b92c5a421c889c8ef833-8.3.28-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\Task',
        'filename' => '/home/debian/__dev/devenv-php/src/laravel-starter/app/Models/Task.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\Task',
    'shortName' => 'Task',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @property ?string $id
 * @property string $title
 * @property ?string $description
 * @property string $user_id
 * @property \\Illuminate\\Support\\Carbon|null $created_at
 * @property \\Illuminate\\Support\\Carbon|null $updated_at
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 32,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      1 => 'Spatie\\ModelStatus\\HasStatuses',
      2 => 'Illuminate\\Database\\Eloquent\\Concerns\\HasUlids',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'user' => 
      array (
        'name' => 'user',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return BelongsTo<User>
 */',
        'startLine' => 28,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Task',
        'implementingClassName' => 'App\\Models\\Task',
        'currentClassName' => 'App\\Models\\Task',
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