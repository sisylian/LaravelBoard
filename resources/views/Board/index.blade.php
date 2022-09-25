@extends('layout.default')

@section('content')
    @component('layout.alert')
        <strong>Whoops!</strong> Something went wrong!
    @endcomponent
    <div class="text-right">
        <a class="btn btn-sm btn-primary" href="{{ route('board.create') }}">
            글작성
        </a>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table text-center simonboard">
            <colgroup>
                <col width="80" />
                <col width="*" />
                <col width="120"/>
                <col width="220"/>
            </colgroup>
            <thead class="bg-secondary text-white">
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
            </thead>
            <tbody>
            @forelse($lists as $list)
                <tr data-id="{{ $list-> id}}">
                    <td>{{ $lists->total() - ($lists->perPage() * ($lists->currentPage() - 1)) - $loop->index }}</td>
                    <td>{{ $list-> title}}</td>
                    <td>{{ $list-> name}}</td>
                    <td>{{ $list-> created_at}}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="4">게시판이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div>
            {{$lists->links()}}
        </div>
    </div>
    <input type="hidden" name="page" value="{{ $lists->currentpage() }}" />
@endsection