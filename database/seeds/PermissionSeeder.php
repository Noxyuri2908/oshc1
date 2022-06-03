<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        \DB::table('permissions')->delete();
        \DB::table('employee_access_lists')->delete();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $permissions = [
            'dashboard' => [
                'dashboard.index'
            ],
            'role' => [
                'roles.index',
                'roles.store',
                'roles.show',
                'roles.update',
                'roles.destroy',
                'roles.setPermission'
            ],
            'user' => [
                'users.viewAny',
                'users.store',
                'users.show',
                'users.update',
                'users.destroy',
            ],
            'google_calendar' => [
                'google_calendar.index',
                'google_calendar.login',
                'google_calendar.store',
                'google_calendar.edit',
                'google_calendar.update',
                'google_calendar.delete'
            ],
            'flywire' => [
                'flywire.index',
                'flywire.store',
                'flywire.edit',
                'flywire.update',
                'flywire.delete',
                'flywire.columnComFromProvider',
                'flywire.columnUnitComFromProvider',
                'flywire.columnExchangeInAudProvider',
                'flywire.columnComInAudProvider',
                'flywire.columnProviderPaidDate',
                'flywire.columnProfitAud',
                'flywire.columnProfitVnd',
                'flywire.columnComAnnalink',
                'flywire.commissionAndProfit.show',
                'flywire.commissionAndProfit.store'
            ],
            'status' => [
                'status.index',
                'status.store',
                'status.edit',
                'status.update',
                'status.delete'
            ],
            'archive-media-link' => [
                'archive-media-link.index',
                'archive-media-link.store',
                'archive-media-link.edit',
                'archive-media-link.update',
                'archive-media-link.delete'
            ],
            'archive-media-content' => [
                'archive-media-content.index',
                'archive-media-content.store',
                'archive-media-content.edit',
                'archive-media-content.update',
                'archive-media-content.delete'
            ],
            'google-adword-media' => [
                'google-adword-media.index',
                'google-adword-media.store',
                'google-adword-media.edit',
                'google-adword-media.update',
                'google-adword-media.delete'
            ],
            'check-list-group' => [
                'check-list-group.index',
                'check-list-group.store',
                'check-list-group.edit',
                'check-list-group.update',
                'check-list-group.delete'
            ],
            'check-list' => [
                'check-list.index',
                'check-list.store',
                'check-list.edit',
                'check-list.update',
                'check-list.delete'
            ],
            'domain-hosting-manager' => [
                'domain-hosting-manager.index',
                'domain-hosting-manager.store',
                'domain-hosting-manager.edit',
                'domain-hosting-manager.update',
                'domain-hosting-manager.delete'
            ],
            'email-skype-manager' => [
                'email-skype-manager.index',
                'email-skype-manager.store',
                'email-skype-manager.edit',
                'email-skype-manager.update',
                'email-skype-manager.delete'
            ],
            'website-account-manager' => [
                'website-account-manager.index',
                'website-account-manager.store',
                'website-account-manager.edit',
                'website-account-manager.update',
                'website-account-manager.delete'
            ],
            'serviceAccount'=>[
                'serviceAccount.index',
                'serviceAccount.store',
                'serviceAccount.edit',
                'serviceAccount.update',
                'serviceAccount.delete'
            ],
            'traffice' => [
                'traffice.index',
                'traffice.store',
                'traffice.edit',
                'traffice.update',
                'traffice.delete'
            ],
            'seo-keyword' => [
                'seo-keyword.index',
                'seo-keyword.store',
                'seo-keyword.edit',
                'seo-keyword.update',
                'seo-keyword.delete'
            ],
            'it-checklist' => [
                'it-checklist.index',
                'it-checklist.store',
                'it-checklist.edit',
                'it-checklist.update',
                'it-checklist.delete'
            ],
            'marketing-material' => [
                'marketing-material.index',
                'marketing-material.store',
                'marketing-material.edit',
                'marketing-material.update',
                'marketing-material.delete'
            ],
            'customer'=>[
                'customer.index',
                'customer.store',
                'customer.edit',
                'customer.update',
                'customer.delete',
                'customer.sendEmail',
            ],
            'commissionInvoice'=>[
                'commissionInvoice.index',
                'commissionInvoice.store',
                'commissionInvoice.edit',
                'commissionInvoice.update',
                'commissionInvoice.delete',
                'commissionInvoice.sendEmail'
            ],
            'profitInvoice'=>[
                'profitInvoice.index',
                'profitInvoice.store',
                'profitInvoice.edit',
                'profitInvoice.update',
                'profitInvoice.delete',
                'profitInvoice.sendEmail'
            ],
            'refundInvoice'=>[
                'refundInvoice.index',
                'refundInvoice.store',
                'refundInvoice.edit',
                'refundInvoice.update',
                'refundInvoice.delete',
                'refundInvoice.sendEmail'
            ],
            'extendInvoice'=>[
                'extendInvoice.index',
                'extendInvoice.store',
                'extendInvoice.edit',
                'extendInvoice.update',
                'extendInvoice.delete',
                'extendInvoice.remindStatus',
                'extendInvoice.extend',
                'extendInvoice.sendEmail'
            ],
            'customerReceipt'=>[
                'customerReceipt.index',
                'customerReceipt.store',
                'customerReceipt.edit',
                'customerReceipt.update',
                'customerReceipt.delete'
            ],
            'customerDoc'=>[
                'customerDoc.index',
                'customerDoc.store',
                'customerDoc.edit',
                'customerDoc.update',
                'customerDoc.delete'
            ],
            'customerManager'=>[
                'customerManager.index',
                'customerManager.store',
                'customerManager.edit',
                'customerManager.update',
                'customerManager.delete'
            ],
            'mediaTask'=>[
                'mediaTask.index'
            ],
            'mediaCheckList'=>[
                'mediaCheckList.index',
                'mediaCheckList.store',
                'mediaCheckList.edit',
                'mediaCheckList.update',
                'mediaCheckList.delete'
            ],
            'mediaManagerWebsite'=>[
                'mediaManagerWebsite.index',
                'mediaManagerWebsite.store',
                'mediaManagerWebsite.edit',
                'mediaManagerWebsite.update',
                'mediaManagerWebsite.delete'
            ],
            'mediaManagerFanpage'=>[
                'mediaManagerFanpage.index',
                'mediaManagerFanpage.store',
                'mediaManagerFanpage.edit',
                'mediaManagerFanpage.update',
                'mediaManagerFanpage.delete'
            ],
            'mediaManagerGroup'=>[
                'mediaManagerGroup.index',
                'mediaManagerGroup.store',
                'mediaManagerGroup.edit',
                'mediaManagerGroup.update',
                'mediaManagerGroup.delete'
            ],
            'providerCom'=>[
                'providerCom.index',
                'providerCom.store',
                'providerCom.edit',
                'providerCom.update',
                'providerCom.delete'
            ],
            'agent'=>[
                'agent.index',
                'agent.store',
                'agent.edit',
                'agent.update',
                'agent.process',
                'agent.sendEmail',
                'agent.delete'
            ],
            'commissionAgent'=>[
                'commissionAgent.index',
                'commissionAgent.store',
                'commissionAgent.edit',
                'commissionAgent.update',
                'commissionAgent.delete'
            ],
            'followUp'=>[
                'followUp.index',
                'followUp.store',
                'followUp.edit',
                'followUp.update',
                'followUp.delete'
            ],
            'agentFeedback'=>[
                'agentFeedback.index',
                'agentFeedback.store',
                'agentFeedback.edit',
                'agentFeedback.update',
                'agentFeedback.delete'
            ],
            'competitorUpdate'=>[
                'competitorUpdate.index',
                'competitorUpdate.store',
                'competitorUpdate.edit',
                'competitorUpdate.update',
                'competitorUpdate.delete'
            ],
            'tasksAsigned'=>[
                'tasksAsigned.index',
                'tasksAsigned.store',
                'tasksAsigned.edit',
                'tasksAsigned.update',
                'tasksAsigned.delete'
            ],
            'proposal'=>[
                'proposal.index',
                'proposal.store',
                'proposal.edit',
                'proposal.update',
                'proposal.delete'
            ],
            'training'=>[
                'training.index',
                'training.store',
                'training.edit',
                'training.update',
                'training.delete'
            ],
            'agentReport'=>[
                'agentReport.index'
            ],
            'processingFollowUp'=>[
                'processingFollowUp.index'
            ],
        ];

        foreach ($permissions as $keyPermissionType => $arrPermission) {
            foreach ($arrPermission as $permission) {
                if (!Permission::whereName($permission)->exists()) {
                    Permission::create([
                        'name' => $permission,
                        'type' => $keyPermissionType,
                        'guard_name' => 'admin'
                    ]);
                }
            }
        }

        // create roles and assign created permissions
//        Role::findByName('Super Admin')->givePermissionTo(Permission::all());
        \DB::table('roles')->delete();
        Role::create([
            'name'=>'Super Admin',
            'guard_name' => 'admin'
        ]);
        Role::where('name','Super Admin')
            ->where('guard_name','admin')
            ->first()
            ->givePermissionTo(Permission::all());
        Admin::where('username','Admin')->first()->assignRole('Super Admin');
//        Admin::where('username', 'Admin')->delete();
//        $user = Admin::create([
//            'username' => 'Admin',
//            'email' => 'admin@admin.com',
//            'role' => '1',
//            'status' => 1,
//            'password' => bcrypt('oshc@123'),
//        ]);
//        $user->assignRole('Super Admin');
    }
}
