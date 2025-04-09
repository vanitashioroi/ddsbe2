<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserJob;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use DB;

class UserController extends Controller
{
    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getUsers()
    {
        // Using raw SQL query instead of Eloquent
        $users = DB::connection('mysql')
            ->select("SELECT * FROM tbluser");

        return $this->successResponse($users);
    }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'data' => $users->values(),
            'site' => 2
        ]);
    }
    

    public function show($id)
    {
        $user = User::findOrFail($id);
            return $this->successResponse($user);
    }
    
    public function add(Request $request) {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];
        $this->validate($request, $rules);
    
        // Validate jobid exists
        UserJob::findOrFail($request->jobid);
    
        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }
    
    public function update(Request $request, $id) {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];
        $this->validate($request, $rules);
    
        UserJob::findOrFail($request->jobid); // validate job exists
    
        $user = User::findOrFail($id);
        $user->fill($request->all());
    
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $user->save();
        return $this->successResponse($user);
    }
    

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return $this->successResponse('User deleted successfully');
    }
     

}