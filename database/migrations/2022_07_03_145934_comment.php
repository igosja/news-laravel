<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'comments';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->text('text');
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
