<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Lien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $
     *
     *
     *
     */
    public function save(Request $request)
    {
        $lien = Lien::findOrNew($request->get("id"));

        $lien->setAttribute("id", $request->get("id"));
        $lien->setAttribute("note_id", $request->get("note_id"));
        $lien->setAttribute("linked_note_id", $request->get("linked_note_id"));
        $lien->setAttribute("user_id", $request->get("user_id"));
        $lien->setAttribute("name", $request->get("name"));
        $lien->fillable(["id" => $lien->id,
            "note_id" => $lien->note_id,
            "linked_note_id" => $lien->linked_note_id,
            "name" => $lien->name
        ]);


        $lien->save();


        echo "<p> Lien saved</p>";


        return Redirect::to('note/joint/edit/' . $lien->getAttribute("id"))->with(["Message" => "Sauvegardé"]);
    }

}
