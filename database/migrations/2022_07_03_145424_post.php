<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'posts';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('image_id')->unsigned();
            $table->boolean('is_active');
            $table->string('name');
            $table->json('translation_text');
            $table->json('translation_title');
            $table->bigInteger('updated_by')->unsigned();
            $table->string('url')->unique();
            $table->integer('views')->default(0);
            $table->timestamps();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');
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
