<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Utils\ResponseRequest;

use function Laravel\Prompts\error;

/**
 * Class UserService.
 */
class UserService
{

    protected $user_repository;

    public function __construct(UserRepository $repository)
    {
        $this->user_repository = $repository;
    }
    public function store($request)
    {
        
        $request['password'] = Hash::make($request['password']);
        
        try {
            
            $user = $this->user_repository->create($request);
            return responseStatus('S', 2, 201, $user->toArray(),'' );
        } catch (\Throwable $th) {
            return responseStatus('E', 1, 502,'Erro ao processar solitação', $th->getMessage());
        }
    }

    public function update($request, string $id){
        
        if(isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        try {
            $this->user_repository->update($id, $request);
            
                return responseStatus('S', 3, 200, null, '' );

        } catch (\Throwable $th) {
            return responseStatus('E', 3, 404, null, null);
        }

    }

    public function destroy($id){

        try {
            $this->user_repository->delete($id);

                return responseStatus('S', 4, 200, null, '' );
            
            } catch (\Throwable $th) {
            return responseStatus('E', 3, 404, null, null);
        }

    }

    public function show(string $id)
    {
        try {
            
            $user = $this->user_repository->find($id);
            return responseStatus('S', 0, 200, $user, '' );
            
        } catch (\Throwable $th) {
            return responseStatus('E', 3, 404, null, null);
        }
    }

    public function all()
    {
        $user = $this->user_repository->all();
        return responseStatus('S', 0, 200, $user, '' );
    }
    
}
