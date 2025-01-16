<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Khai báo các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'title',
        'location',
        'district',
        'ward',
        'price',
        'area',
        'status',
        'posted_by',
        'phone',
        'user_id',
        'description',
        'images',
        'type',
    ];

    // Nếu bạn muốn lấy images dưới dạng mảng thay vì chuỗi JSON
    protected $casts = [
        'images' => 'array',
    ];
}
