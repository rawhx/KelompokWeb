<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void 
    {
        Schema::table('comments', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['post_id']);

            // Rename kolom dari post_id ke image_id
            $table->renameColumn('post_id', 'image_id');
        });

        Schema::table('comments', function (Blueprint $table) {
            // Tambah foreign key baru
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        
    }

};
