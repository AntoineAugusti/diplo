<?php

namespace Diplo\Http\Controllers;

use Diplo\Messages\Conversation;
use Illuminate\Http\Response;

class ConversationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($joueurId)
    {
        // TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::only('joueurs');

        return Conversation::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return Conversation::find($id);
    }
}
