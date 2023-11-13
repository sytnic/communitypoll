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
}
