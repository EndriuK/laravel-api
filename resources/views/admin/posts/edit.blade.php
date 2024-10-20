@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Modifica post</h2>
            </div>
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.posts.update', ['post' => $post]) }}" method="post">
                    @csrf
                    @method('PUT')
                   <div class="row gy-3">
                        <div class="col-12">
                            <label for="title" class="control-label">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control form-control-sm @error('title')) is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old('title', $post->title) }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> 
                        <div class="col-12">
                            @if (Str::startsWith($post->cover_image, 'https'))
                                <img class="cover_image" src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                            @else
                                <img class="cover_image" src="{{ asset('./storage/'.$post->cover_image)}}" alt="{{ $post->title }}">
                            @endif
                            <div class="mt-3">
                                <label for="" class="control-label">Immagine di copertina</label>
                                <input type="file" name="cover_image" id="cover_image" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" class="control-label">Categorie</label>
                            <select name="category_id" id="category_id" class="form-select form-select-sm @error('category_id') is-invalid @enderror" required>
                                <option value="">-Seleziona una categoria-</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == old('category_id', $post->category ? $post->category->id : ''))>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="control-label">Seleziona tag</label>
                            <div>
                                @foreach ($tags as $tag)
                                    <div class="form-check-inline">
                                        @if ($errors->any())
                                        <input type="checkbox" name="tags[]" id="" class="form-check-input" value="{{ $tag->id}}" {{ in_array($tag->id, old('tags')) ? 'checked' : ''}}>
                                        @else
                                            <input type="checkbox" name="tags[]" id="" class="form-check-input" value="{{ $tag->id}}" @checked($post->tags->contains($tag->id ? 'checked' : ''))>
                                        @endif
                                        {{-- <input type="checkbox" name="tags[]" id="" class="form-check-input" value="{{$tag->id}}" @checked(is_array(old('tags') && in_array($tag->id, old('tags '))))> --}}
                                        <label class="form-check-label" for="">{{$tag->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="content" class="control-label">Contenuto</label>
                            <textarea name="content" id="content-post" class="form-control form-control-sm" rows="10" cols="30">{{ old('content', $post->content) }}</textarea>
                        </div>  
                        <div class="col-12">
                            <button class="btn btn-sm btn-success" type="submit">Salva</button>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
@endsection