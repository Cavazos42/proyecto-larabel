<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = User::paginate(10);

        return jsend_success([
            'total' => $paginate->total(),
            'usuarios' => $paginate->items(),
            'per_page' => $paginate->perPage(),
            'current_page' => $paginate->currentPage(),
            'last_page' => $paginate->lastPage(),
            'next_page_url' => $paginate->nextPageUrl()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());

        return jsend_success([
            'message' => 'Usuario creado correctamente',
            'usuario' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return jsend_success($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return jsend_success([
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return jsend_success([
            'message' => 'Usuario eliminado correctamente',
            'usuario' => $user
        ]);
    }
}
