<?php declare(strict_types = 1);

// ftm-/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v4-2.3.2',
   'data' => 
  array (
    0 => 
    array (
      '2c2f8c9ec3edbe37b162a69c29acbe56' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '46aeb02dd62d96404efc7b1fc35d149e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '231fa7d1d971c16179311d01741e951a' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'bootHasPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '3be3421a9416ebe34ccac9465c7a2af5' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getPermissionClass',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'c007a559d5f4bd7a225f1e8dfa6d7e9f' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getWildcardClass',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '159b9c91059e379e4918f8a21bdc7f5b' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'permissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '030f49c19b94049499b1c9bf9be7bed6' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'scopePermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '7dd6705ff7d9c8ed4c61198a58bed08c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'scopeWithoutPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '9b323457dbb266b7b1b5e3d9b2d7298c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'convertToPermissionModels',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'aeec5dc6096eb212471209e924b05f93' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'filterPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'bee2127db7425abae38da20a36fa6757' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasPermissionTo',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '284da5f5a699dd17fa897911444950a8' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasWildcardPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '2bec1bbd49dd74c02f8fde56ccbd6f30' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'checkPermissionTo',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '0bcfaebbfb6aeb2a55d709c39e550e74' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasAnyPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'c2509031781bb7793f369c295c1022cf' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasAllPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '6b9952af96c815660644b0ebbb931766' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasPermissionViaRole',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '1c61a4af63b50fc3a949fe3c8334572f' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasDirectPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '8031131f5d767221a0d52432c419a0ce' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getPermissionsViaRoles',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '773a0f844757929c2b40690364450850' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getAllPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '530ff68ad6b73d08b24a628a30caaec4' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'collectPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'f25cb4a54159a91ca9aef66593ea1c74' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'givePermissionTo',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '3c655019c8af0c6bb48abbbd1cc25d44' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'forgetWildcardPermissionIndex',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '86fd36f6b2ef742aa31f045967360b15' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'syncPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'ea7f1c695e0f195f975aaf56c7bd1b07' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'revokePermissionTo',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '7c2ab47f7b6945a1ecce209b9a5bc11e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getPermissionNames',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '3738465e83c1889f91e27e85bf9e9a95' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getStoredPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '7b2a2b686cea3a13ce32022e5a1f6a0a' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'ensureModelSharesGuard',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'cb309a87fecfc8e02ced18c88edf4a0f' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getGuardNames',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'b8c728280d8bee8b6ffd8157cdfacdce' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'getDefaultGuardName',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '1b6719be87b0eae8922df8186d5bf98e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'forgetCachedPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '69759585aa18cb206e991c2bb13d2b11' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasAllDirectPermissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      'a6a74c3c0e508aaf3f877175d9bed825' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'arr' => 'Illuminate\\Support\\Arr',
          'collection' => 'Illuminate\\Support\\Collection',
          'permission' => 'Spatie\\Permission\\Contracts\\Permission',
          'role' => 'Spatie\\Permission\\Contracts\\Role',
          'wildcard' => 'Spatie\\Permission\\Contracts\\Wildcard',
          'permissionattached' => 'Spatie\\Permission\\Events\\PermissionAttached',
          'permissiondetached' => 'Spatie\\Permission\\Events\\PermissionDetached',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'wildcardpermissioninvalidargument' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionInvalidArgument',
          'wildcardpermissionnotimplementscontract' => 'Spatie\\Permission\\Exceptions\\WildcardPermissionNotImplementsContract',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'wildcardpermission' => 'Spatie\\Permission\\WildcardPermission',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasAnyDirectPermission',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\HasPermissions',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\HasPermissions',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '4dabe83d1346511eb81be3a4ac59f040' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => NULL,
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '16e70e8c23fffa04c45eea85253c9226' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Traits',
         'uses' => 
        array (
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'bootRefreshesPermissionCache',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => NULL,
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
         'traitData' => 
        array (
          0 => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php',
          1 => 'Spatie\\Permission\\Models\\Role',
          2 => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          3 => NULL,
          4 => NULL,
        ),
      )),
      '6749a4f5777718b875df495f9da55919' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => '__construct',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '602f6fa07cbb0734f9b373ce2ec06519' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'create',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'c57fb5966f0f62d7bc22366f4304c43c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'permissions',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '175c4718622a6c9e18f0a181a262e84e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'users',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '204daa227441bbd9cac4c671074385c0' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'findByName',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '3e2d76a6d013f62273cf0a1a705a660e' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'findById',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '95d2595cbe97178b3f1954f0390d3d5b' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'findOrCreate',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      'ab16b09944e81dbf14b4860c6bf44bd7' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'findByParam',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
      '4874dbc75aefb0d71c9c9e4de984062c' => 
      \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
         'namespace' => 'Spatie\\Permission\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
          'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
          'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
          'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
          'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
          'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
          'guard' => 'Spatie\\Permission\\Guard',
          'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
          'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
          'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
        ),
         'className' => 'Spatie\\Permission\\Models\\Role',
         'functionName' => 'hasPermissionTo',
         'templatePhpDocNodes' => 
        array (
        ),
         'parent' => 
        \PHPStan\Analyser\IntermediaryNameScope::__set_state(array(
           'namespace' => 'Spatie\\Permission\\Models',
           'uses' => 
          array (
            'model' => 'Illuminate\\Database\\Eloquent\\Model',
            'belongstomany' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsToMany',
            'rolecontract' => 'Spatie\\Permission\\Contracts\\Role',
            'guarddoesnotmatch' => 'Spatie\\Permission\\Exceptions\\GuardDoesNotMatch',
            'permissiondoesnotexist' => 'Spatie\\Permission\\Exceptions\\PermissionDoesNotExist',
            'rolealreadyexists' => 'Spatie\\Permission\\Exceptions\\RoleAlreadyExists',
            'roledoesnotexist' => 'Spatie\\Permission\\Exceptions\\RoleDoesNotExist',
            'guard' => 'Spatie\\Permission\\Guard',
            'permissionregistrar' => 'Spatie\\Permission\\PermissionRegistrar',
            'haspermissions' => 'Spatie\\Permission\\Traits\\HasPermissions',
            'refreshespermissioncache' => 'Spatie\\Permission\\Traits\\RefreshesPermissionCache',
          ),
           'className' => 'Spatie\\Permission\\Models\\Role',
           'functionName' => NULL,
           'templatePhpDocNodes' => 
          array (
          ),
           'parent' => NULL,
           'typeAliasesMap' => 
          array (
          ),
           'bypassTypeAliases' => false,
           'constUses' => 
          array (
          ),
           'typeAliasClassName' => NULL,
           'traitData' => NULL,
        )),
         'typeAliasesMap' => 
        array (
        ),
         'bypassTypeAliases' => false,
         'constUses' => 
        array (
        ),
         'typeAliasClassName' => NULL,
         'traitData' => NULL,
      )),
    ),
    1 => 
    array (
      '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/spatie/laravel-permission/src/Models/Role.php' => 'ae7de83fac452a01ad884845aed9c328912a12b5becefd2d958aa9cd0a6355d0',
      '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/composer/../spatie/laravel-permission/src/Traits/HasPermissions.php' => '89d1dc525802930071b0d69e4541279edee0de7e82f08b06f816d87b7fe8cd55',
      '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/composer/../spatie/laravel-permission/src/Traits/RefreshesPermissionCache.php' => '370881494ee529b47bbc1faed96282b4faf9b828a35fc32ff9c766f1f4c2f69f',
    ),
  ),
));