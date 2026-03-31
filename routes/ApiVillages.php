<?php
use Steampixel\Route;
use Uganda\Exceptions\VillageNotFoundException;

/**
 * Village Particular operations
 */
// Get all village details, without a space e.g. 
Route::add('/v1/village/([a-z-0-9-]*)', function ($param) use($uganda) {

  $village = insertSpaceBeforeUppercase($param);

  try {
    $village_ = $uganda->village($village);
    successResponse([
      'count' => 1,
      'village' => $village_
    ]);
  } catch (VillageNotFoundException $e) {
    errorResponse(
      sprintf('Village not found: %s', $village),
      404,
      'VILLAGE_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch village',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');


