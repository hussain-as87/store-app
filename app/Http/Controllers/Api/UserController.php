<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-per', ['only' => [
            'index',
            'show',
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ]]);
    }
    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->currentAccessToken()->tokenable->id;
        $user = User::paginate(10);
        if ($user) {
            return new JsonResponse([
                'status' => '201',
                'message' => $user
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => __('not found !')
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>$request->password
        ]);
        if ($user) {
            return new JsonResponse([
                'status' => '201',
                'message' => $user
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => __('failed created !')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        \auth()->user()->currentAccessToken()->tokenable->id;
        $user = User::where('id', $request->id)->first();
        if ($user) {
            return new JsonResponse([
                'status' => '201',
                'message' => $user
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => __('not found !')
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $user = \auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
           'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);
        $user = User::where('id', $request->id)->first();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>$request->password
        ]);
        if ($user) {
            return new JsonResponse([
                'status' => '201',
                'message' => $user
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => __('failed updated !')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
         auth()->user()->currentAccessToken()->tokenable->id;
        $user = User::where('id', $request->id)->first()->delete();
        if (!$user) {
            return new JsonResponse([
                'status' => '401',
                'message' => 'failed deleted !'
            ]);
        }
        return new JsonResponse([
            'status' => '201',
            'message' => __('user is deleted !')
        ]);
    }
}
