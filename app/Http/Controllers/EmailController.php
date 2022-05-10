<?php

namespace App\Http\Controllers;

use App\EmailCategories;
use App\EmailSettings;
use App\EmailTemplate;
use App\Http\Traits\Notify;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class EmailController extends Controller
{
    //
    use Notify;

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
        $action = 'add-new';
        return view('CRM.pages.email-template.form', compact('flag', 'action'));
    }

    public function storeEmailTemplate(Request $request)
    {
        $mail_status = $request->get('status') && $request->get('status') == 'on' ? 0 : 1;
        $template = $request->get('template');
        $name = $request->get('name');
        $subject = $request->get('subject');
        $cat_id = $request->get('cat_id');

        $emailTemplate = new EmailTemplate();
        $emailTemplate->mail_status = $mail_status;
        $emailTemplate->subject = $subject;
        $emailTemplate->template = $template;
        $emailTemplate->name = $name;
        $emailTemplate->cat_id = $cat_id;
        $emailTemplate->save();
        return back()->with('success', 'Store Successfully');
    }

    public function editEmailTemplate($id)
    {

        $flag = 'email';
        $action = 'update';
        $emailTemplate = EmailTemplate::find($id);
        return view('CRM.pages.email-template.form', compact('flag', 'emailTemplate', 'action'));
    }

    public function updateEmailTemplate(Request $request, $id)
    {
        $mail_status = $request->get('status') && $request->get('status') == 'on' ? 0 : 1;
        $template = $request->get('template');
        $name = $request->get('name');
        $subject = $request->get('subject');
        $cat_id = $request->get('cat_id');

        $emailTemplate = EmailTemplate::find($id);
        $emailTemplate->mail_status = $mail_status;
        $emailTemplate->subject = $subject;
        $emailTemplate->template = $template;
        $emailTemplate->name = $name;
        $emailTemplate->cat_id = $cat_id;
        $emailTemplate->save();
        return back()->with('success', 'Update Successfully');
    }

    public function destroyEmailTemplate(Request $request)
    {
        EmailTemplate::destroy($request->get('id'));

        $EmailTemplates = EmailTemplate::get();
        return response()->json([
            'view' => view('CRM.pages.email-template.data', compact('EmailTemplates'))->render(),
            'code' => 200,
            'message' => 'Successfully'
        ]);
    }

    public function indexCategories()
    {
        $flag = 'email';
        $emailCategories = new EmailCategories();
        $emailCategories = $emailCategories->getAll();
        return view('CRM.pages.email-categories.index', compact('flag', 'emailCategories'));
    }

    public function eventCategories(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $status = $request->get('status');
        $action = $request->get('action');

        if ($action == 'Update') {
            $emailCategories = EmailCategories::find($id);
        } else if ($action == 'Add new') {
            $emailCategories = new EmailCategories();
        } else if ($action == 'Delete') {
            EmailCategories::destroy($id);
            return $this->renderViewForCategories();
        }

        $emailCategories->name = $name;
        $emailCategories->status = $status;
        $emailCategories->save();
        return $this->renderViewForCategories();

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

    public function renderViewForCategories()
    {
        $emailCategories = EmailCategories::all();
        return response()->json([
            'view' => view('CRM.pages.email-categories.data', compact('emailCategories'))->render(),
            'code' => 200,
            'message' => 'Successfully'
        ]);
    }

    public function sendMailWithTemplate($receiver = 'son.dang@annalink.com', $idTemplateEmail = '1')
    {
        $emailTemplate = EmailTemplate::find('name', 'test');
        $emailSetting = EmailSettings::limit(1)->get();

        $this->sendMail($emailSetting[0], $receiver, $emailTemplate);
    }


}
