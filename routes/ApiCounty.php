<?php
use Steampixel\Route;
use Uganda\Exceptions\CountyNotFoundException;

/**
 * County Particular operations
 */
// Get all County details, without a space e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)', function ($param) use($uganda) {

  $county = insertSpaceBeforeUppercase($param);

  try {
    $county_ = $uganda->county($county);
    successResponse([
      'count' => 1,
      'county' => $county_
    ]);
  } catch (CountyNotFoundException $e) {
    errorResponse(
      sprintf('County not found: %s', $county),
      404,
      'COUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch county',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all subcounties in a particular county e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)/subcounties', function ($param) use($uganda) {

  $county = insertSpaceBeforeUppercase($param);
  
  try {
    $subcounties_ = $uganda
              ->county($county)
              ->subcounties();

    $count = count($subcounties_);

    $names = [];
    foreach($subcounties_ as $subcounty):
      $names[] = [
        "id" => $subcounty->id,
        "name" => $subcounty->name
      ];
    endforeach;
    successResponse([
      'count' => $count,
      'subcounties' => $names
    ]);
  } catch (CountyNotFoundException $e) {
    errorResponse(
      sprintf('County not found: %s', $county),
      404,
      'COUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch county subcounties',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all parsihes in a particular county e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)/parishes', function ($param) use($uganda) {

  $county = insertSpaceBeforeUppercase($param);
  
  try {
    $parishes = $uganda
              ->county($county)
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
  } catch (CountyNotFoundException $e) {
    errorResponse(
      sprintf('County not found: %s', $county),
      404,
      'COUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch county parishes',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all parsihes in a particular county e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)/villages', function ($param) use($uganda) {

  $county = insertSpaceBeforeUppercase($param);
  
  try {
    $villages = $uganda
              ->county($county)
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
  } catch (CountyNotFoundException $e) {
    errorResponse(
      sprintf('County not found: %s', $county),
      404,
      'COUNTY_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch county villages',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

