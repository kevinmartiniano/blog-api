<?php

namespace App\Http\Controllers\API;

use App\Model\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTypeController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserType::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', UserType::class);

        return UserType::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType)
    {
        return $userType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserType $userType)
    {
        $this->authorize('update', $userType);

        return $userType->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
        $this->authorize('delete', $userType);

        $userType->delete();
    }
}
