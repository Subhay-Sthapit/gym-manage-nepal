<?php
use Illuminate\Support\Facades\Route;

Route::post('auth/login', fn() => response()->json(['message' => 'login']));
