<?php
declare(strict_types=1);

/**
 * @var \App\Models\Post $post
 * @var \App\Models\Language[] $languages
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">{{ $post->name }}</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('post.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('post.edit', ['post' => $post]) }}">Update</a>
        </li>
        <li class="list-inline-item">
            <form action="{{ route('post.destroy', ['post' => $post]) }}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-default" href="javascript:" onclick="$(this).closest('form').submit()">Delete</a>
            </form>
        </li>
    </ul>
    <div class="row">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <tr>
                <td>Id</td>
                <td>{{ $post->id }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $post->name }}</td>
            </tr>
            <tr>
                <td>Url</td>
                <td>{{ $post->url }}</td>
            </tr>
            <tr>
                <td>Category</td>
                <td>{{ $post->category()->first()->name }}</td>
            </tr>
            @foreach ($languages as $language)
                <tr>
                    <td>Translation title ({{ $language->code }})</td>
                    <td>{{ $post->translation_title[$language->code] }}</td>
                </tr>
            @endforeach
            @foreach ($languages as $language)
                <tr>
                    <td>Translation text ({{ $language->code }})</td>
                    <td>{{ $post->translation_text[$language->code] }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Is active</td>
                <td>{{ $post->is_active }}</td>
            </tr>
            <tr>
                <td>Created by</td>
                <td>{{ $post->createdBy()->first()->name }}</td>
            </tr>
            <tr>
                <td>Created at</td>
                <td>{{ $post->created_at }}</td>
            </tr>
            <tr>
                <td>Updated by</td>
                <td>{{ $post->updatedBy()->first()->name }}</td>
            </tr>
            <tr>
                <td>Updated at</td>
                <td>{{ $post->updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
