<?php
declare(strict_types=1);

/**
 * @var \App\Models\Language $language
 */

?>
<table>
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
</table>
