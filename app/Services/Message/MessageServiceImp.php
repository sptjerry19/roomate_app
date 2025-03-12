<?php

namespace App\Services\Message;

use App\Helpers\Common;
use App\Models\Notification;
use App\Repositories\Favorite\FavoriteRepository;
use App\Repositories\Message\MessageRepository;
use App\Repositories\User\UserRepository;
use App\Services\Base\BaseServiceImp;
use App\Services\Favorite\FavoriteService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MessageServiceImp extends BaseServiceImp implements MessageService
{
    protected UserRepository $userRepository;
    public function __construct(MessageRepository $messageRepository, UserRepository $userRepository)
    {
        $this->repository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function getMessages(array $attribute): mixed
    {
        try {
            return $this->repository->getMessages($attribute);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function createMessage(string $message, ?int $receiverId): mixed
    {
        DB::beginTransaction();
        try {
            $data = [
                'message' => $message,
                'user_id' => auth()->user()->id,
                'receiver_id' => $receiverId ?? null
            ];
            $message = $this->repository->create($data);


            // Create notification
            if ($receiverId) {
                $receiver = $this->userRepository->find($receiverId);
                Notification::create([
                    'user_id' => $receiverId,
                    'title' => "Có tin nhắn mới từ " . $receiver->name,
                ]);
            }

            DB::commit();
            return $message;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function updateMessage(string $message, int $messageId): mixed
    {
        try {
            $data = [
                'message' => $message,
            ];
            $message = parent::update($messageId, $data);
            return $message;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
