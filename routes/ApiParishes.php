<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Steampixel\Route;
use Uganda\Exceptions\ParishNotFoundException;

/**
 * Parish Particular operations
 */
// Get all parish details, without a space e.g. 
Route::add('/v1/parish/([a-z-0-9-]*)', function ($param) use($uganda) {

  $parish = insertSpaceBeforeUppercase($param);

  try {
    $parish_ = $uganda->parish($parish);
    successResponse([
      'count' => 1,
      'parish' => $parish_
    ]);
  } catch (ParishNotFoundException $e) {
    errorResponse(
      sprintf('Parish not found: %s', $parish),
      404,
      'PARISH_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch parish',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all villages in a parish, without a space e.g. 
Route::add('/v1/parish/([a-z-0-9-]*)/villages', function ($param) use($uganda) {

  $parish = insertSpaceBeforeUppercase($param);

  try {
    $villages = $uganda
                ->parish($parish)
                ->villages();

    $count = count($villages);

    $names = [];
    foreach($villages as $village):
      $names[] = [
        "id" => $village->id,
        "name" => $village->name
      ];
    endforeach;
    successResponse([
      'count' => $count,
      'villages' => $names
    ]);
  } catch (ParishNotFoundException $e) {
    errorResponse(
      sprintf('Parish not found: %s', $parish),
      404,
      'PARISH_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch parish villages',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');


