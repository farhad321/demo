<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class general extends SettingsMigration
{
    public function up(): void
    {
     $this->migrator->add('general.site_name', 'Spatie');
     $this->migrator->add('general.site_active', true);
    }
}
