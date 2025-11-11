<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AiClient;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    private AiClient $aiClient;

    public function __construct(AiClient $aiClient)
    {
        $this->aiClient = $aiClient;
    }

    /**
     * Check AI service health status.
     */
    public function index()
    {
        $result = $this->aiClient->health();
        
        $aiStatus = $result['status'] === 'ok' ? 'ok' : 'error';
        $aiError = $result['error'] ?? null;

        return view('admin.health', [
            'ai_status' => $aiStatus,
            'ai_error' => $aiError,
        ]);
    }
}

