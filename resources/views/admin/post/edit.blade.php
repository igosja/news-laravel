<?php
declare(strict_types=1);

/**
 * @var \App\Models\Category[] $categories
 * @var \App\Models\Language[] $languages
 * @var \App\Models\Post $post
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">Update post</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('post.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('post.show', ['post' => $post]) }}">View</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form method="POST" action="{{ route('post.update', ['post' => $post]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 required">
                    <label class="form-label" for="name">Name</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name', $post->name) }}"/>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 required">
                    <label class="form-label" for="category_id">Category</label>
                    <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                            name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 required">
                    <label class="form-label" for="url">Url</label>
                    <input id="url" class="form-control @error('url') is-invalid @enderror" name="url"
                           value="{{ old('url', $post->url) }}"/>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if ($post->image_id)
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Image</label>
                        <div class="col-md-6">
                            <a href="{{ route('admin_post_delete_image', ['post' => $post]) }}">×</a>
                            <img src="/uploads/{{ $post->image()->first()->path }}" class="img-fluid" alt="img"/>
                        </div>
                    </div>
                @else
                    <div class="mb-3 required">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" id="image" class="form-control @error('image') is-invalid @enderror"
                               name="image"/>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                @foreach ($languages as $language)
                    <div class="mb-3 required">
                        <label class="form-label" for="translation_title_{{ $language->code }}">Translation title
                            ({{ $language->code }})</label>
                        <input id="translation_title_{{ $language->code }}"
                               class="form-control @error('translation_title.' . $language->code) is-invalid @enderror"
                               name="translation_title[{{ $language->code }}]"
                               value="{{ old('translation_title.' . $language->code, $post->translation_title[$language->code]) }}"/>
                        @error('translation_title.' . $language->code)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                @foreach ($languages as $language)
                    <div class="mb-3 required">
                        <label class="form-label" for="translation_text_{{ $language->code }}">Translation text
                            ({{ $language->code }})</label>
                        <textarea id="translation_text_{{ $language->code }}"
                                  class="form-control @error('translation_text.' . $language->code) is-invalid @enderror"
                                  name="translation_text[{{ $language->code }}]"
                        >{{ old('translation_text.' . $language->code, $post->translation_text[$language->code]) }}</textarea>
                        @error('translation_text.' . $language->code)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                <div class="mb-3">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active"
                               class="form-check-input @error('is_active') is-invalid @enderror" name="is_active"
                               @checked(old('is_active', $post->is_active))
                               value="1">
                        <label class="form-check-label" for="is_active">Is active</label>
                        @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="submit" class="btn btn-default">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
