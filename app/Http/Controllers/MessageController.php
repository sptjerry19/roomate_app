<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Message\MessageRequest;
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
            $message = $this->messageService->updateMessage($params['message'], $params['receiver_id']);
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
        try {
            $params = $request->validated();
            $message = $this->messageService->updateMessage($params['message'], $id);
            return ApiResponse::success($message, __('messages.update.success'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('messages.update.error'), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->messageService->delete($id);
            return ApiResponse::success([], __('messages.delete.success'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('messages.delete.error'), 500);
        }
    }
}
