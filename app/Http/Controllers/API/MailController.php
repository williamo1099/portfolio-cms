<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\MailService;
use App\Traits\HasAPIResponse;
use App\Traits\HasLogging;
use Exception;
use Illuminate\Http\Request;

class MailController extends Controller
{
    use HasAPIResponse, HasLogging;

    protected MailService $service;

    public function __construct(MailService $service)
    {
        $this->service = $service;
    }

    /**
     * Create a new mail (sent mail).
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function createMail(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string',
            ]);
            $data['date'] = now()->toDateString();

            $mail = $this->service->createMail($data);
            return $this->success(null, "Mail created successfully!");
        } catch (Exception $ex) {
            $this->logException('creating mail', $ex);
            return $this->error("Failed to create mail!", 500, $ex->getMessage());
        }
    }
}
