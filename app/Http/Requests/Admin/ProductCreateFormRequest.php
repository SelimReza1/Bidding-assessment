<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => "required",
            'minimum_bidding_price' => function ($attribute, $value, $fail) {
                if ($value == '') return;
                if (is_numeric($value) && (int)$value > 0) return;

                $fail("The $attribute field is invalid.");
            },
            'deadline' => 'required',
        ];
    }

    public function save(): void
    {
        $this->deadline = Carbon::parse($this->deadline, "Asia/Dhaka")
            ->subHours(6)->format("Y-m-d H:i:s");

        Product::create([
            'title' => $this->title,
            'minimum_bidding_price' => $this->minimum_bidding_price,
            'deadline' => $this->deadline,
        ]);
    }
}
