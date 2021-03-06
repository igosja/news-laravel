<?php
declare(strict_types=1);

/**
 * @var \App\Models\Language $language
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">{{ $language->name }}</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('language.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('language.edit', ['language' => $language]) }}">Update</a>
        </li>
        <li class="list-inline-item">
            <form action="{{ route('language.destroy', ['language' => $language]) }}" method="POST">
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
                <td>{{ $language->id }}</td>
            </tr>
            <tr>
                <td>Code</td>
                <td>{{ $language->code }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $language->name }}</td>
            </tr>
            <tr>
                <td>Is active</td>
                <td>{{ $language->is_active }}</td>
            </tr>
            <tr>
                <td>Created at</td>
                <td>{{ $language->created_at }}</td>
            </tr>
            <tr>
                <td>Updated at</td>
                <td>{{ $language->updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
