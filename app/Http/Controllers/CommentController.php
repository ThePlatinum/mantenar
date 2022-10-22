<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
  
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'body' => 'required|string',
      'share_id' => 'required|exists:shares,id'
    ]);

    if ($validator->fails()) return response()->json(400);

    $comment = Comment::create([
      'author_user_id' => Auth()->user()->id,
      'share_id' => $request->share_id,
      'body' => $request->body,
    ]);

    return response()->json(['comment' => $comment], 200);
  }
}
