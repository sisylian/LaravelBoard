@extends('layout.default')

@section('content')
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th class="bg-light" width="200">작성자</th>
                <td>{{ $view->name }}</td>
            </tr>
            <tr>
                <th class="bg-light" width="200">제목</th>
                <td>{{ $view->title }}</td>
            </tr>
            <tr>
                <th class="bg-light" width="200">내용</th>
                <td>
                    <?php
                        echo nl2br(str_replace(" ","&nbsp;", $view->description))
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
        <a href="{{ route('board.index', ['page' => app('request')->input('page')]) }}" class="btn btn-sm btn-success">
            목록
        </a>
        @if ($view->userid == Auth::user()->id)
            <a href="{{ route('board.edit', ['page' => app('request')->input('page'), 'id' => $view->id ]) }}" class="btn btn-sm btn-warning">
                수정
            </a>
            <a href="{{ route('board.destroy', ['boardInfo' => $view->id]) }}" class="btn btn-sm btn-danger">
                삭제
            </a>
        @endif

        <hr>

        <div class="row">
            <div class="panel panel-default widget">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span>
                    <h3 class="panel-title">Recent Comments</h3>
                    <span class="label label-info">{{ count($cmtlist) }}</span>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @forelse($cmtlist as $cmt)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-12 col-md-11">
                                        <div>
                                            <div class="mic-info">
                                                By: <a href="#">{{ $cmt->name }}</a> on {{ $cmt->created_at }}
                                            </div>
                                        </div>
                                        <div class="comment-text">
                                            <?php
                                                echo nl2br(str_replace(" ","&nbsp;", $cmt->comment ))
                                            ?>
                                        </div>
                                        <div class="action">
                                            <!--
                                            <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            <button type="button" class="btn btn-success btn-xs" title="Approved">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>-->
                                            @if($cmt->userid == Auth::user()->id)
                                            <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                                <span class="glyphicon glyphicon-trash" data-id="{{ $cmt->id }}"></span>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item">
                                <div class="row">
                                    댓글이 없습니다.
                                </div>
                            </li>
                        @endforelse
                        
                    </ul>
                    <!--<a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>-->
                </div>
            </div>
        </div>
        
        <div>            
            <form name="cform" method="post" action="">
                @csrf
                <div class='commentarea'>
                    <input type="hidden" name="boardsid" value="{{ $view->id }}" />
                    <div class="col-10 pe-2">
                        <textarea name="comment" placeholder="댓글" class="form-control comment"></textarea>
                    </div>
                    <div class="col-2 btn btn-sm btn-success comment">등록</div>
                </div>
            </form>
        </div>

        <form name="cmtform" method="post" action="">
            @csrf
            <input type="hidden" name="id" value="0" />
        </form>
    </div>    
@endsection