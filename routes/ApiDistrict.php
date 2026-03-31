<?php
use Steampixel\Route;
use Uganda\Exceptions\DistrictNotFoundException;

/**
 * District Particular operations
 */
// Get all district details e.g. Mukono
Route::add('/v1/district/([a-z-0-9-]*)', function ($district) use($uganda) {
  try {
    $dist = $uganda->district($district);
    successResponse([
      'count' => 1,
      'district' => $dist
    ]);
  } catch (DistrictNotFoundException $e) {
    errorResponse(
      sprintf('District not found: %s', $district),
      404,
      'DISTRICT_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch district',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all counties in a particular district e.g. Mukono
Route::add('/v1/district/([a-z-0-9-]*)/counties', function ($district) use($uganda) {
  try {
    $counties = $uganda
                ->district($district)
                ->counties();
    
    $names = [];
    foreach($counties as $county):
      $names[] = [
        "id" => $county->id,
        "name" => $county->name
      ];
    endforeach;
    successResponse([
      'count' => count($names),
      'counties' => $names
    ]);
  } catch (DistrictNotFoundException $e) {
    errorResponse(
      sprintf('District not found: %s', $district),
      404,
      'DISTRICT_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch district counties',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all subcounties in a particular district e.g.Mukono
Route::add('/v1/district/([a-z-0-9-]*)/subcounties', function ($district) use($uganda) {
  try {
    $subcounties = $uganda
                ->district($district)
                ->subcounties();
    
    $names = [];
    foreach($subcounties as $subcounty):
      $names[] = [
        "id" => $subcounty->id,
        "name" => $subcounty->name
      ];
    endforeach;
    successResponse([
      'count' => count($names),
      'subcounties' => $names
    ]);
  } catch (DistrictNotFoundException $e) {
    errorResponse(
      sprintf('District not found: %s', $district),
      404,
      'DISTRICT_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch district subcounties',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all parishes in a particular district e.g. Mukono
Route::add('/v1/district/([a-z-0-9-]*)/parishes', function ($district) use($uganda) {
  try {
    $parishes = $uganda
                ->district($district)
                ->parishes();
    
    $names = [];
    foreach($parishes as $parish):
      $names[] = [
        "id" => $parish->id,
        "name" => $parish->name
      ];
    endforeach;
    successResponse([
      'count' => count($names),
      'parishes' => $names
    ]);
  } catch (DistrictNotFoundException $e) {
    errorResponse(
      sprintf('District not found: %s', $district),
      404,
      'DISTRICT_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch district parishes',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');

// Get all villages in a particular district e.g. Mukono
Route::add('/v1/district/([a-z-0-9-]*)/villages', function ($district) use($uganda) {
  try {
    $villages = $uganda
                ->district($district)
                ->villages();
    
    $names = [];
    foreach($villages as $village):
      $names[] = [
        "id" => $village->id,
        "name" => $village->name
      ];
    endforeach;
    successResponse([
      'count' => count($names),
      'villages' => $names
    ]);
  } catch (DistrictNotFoundException $e) {
    errorResponse(
      sprintf('District not found: %s', $district),
      404,
      'DISTRICT_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch district villages',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
},'GET');
