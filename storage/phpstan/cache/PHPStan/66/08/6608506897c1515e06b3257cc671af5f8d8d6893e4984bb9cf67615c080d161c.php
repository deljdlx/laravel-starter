<?php declare(strict_types = 1);

// osfsl-/home/debian/__dev/devenv-php/src/laravel-starter/vendor/composer/../laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Illuminate\Cookie\Middleware\EncryptCookies
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-f8fd2f4b1bc663048cc94285b11ca953ef72317732907f8f5fedc325e9daeab6-8.3.28-6.65.0.9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'filename' => '/home/debian/__dev/devenv-php/src/laravel-starter/vendor/composer/../laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php',
      ),
    ),
    'namespace' => 'Illuminate\\Cookie\\Middleware',
    'name' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
    'shortName' => 'EncryptCookies',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 254,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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
      'encrypter' => 
      array (
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'name' => 'encrypter',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The encrypter instance.
 *
 * @var \\Illuminate\\Contracts\\Encryption\\Encrypter
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'except' => 
      array (
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'name' => 'except',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 28,
            'endLine' => 28,
            'startTokenPos' => 72,
            'startFilePos' => 690,
            'endTokenPos' => 73,
            'endFilePos' => 691,
          ),
        ),
        'docComment' => '/**
 * The names of the cookies that should not be encrypted.
 *
 * @var array<int, string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 28,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 27,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'neverEncrypt' => 
      array (
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'name' => 'neverEncrypt',
        'modifiers' => 18,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 35,
            'startTokenPos' => 86,
            'startFilePos' => 839,
            'endTokenPos' => 87,
            'endFilePos' => 840,
          ),
        ),
        'docComment' => '/**
 * The globally ignored cookies that should not be encrypted.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 35,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'serialize' => 
      array (
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'name' => 'serialize',
        'modifiers' => 18,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 42,
            'endLine' => 42,
            'startTokenPos' => 100,
            'startFilePos' => 968,
            'endTokenPos' => 100,
            'endFilePos' => 972,
          ),
        ),
        'docComment' => '/**
 * Indicates if cookies should be serialized.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'encrypter' => 
          array (
            'name' => 'encrypter',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Contracts\\Encryption\\Encrypter',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 49,
            'endLine' => 49,
            'startColumn' => 33,
            'endColumn' => 60,
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
 * Create a new CookieGuard instance.
 *
 * @param  \\Illuminate\\Contracts\\Encryption\\Encrypter  $encrypter
 */',
        'startLine' => 49,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'disableFor' => 
      array (
        'name' => 'disableFor',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 60,
            'endLine' => 60,
            'startColumn' => 32,
            'endColumn' => 36,
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
 * Disable encryption for the given cookie name(s).
 *
 * @param  string|array  $name
 * @return void
 */',
        'startLine' => 60,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 72,
            'endLine' => 72,
            'startColumn' => 28,
            'endColumn' => 35,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'next' => 
          array (
            'name' => 'next',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 72,
            'endLine' => 72,
            'startColumn' => 38,
            'endColumn' => 50,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Handle an incoming request.
 *
 * @param  \\Illuminate\\Http\\Request  $request
 * @param  \\Closure  $next
 * @return \\Symfony\\Component\\HttpFoundation\\Response
 */',
        'startLine' => 72,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'decrypt' => 
      array (
        'name' => 'decrypt',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Symfony\\Component\\HttpFoundation\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 83,
            'endLine' => 83,
            'startColumn' => 32,
            'endColumn' => 47,
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
 * Decrypt the cookies on the request.
 *
 * @param  \\Symfony\\Component\\HttpFoundation\\Request  $request
 * @return \\Symfony\\Component\\HttpFoundation\\Request
 */',
        'startLine' => 83,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'validateValue' => 
      array (
        'name' => 'validateValue',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
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
            'startLine' => 109,
            'endLine' => 109,
            'startColumn' => 38,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 109,
            'endLine' => 109,
            'startColumn' => 51,
            'endColumn' => 56,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Validate and remove the cookie value prefix from the value.
 *
 * @param  string  $key
 * @param  string  $value
 * @return string|array|null
 */',
        'startLine' => 109,
        'endLine' => 114,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'validateArray' => 
      array (
        'name' => 'validateArray',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
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
            'startLine' => 123,
            'endLine' => 123,
            'startColumn' => 38,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 123,
            'endLine' => 123,
            'startColumn' => 51,
            'endColumn' => 62,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Validate and remove the cookie value prefix from all values of an array.
 *
 * @param  string  $key
 * @param  array  $value
 * @return array
 */',
        'startLine' => 123,
        'endLine' => 132,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'decryptCookie' => 
      array (
        'name' => 'decryptCookie',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 141,
            'endLine' => 141,
            'startColumn' => 38,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'cookie' => 
          array (
            'name' => 'cookie',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 141,
            'endLine' => 141,
            'startColumn' => 45,
            'endColumn' => 51,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Decrypt the given cookie and return the value.
 *
 * @param  string  $name
 * @param  string|array  $cookie
 * @return string|array
 */',
        'startLine' => 141,
        'endLine' => 146,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'decryptArray' => 
      array (
        'name' => 'decryptArray',
        'parameters' => 
        array (
          'cookie' => 
          array (
            'name' => 'cookie',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 37,
            'endColumn' => 49,
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
 * Decrypt an array based cookie.
 *
 * @param  array  $cookie
 * @return array
 */',
        'startLine' => 154,
        'endLine' => 169,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'encrypt' => 
      array (
        'name' => 'encrypt',
        'parameters' => 
        array (
          'response' => 
          array (
            'name' => 'response',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Symfony\\Component\\HttpFoundation\\Response',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 177,
            'endLine' => 177,
            'startColumn' => 32,
            'endColumn' => 49,
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
 * Encrypt the cookies on an outgoing response.
 *
 * @param  \\Symfony\\Component\\HttpFoundation\\Response  $response
 * @return \\Symfony\\Component\\HttpFoundation\\Response
 */',
        'startLine' => 177,
        'endLine' => 194,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'duplicate' => 
      array (
        'name' => 'duplicate',
        'parameters' => 
        array (
          'cookie' => 
          array (
            'name' => 'cookie',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Symfony\\Component\\HttpFoundation\\Cookie',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 203,
            'endLine' => 203,
            'startColumn' => 34,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 203,
            'endLine' => 203,
            'startColumn' => 50,
            'endColumn' => 55,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Duplicate a cookie with a new value.
 *
 * @param  \\Symfony\\Component\\HttpFoundation\\Cookie  $cookie
 * @param  mixed  $value
 * @return \\Symfony\\Component\\HttpFoundation\\Cookie
 */',
        'startLine' => 203,
        'endLine' => 206,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'isDisabled' => 
      array (
        'name' => 'isDisabled',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 214,
            'endLine' => 214,
            'startColumn' => 32,
            'endColumn' => 36,
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
 * Determine whether encryption has been disabled for the given cookie.
 *
 * @param  string  $name
 * @return bool
 */',
        'startLine' => 214,
        'endLine' => 217,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'except' => 
      array (
        'name' => 'except',
        'parameters' => 
        array (
          'cookies' => 
          array (
            'name' => 'cookies',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 225,
            'endLine' => 225,
            'startColumn' => 35,
            'endColumn' => 42,
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
 * Indicate that the given cookies should never be encrypted.
 *
 * @param  array|string  $cookies
 * @return void
 */',
        'startLine' => 225,
        'endLine' => 230,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'serialized' => 
      array (
        'name' => 'serialized',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 238,
            'endLine' => 238,
            'startColumn' => 39,
            'endColumn' => 43,
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
 * Determine if the cookie contents should be serialized.
 *
 * @param  string  $name
 * @return bool
 */',
        'startLine' => 238,
        'endLine' => 241,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'aliasName' => NULL,
      ),
      'flushState' => 
      array (
        'name' => 'flushState',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Flush the middleware\'s global state.
 *
 * @return void
 */',
        'startLine' => 248,
        'endLine' => 253,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Cookie\\Middleware',
        'declaringClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'implementingClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
        'currentClassName' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
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