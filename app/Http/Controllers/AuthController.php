<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorLoginRequest;
use App\Http\Requests\AuthorRegisterRequest;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorService;

class AuthController extends Controller
{
    /**
     * @var AuthorService
     */
    protected $authorService;

    public function __construct(
        AuthorService $authorService
    )
    {
        $this->authorService = $authorService;
    }
   
    public function register(AuthorRegisterRequest $request) : AuthorResource
    {
        $data = $request->validated();
        $user = $this->authorService->register(
            $data
        );
        $user->save();
       
        return new AuthorResource($user->fresh());
    }

    public function login(AuthorLoginRequest $request) : AuthorResource
    {
        $data = $request->validated();
        $this->authorService->login($data);
        //get the user
        $user = request()->user();
        return new AuthorResource($user);
    }

    public function me() : AuthorResource
    {
        $user = request()->user();
        return new AuthorResource($user);
    }

    public function logout() {
        $this->authorService->logout();
    }
}
