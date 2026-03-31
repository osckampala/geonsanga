<?php

use Steampixel\Route;
use Uganda\Exceptions\CountyNotFoundException;
use Uganda\Exceptions\DistrictNotFoundException;
use Uganda\Exceptions\ParishNotFoundException;
use Uganda\Exceptions\SubCountyNotFoundException;
use Uganda\Exceptions\VillageNotFoundException;

Route::add('/v1/ping', function () {
  successResponse([
    'message' => 'Hello World'
  ]);
}, 'GET');

// Get all districts
Route::add('/v1/districts', function () use ($uganda) {
  try {
    $districts = $uganda->districts();
    $items = [];
    foreach ($districts as $dist):
      $items[] = [
        "id" => $dist->id,
        "name" => $dist->name
      ];
    endforeach;
    successResponse([
      'count' => count($items),
      'districts' => $items
    ]);
  } catch (DistrictNotFoundException $e) {
    errorResponse(
      "Districts not found",
      404,
      'DISTRICTS_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch districts',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
}, 'GET');

// Get all Counties
Route::add('/v1/counties', function () use ($uganda) {
  try {
    $counties = $uganda->counties();
    $items = [];
    foreach ($counties as $county):
      $items[] = [
        "id" => $county->id,
        "name" => $county->name
      ];
    endforeach;
    successResponse([
      'count' => count($items),
      'counties' => $items
    ]);
  } catch (CountyNotFoundException $e) {
    errorResponse(
      "Counties not found",
      404,
      'COUNTIES_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch counties',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
}, 'GET');

// Get all Sub Counties
Route::add('/v1/subcounties', function () use ($uganda) {
  try {
    $subcounties = $uganda->subcounties();
    $items = [];
    foreach ($subcounties as $subcounty):
      $items[] = [
        "id" => $subcounty->id,
        "name" => $subcounty->name
      ];
    endforeach;
    successResponse([
      'count' => count($items),
      'subcounties' => $items
    ]);
  } catch (SubCountyNotFoundException $e) {
    errorResponse(
      "Subcounties not found",
      404,
      'SUBCOUNTIES_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch subcounties',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
}, 'GET');

// Get all Parishes
Route::add('/v1/parishes', function () use ($uganda) {
  try {
    $parishes = $uganda->parishes();
    $items = [];
    foreach ($parishes as $parish):
      $items[] = [
        "id" => $parish->id,
        "name" => $parish->name
      ];
    endforeach;
    successResponse([
      'count' => count($items),
      'parishes' => $items
    ]);
  } catch (ParishNotFoundException $e) {
    errorResponse(
      "Parishes not found",
      404,
      'PARISHES_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch parishes',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
}, 'GET');

// Get all Villages
Route::add('/v1/villages', function () use ($uganda) {
  try {
    $villages = $uganda->villages();
    $items = [];
    foreach ($villages as $village):
      $items[] = [
        "id" => $village->id,
        "name" => $village->name
      ];
    endforeach;
    successResponse([
      'count' => count($items),
      'villages' => $items
    ]);
  } catch (VillageNotFoundException $e) {
    errorResponse(
      "Villages not found",
      404,
      'VILLAGES_NOT_FOUND'
    );
  } catch (\Throwable $e) {
    errorResponse(
      'Unable to fetch villages',
      500,
      'INTERNAL_SERVER_ERROR'
    );
  }
}, 'GET');
