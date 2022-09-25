<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmtBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmtBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rescode = "0001";
        $resmsg = "";
        if (Auth::check()) {
            $validation  = request()->validate([
                'boardsid' => ['required'],
                'comment' => ['required']
            ]);

            $cmtboard = new CmtBoard();
            $board->userid = auth() -> user() -> id;
            $board->comment = $request->input('comment');
            $board->boardsid = $request->input('boardsid');
            $board -> save();

            if($board->id > 0){
                $rescode = "0000";
            }else{
                $resmsg = "댓글 등록에 실패하였습니다.";
            }
        }else{
            $rescode = "0002";
            $resmsg = "로그인을 하셔야 합니다.";
        }
        return response()->json([
            'rescode' => $rescode,
            'resmsg' => $resmsg,
            'auth' => auth(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
