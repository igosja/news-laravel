<?php
declare(strict_types=1);

/**
 * @var \App\Models\Language $language
 */

?>
@extends('admin.layouts.layout')

@section('content')
    <h1 class="text-center">Update language</h1>
    <ul class="list-inline text-center">
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('language.index') }}">List</a>
        </li>
        <li class="list-inline-item">
            <a class="btn btn-default" href="{{ route('language.show', ['language' => $language]) }}">View</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form method="POST" action="{{ route('language.update', ['language' => $language]) }}">
                @csrf
                @method('PUT')
                <div class="mb-3 required">
                    <label class="form-label" for="name">Name</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name', $language->name) }}"/>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 required">
                    <label class="form-label" for="code">Code</label>
                    <input id="code" class="form-control @error('code') is-invalid @enderror" name="code"
                           value="{{ old('code', $language->code) }}"/>
                    @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active"
                               class="form-check-input @error('is_active') is-invalid @enderror" name="is_active"
                               value="1" @checked(old('is_active', $language->is_active))>
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
