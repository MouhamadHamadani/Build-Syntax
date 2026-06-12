<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Convert portfolio_projects.category from ENUM to VARCHAR(30) and remap
     * legacy 'mobile' rows to 'other'.
     *
     * Why: the public portfolio filter offers 'pos', which the original
     * ENUM('web','ecommerce','mobile','other') can never store, and 'mobile'
     * is no longer a sold product. A plain string lets application-level
     * validation own the whitelist (see config/products.php).
     *
     * Driver safety: data remap uses the driver-agnostic query builder; the
     * type change uses the schema builder's native change() (no raw SQL).
     * On MySQL this compiles to MODIFY COLUMN, which preserves the existing
     * ['category','featured'] composite index; on SQLite Laravel recreates
     * the table (indexes included). A defensive guard below recreates the
     * index if a driver ever drops it during the conversion.
     */
    public function up(): void
    {
        // Remap legacy 'mobile' rows (product not sold) to 'other'. 'other'
        // is valid under both the old enum and the new string, so ordering
        // before the type change is safe. DB::table() bypasses soft-delete
        // scoping, so trashed rows are remapped too.
        DB::table('portfolio_projects')
            ->where('category', 'mobile')
            ->update(['category' => 'other']);

        Schema::table('portfolio_projects', function (Blueprint $table) {
            $table->string('category', 30)->default('web')->change();
        });

        // Defensive: recreate the composite index if the conversion dropped
        // it (it should survive on both MySQL and SQLite, but this keeps the
        // migration self-healing across drivers).
        if (! in_array(
            'portfolio_projects_category_featured_index',
            Schema::getIndexListing('portfolio_projects'),
            true
        )) {
            Schema::table('portfolio_projects', function (Blueprint $table) {
                $table->index(['category', 'featured']);
            });
        }
    }

    /**
     * Restore the original ENUM definition.
     *
     * NOTE: the 'mobile' -> 'other' remap is intentionally NOT reversed
     * (which rows were 'mobile' is no longer knowable). On MySQL (strict
     * mode) this rollback will FAIL if any rows hold values outside the
     * original enum (e.g. 'pos') — documented, accepted trade-off.
     */
    public function down(): void
    {
        Schema::table('portfolio_projects', function (Blueprint $table) {
            $table->enum('category', ['web', 'ecommerce', 'mobile', 'other'])
                ->default('web')
                ->change();
        });

        if (! in_array(
            'portfolio_projects_category_featured_index',
            Schema::getIndexListing('portfolio_projects'),
            true
        )) {
            Schema::table('portfolio_projects', function (Blueprint $table) {
                $table->index(['category', 'featured']);
            });
        }
    }
};
