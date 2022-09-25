<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CmtBoardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CmtBoard;

class ApiController extends Controller
{
    public function cmtwrite(Request $request)
    {
        $rescode = "0001";
        $resmsg = "";
        if (Auth::check()) {
            $validation  = request()->validate([
                'boardsid' => ['required'],
                'comment' => ['required']
            ]);

            $cmtboard = new CmtBoard();
            $cmtboard->userid = auth() -> user() -> id;
            $cmtboard->comment = $request->input('comment');
            $cmtboard->boardsid = $request->input('boardsid');
            $cmtboard -> save();

            if($cmtboard->id > 0){
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
        ]);
    }

    public function cmtremove(Request $request){
        $rescode = "0000";
        $resmsg = "";

        $data = DB::table('cmt_boards')
            ->where('id', '=', $request->id)
            ->delete();
        
        return response()->json([
            'rescode' => $rescode,
            'resmsg' => $resmsg,
        ]);
    }
}

?>