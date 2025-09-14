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
        // Pastikan sudah menginstall doctrine/dbal sebelum menjalankan migration ini:
        // composer require doctrine/dbal

        Schema::table('hasil_analisis', function (Blueprint $table) {
            // ubah data_point dari integer ke json (nullable)
            // NOTE: requires doctrine/dbal to be installed for change()
            if (Schema::hasColumn('hasil_analisis', 'data_point')) {
                $table->json('data_point')->nullable()->change();
            } else {
                $table->json('data_point')->nullable();
            }

            // tambahkan kolom baru untuk menyimpan hasil regresi dan waktu paruh
            if (!Schema::hasColumn('hasil_analisis', 'regression_results')) {
                $table->json('regression_results')->nullable()->after('data_point');
            }
            if (!Schema::hasColumn('hasil_analisis', 'half_life')) {
                $table->json('half_life')->nullable()->after('regression_results');
            }

            // jika kolom 'graf' sudah ada sebagai json, biarkan. Jika belum, pastikan ada:
            if (!Schema::hasColumn('hasil_analisis', 'graf')) {
                $table->json('graf')->nullable()->after('hasil_analisis');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {
            // rollback: ubah kembali data_point ke integer nullable (jika perlu)
            if (Schema::hasColumn('hasil_analisis', 'data_point')) {
                // hati-hati: konversi dari JSON -> integer tidak otomatis.
                // Disarankan backup DB sebelum rollback.
                $table->integer('data_point')->nullable()->change();
            }

            if (Schema::hasColumn('hasil_analisis', 'regression_results')) {
                $table->dropColumn('regression_results');
            }
            if (Schema::hasColumn('hasil_analisis', 'half_life')) {
                $table->dropColumn('half_life');
            }
        });
    }
};