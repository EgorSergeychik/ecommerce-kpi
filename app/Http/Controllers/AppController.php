<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Log;

class AppController extends Controller
{
    public function health(): JsonResponse
    {
        try {
            \DB::connection()->getPdo();

            Log::info('Health check passed. DB is connected.');

            return $this->success(['database' => true]);
        } catch (\Exception $e) {
            Log::error('Health check failed. DB connection error: ' . $e->getMessage());
            return $this->error(status: 503, data: ['database' => false]);
        }
    }

    public function hardRequest(): JsonResponse
    {
        try {
            sleep(10);
            Log::info('Hard request completed successfully.');
            return $this->noContent();
        } catch (\Exception $e) {
            Log::error('Hard request failed: ' . $e->getMessage());
            return $this->error(status: 500, data: ['error' => 'Hard request failed']);
        }
    }
}
