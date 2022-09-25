@extends('layout.default')

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{ route('board.store') }}">
        <div class="row justify-content-center">
            <div>
                @include('board.partial.form')
            </div>
        </div>
        <hr>
        <div class="btnbox text-right">
            <button type="submit" class="btn btn-sm btn-primary">
                등록
            </button>
            <a href="{{ route('board.index', ['page' => app('request')->input('page')]) }}" class="btn btn-sm btn-danger">
                취소
            </a>
        </div>
    </form>
@endsection