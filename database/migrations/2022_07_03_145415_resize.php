<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'resizes';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->integer('height');
            $table->bigInteger('image_id')->unsigned();
            $table->string('path');
            $table->integer('width');
            $table->timestamps();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->foreign('image_id')->references('id')->on('images');
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
