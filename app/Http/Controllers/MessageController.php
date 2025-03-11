<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\MessageRequest;
use App\Services\Message\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected MessageService $messageService;
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $params = $request->validate([
                'keyword' => 'string|nullable',
                'receiver_id' => 'nullable|integer'
            ]);
            $messages = $this->messageService->getMessages($params);
            return ApiResponse::success($messages, __('messages.success'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('messages.error'), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        try {
            $params = $request->validated();
            $message = $this->messageService->createMessage($params['message'], $params['receiver_id']);
            return ApiResponse::success($message, __('messages.success'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('messages.error'), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
