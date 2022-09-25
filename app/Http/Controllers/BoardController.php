<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$lists = Board::latest();

        $lists = DB::table('boards')
            ->join('users', 'boards.userid', '=', 'users.id')
            ->select('boards.*', 'users.name')
            ->paginate(5);

        $view = [
            'lists' => $lists,
        ];

        return view('board.index', $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = new Board();
        // dd(config('ext.user.user_level.roles'));
        $view = [
            'form' => $form,
        ];

        return view('board.create', $view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $validated = $request->validate([
            'title' => ['required','required|min:10|max:20'],
            'description' => ['required']
        ]);
        */

        if (Auth::check()) {
            $validation  = request()->validate([
                'title' => ['required','min:3'],
                'description' => ['required']
            ]);

            $board = new Board();
            $board->userid = auth() -> user() -> id;
            $board->title = $request->input('title');
            $board->description = $request->input('description');
            $board->reply = 0;
            $board -> save();
            
        }else{
            return redirect(route('auth.login'));
        }
        return redirect('board/show/'.$board -> id);

        /*
        if (Auth::check()) {
            Board::create(request()->validate([
                'title' => ['required','min:3'],
                'description' => ['required'],
                'userid' => Auth::id(),
                'reply' => 0,
            ]));
            return redirect(route('board.index'))->with('alert-success', '추가되었습니다.');
        }else {
            return redirect(route('auth.login'));
        }
        */
        /*
        $board = Board::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description')
        ]);

        return redirect(route('board.index'))->with('alert-success', '추가되었습니다.');
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Board $boardInfo)
    {
        $data = DB::table('boards')
            ->join('users', 'boards.userid', '=', 'users.id')
            ->select('boards.*', 'users.name')
            ->where('boards.id', '=', $boardInfo->id)
            ->get();

        $cmt = DB::table("cmt_boards")
            ->join('users', 'cmt_boards.userid', '=', 'users.id')
            ->where("boardsid", $boardInfo->id)
            ->select('cmt_boards.*', 'users.name')
            ->get();

        $view = [
            'view' => $data[0],
            'cmtlist' => $cmt,
        ];

        return view('board.show', $view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = DB::table('boards')
            ->where('id', '=', $request->input('id'))
            ->get();

        $view = [
            'form' => $data[0],
        ];

        return view('board.edit', $view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $boardInfo)
    {
        $boardInfo->update(request(['title','description']));

        return redirect(route('board.index'))->with('alert-success', '수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $boardInfo)
    {
        $boardInfo->delete();

        return redirect(route('board.index'))->with('alert-danger', '삭제되었습니다.');
    }




    public function list(Request $request)
    {
        $lists = Board::latest();
        $view = [
            'lists' => $lists->paginate(),
        ];
        return $view;
    }
}
