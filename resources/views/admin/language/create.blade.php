<?php
declare(strict_types=1);

/**
 * @var \App\Models\Language[] $languages
 */

?>
<form method="POST" action="{{ route('language.store') }}">
    @csrf

    <label for="code">Code</label>
    <input id="code" name="code"/>
    <label for="name">Name</label>
    <input id="name" name="name"/>
    <label for="is_active">Is active</label>
    <input type="hidden" name="is_active" value="0"/>
    <input type="checkbox" id="is_active" name="is_active" value="1"/>
    <button>Submit</button>
</form>