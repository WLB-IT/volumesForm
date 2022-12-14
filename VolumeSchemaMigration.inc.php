<?php

/**
 * @file classes/migration/VolumeSchemaMigration.inc.php
 *
 * @class VolumeSchemaMigration
 * @brief Describe database table structures.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;


class VolumeSchemaMigration extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		// Volumes.
		Capsule::schema()->create('volumes', function (Blueprint $table) {
			$table->bigInteger('volume_id')->autoIncrement();
			$table->bigInteger('context_id');
			$table->string('path', 255);
			$table->text('image')->nullable();
		});

		// Volume Settings.
		Capsule::schema()->create('volume_settings', function (Blueprint $table) {
			$table->bigInteger('volume_id');
			$table->string('locale', 14)->default('');
			$table->string('setting_name', 255);
			$table->longText('setting_value')->nullable();
			$table->string('setting_type', 6)->comment('string');
			$table->index(['volume_id'], 'volume_settings_id');
			$table->unique(['volume_id', 'locale', 'setting_name'], 'volume_settings_pkey');
		});
	}
}
