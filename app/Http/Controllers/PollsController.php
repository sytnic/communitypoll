<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

class PollsController extends Controller
{
    public function index() 
    {
        // Вернуть все записи в формате json из таблицы polls
        // с http ответом 200
        return response()->json(Poll::get(), 200);
    }

    // Показать одну запись по идентификатору
    public function show($id) 
    {
        return response()->json(Poll::find($id), 200);
    }

    // Создать ресурс, http ответ 201
    public function store(Request $request) 
    {
    	$poll = Poll::create($request->all());
    	return response()->json($poll, 201);
    }
}
