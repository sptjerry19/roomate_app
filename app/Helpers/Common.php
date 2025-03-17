<?php

// app/Helpers/Common.php
namespace App\Helpers;

use Exception;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class Common
{
    const ORDER_STATUS_COMPLETED = 'completed';

    const ORDER_STATUS_PENDING = 'pending';

    const SHIPPER_STATUS_DELIVERING = 'delivering';
    /**
     * Xóa ảnh cũ và cập nhật ảnh mới cho sản phẩm.
     *
     * @param string|null $newImageBase64 Base64 của ảnh mới
     * @param string|null $oldImagePath Đường dẫn ảnh cũ
     * @param string $directory Thư mục lưu trữ ảnh
     * @return string|null Đường dẫn ảnh mới hoặc null nếu không có ảnh mới
     */
    public static function updateProductImage($newImageBase64, $oldImagePath, $directory = 'Product/image/')
    {
        // Xóa ảnh cũ nếu tồn tại
        if ($oldImagePath && file_exists(public_path($oldImagePath))) {
            unlink(public_path($oldImagePath));
        }

        // Nếu không có ảnh mới thì trả về null
        if (is_null($newImageBase64)) {
            return null;
        }

        // Tải lên ảnh mới và trả về đường dẫn
        return self::uploadbase64Image($newImageBase64, $directory);
    }

    /**
     * Upload base64 encoded image(s)
     *
     * @param string|array $file Single base64 string or array of base64 strings
     * @param string $path Storage path
     * @param bool $multi Whether handling multiple files
     * @param string|null $folder Optional subfolder
     * @return string|array Path(s) to uploaded file(s)
     * @throws InvalidArgumentException
     */
    public static function uploadbase64Image($file, string $path, bool $multi = false, ?string $folder = null): string|array
    {
        // Early return if no file
        if (empty($file)) {
            return $multi ? [] : '';
        }

        try {
            // Handle multiple files
            if ($multi) {
                if (!is_array($file)) {
                    throw new InvalidArgumentException('Multiple file upload requires array input');
                }
                return self::handleMultipleUploads($file, $path, $folder);
            }

            // Handle single file
            if (!is_string($file)) {
                throw new InvalidArgumentException('Single file upload requires string input');
            }
            return self::handleSingleUpload($file, $path, $folder);
        } catch (Exception $e) {
            throw new InvalidArgumentException("Image upload failed: {$e->getMessage()}");
        }
    }

    /**
     * Handle multiple file uploads
     */
    private static function handleMultipleUploads(array $files, string $path, ?string $folder): array
    {
        $uploadedPaths = [];
        foreach ($files as $key => $base64String) {
            if (empty($base64String)) {
                continue;
            }

            $uploadedPaths[] = self::processAndSaveImage(
                $base64String,
                $path,
                $folder,
                $key . '_'
            );
        }
        return $uploadedPaths;
    }

    /**
     * Handle single file upload
     */
    private static function handleSingleUpload(string $base64String, string $path, ?string $folder): string
    {
        return self::processAndSaveImage(
            $base64String,
            $path,
            $folder,
            str_replace('/', '', $path) . '_'
        );
    }

    /**
     * Process and save base64 image
     */
    private static function processAndSaveImage(string $base64String, string $path, ?string $folder, string $prefix): string
    {
        // Validate and extract image data
        self::validateBase64Image($base64String);
        $imageData = self::extractBase64Data($base64String);
        $extension = self::getImageExtension($base64String);

        // Generate secure filename
        $fileName = $prefix . time() . '_' . Str::random(10) . '.' . $extension;

        // Determine storage path
        $storagePath = $folder
            ? $path . trim(str_replace(' ', '', $folder), '/') . '/'
            : $path;
        $fullPath = trim($storagePath, '/') . '/' . $fileName;

        // Save the file
        Storage::disk('public')->put($fullPath, base64_decode($imageData));

        // Return path with leading slash for consistency
        return '/' . $fullPath;
    }

    /**
     * Validate base64 image string
     * @throws InvalidArgumentException
     */
    private static function validateBase64Image(string $base64String): void
    {
        if (strlen($base64String) > 5 * 1024 * 1024) { // 5MB limit
            throw new InvalidArgumentException('Image size exceeds 5MB limit');
        }

        if (!preg_match('/^data:image\/(jpeg|jpg|png|gif);base64,/', $base64String)) {
            throw new InvalidArgumentException('Invalid image format');
        }
    }

    /**
     * Extract base64 data from string
     */
    private static function extractBase64Data(string $base64String): string
    {
        return preg_replace('/^data:image\/\w+;base64,/', '', $base64String);
    }

    /**
     * Get image extension from base64 string
     */
    private static function getImageExtension(string $base64String): string
    {
        preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches);
        return strtolower($matches[1]);
    }

    public static function responseImage($pathImg)
    {
        $domain = env('APP_URL', 'https://aahome.click/storage');
        return $domain . $pathImg;
    }

    public static function responseProductImage($pathImg)
    {
        $domain = 'https://fnbapi.vietapp.vn';
        return $domain . $pathImg;
    }

    public static function checkImage($imagePathOrUrl)
    {
        // Kiểm tra xem đó là URL hay đường dẫn tệp
        if (filter_var($imagePathOrUrl, FILTER_VALIDATE_URL)) {
            // Kiểm tra URL
            $headers = @get_headers($imagePathOrUrl);
            if ($headers && strpos($headers[0], '200') !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            // Kiểm tra đường dẫn tệp
            if (Storage::exists($imagePathOrUrl)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param $file
     * @param $path
     * @param bool $multi
     * @param $folder
     * @return array|string
     */
    public static function uploadbase64ImageFtp($file, $path, bool $multi = false, $folder = null, $disk = 'ftp'): array|string
    {
        if ($multi) {
            $uploadedPaths = [];
            foreach ($file as $key => $item) {
                if ($item) {
                    $data = preg_replace('/^data:image\/\w+;base64,/', '', $item);
                    $type = explode(';', $item)[0];
                    $type = explode('/', $type)[1];

                    // upload new file
                    $fileName = $key . '_' . time() . rand(1, 99999) . '.' . $type;
                    if ($disk == 'ftp') {
                        Storage::disk($disk)->put($path . str_replace(' ', '', $folder) . '/' . $fileName, base64_decode($data));
                        $uploadedPaths[] = $path . str_replace(' ', '', $folder) . '/' . $fileName;
                    } else {
                        Storage::disk($disk)->put('/images/' . $fileName, base64_decode($data));
                        $uploadedPaths[] = '/images/' . $fileName;
                    }
                }
            }

            return $uploadedPaths;
        } else {
            if ($file) {
                $data = preg_replace('/^data:image\/\w+;base64,/', '', $file);
                $type = explode(';', $file)[0];
                $type = explode('/', $type)[1];

                // upload new file
                $fileName = str_replace('/', '', $path) . '_' . time() . rand(1, 99999) . '.' . $type;

                if ($folder) {
                    if ($disk == 'ftp') {
                        Storage::disk($disk)->put($path . str_replace(' ', '', $folder) . '/' . $fileName, base64_decode($data));
                        return $path . str_replace(' ', '', $folder) . '/' . $fileName;
                    } else {
                        Storage::disk($disk)->put('/images/' . $fileName, base64_decode($data));
                        return '/images/' . $fileName;
                    }
                } else {

                    if ($disk == 'ftp') {
                        Storage::disk($disk)->put($path . $fileName, base64_decode($data));
                        return $path . $fileName;
                    } else {
                        Storage::disk($disk)->put('/images/' . $fileName, base64_decode($data));
                        return '/images/' . $fileName;
                    }
                }
            }
            return '';
        }
    }
    /**
     * @param ResourceCollection $collection
     * @return array|null
     */
    #[ArrayShape([
        'total' => "int",
        'count' => "int",
        'per_page' => "int",
        'current_page' => "int",
        'last_page' => "int"
    ])]
    public static function collectionPagination(ResourceCollection $collection): ?array
    {
        try {
            return [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage()
            ];
        } catch (Exception $e) {
            return null;
        }
    }

    public static function generateCode($length = 6)
    {
        // Bộ ký tự cho phép bao gồm chữ cái in hoa và số
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomCode = '';

        // Tạo mã ngẫu nhiên
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomCode;
    }

    public static function generateCodePos($tableName)
    {

        $length = 0;
        if ($tableName === 'm_order') {
            $length = 10;
        } elseif ($tableName === 'm_customer') {
            $length = 8;
        }

        // Bộ ký tự cho phép bao gồm chữ cái in hoa và số
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomCode = '';

        // Tạo mã ngẫu nhiên
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomCode;
    }
}