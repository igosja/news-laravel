<?php
declare(strict_types=1);

/**
 * @var \App\Models\Comment[] $comments
 * @var \App\Models\Language $language
 * @var \App\Models\Post $post
 */

?>
@extends('layouts.layout')

@section('content')
    <h1 class="text-center">{{ $post->translation_title[App::getLocale()] }}</h1>
    <div class="row small">
        <div class="col-9 text-muted">
            {{ $post->updated_at }}
            (<strong>{{ $post->createdBy()->first()->name }}</strong>)
            |
            Views: {{ $post->views }}
            |
            Comments: {{ $post->comment($language)->count() }}
        </div>
        <div class="col-3 text-end">
            <a href="{{ route('post_rating', ['post' => $post, 'value' => 1]) }}">+</a>
            {{ $post->totalRating() }}
            <a href="{{ route('post_rating', ['post' => $post, 'value' => -1]) }}">-</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($post->image_id)
                <img
                        class="img-fluid"
                        alt="{{ $post->translation_title[App::getLocale()] }}"
                        src="/uploads/{{ \App\Helpers\ImageHelper::resize($post->image()->first(), 1140, 641) }}"
                >
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {{ $post->translation_text[App::getLocale()] }}
        </div>
    </div>
    <hr/>
    <div class="row small">
        <div class="col-12 text-center mb-2">
            Comments:
        </div>
    </div>
    <div class="row small">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form method="POST" action="{{ route('post_save_comment', ['post' => $post]) }}">
                @csrf
                @method('POST')
                <div class="mb-3 required">
                    <label class="form-label" for="text">Text</label>
                    <textarea id="text" class="form-control @error('text') is-invalid @enderror"
                              name="text">{{ old('text') }}</textarea>
                    @error('text')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="submit" class="btn btn-default">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="list-view">
        @foreach ($comments as $comment)
            <div data-key="{{ $comment->id }}">
                <div class="col-row mt-2">
                    <div class="col-12 small text-muted">
                        {{ $comment->created_at }}
                        (<strong>{{ $comment->createdBy()->first()->name }}</strong>)
                    </div>
                    <div class="col-12">
                        {{ $comment->text }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
