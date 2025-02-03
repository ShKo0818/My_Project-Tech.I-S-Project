<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // 例: create_categories_table.php

   public function up()
   {
       Schema::table('items', function (Blueprint $table) {
           if (!Schema::hasColumn('items', 'category')) {
               $table->string('category')->nullable();
           }
       });
   }
   

public function down()
{
    Schema::dropIfExists('categories');
}

};
