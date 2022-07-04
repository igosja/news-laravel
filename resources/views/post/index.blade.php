<?php
declare(strict_types=1);

/**
 * @var \App\Models\Category[] $categories
 * @var \App\Models\Language $language
 * @var \App\Models\Post[] $posts
 */

?>
@extends('layouts.layout')

@section('content')
    <div class="site-index">
        <h1 class="text-center">Posts</h1>
        <ul class="list-inline text-center">
            @foreach ($categories as $category)
                <li class="list-inline-item">
                    <a href="{{ route('post', ['category' => $category]) }}">
                        {{ $category->translation[App::getLocale()] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="list-view">
            @foreach ($posts as $post)
                <div data-key="{{ $post->id }}">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 rounded">
                        <div class="row">
                            <div class="col-12">
                                @if ($post->image_id)
                                    <img class="img-fluid"
                                         src="/uploads/{{ \App\Helpers\ImageHelper::resize($post->image, 569, 320) }}"
                                         alt="{{ $post->translation_title[App::getLocale()] }}">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 small text-muted">
                                {{ $post->created_at }}
                                (<strong>{{ $post->createdBy->name }}</strong>)
                                |
                                Views: {{ $post->views }}
                                |
                                Comments: {{ count($post->comment) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-truncate">
                                {{ $post->translation_text[App::getLocale()] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-outline-secondary"
                                   href="{{ route('post_view', ['url' => $post->url]) }}">
                                    Read
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
