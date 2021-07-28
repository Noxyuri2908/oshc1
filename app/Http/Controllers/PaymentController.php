<?php

namespace App\Http\Controllers;

use App\Admin\Service;
use App\Admin\TemplateInvoiceManager;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Admin\Webinfo;
use App\Admin\Apply;
use App\Admin\Customer;
use App\Admin\Commission;
use App\Admin\Report;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spipu\Html2Pdf\Html2Pdf;
use Session;
use App\Services\PayPalService;
use Illuminate\Support\Facades\App;

class PaymentController extends Controller
{

    public function getForm($id)
    {
        $apply = Apply::with([
            'customers' => function ($query) {
                $query->where('type', 1);
            }
        ])->find($id);

        $applyCountry = (!empty($apply->customers)) ? $apply->customers->first()->country : '';
        \Session::put('country', $applyCountry);
        if ($applyCountry == 'VN') {
            $type_file = [1];
        } else {
            $type_file = [1];
        }
        \Session::put('type_file', $type_file);
        \Session::put('apply_id', $id);


        if ($apply == null || \Session::get('step', 0) == 0 || $apply->status != 0) {
            \Session::put('step', 1);
            return redirect()->route('get-a-quote.get');
        }
        if (\Session::get('step', 0) == 2) {
            return redirect()->route('apply.get', ['id' => $apply->id]);
        }
        $info = Webinfo::whereIN('code', ['payment_section_8', 'payment_section_1', 'payment_section_2', 'payment_section_3', 'payment_section_4', 'payment_section_5', 'payment_section_6', 'payment_section_7'])
            ->where('status', 1)->get();
        $payment_section_1 = $info->where('code', 'payment_section_1')->first();
        $payment_section_2 = $info->where('code', 'payment_section_2')->first();
        $payment_section_3 = $info->where('code', 'payment_section_3')->first();
        $payment_section_4 = $info->where('code', 'payment_section_4')->first();
        $payment_section_5 = $info->where('code', 'payment_section_5')->first();
        $payment_section_6 = $info->where('code', 'payment_section_6')->first();
        $payment_section_7 = $info->where('code', 'payment_section_7')->first();
        $payment_section_8 = $info->where('code', 'payment_section_8')->first();
        // dd($payment_section_8);
        $price_comm = 0;
        $price_gst = 0;
        $price_su = floatval($apply->net_amount) * 0.03;
        $total = $apply->net_amount;
        $agent = $apply->User;
        if ($agent == null) $total = $apply->net_amount;
        else {
            $info = $agent->info;
            if ($info == null) return redirect()->route('home');
            $no_adults = $apply->no_of_adults;
            $no_chilren = $apply->no_of_children;
            if ($no_chilren == 0 && $no_adults == 1) {
                $policy = 1;
            } else if ($no_chilren > 0) {
                $policy = 3;
            } else {
                $policy = 2;
            }
            $comm = $apply->getCom();
            if ($comm == null) $price_comm = 0;
            else {
                $price_comm = (floatval($comm->comm) / 100) * floatval($apply->net_amount);
                if ($info->type_payment == 2) {
                    $report = Report::create([
                        'apply_id' => $apply->id,
                        'user_id' => $agent->id,
                        'amount' => $price_comm,
                    ]);
                    $price_comm = 0;
                }
            }
            if ($info->gst == 1) $price_gst = $price_comm / 11;
        }
        $total = $total - $price_comm + $price_gst + $price_su;
        $data = [];
        $data['price_su'] = $price_su;
        $data['price_comm'] = $price_comm;
        $data['price_gst'] = $price_gst;
        $data['total'] = $total;
        $apply->update($data);
        $customerRegister = $apply->registerCus();
        $service = Service::find(session()->get('provider_id'));
        $start_date = session()->get('start_date');
        $end_date = session()->get('end_date');
        $childs = session()->get('childs');
        $adults = session()->get('adults');
        $price = session()->get('price');
        return view('fontend.page.payment', [
            'apply' => $apply,
            'payment_section_1' => $payment_section_1,
            'payment_section_2' => $payment_section_2,
            'payment_section_3' => $payment_section_3,
            'payment_section_4' => $payment_section_4,
            'payment_section_5' => $payment_section_5,
            'payment_section_6' => $payment_section_6,
            'payment_section_7' => $payment_section_7,
            'payment_section_8' => $payment_section_8,
            'price_comm' => $price_comm,
            'price_gst' => $price_gst,
            'price_su' => $price_su,
            'total' => $total,
            'customerRegister' => $customerRegister
        ], compact(
            'service',
            'start_date',
            'end_date',
            'childs',
            'adults',
            'price'
        ));
    }

    public function paymentPayPal($id)
    {

        $apply = Apply::with('provider')->find($id);
        if ($apply == null) {
            \Session::put('step', 1);
            return redirect()->route('apply.get');
        }
        $getNameProvider = $apply->provider->name;
        $getIdProvider = $apply->provider->id;
        $getPriceProvider = $apply->net_amount;
        $subChange = floatval($getPriceProvider) * 0.03;
        $totalPrice = $getPriceProvider + $subChange;
        $itemData[] = [
            'name' => $getNameProvider,
            'sku' => $getIdProvider,
            'price' => $totalPrice,
            'quantity' => 1
        ];
        $payPal = new PayPalService();
        //
        $payPal->setItem($itemData);
        $payPal->setCancelUrl(route('payment.paypal.order.cancel'));
        $payPal->setReturnUrl(route('payment.paypal.order.success'));

        $apply->update([
            'payment_method' => 3,
            'status' => 1,
        ]);
        reset_data();
        return redirect()->to($payPal->createPayment('test order'));
    }

    public function paymentTranfer(Request $request)
    {
        $id = \Session::get('apply', 0);
        if ($id == 0) return route('home');
        $apply = Apply::find($id);
        if ($apply == null) return route('home');
        if ($apply->status != 0 || \Session::get('step', 0) != 3) return redirect()->route('home');
        $price_comm = 0;
        $price_gst = 0;
        $price_su = floatval($apply->net_amount) * 0.03;
        $total = $apply->net_amount;
        $agent = $apply->User;
        if ($agent == null) $total = $apply->net_amount;
        else {
            //            $info = $agent->info;
            //            if ($info == null) return redirect()->route('home');
            $no_adults = $apply->no_of_adults;
            $no_chilren = $apply->no_of_children;

            $comm = $apply->getCom();
            if ($comm == null) $price_comm = 0;
            else {
                $price_comm = (floatval($comm->comm) / 100) * floatval($apply->net_amount);
            }
            if ($info->gst == 1) $price_gst = $price_comm / 11;
        }
        $total = $total - $price_comm + $price_gst + $price_su;
        $data = $request->all();
        $obj = Apply::with([
            'customers' => function ($query) {
                $query->where('type', 1);
            }
        ])->find($id);

        if ($obj == null) abort(404);
        $provider = $obj->provider;

        if ($provider == null) abort(404);
        $cus = $obj->customers[0];

        $list_file = [];
        $fileName = '';
        $templateConfig = TemplateInvoiceManager::where('template_name', 9)->first();
        $template = Storage::disk('template')->get('template_invoice_9.php');

        $template = str_replace('_company_name', $templateConfig->company_name, $template);
        $template = str_replace('_company_address', $templateConfig->company_address, $template);
        $template = str_replace('_company_phone', $templateConfig->company_phone, $template);
        $template = str_replace('_company_website', $templateConfig->company_website, $template);
        $template = str_replace('_currency', $obj->provider->currency(), $template);
        $template = str_replace('_logo', ($templateConfig->logo) ? 'https://oshcglobal.com.au/FILES/source/' . $templateConfig->logo : "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D", $template);
        $template = str_replace('_ref_no', ($obj->ref_no) ?? '', $template);
        $template = str_replace('_date', convert_date_form_db($obj->created_at), $template);
        $template = str_replace('_cusName', $cus->first_name.' '.$cus->last_name, $template);
        $template = str_replace('_provider_name', ($obj->provider) ?$obj->provider->name: '', $template);
        $template = str_replace('_policy', ($obj->policyName()) ?? '', $template);
        $template = str_replace('_startdate', ($obj->start_date) ?? '', $template);
        $template = str_replace('_enddate', ($obj->end_date) ?? '', $template);
        $template = str_replace('_amount', $obj->net_amount, $template);
        $template = str_replace('_content', $templateConfig->content, $template);
        foreach (\Session::get('type_file') as $type) {
            if ($type == 1) {
                $nameFile = ($type == 1) ? 'Invoice -' . md5(uniqid()) : 'PhieuDeNghiChuyenTien -' . md5(uniqid());
                $apiKey = 'api_696BA4651A40413B869C0C3E6DA4D99C';
                $url = "https://api.sejda.com/v2/html-pdf";
                $content = json_encode(array('htmlCode' => $template, 'pageSize' => 'a4'));

                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    "Content-type: application/json",
                    "Authorization: Token: " . $apiKey));

                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

                $response = curl_exec($curl);

                $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if ($status == 200) {
                    Storage::put('public/pdf/'. $nameFile . '.pdf',$response);
                } else {
                    print("Error: failed with status $status, response $response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                }
            }

            array_push($list_file, $nameFile . '.pdf');
            $fileName = \Config::get('admin.base_url').'storage/app/public/pdf/'.$nameFile .'.pdf';
        }
        $apply->update([
            'payment_method' => 1,
            'status' => 1,
        ]);
        reset_data();
        $data_email_payment_customer = [
            'name' => ucfirst($cus->first_name) . ' ' . ucfirst($cus->last_name),
            'service' => $provider->name,
            'type_payment' => 'telegraphic transfers',
            'list_file' => $list_file
        ];
        Mail::to($cus->email)->later(3,new \App\Mail\PaymentCustomerMail($data_email_payment_customer));
//        $payment_finish = Webinfo::whereIN('code', ['payment_finish'])->where('status', 1)->first();
//        return view('fontend.partials.payment.payment-form-1', [
//            'price_comm' => $price_comm,
//            'price_gst' => $price_gst,
//            'price_su' => $price_su,
//            'total' => $total,
//            'payment_finish' => $payment_finish,
//            'apply' => $apply,
//            'list_file' => $list_file
//        ]);
        return $fileName;
    }

    public function paymentCredit($id)
    {
        $apply = Apply::with('provider')->find($id);
        if ($apply == null) {
            \Session::put('step', 1);
            return redirect()->route('apply.get');
        }
        $getNameProvider = $apply->provider->name;
        $getIdProvider = $apply->provider->id;
        $getPriceProvider = $apply->net_amount;
        $subChange = floatval($getPriceProvider) * 0.03;
        $totalPrice = $getPriceProvider + $subChange;
        $itemData[] = [
            'name' => $getNameProvider,
            'sku' => $getIdProvider,
            'price' => $totalPrice,
            'quantity' => 1
        ];
        $payPal = new PayPalService();

        $payPal->setItem($itemData);
        $payPal->setCancelUrl(route('payment.paypal.credit_card.cancel'));
        $payPal->setReturnUrl(route('payment.paypal.credit_card.success'));
        $apply->update([
            'payment_method' => 2,
            'status' => 1,
        ]);
        reset_data();
        return redirect()->to($payPal->createPaymentCredit('test order'));
    }

    public function downloadInvoice($id, $type)
    {
        //        dd(Session::all());
        //Create code
        $apply = Apply::find($id);

        //        if ($apply == null) return redirect()->back();
        $agent = $apply->User;

        $customer = $apply->customers()->where('type', 0)->first();
        $service = $apply->service;
        $price_comm = 0;
        $price_gst = 0;
        $price_surchagre = 0;
        $total = $apply->price;
        $policy = 1;
        $price = $apply->price;
        $str_policy = 'Single';
        //        if ($customer == null || $service == null) return redirect()->back();
        $template = Storage::disk('template')->get('invoice-VN.php');
        //        if ($template == null) return redirect()->back();
        $template = Storage::disk('template')->get('invoice.php');
        //        if ($template == null) return redirect()->back();

        if ($agent == null) $total = $apply->price;
        else {
            $info = $agent->info;
            if ($info == null) return redirect()->back();
            $no_adults = $aplly->no_of_adults;
            $no_chilren = $aplly->no_of_children;
            if ($no_chilren == 0 && $no_adults == 1) {
                $policy = 1;
                $str_policy = 'Single';
            } else if ($no_chilren > 0) {
                $policy = 3;
                $str_policy = 'Family';
            } else {
                $policy = 2;
                $str_policy = 'Couple';
            }
            $comm = Commission::where('service_id', $aplly->service_id)->where('user_id', $agent->id)->where('type', $policy)->first();
            if ($comm == null) $price_comm = 0;
            else {
                $price_comm = (floatval($comm->comm) / 100) * floatval($apply->price);
            }
            if ($info->gst == 1) $price_gst = $price_comm / 11;
            if ($type == 2) $price_surchagre = floatval($apply->price) * 0.03;
        }
        $total = $total - $price_comm + $price_gst + $price_surchagre;
        $name = $customer->first_name . ' ' . $customer->last_name;
        $date = date("d/m/Y");
        ///////////////////////////////////////////////////////////////////
        if ($customer->country == 'VN') {
            $template = Storage::disk('template')->get('invoice-VN.php');
            $template = str_replace('_current_date', $date, $template);
            $template = str_replace('_str_policy', $str_policy, $template);
            $template = str_replace('_code', $apply->ref_no, $template);
            $template = str_replace('_name', $name, $template);
            $template = str_replace('_start_date', $apply->start_date, $template);
            $template = str_replace('_end_date', $apply->end_date, $template);
            $template = str_replace('_service', $service->name, $template);
            $template = str_replace('_total', $total, $template);
            $template = str_replace('_price', $price, $template);
            if ($agent == null || $agent->type_payment == 2) $template = str_replace('_row_commission', '', $template);
            else {
                $row_commission = "<tr><td style='text-align:center;'>Commission (include GST)</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_comm . "</td></tr>";
                $template = str_replace('_row_commission', $row_commission, $template);
            }

            if ($agent == null || $agent->gst == 0) $template = str_replace('_row_gst', '', $template);
            else {
                $row_gst = "<tr><td style='text-align:center;'>GST</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_gst . "</td></tr>";
                $template = str_replace('_row_gst', $row_gst, $template);
            }

            if ($type != 1) {
                $row_fee = "<tr><td style='text-align:center;'>Surcharge fee(3%)</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_surchagre . "</td></tr>";
                $template = str_replace('_row_fee', $row_fee, $template);
            } else {
                $template = str_replace('_row_fee', '', $template);
            }
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->addFont('cambria', '', '');
            $html2pdf->addFont('cambriab', 'B', '');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($template, true);
            $html2pdf->output('Invoive.pdf', 'D');

            $template = Storage::disk('template')->get('invoice.php');
            $template = str_replace('_current_date', $date, $template);
            $template = str_replace('_str_policy', $str_policy, $template);
            $template = str_replace('_code', $apply->ref_no, $template);
            $template = str_replace('_name', $name, $template);
            $template = str_replace('_start_date', $apply->start_date, $template);
            $template = str_replace('_end_date', $apply->end_date, $template);
            $template = str_replace('_service', $service->name, $template);
            $template = str_replace('_total', $total, $template);
            $template = str_replace('_price', $price, $template);
            if ($agent == null || $agent->type_payment == 2) $template = str_replace('_row_commission', '', $template);
            else {
                $row_commission = "<tr><td style='text-align:center;'>Commission (include GST)</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_comm . "</td></tr>";
                $template = str_replace('_row_commission', $row_commission, $template);
            }

            if ($agent == null || $agent->gst == 0) $template = str_replace('_row_gst', '', $template);
            else {
                $row_gst = "<tr><td style='text-align:center;'>GST</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_gst . "</td></tr>";
                $template = str_replace('_row_gst', $row_gst, $template);
            }

            if ($type != 1) {
                $row_fee = "<tr><td style='text-align:center;'>Surcharge fee(3%)</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_surchagre . "</td></tr>";
                $template = str_replace('_row_fee', $row_fee, $template);
            } else {
                $template = str_replace('_row_fee', '', $template);
            }
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->addFont('cambria', '', '');
            $html2pdf->addFont('cambriab', 'B', '');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($template, true);
            $html2pdf->output('Invoive.pdf', 'D');
        } else {
            $template = Storage::disk('template')->get('invoice.php');
            $template = str_replace('_current_date', $date, $template);
            $template = str_replace('_str_policy', $str_policy, $template);
            $template = str_replace('_code', $apply->invoice_code, $template);
            $template = str_replace('_name', $name, $template);
            $template = str_replace('_start_date', $apply->start_date, $template);
            $template = str_replace('_end_date', $apply->end_date, $template);
            $template = str_replace('_service', $service->name, $template);
            $template = str_replace('_total', $total, $template);
            $template = str_replace('_price', $price, $template);
            if ($agent == null || $agent->type_payment == 2) $template = str_replace('_row_commission', '', $template);
            else {
                $row_commission = "<tr><td style='text-align:center;'>Commission (include GST)</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_comm . "</td></tr>";
                $template = str_replace('_row_commission', $row_commission, $template);
            }

            if ($agent == null || $agent->gst == 0) $template = str_replace('_row_gst', '', $template);
            else {
                $row_gst = "<tr><td style='text-align:center;'>GST</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_gst . "</td></tr>";
                $template = str_replace('_row_gst', $row_gst, $template);
            }

            if ($type != 1) {
                $row_fee = "<tr><td style='text-align:center;'>Surcharge fee(3%)</td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''></td>" .
                    "<td style=' text-align:center;''>" . $price_surchagre . "</td></tr>";
                $template = str_replace('_row_fee', $row_fee, $template);
            } else {
                $template = str_replace('_row_fee', '', $template);
            }
            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
            $html2pdf->addFont('cambria', '', '');
            $html2pdf->addFont('cambriab', 'B', '');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($template, true);
            $html2pdf->output('Invoive.pdf', 'D');
        }
        //        return redirect('home');
    }

    public function paypalSuccess(Request $request)
    {
        $paymentPaypal = new PayPalService();
        $resurt = $paymentPaypal->getPaymentStatus($request);
        $apply_id = \Session::get('apply_id', 0);
        $obj = Apply::with([
            'customers' => function ($query) {
                $query->where('type', 0);
            }
        ])->find($apply_id);
        $provider = $obj->provider;
        $cus = $obj->customers[0];
        $data_email_payment_customer = [
            'name' => ucfirst($cus->first_name) . ' ' . ucfirst($cus->last_name),
            'service' => $provider->name,
            'type_payment' => 'paypal'
        ];
        if ($resurt->getState() == 'approved') {
            Mail::to($cus->email)->send(new \App\Mail\PaymentCustomerMail($data_email_payment_customer));
            \Session::forget('apply_id');
            return view('fontend.page.payment_success');
        } else {
            return redirect()->route('homepage');
        }
    }

    public function paypalCancel()
    {
        return redirect()->route('get-a-quote.get');
    }

    public function paypalCreditSuccess(Request $request)
    {
        $paymentPaypal = new PayPalService();
        $resurt = $paymentPaypal->getPaymentStatus($request);
        $apply_id = \Session::get('apply_id', 0);
        $obj = Apply::with([
            'customers' => function ($query) {
                $query->where('type', 0);
            }
        ])->find($apply_id);
        $provider = $obj->provider;
        $cus = $obj->customers[0];
        $data_email_payment_customer = [
            'name' => ucfirst($cus->first_name) . ' ' . ucfirst($cus->last_name),
            'service' => $provider->name,
            'type_payment' => 'credit card'
        ];
        if ($resurt->getState() == 'approved') {
            Mail::to($cus->email)->send(new \App\Mail\PaymentCustomerMail($data_email_payment_customer));
            \Session::forget('apply_id');
            return view('fontend.page.payment_success');
        } else {
            return redirect()->route('homepage');
        }
    }

    public function paypalCreditCancel()
    {
        return redirect()->route('get-a-quote.get');
    }
    public function flywirePaymentSuccess(Request $request)
    {
        $id = $request->get('id');
        $apply = Apply::findOrFail($id);
        $data = [
            'payment_method' => 4,
            'type_get_data_payment' => 1
        ];
        $apply->update($data);
        return view('fontend.page.payment_success');
    }
}
