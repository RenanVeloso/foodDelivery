<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service=$userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        return $this->service->store($validated);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, UpdateRequest $request)
    {
        // dd($id);
        $validated = $request->validated();
        return $this->service->update($validated, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
