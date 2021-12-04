<?php


use Fuseday\Torque\Http\Controllers\LegoController;
use Illuminate\Support\Facades\Route;
use Fuseday\Torque\Http\Controllers\ApiActionController;
use Fuseday\Torque\Http\Controllers\AssetController;

Route::get('/_torque/assets/{assetFolder}/{assetFile}', AssetController::class)
    ->where('assetFile', '.*')
    ->name('torque.asset');

Route::get('/fonts/vendor/{assetFolder}/{assetFile}', AssetController::class)
    ->where('assetFile', '.*');

Route::post('/_torque/message/{entrypoint}', ApiActionController::class)->name('torque.message');

Route::get('/_torque/lego/{vendor}/{package}/{distFile}', LegoController::class)
    ->where('distFile', '.*')
    ->name('torque.lego');
