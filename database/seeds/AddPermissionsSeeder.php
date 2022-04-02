<?php

use Illuminate\Database\Seeder;

class AddPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $permissions = [
            'agentContact' => [
                'agentContact.index',
                'agentContact.store',
                'agentContact.update',
                'agentContact.destroy',
                'agentContact.import',
                'agentContact.export',
            ],
            'providerList' => [
                'providerList.index',
                'providerList.store',
                'providerList.update',
                'providerList.destroy',
            ],
            'school' => [
                'school.index',
                'school.store',
                'school.update',
                'school.destroy',
            ],
            'service' => [
                'service.index',
                'service.store',
                'service.update',
                'service.destroy',
            ],
            'status' => [
                'status.index',
                'status.store',
                'status.update',
                'status.destroy',
            ],
        ];

        foreach ($permissions as $keyPermissionType => $arrPermission) {
            foreach ($arrPermission as $permission) {
                if (!\Spatie\Permission\Models\Permission::whereName($permission)->exists()) {
                    \Spatie\Permission\Models\Permission::create([
                        'name' => $permission,
                        'type' => $keyPermissionType,
                        'guard_name' => 'admin'
                    ]);
                }
            }
        }
    }
}
