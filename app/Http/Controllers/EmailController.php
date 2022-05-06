<?php

namespace App\Http\Controllers;

use App\EmailCategories;
use App\EmailSettings;
use App\EmailTemplate;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //

    public function indexEmailTempaltes()
    {
        $emailTemplates = new EmailTemplate();
        $EmailTemplates = $emailTemplates->getAll();

        $flag = 'email';
        return view('CRM.pages.email-template.index', compact('EmailTemplates', 'flag'));
    }

    public function addNewEmailTemplate()
    {
        $flag = 'email';
        return view('CRM.pages.email-template.form', compact('flag'));
    }

    public function editEmailTemplate($id)
    {

        $flag = 'email';
        $emailTemplate = EmailTemplate::find($id);
        return view('CRM.pages.email-template.form', compact('flag', 'emailTemplate'));
    }

    public function indexCategories()
    {
        $flag = 'email';
        $emailCategories = new EmailCategories();
        $emailCategories = $emailCategories->getAll();
        return view('CRM.pages.email-categories.index', compact('flag', 'emailCategories'));
    }

    public function indexEmailSettings()
    {
        $flag = 'email';
        $emailSettings = EmailSettings::limit(1)->get();
        return view('CRM.pages.email-settings.index', compact('flag', 'emailSettings'));
    }

    public function updateEmailSettings(Request $request)
    {
        $emailSetting = new EmailSettings();
        if (!empty($request->get('id'))) {
            $emailSetting = EmailSettings::find($request->get('id'));
        }
        $emailSetting->email_from = $request->get('email-address');
        $emailSetting->email_password = $request->get('email-password');
        $emailSetting->email_description = $request->get('email-description');

        $emailSetting->save();
        return back()->with('success', 'Update Successfully');
    }


}
