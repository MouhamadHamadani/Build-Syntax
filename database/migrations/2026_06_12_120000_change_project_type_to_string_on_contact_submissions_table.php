<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Convert contact_submissions.project_type from ENUM to VARCHAR(30).
     *
     * Why: the live contact form now submits 'appointment' and 'pos', which
     * the original ENUM('website','ecommerce','mobile_app','other') rejects
     * on MySQL with STRICT_TRANS_TABLES (insert fails -> lead lost). A plain
     * string lets application-level validation own the whitelist (see
     * config/products.php), so adding future products never requires a
     * schema migration.
     *
     * Driver safety: uses the schema builder's native change() (no raw SQL).
     * On MySQL this compiles to MODIFY COLUMN (existing rows and indexes are
     * preserved); on SQLite (the :memory: test suite) Laravel recreates the
     * table transparently.
     *
     * Data: existing values ('website','ecommerce','mobile_app','other') are
     * all valid VARCHAR(30) values and survive untouched. 'mobile_app' rows
     * are historical leads and are intentionally NOT rewritten.
     */
    public function up(): void
    {
        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->string('project_type', 30)->default('website')->change();
        });
    }

    /**
     * Restore the original ENUM definition.
     *
     * NOTE: on MySQL (strict mode) this rollback will FAIL if any rows hold
     * values outside the original enum (e.g. 'appointment', 'pos') — those
     * rows would need to be remapped or removed first. This is a documented,
     * accepted trade-off: rolling back after new-product leads exist is not
     * expected.
     */
    public function down(): void
    {
        Schema::table('contact_submissions', function (Blueprint $table) {
            $table->enum('project_type', ['website', 'ecommerce', 'mobile_app', 'other'])
                ->default('website')
                ->change();
        });
    }
};
