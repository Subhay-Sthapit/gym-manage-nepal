<?php

use Illuminate\Support\Facades\Route;

// -------------------------------------------------------
// Public routes (no auth required)
// -------------------------------------------------------
Route::prefix('v1')->group(function () {
    require __DIR__ . '/v1/auth.php';
});

// -------------------------------------------------------
// Tenant routes — auth + tenant context required
// Every gym's staff and members hit these
// -------------------------------------------------------
Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {
        require __DIR__ . '/v1/members.php';
    });

// -------------------------------------------------------
// Platform / central routes — auth required, NO tenant middleware
// Only the Platform Owner hits these
// -------------------------------------------------------
Route::prefix('v1/platform')
    // todo need to create middleware for the platform_owner
//    ->middleware(['auth:sanctum', 'platform_owner'])
    ->group(function () {
        require __DIR__ . '/v1/gyms.php';
    });
