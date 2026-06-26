<?php
use Illuminate\Support\Facades\Route;

Route::get('gyms', fn() => response()->json(['message' => 'gyms']));
