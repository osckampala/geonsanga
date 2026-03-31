<?php

/**
 * root
 */
$root = $_SERVER["DOCUMENT_ROOT"]. "/";
/**
 * Composer
 */
require_once $root  . '/vendor/autoload.php';

use Ahc\Env\Loader;
(new Loader)->load($root .'.env'); 
use Ahc\Env\Retriever;

/**
 * Error and Exception handling
 */
if(Retriever::getEnv("APP_DEBUG")):
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
endif;

// DB connection would reside there, but I don't think we'll use any

// Other functions
/**
 * Takes in a string and inserts a space before any capital letter
 */
function insertSpaceBeforeUppercase($string) {
  // Regex pattern with negative lookbehinds:
  // - (?<! ): Negative lookbehind to avoid spaces before the current character
  // - (?<!^): Negative lookbehind to avoid the first character
  // - (?<![A-Z]): Negative lookbehind to avoid sequences of uppercase letters
  // - [A-Z]: Matches any uppercase letter
  $pattern = '/(?<! )(?!^)(?<![A-Z])[A-Z]/';
  return preg_replace($pattern, ' $0', $string);
}

/**
 * Send JSON response with a consistent API contract.
 *
 * @param array<string, mixed> $payload
 */
function jsonResponse(array $payload, int $statusCode = 200): void
{
  http_response_code($statusCode);
  header('Content-Type: application/json');
  echo json_encode($payload, JSON_PRETTY_PRINT);
}

/**
 * @param array<string, mixed> $data
 */
function successResponse(array $data, int $statusCode = 200): void
{
  jsonResponse([
    'success' => true,
    'data' => $data
  ], $statusCode);
}

/**
 * @param array<string, mixed>|null $details
 */
function errorResponse(string $message, int $statusCode, string $errorCode = 'ERROR', ?array $details = null): void
{
  $error = [
    'code' => $errorCode,
    'message' => $message
  ];

  if ($details !== null) {
    $error['details'] = $details;
  }

  jsonResponse([
    'success' => false,
    'error' => $error
  ], $statusCode);
}
?>