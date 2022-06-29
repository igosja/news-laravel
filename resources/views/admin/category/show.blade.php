<?php
declare(strict_types=1);

/**
 * @var \App\Models\Category $category
 * @var \App\Models\Language[] $languages
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">{{ $category->name }}</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('category.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('category.edit', ['category' => $category]) }}">Update</a>
        </li>
        <li class="list-inline-item">
            <form action="{{ route('category.destroy', ['category' => $category]) }}" method="POST">
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
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $category->name }}</td>
            </tr>
            @foreach ($languages as $language)
                <tr>
                    <td>Translation ({{ $language->code }})</td>
                    <td>{{ $category->translation[$language->code] }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Is active</td>
                <td>{{ $category->is_active }}</td>
            </tr>
            <tr>
                <td>Created at</td>
                <td>{{ $category->created_at }}</td>
            </tr>
            <tr>
                <td>Updated at</td>
                <td>{{ $category->updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
