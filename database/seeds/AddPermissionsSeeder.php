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
                'agentContact.menu',
                'agentContact.index',
                'agentContact.store',
                'agentContact.update',
                'agentContact.destroy',
                'agentContact.import',
                'agentContact.export',
            ],
            'providerList' => [
                'providerList.menu',
                'providerList.index',
                'providerList.store',
                'providerList.update',
                'providerList.destroy',
            ],
            'school' => [
                'school.menu',
                'school.index',
                'school.store',
                'school.update',
                'school.destroy',
            ],
            'service' => [
                'service.menu',
                'service.index',
                'service.store',
                'service.update',
                'service.destroy',
            ],
            'status' => [
                'status.menu',
                'status.index',
                'status.store',
                'status.update',
                'status.destroy',
            ],
            'templateInvoiceManager' => [
                'templateInvoiceManager.menu',
                'templateInvoiceManager.index',
                'templateInvoiceManager.store',
                'templateInvoiceManager.update',
                'templateInvoiceManager.destroy',
            ],
            'kho' => [
                'kho.menu',
                'kho.index',
                'kho.store',
                'kho.update',
                'kho.destroy',
            ],
            'itSystem' => [
                'itSystem.menu',
                'itSystem.index',
                'itSystem.store',
                'itSystem.update',
                'itSystem.destroy',
            ],
            'bank' => [
                'bank.menu',
                'bank.index',
                'bank.store',
                'bank.update',
                'bank.destroy',
            ],
            'exchangeRate' => [
                'exchangeRate.menu',
                'exchangeRate.index',
                'exchangeRate.store',
                'exchangeRate.update',
                'exchangeRate.destroy',
            ],
            'campaign' => [
                'campaign.menu',
                'campaign.index',
                'campaign.store',
                'campaign.update',
                'campaign.destroy',
            ],
            'media' => [
                'media.menu',
                'media.index',
                'media.store',
                'media.update',
                'media.destroy',
            ],
            'report' => [
                'report.menu',
                'report.index',
                'report.store',
                'report.update',
                'report.destroy',
            ],
            'configLuckyDraw' => [
                'configLuckyDraw.menu',
                'configLuckyDraw.index',
                'configLuckyDraw.store',
                'configLuckyDraw.update',
                'configLuckyDraw.destroy',
            ]
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
