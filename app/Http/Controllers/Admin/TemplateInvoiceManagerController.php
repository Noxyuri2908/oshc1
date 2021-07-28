<?php

namespace App\Http\Controllers\Admin;

use App\Admin\TemplateInvoiceManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateInvoiceManagerStoreRequest;
use App\Http\Requests\TemplateInvoiceManagerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateInvoiceManagerController extends Controller
{

    public function index()
    {
        if (!auth()->user()->can('customerManager.index')) {
            return abort(403);
        }
        $flag = 'template_invoice_manager';
        return view('CRM.pages.template_invoice_manager.index', compact('flag'));
    }

    public function getData(Request $request)
    {
        if (!auth()->user()->can('customerManager.index')) {
            return abort(403);
        }
        $templateDatas = TemplateInvoiceManager::orderBy('id', 'desc')->paginate(20);
        $lastPage = $templateDatas->lastPage();
        return response()->json([
            'view' => view('CRM.pages.template_invoice_manager.data', compact(
                'templateDatas'
            ))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function create()
    {
        $flag = 'template_invoice_manager';
        return view('CRM.pages.template_invoice_manager.form', compact('flag'));
    }

    public function store(TemplateInvoiceManagerStoreRequest $request)
    {
        if (!auth()->user()->can('customerManager.store')) {
            return abort(403);
        }
        $data = $request->validated();
        $logo = explode("/", $data['logo']);
        $data['logo'] = $logo[count($logo) - 1];
        TemplateInvoiceManager::create($data);
        return redirect()->route('template_invoice_manager.index');
    }

    public function edit(Request $request, $id)
    {
        if (!auth()->user()->can('customerManager.edit')) {
            return abort(403);
        }
        $flag = 'template_invoice_manager';
        $templateData = TemplateInvoiceManager::findOrFail($id);
        return view('CRM.pages.template_invoice_manager.form', compact(
            'templateData',
            'flag'
        ));
    }

    public function update(TemplateInvoiceManagerUpdateRequest $request, $id)
    {
        if (!auth()->user()->can('customerManager.update')) {
            return abort(403);
        }
        $data = $request->validated();
        $logo = explode("/", $data['logo']);
        $data['logo'] = $logo[count($logo) - 1];
        $customerData = TemplateInvoiceManager::findOrFail($id);
        $customerData->update($data);
        return redirect()->route('template_invoice_manager.index');
    }

    public function destroy(Request $request, $id)
    {
        if (!auth()->user()->can('customerManager.delete')) {
            return abort(403);
        }
        $customerData = TemplateInvoiceManager::findOrFail($id);
        $customerData->delete();
        return response()->json([
            'id' => $id,
        ]);
    }

    public function showTemplateInvoice(Request $request, $id)
    {
        $templateConfig = TemplateInvoiceManager::findOrFail($id);
        $typeFile = $templateConfig->template_name;
        $template = Storage::disk('template')->get('template_invoice_'.$typeFile.'.php');
        if (
            $typeFile == 1 ||
            $typeFile == 6 ||
            $typeFile == 7 ||
            $typeFile == 8 ||
            $typeFile == 9 ||
            $typeFile == 10 ||
            $typeFile == 13 ||
            $typeFile == 14
        ) {
            $template = str_replace('_nameCompany', $templateConfig->company_name, $template);
            $template = str_replace('_addressCompany', $templateConfig->company_address, $template);
            $template = str_replace('_phoneCompany', $templateConfig->company_phone, $template);
            $template = str_replace('_websiteCompany', $templateConfig->company_website, $template);
            $template = str_replace('_currentDate', date('d/m/Y'), $template);
        } elseif (
            $typeFile == 2 ||
            $typeFile == 3 ||
            $typeFile == 4 ||
            $typeFile == 5 ||
            $typeFile == 11 ||
            $typeFile == 12 ||
            $typeFile == 15
        ) {
            $template = str_replace('_companyNameVi', $templateConfig->company_name_vi, $template);
            $template = str_replace('_companyAddressVi1', $templateConfig->company_address_vi_1, $template);
            $template = str_replace('_companyPhoneVi1', $templateConfig->company_phone_vi_1, $template);
            $template = str_replace('_companyAddressVi2', $templateConfig->company_address_vi_2, $template);
            $template = str_replace('_companyPhoneVi2', $templateConfig->company_phone_vi_2, $template);
            $template = str_replace('_companyEmailVi1', $templateConfig->company_email_vi, $template);
        }
        $template = str_replace('_moreInformation', $templateConfig->content, $template);
        $template = str_replace('_logoCompany', $templateConfig->logo, $template);

        return $template;
    }
}
