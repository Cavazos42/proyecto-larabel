<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = Foto::paginate(10);

        return jsend_success([
                'total' => $paginate->total(),
                'fotos' => $paginate->items(),
                'current_page' => $paginate->currentPage(),
                'last_page' => $paginate->lastPage(),
                'next_page_url' => $paginate->nextPageUrl()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        if($request->hasFile('file') && $file->isValid()) {
            $path = $file->store('public/fotos');
            $url = Storage::url($path);

            $foto = Foto::create([
                'tipo' => $request->tipo,
                'entrega' => $request->entrega,
                'path' => $url,
                'album_id' => $request->album_id
            ]);

            return jsend_success([
                'message' => 'Foto subida correctamente',
                'foto' => $foto
            ]);
        }

        return jsend_error([
            'message' => 'No se pudo subir la foto'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        return jsend_success($foto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        
        $foto->update([
            'tipo' => $request->tipo,
            'entrega' => $request->entrega,
        ]);
        
        return jsend_success([
            'message' => 'Foto actualizada correctamente',
            'foto' => $foto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        $foto->delete();
        return jsend_success([
            'message' => 'Foto eliminada correctamente'
        ]);
    }
}
