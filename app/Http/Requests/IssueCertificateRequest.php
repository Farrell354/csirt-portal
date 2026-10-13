<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * IssueCertificateRequest — Defense in Depth: Authorization & Validation
 *
 * Strictly authorizes only authenticated CSIRT administrators to issue certificates.
 */
class IssueCertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Currently no additional body payload required, but can accept optional issuance notes
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
