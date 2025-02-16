<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'district' => 'required|string|max:100',
            'ward' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:1',
            'status' => 'nullable|in:available,occupied',
            'posted_by' => 'required|string|max:100',
            'phone' => 'required|string|max:11',
            'description' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'required|string', // Xác thực base64
            'type' => 'required|in:roommate,room',
            'advertisement_type' => 'required|in:pop_up,banner,premium,common',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'location.required' => 'Địa chỉ là bắt buộc.',
            'district.required' => 'Quận/Huyện là bắt buộc.',
            'price.required' => 'Giá phòng là bắt buộc.',
            'price.numeric' => 'Giá phòng phải là số.',
            'area.required' => 'Diện tích là bắt buộc.',
            'area.numeric' => 'Diện tích phải là số.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'posted_by.required' => 'Tên người đăng là bắt buộc.',
            'description.required' => 'Mô tả là bắt buộc.',
            'images.required' => 'Bạn phải cung cấp ít nhất một hình ảnh.',
            'images.*.regex' => 'Hình ảnh phải được mã hóa dưới dạng base64 hợp lệ.',
            'type.required' => 'Loại bài đăng là bắt buộc.',
            'type.in' => 'Loại bài đăng không hợp lệ.',
            'advertisement_type.in' => 'Loại quảng cáo bài đăng không hợp lệ.',
        ];
    }
}