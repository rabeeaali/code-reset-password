<?php

namespace App\Http\Controllers\Auth;

use App\Models\ResetCodePassword;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\CodeCheckRequest;

class CodeCheckController extends ApiController
{
    /**
     * Check if the code is exist and vaild one (Setp 2)
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(CodeCheckRequest $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {
            return $this->jsonResponse(null, trans('passwords.code_is_expire'), 422);
        }

        return $this->jsonResponse(['code' => $passwordReset->code], trans('passwords.code_is_valid'), 200);
    }
}
