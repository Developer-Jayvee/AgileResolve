<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Override;

class UserController extends ResourceController
{
    #[Override]
    public function setParams()
    {
        $this->mainModel = new User;
        $this->storeRequest = new StoreUserRequest;
        $this->updateRequest = new UpdateUserRequest;
    }
}
