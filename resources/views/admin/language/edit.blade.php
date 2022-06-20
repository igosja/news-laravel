<?php
declare(strict_types=1);

/**
 * @var \App\Models\Language $language
 */

?>
<form method="POST" action="{{ route('language.update', ['language' => $language]) }}">
    @csrf
    @method('PUT')

    <label for="code">Code</label>
    <input id="code" name="code" value="{{ $language->code }}"/>
    <label for="name">Name</label>
    <input id="name" name="name" value="{{ $language->name }}"/>
    <label for="is_active">Is active</label>
    <input type="hidden" name="is_active" value="0"/>
    <input type="checkbox" id="is_active" name="is_active" value="1" @checked($language->is_active) />
    <button>Submit</button>
</form>