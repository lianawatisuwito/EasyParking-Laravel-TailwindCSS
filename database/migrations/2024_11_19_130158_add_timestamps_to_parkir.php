<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndTimestampsToParkirTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('parkir', function (Blueprint $table) {
            // Menambahkan kolom status dengan nilai default 'masuk'
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');

            // Menambahkan kolom timestamps (created_at dan updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parkir', function (Blueprint $table) {
            // Menghapus kolom status
            $table->dropColumn('status');

            // Menghapus kolom timestamps
            $table->dropTimestamps();
        });
    }
}
