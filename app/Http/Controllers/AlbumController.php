<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = Album::paginate(10);

        return jsend_success([
                'total' => $paginate->total(),
                'albums' => $paginate->items(),
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
        $album = Album::create($request->all());

        return jsend_success([
            'message' => 'Album creado correctamente',
            'album' => $album
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return jsend_success($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album->update([
            "materia" => $request->materia,
            "profesor" => $request->profesor,
            "grupo" => $request->grupo,
            "semestre" => $request->semestre,
            "horario_inicio" => $request->horario_inicio,
            "horario_fin" => $request->horario_fin
        ]);

        return jsend_success([
            'message' => 'Album actualizado correctamente',
            'album' => $album
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return jsend_success([
            'message' => 'Album eliminado correctamente',
            'album' => $album

        ]);
    }
}
