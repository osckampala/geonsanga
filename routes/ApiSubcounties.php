<?php
use Steampixel\Route;
use Uganda\Exceptions\SubCountyNotFoundException;

/**
 * Subcounty Particular operations
 */
// Get all subcounties details, without a space e.g. Abim
Route::add('/v1/subcounty/([a-z-0-9-]*)', function ($param) use($uganda) {

  $subcounty = insertSpaceBeforeUppercase($param);

  try {
    $subcounty_ = $uganda->subcounty($subcounty);
    successResponse([
      'count' => 1,
      'subcounty' => $subcounty_
    ]);
  } catch (SubCountyNotFoundException $e) {
    errorResponse(
      sprintf('Subcounty not found: %s', $subcounty),
      404,
      'SUBCOUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch subcounty',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all parishes in a subcounty, without a space e.g. Abim
Route::add('/v1/subcounty/([a-z-0-9-]*)/parishes', function ($param) use($uganda) {

  $subcounty = insertSpaceBeforeUppercase($param);

  try {
    $parishes = $uganda
                  ->subcounty($subcounty)
                  ->parishes();
    $count = count($parishes);

    $names = [];
    foreach($parishes as $parish):
      $names[] = [
        "id" => $parish->id,
        "name" => $parish->name
      ];
    endforeach;

    successResponse([
      'count' => $count,
      'parishes' => $names
    ]);
  } catch (SubCountyNotFoundException $e) {
    errorResponse(
      sprintf('Subcounty not found: %s', $subcounty),
      404,
      'SUBCOUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch subcounty parishes',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all villages in a subcounty, without a space e.g. Abim
Route::add('/v1/subcounty/([a-z-0-9-]*)/villages', function ($param) use($uganda) {

  $subcounty = insertSpaceBeforeUppercase($param);

  try {
    $villages = $uganda
                  ->subcounty($subcounty)
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
  } catch (SubCountyNotFoundException $e) {
    errorResponse(
      sprintf('Subcounty not found: %s', $subcounty),
      404,
      'SUBCOUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch subcounty villages',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');


