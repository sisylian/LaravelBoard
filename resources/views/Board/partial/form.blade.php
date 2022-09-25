@csrf
<div class="form-group mt-4">
    <input type="hidden" id="id" name="id" value="{{ old('id', $form->id ?? 0) }}" />
    <div>
        <input type="text" id="title" name="title" placeholder="제목" class="form-control mb-3 @error('title') is-invalid @enderror" value="{{ old('title', $form->title) }}">
        
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <textarea name="description" placeholder="내용" class="form-control">{{ old('description', $form->description) }}</textarea>

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>