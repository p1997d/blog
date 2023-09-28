<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Comment\StoreRequest;
use Illuminate\Http\Request;
use App\Models\PostComment;

class CommentsConroller extends Controller
{
    public function send(StoreRequest $request)
    {
        $data = $request->validated();
        PostComment::create($data);
    }
    public function remove(Request $request)
    {
        PostComment::where('reply_id', $request['id'])->delete();
        PostComment::where('id', $request['id'])->delete();
    }
}