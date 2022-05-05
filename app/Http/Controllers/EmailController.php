<?php

namespace App\Http\Controllers;

use App\EmailCategories;
use App\EmailTemplate;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //

    public function index()
    {
        $emailTemplates = new EmailTemplate();
        $EmailTemplates = $emailTemplates->getAll();

        $flag = 'email';
        return view('CRM.pages.email-template.index', compact('EmailTemplates', 'flag'));
    }

    public function addNew()
    {
        $flag = 'email';
        return view('CRM.pages.email-template.form', compact('flag'));
    }

    public function edit($id)
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
}
