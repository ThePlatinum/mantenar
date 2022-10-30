<?php

namespace App\Http\Controllers;

use App\Models\Trail;
use Illuminate\Http\Request;

class TrailController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $actions = Trail::all();
    return view('trail', ['actions'=> $actions]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Trail  $trail
   * @return \Illuminate\Http\Response
   */
  public function destroy(Trail $trail)
  {
    //
  }
}
