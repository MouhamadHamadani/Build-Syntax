<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // One row per service: the four products, custom development, hosting and maintenance.
        Schema::create('catalog_services', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 60)->unique();
            $table->string('kind', 20)->index();          // product, custom, hosting, maintenance
            $table->string('name', 80);
            $table->string('label', 80)->nullable();      // short tag: "Appointments"
            $table->string('project_type', 30)->nullable(); // value of the contact form type
            $table->string('accent', 20)->default('brand');
            $table->string('site_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('demo_label', 80)->nullable();
            $table->string('headline_price', 40)->nullable(); // shown as "From {price}" on cards
            $table->string('headline_unit', 60)->nullable();  // suffix after the headline price
            $table->text('description')->nullable();
            $table->text('intro')->nullable();            // Services page intro (custom, hosting, maintenance)
            $table->text('note')->nullable();             // line under the plans on the home page
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            // Keys the views read whole and never filter on: blurb, card_unit, plans_label, for, for_extra,
            // for_extra_strong, features[], points[], stack[], headline, cta, heading, anchor,
            // legacy_anchors[], secondary_cta, service_note{strong,text}, minimum_months.
            $table->json('details')->nullable();
            $table->timestamps();
        });

        Schema::create('catalog_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('catalog_services')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('name', 80);
            $table->string('price', 40);                  // display string, exactly as shown: "$349", "From $800", "Contact us"
            $table->string('unit', 60)->nullable();       // suffix on the home card: "/mo"
            $table->string('period', 60)->nullable();     // suffix on the Services card: " / month"
            $table->string('billing', 120)->nullable();   // "or $190 a year"
            $table->text('summary')->nullable();
            $table->text('description')->nullable();      // product plans: line on the home card
            $table->string('meta', 200)->nullable();      // timing and support line
            $table->string('cta', 80)->default('Request this plan');
            $table->string('plan_key', 80)->nullable();   // value sent as ?plan= when it differs from the name
            $table->boolean('is_featured')->default(false);
            $table->json('extra')->nullable();            // weeks [min, max] and support_months
            $table->timestamps();

            $table->index(['service_id', 'sort_order']);
        });

        Schema::create('catalog_plan_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('catalog_plans')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('text', 200);

            $table->index(['plan_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_plan_features');
        Schema::dropIfExists('catalog_plans');
        Schema::dropIfExists('catalog_services');
    }
};
