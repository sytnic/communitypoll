<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;
use Validator;

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
        // Если id не существует,
        // вернётся пустой json
        $poll = Poll::find($id);
        if (is_null($poll)) {
            return response()->json(null, 404);
        }

        // find вернёт пустой json в ответе при неверном id,
        // findOrFail вернёт страницу 404 при неверном id

        //return response()->json(Poll::find($id), 200);
        return response()->json(Poll::findOrFail($id), 200);
    }

    // Создать ресурс, http ответ 201
    public function store(Request $request) 
    {
        $rules = [
            'title' => 'required|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        //dd($validator->fails());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    	$poll = Poll::create($request->all());
    	return response()->json($poll, 201);
    }

    // Редактирование записи
    public function update(Request $request, Poll $poll) 
    {
        $poll->update($request->all());
        return response()->json($poll, 200);
    }

    // Удаление записи
    public function delete(Request $request, Poll $poll) 
    {
        $poll->delete();
        return response()->json(null, 204);
    }

    // возврат собственных ошибок по GET /api/errors
    public function errors() 
    {
        // возвращается ошибка 501 и пустой массив
        //return response()->json([], 501);

        // возвращается ошибка 501 и массив с сообщением
        return response()->json(['msg' => 'Payment is required.'], 501);
    }
}
