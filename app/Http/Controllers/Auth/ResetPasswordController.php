<?php

namespace App\Http\Controllers\Auth;

use App\Models\ResetCodePassword;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController extends ApiController
{
    /**
     * Change the password (Setp 3)
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {
            return $this->jsonResponse(null, trans('passwords.code_is_expire'), 422);
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update($request->only('password'));

        $passwordReset->delete();

        return $this->jsonResponse(null, trans('site.password_has_been_successfully_reset'), 200);
    }
}
