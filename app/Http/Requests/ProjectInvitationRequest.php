<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class ProjectInvitationRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'invitations';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('manage', $this->route('project'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'exists:users,email']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.exists' => 'The invited user must have an account.'
        ]; 
    }
}
