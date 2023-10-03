<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Comment\StoreRequest;
use Illuminate\Http\Request;
use App\Models\PostComment;

class CommentsConroller extends Controller
{
    /**
     * Сохранение комментария
     *
     * @param StoreRequest $request
     * @return void
     */
    public function send(StoreRequest $request)
    {
        $data = $request->validated();
        PostComment::create($data);
    }

    /**
     * Удаление комментария
     *
     * @param Request $request
     * @return void
     */
    public function remove(Request $request)
    {
        $id = $request->input('id');

        PostComment::where('reply_id', $id)->delete();
        PostComment::where('id', $id)->delete();
    }
}
