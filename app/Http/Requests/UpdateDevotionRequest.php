<?php

namespace App\Http\Requests;

use App\Models\Devotion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Mews\Purifier\Facades\Purifier;

class UpdateDevotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::forUser($this->user())->allows('update', $this->route('devotion'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $devotion = $this->route('devotion');

        return [
            'title' => ['required', 'string', 'max:255', Rule::unique(Devotion::class, 'title')->ignore($devotion)],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'date' => ['required', 'date', Rule::unique(Devotion::class, 'date')->ignore($devotion)],
            'status' => ['required', Rule::in(['published', 'unpublished', 'draft'])],
            'is_recommended' => ['nullable', 'boolean'],
            'user_id' => ['required', Rule::exists('users', 'id')],
        ]; 
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'content' => Purifier::clean($this->get('content')),
        ]);
    }
}
