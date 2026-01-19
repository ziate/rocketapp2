<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'delivery_driver_id' => 'nullable|exists:delivery_drivers,id',
            'order_type_id' => 'required|exists:order_types,id',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'العميل مطلوب',
            'customer_id.exists' => 'العميل المختار غير موجود',
            'order_type_id.required' => 'نوع الطلب مطلوب',
            'order_type_id.exists' => 'نوع الطلب المختار غير موجود',
            'status.required' => 'الحالة مطلوبة',
        ];
    }
}
