<?php

use App\Admin;
use App\Admin\ExchangRate;
use App\Ahm;
use App\Allianz;
use App\Cover;
use App\Medibank;
use App\Nib;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Admin\Webinfo;
use App\Admin\Service;
use App\Admin\Price;
use App\Admin\Report;
use App\Admin\Person;
use App\User;
use App\Admin\Apply;
use App\Admin\Dichvu;
use App\Admin\Support;
use Carbon\Carbon;

if (!function_exists('get_week')) {
    function get_week($week)
    {
        $monday = strtotime("last monday");
        $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
        $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
        $this_week_sd = (new DateTime(date("Y-m-d", $monday)))->modify('-' . (intval($week) * 7) . ' day');
        $this_week_ed = (new DateTime(date("Y-m-d", $sunday)))->modify('-' . (intval($week) * 7) . ' day');
        return array('start' => $this_week_sd->format('Y-m-d'), 'end' => $this_week_ed->format('Y-m-d'));
    }
}

if (!function_exists('reload_notifi')) {
    function reload_notifi()
    {
        $dt = date("Y-m-d");
        $dt2 = date("Y-m-d", strtotime("$dt +8 day"));
        $applies = Apply::where('status', 2)->whereRaw("STR_TO_DATE(end_date,'%d/%m/%Y') >= '" . $dt . "'")->whereRaw("STR_TO_DATE(end_date,'%d/%m/%Y') <= '" . $dt2 . "'");
        return $applies->get();
    }
}

if (!function_exists('get_day_support')) {
    function get_day_support($user)
    {
        $newest = $user->created_at;
        $newest_support = Support::where('agent_id', $user->id)->orderby('created_at', 'desc')->first();
        if ($newest_support != null) $newest = $newest_support->created_at;
        $newest_date = explode(" ", $newest);
        $newest_date = $newest_date[0];
        $current_date = date('Y-m-d');
        $earlier = new DateTime($newest_date);
        $later = new DateTime($current_date);
        $diff = $later->diff($earlier)->format("%a");
        return $diff;
    }
}

if (!function_exists('reload_apply_pending')) {
    function reload_apply_pending()
    {
        $applies = Apply::where('status', 1);
        return $applies->get();
    }
}

if (!function_exists('reload_reg_agent')) {
    function reload_reg_agent()
    {
        $agents = User::where('status', '==', 0)->get();
        return $agents;
    }
}

if (!function_exists('reload_date_of_birth')) {
    function reload_date_of_birth()
    {
        $dt = date("Y-m-d");
        $month_1 = date("m", strtotime($dt));
        $dt2 = date("Y-m-d", strtotime("$dt +3 day"));
        $month_2 = date("m", strtotime($dt2));
        $person = Person::orwhereRaw("EXTRACT(MONTH FROM STR_TO_DATE(birthday,'%d/%m/%Y')) =" . $month_1)->orwhereRaw("EXTRACT(MONTH FROM STR_TO_DATE(birthday,'%d/%m/%Y')) =" . $month_2)->where('status', 1)->get();
        $count = 0;
        foreach ($person as $p) {
            $birthday = $p->birthday;
            $dt = date("Y-m-d");
            $dt2 = date("Y-m-d", strtotime("$dt +3 day"));
            $data = explode("/", $birthday);
            if (sizeof($data) == 3) {
                $birthday = date("Y") . '-' . $data[1] . '-' . $data[0];
                $birthday = date('Y-m-d', strtotime($birthday));
                if ($birthday >= $dt && $birthday <= $dt2) $count = $count + 1;
            }
        }
        return $count;
    }
}

if (!function_exists('set_step')) {
    function set_step($number)
    {
        $step = Session::get('step', 0);
        if ($step == 0) Session::put('step', $number);
        else {
            if ($step < $number) Session::put('step', $number);
        }
        return true;
    }
}

if (!function_exists('get_list_comm_by_month')) {
    function get_list_comm_by_month($month, $user_id)
    {
        $reports = Report::where('user_id', $user_id)->whereRaw("EXTRACT(MONTH FROM created_at) =" . $month)->where('status', 1)->get();
        return $reports;
    }
}

if (!function_exists('get_sum_comm_by_month')) {
    function get_sum_comm_by_month($month, $user_id)
    {
        $reports = Report::where('user_id', $user_id)->whereRaw("EXTRACT(MONTH FROM created_at) =" . $month)->where('status', 1)->sum('amount');
        return $reports;
    }
}

if (!function_exists('reset_data')) {
    function reset_data()
    {
        Session::forget('step');
        Session::forget('apply');
        Session::forget('start_date');
        Session::forget('end_date');
        Session::forget('childs');
        Session::forget('adults');
        Session::forget('price');
    }
}

if (!function_exists('send_mail')) {
    function send_mail($email, $title, $subject, $content)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'nm.dung.1991@gmail.com';                     // SMTP username
            $mail->Password = 'diowabxrnafuksbm';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );
            //Recipients
            $mail->setFrom('nm.dung.1991@gmail.com', 'OSHC GLOBAL');
            $mail->addAddress($email);              // Name is optional
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $content;
            $mail->send();
        } catch (Exception $e) {
        }
    }
}

if (!function_exists('get_content')) {
    function get_content($obj)
    {
        if ($obj != null) {
            if (App::isLocale('cn')) return $obj->content_cn;
            else if (App::isLocale('vi')) return $obj->content_vi;
            else return $obj->content;
        } else return '';
    }
}

if (!function_exists('get_des_s')) {
    function get_des_s($obj)
    {
        if ($obj != null) {
            if (App::isLocale('cn')) return $obj->des_s_cn;
            else if (App::isLocale('vi')) return $obj->des_s_vi;
            else return $obj->des_s;
        } else return '';
    }
}

if (!function_exists('get_note')) {

    function get_note($obj)
    {
        if ($obj != null) {
            if (App::isLocale('cn')) return $obj->note_cn;
            else if (App::isLocale('vi')) return $obj->note_vi;
            else return $obj->note;
        } else return '';
    }
}

if (!function_exists('get_name')) {
    function get_name($obj)
    {
        if ($obj != null) {
            if (App::isLocale('cn')) return $obj->name_cn;
            else if (App::isLocale('vi')) return $obj->name_vi;
            else return $obj->name;
        } else return '';
    }
}

if (!function_exists('get_link')) {
    function get_link($obj)
    {
        if ($obj != null) {
            return (isset($obj->link)) ? $obj->link : '#';
        } else return '#';
    }
}

if (!function_exists('get_image')) {
    function get_image($obj)
    {
        if ($obj != null) {
            return (isset($obj->get_image)) ? $obj->get_image : '';
        } else return '';
    }
}

if (!function_exists('multiRequest_qa')) {

    function multiRequest_qa($data, $options = array())
    {

        $curly = array();

        $result = array();

        $mh = curl_multi_init();
        foreach ($data as $id => $d) {
            if ($d['slug'] == 'allianz') {
                $startDate = $d['start_date'];
                $endDate = $d['end_date'];
                $adult = $d['number_person']['adult'];
                $child = $d['number_person']['child'];
                $curly[$id] = curl_init();
                $params = "{\"classId\":\"com.allianz.cisl.core.contract.Contract\",\"contractHolder\":null,\"contractInterval\":{\"classId\":\"com.allianz.cisl.base.types.Interval\",\"startDateTime\":\"" . $startDate . "T00:00\",\"endDateTime\":\"" . $endDate . "T00:00\"},\"contractNumber\":null,\"extEntity\":{\"classId\":\"com.allianz.cisl.ext.extcontract.ExtContract\",\"applicationNumber\":1,\"businessPartnerId\":49161,\"numberOfAdults\":" . $adult . ",\"numberOfDependents\":" . $child . "},\"externalContractNumber\":\"\",\"language\":\"US\",\"parties\":[{\"classId\":\"com.allianz.cisl.core.person.Person\",\"identificationDocuments\":[{\"classId\":\"com.allianz.cisl.core.document.IdentityDocument\"}],\"roles\":[{\"classId\":\"com.allianz.cisl.core.person.InsuredPerson\",\"roleName\":\"PH\"}]}],\"premiums\":[]}";
                curl_setopt_array($curly[$id], array(
                    CURLOPT_URL => "https://api.allianz.com/gateway/contracts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $params,
                    CURLOPT_HTTPHEADER => array(
                        "Connection: keep-alive",
                        "sec-ch-ua: \"Chromium\";v=\"86\", \"\"NotA;Brand\";v=\"99\", \"Google Chrome\";v=\"86\"",
                        "Accept: application/json, text/plain, */*",
                        "contractState: Quotation",
                        "sec-ch-ua-mobile: ?0",
                        "ContractVerification: ",
                        "User-User: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36",
                        "Content-Type: application/json",
                        "Origin: https://api.allianz.com",
                        "Sec-Fetch-Site: same-origin",
                        "Sec-Fetch-Mode: cors",
                        "Sec-Fetch-Dest: empty",
                        "Referer: https://api.allianz.com/myquote/1?fbclid=IwAR3JY_scAJPGOX3fcqME2kBLEVrHzauCSoPzhfVlvaK6eryFZys6TnVXEJc",
                        "Accept-Language: en,vi;q=0.9",
                        "Cookie: WebSessionID=123.24.212.24.1605521796384209"
                    ),
                ));
                curl_multi_add_handle($mh, $curly[$id]);
            } else {
                $curly[$id] = curl_init();
                $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
                curl_setopt($curly[$id], CURLOPT_URL, $url);
                curl_setopt($curly[$id], CURLOPT_HEADER, 0);
                curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);


                if (is_array($d)) {
                    if (!empty($d['header'])) {
                        curl_setopt($curly[$id], CURLOPT_HTTPHEADER, $d['header']);
                    }
                    if (!empty($d['post'])) {
                        curl_setopt($curly[$id], CURLOPT_POST, 1);
                        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
                    }
                }

                if (!empty($options)) {
                    curl_setopt_array($curly[$id], $options);
                }
                curl_multi_add_handle($mh, $curly[$id]);
            }
//            dump($curly[$id]);
        }


        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);

        foreach ($curly as $id => $c) {
            $result[$id] = json_decode(curl_multi_getcontent($c), true);
            curl_multi_remove_handle($mh, $c);
        }
        curl_multi_close($mh);
        return $result;
    }
}
if (!function_exists('convert_scope_to_scale')) {
    function convert_scope_to_scale($scope)
    {
        $sc = '';
        if ($scope == 'Family') {
            $sc = 'F';
        }
        if ($scope == 'Single') {
            $sc = 'S';
        }
        if ($scope == 'Couple') {
            $sc = 'D';
        }
        if ($scope == 'Single Parents') {
            $sc = 'P';
        }
        return $sc;
    }
}
if (!function_exists('convert_scale_to_number_person')) {
    function convert_scale_to_number_person($scope, $singleParents = null)
    {
        $sc = [];
        if ($scope == 'Family') {
            $sc['adult'] = 2;
            $sc['child'] = 1;
        }
        if ($scope == 'Single') {
            $sc['adult'] = 1;
            $sc['child'] = 0;

        }
        if ($scope == 'Couple') {
            $sc['adult'] = 2;
            $sc['child'] = 0;
        }
        if ($scope == 'Single Parents') {
            $sc['adult'] = $singleParents[0];
            $sc['child'] = $singleParents[1];
        }
        return $sc;
    }
}
if (!function_exists('get_arr_price_qa')) {

    function get_arr_price_qa($start_date, $end_date, $scale, $singleParents = null, $service_id, $serviceProviders)
    {
//        $serviceProviders = Dichvu::where('service_id', $service_id)->get()->pluck('id')->toArray();

        $data = array(array());
        $scope = convert_scope_to_scale($scale);
        $services = Service::where('status', 1)->whereIn('dichvu_id', $serviceProviders)->whereNotNull('link')->where('price_type', 1)->get();

        $i = 0;
        $tmp_start_date = $start_date;
        $tmp_end_date = $end_date;
        foreach ($services as $service) {
            if ($service->slug == 'nib') {
                $start_date = convert_format_date_qa($start_date);
                $end_date = convert_format_date_qa($end_date);
                if (count($singleParents) > 0) {
                    if ($singleParents[0] == 1 && $singleParents[1] == 0) {
                        $scale = 'Single';
                    } else if ($singleParents[0] == 2 && $singleParents[1] == 0) {
                        $scale = 'Couple';
                    } else if ($singleParents[0] >= 1 && $singleParents[1] >= 1) {
                        $scale = 'Family';
                    }
                }
            } else {
                $start_date = $tmp_start_date;
                $end_date = $tmp_end_date;
            }
            $url = str_replace('{$start_date}', $start_date, $service->link);
            $url = str_replace('{$end_date}', $end_date, $url);
            $url = str_replace('{$scope}', $scope, $url);
            $url = str_replace('{$scale}', $scale, $url);

            $data[$i]['url'] = $url;
            $data[$i]['header'] = array($service->des_s);
            $data[$i]['slug'] = $service->slug;
            $data[$i]['start_date'] = convert_date_to_db($start_date);
            $data[$i]['end_date'] = convert_date_to_db($end_date);
            $data[$i]['number_person'] = convert_scale_to_number_person($scale, $singleParents);
            $i++;
        }
//        dd($data);
        $r = multiRequest_qa($data);

        $data = array();
        $list_url = [];
        foreach ($services as $service) {
            $list_url[] = $service->slug;
        }
        foreach ($r as $key => $value) {
            if (is_array($value)) {
                $data[$list_url[$key]] = (!empty($value['amount'])) ? $value['amount'] : $value['premiums'][0];
            } elseif (is_numeric($value)) {
                $data[$list_url[$key]] = "{$value}";
            }
        }
        return $data;
    }
}

if (!function_exists('convert_format_date_qa')) {
    function convert_format_date_qa($date)
    {
        $old_date = DateTime::createFromFormat('d/m/Y', $date);
        $newdate = $old_date->format('d-M-Y');
        return $newdate;
    }
}

if (!function_exists('get_num_day_of_month')) {
    function get_num_day_of_month($month, $year)
    {
        if ((((int)$month == 4 || (int)$month == 6) || (int)$month == 9) || (int)$month == 11) {
            $numdom1 = 30;
        } else if ((int)$month == 2) {
            if ((int)$year % 400 == 0 || ((int)$year % 4 == 0 && (int)$year % 100 != 0)) {
                $numdom1 = 29;
            } else {
                $numdom1 = 28;
            }
        } else {
            $numdom1 = 31;
        }
    }
}

if (!function_exists('get_num_month_or_day_of_range')) {
    function get_num_month_or_day_of_range($sDay, $eDay, $numdom1, $numdom2)
    {
        if ($sDay[2] == $eDay[2]) {
            if ($sDay[1] == $eDay[1]) {
                $numMonths = 0;
                $numDays = (int)$eDay[0] - ((int)$sDay[0] - 1);
            } else {
                if ((int)$sDay[0] <= (int)$eDay[0]) {
                    $numMonths = (int)$eDay[1] - (int)$sDay[1];
                    $numDays = (int)$eDay[0] - ((int)$sDay[0] - 1);
                    if ($sDay[0] == 1 && $eDay[0] == $numdom1) {
                        $numMonths = (int)$eDay[1] - (int)$sDay[1] + 1;
                        $numDays = 0;
                    }
                } else {
                    if ((int)$sDay[0] == ((int)$eDay[0] + 1)) {
                        $numMonths = (int)$eDay[1] - (int)$sDay[1];
                        $numDays = 0;
                    } else {
                        $numMonths = (int)$eDay[1] - (int)$sDay[1] - 1;
                        if ((((int)$sDay[1] == 4 || (int)$sDay[1] == 6) || (int)$sDay[1] == 9) || (int)$sDay[1] == 11) {
                            if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                $numdom3 = 2;
                                $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                            } else if ((int)$eDay[1] - 1 == 2) {
                                if ((int)$sDay[2] % 400 == 0 || ((int)$sDay[2] % 4 == 0 && (int)$sDay[2] % 100 != 0)) {
                                    if ((int)$sDay[0] <= 29) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numDays = (int)$eDay[0] - ((int)$sDay[0] - 30);
                                    }
                                } else {
                                    if ((int)$sDay[0] <= 28) {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        if ((int)$eDay[0] < ((int)$sDay[0] - 29)) {
                                            $numdom3 = 2;
                                            $numMonths = $numMonths - 1;
                                            $numDays = 30;
                                        } else {
                                            $numDays = (int)$eDay[0] - ((int)$sDay[0] - 29);
                                        }
                                    }
                                }
                            } else {
                                if ((int)$sDay[0] <= 30) {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numDays = (int)$eDay[0] + 1;
                                }
                            }
                        } else if ((int)$sDay[1] == 2) {
                            $numdom3 = 2;
                            if ((int)$sDay[2] % 400 == 0 || ((int)$sDay[2] % 4 == 0 && (int)$sDay[2] % 100 != 0)) {
                                if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                    $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else if ((int)$eDay[1] - 1 == 2) {
                                    $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                }
                            } else {
                                if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                    $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else if ((int)$eDay[1] - 1 == 2) {
                                    $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                }
                            }
                        } else {
                            if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                if ((int)$sDay[0] != 31) {
                                    $numdom3 = 2;
                                }
                                $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                            } else if ((int)$eDay[1] - 1 == 2) {
                                if ((int)$sDay[2] % 400 == 0 || ((int)$sDay[2] % 4 == 0 && (int)$sDay[2] % 100 != 0)) {
                                    if ((int)$sDay[0] <= 29) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numDays = (int)$eDay[0];
                                    }
                                } else {
                                    if ((int)$sDay[0] <= 28) {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        if ((int)$eDay[0] < ((int)$sDay[0] - 29)) {
                                            $numdom3 = 2;
                                            $numMonths = $numMonths - 1;
                                            $numDays = 30;
                                        } else {
                                            $numDays = (int)$eDay[0];
                                        }
                                    }
                                }
                            } else {
                                if ((int)$sDay[0] <= 30) {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numdom3 = 2;
                                    $numDays = (int)$eDay[0] + 1;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $sYear = (int)$eDay[2] - (int)$sDay[2];
            if ($sDay[1] == $eDay[1]) {
                if ((int)$sDay[0] <= (int)$eDay[0]) {
                    $numMonths = (int)$sYear * 12;
                    $numDays = (int)$eDay[0] - ((int)$sDay[0] - 1);
                    if ($sDay[0] == 1 && $eDay[0] == $numdom1) {
                        $numMonths = (int)$sYear * 12 + 1;
                        $numDays = 0;
                    }
                } else {
                    if ((int)$sDay[0] == ((int)$eDay[0] + 1)) {
                        $numMonths = (int)$sYear * 12;
                        $numDays = 0;
                    } else {
                        $numMonths = (int)$sYear * 12 - 1;
                        if ((((int)$sDay[1] == 4 || (int)$sDay[1] == 6) || (int)$sDay[1] == 9) || (int)$sDay[1] == 11) {
                            if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                $numdom3 = 2;
                                $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                            } else if ((int)$eDay[1] - 1 == 2) {
                                if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                    if ((int)$sDay[0] <= 29) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numDays = (int)$eDay[0] - ((int)$sDay[0] - 30);
                                    }
                                } else {
                                    if ((int)$sDay[0] <= 28) {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        if ((int)$eDay[0] < ((int)$sDay[0] - 29)) {
                                            $numdom3 = 2;
                                            $numMonths = $numMonths - 1;
                                            $numDays = 30;
                                        } else {
                                            $numDays = (int)$eDay[0] - ((int)$sDay[0] - 29);
                                        }
                                    }
                                }
                            } else {
                                if ((int)$sDay[0] <= 30) {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numDays = (int)$eDay[0] + 1;
                                }
                            }
                        } else if ((int)$sDay[1] == 2) {
                            if ((int)$sDay[2] % 400 == 0 || ((int)$sDay[2] % 4 == 0 && (int)$sDay[2] % 100 != 0)) {
                                if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                    $numdom3 = 2;
                                    $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else if ((int)$eDay[1] - 1 == 2) {
                                    if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    }
                                } else {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                }
                            } else {
                                if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                    $numdom3 = 2;
                                    $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else if ((int)$eDay[1] - 1 == 2) {
                                    if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    }
                                } else {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                }
                            }
                        } else {
                            if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                if ((int)$sDay[0] != 31) {
                                    $numdom3 = 2;
                                }
                                $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                            } else if ((int)$eDay[1] - 1 == 2) {
                                if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                    if ((int)$sDay[0] <= 29) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numDays = (int)$eDay[0];
                                    }
                                } else {
                                    if ((int)$sDay[0] <= 28) {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        if ((int)$eDay[0] < ((int)$sDay[0] - 29)) {
                                            $numdom3 = 2;
                                            $numMonths = $numMonths - 1;
                                            $numDays = 30;
                                        } else {
                                            $numDays = (int)$eDay[0];
                                        }
                                    }
                                }
                            } else {
                                if ((int)$sDay[0] <= 30) {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numDays = (int)$eDay[0] + 1;
                                }
                            }
                        }
                    }
                }
            } else {
                if ((int)$sDay[0] <= (int)$eDay[0]) {
                    $numMonths = (int)$eDay[1] + (12 - (int)$sDay[1]) + ((int)$sYear - 1) * 12;
                    $numDays = (int)$eDay[0] - ((int)$sDay[0] - 1);
                    if ($sDay[0] == 1 && $eDay[0] == $numdom1) {
                        $numMonths = (int)$eDay[1] + (12 - (int)$sDay[1]) + ((int)$sYear - 1) * 12 + 1;
                        $numDays = 0;
                    }
                } else {
                    if ((int)$sDay[0] == ((int)$eDay[0] + 1)) {
                        $numMonths = (int)$eDay[1] + (12 - (int)$sDay[1]) + ((int)$sYear - 1) * 12;
                        $numDays = 0;
                    } else {
                        $numMonths = (int)$eDay[1] + (12 - (int)$sDay[1]) + ((int)$sYear - 1) * 12 - 1;
                        if ((((int)$sDay[1] == 4 || (int)$sDay[1] == 6) || (int)$sDay[1] == 9) || (int)$sDay[1] == 11) {
                            if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                $numdom3 = 2;
                                $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                            } else if ((int)$eDay[1] - 1 == 2) {
                                if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                    if ((int)$sDay[0] <= 29) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numDays = (int)$eDay[0] - ((int)$sDay[0] - 30);
                                    }
                                } else {
                                    if ((int)$sDay[0] <= 28) {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        if ((int)$eDay[0] < ((int)$sDay[0] - 29)) {
                                            $numdom3 = 2;
                                            $numMonths = $numMonths - 1;
                                            $numDays = 30;
                                        } else {
                                            $numDays = (int)$eDay[0] - ((int)$sDay[0] - 29);
                                        }
                                    }
                                }
                            } else {
                                if ((int)$sDay[0] <= 30) {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numDays = (int)$eDay[0] + 1;
                                }
                            }
                        } else if ((int)$sDay[1] == 2) {
                            if ((int)$sDay[2] % 400 == 0 || ((int)$sDay[2] % 4 == 0 && (int)$sDay[2] % 100 != 0)) {
                                if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                    $numdom3 = 2;
                                    $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else if ((int)$eDay[1] - 1 == 2) {
                                    if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    }
                                } else {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                }
                            } else {
                                if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                    $numdom3 = 2;
                                    $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else if ((int)$eDay[1] - 1 == 2) {
                                    if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    }
                                } else {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                }
                            }
                        } else {
                            if ((((int)$eDay[1] - 1 == 4 || (int)$eDay[1] - 1 == 6) || (int)$eDay[1] - 1 == 9) || (int)$eDay[1] - 1 == 11) {
                                if ((int)$sDay[0] != 31) {
                                    $numdom3 = 2;
                                }
                                $numDays = 30 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                            } else if ((int)$eDay[1] - 1 == 2) {
                                if ((int)$eDay[2] % 400 == 0 || ((int)$eDay[2] % 4 == 0 && (int)$eDay[2] % 100 != 0)) {
                                    if ((int)$sDay[0] <= 29) {
                                        $numdom3 = 2;
                                        $numDays = 29 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        $numDays = (int)$eDay[0];
                                    }
                                } else {
                                    if ((int)$sDay[0] <= 28) {
                                        $numdom3 = 2;
                                        $numDays = 28 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                    } else {
                                        if ((int)$eDay[0] < ((int)$sDay[0] - 29)) {
                                            $numdom3 = 2;
                                            $numMonths = $numMonths - 1;
                                            $numDays = 30;
                                        } else {
                                            $numDays = (int)$eDay[0];
                                        }
                                    }
                                }
                            } else {
                                if ((int)$sDay[0] <= 30) {
                                    $numdom3 = 2;
                                    $numDays = 31 - ((int)$sDay[0] - 1) + (int)$eDay[0];
                                } else {
                                    $numdom3 = 2;
                                    $numDays = (int)$eDay[0] + 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        $res = [];
        $res['num_month'] = $numMonths;
        $res['num_day'] = $numDays;
        return $res;
    }
}


if (!function_exists('get_price')) {
    function get_price($start, $end, $no_of_adults, $no_of_children)
    {
        $oshcStatusId = Config::get('admin.service_id.oshc');
        $serviceProviders = Dichvu::where('service_id', $oshcStatusId)->get()->pluck('id')->toArray();
        $cover = '';
        $sDay = array();
        $sDay = explode('/', $start);
        $eDay = array();
        $eDay = explode('/', $end);
        $numMonths = 0;
        $numDays = 0;
        $numdom1 = 0;
        $numdom2 = 0;
        $ahm_mdb_nib = [];
        $singleParents = array();
        if (sizeof($sDay) == 3 && sizeof($eDay) == 3) {
            $numdom1 = get_num_day_of_month($eDay[1], $eDay[2]);
            $numdom2 = get_num_day_of_month($eDay[1] - 1, $eDay[2]);
            $num_month_day = get_num_month_or_day_of_range($sDay, $eDay, $numdom1, $numdom2);
            $numMonths = $num_month_day['num_month'];
            $numDays = $num_month_day['num_day'];
            $price_all = '';
            $price_m = 0;
            $numdom3 = 1;
            $type = 1;
            //////////////////////////////////////////////////////////////////////////////////////////////
            if ($no_of_adults == 2 && $no_of_children > 0) {
                $cover = 'Family';
                $type = 3;
            } else if ($no_of_adults == 2 || ($no_of_children == 1 && $no_of_adults == 1)) {
                $cover = 'Couple';
                $type = 2;
            } else if ($no_of_adults == 1 && $no_of_children == 0) {
                $cover = 'Single';
            } else if ($no_of_adults == 1 && $no_of_children > 0) {
                $cover = 'Single Parents';
                $type = 3;
                $singleParents = [$no_of_adults, $no_of_children];
            }

            //////////////////////////////////////////////////////////////////////////////////////////////
            $ahm_mdb_nib = get_arr_price_qa($start, $end, $cover, $singleParents, $oshcStatusId, $serviceProviders);
            $services = Service::where('status', 1)->whereIn('dichvu_id', $serviceProviders)->whereNotNull('link')->where('price_type', 0)->get();
            if ($numDays > 0) $numMonths = $numMonths + 1;
            foreach ($services as $service) {

                if ($service->slug == 'bupa' && $no_of_children == 1 && $no_of_adults == 1) {
                    $price = Price::where('status', 1)->where('type', 3)->where('service_id', $service->id)->where('num_month', $numMonths)->first();
                } else {
                    $price = Price::where('status', 1)->where('type', $type)->where('service_id', $service->id)->where('num_month', $numMonths)->first();
                }

                if ($price == null) $price = 0;
                else $price = $price->price;
                $ahm_mdb_nib[$service->slug] = $price;
            }
        }
        return $ahm_mdb_nib;
    }
}

if (!function_exists('covert_string_date')) {

    function covert_string_date($obj)
    {
        $res['day'] = '01';
        if (App::isLocale('cn')) $res['month'] = '一月';
        else if (App::isLocale('vi')) $res['month'] = ' T1';
        else $res['month'] = 'Jan';
        $res['year'] = '2019';
        if ($obj != null) {
            $created_date = $obj->created_at;
            $created_date_main = $obj->post_created_at;


            $day = explode(' ', $created_date);
            if (sizeof($day) != 2) return $res;
            $day = $day[0];

            if (!empty($created_date_main)) {
                $day = $created_date_main;
            }
            $day = explode('-', $day);
            if (sizeof($day) != 3) return $res;
            $res['year'] = $day[0];
            $res['day'] = $day[2];
            $month = intval($day[1]);

            switch ($month) {
                case '1':
                    if (App::isLocale('cn')) $res['month'] = '一月';
                    else if (App::isLocale('vi')) $res['month'] = ' T1';
                    else $res['month'] = 'Jan';
                    break;
                case '2':
                    if (App::isLocale('cn')) $res['month'] = '二月';
                    else if (App::isLocale('vi')) $res['month'] = ' T2';
                    else $res['month'] = 'Feb';
                    break;
                case '3':
                    if (App::isLocale('cn')) $res['month'] = '三月';
                    else if (App::isLocale('vi')) $res['month'] = ' T3';
                    else $res['month'] = 'Mar';
                    break;
                case '4':
                    if (App::isLocale('cn')) $res['month'] = '四月';
                    else if (App::isLocale('vi')) $res['month'] = ' T4';
                    else $res['month'] = 'Apr';
                    break;
                case '5':
                    if (App::isLocale('cn')) $res['month'] = '五月';
                    else if (App::isLocale('vi')) $res['month'] = ' T5';
                    else $res['month'] = 'May';
                    break;
                case '6':
                    if (App::isLocale('cn')) $res['month'] = '六月';
                    else if (App::isLocale('vi')) $res['month'] = ' T6';
                    else $res['month'] = 'Jun';
                    break;
                case '7':
                    if (App::isLocale('cn')) $res['month'] = '七月';
                    else if (App::isLocale('vi')) $res['month'] = ' T7';
                    else $res['month'] = 'Jul';
                    break;
                case '8':
                    if (App::isLocale('cn')) $res['month'] = '八月';
                    else if (App::isLocale('vi')) $res['month'] = ' T8';
                    else $res['month'] = 'Aug';
                    break;
                case '9':
                    if (App::isLocale('cn')) $res['month'] = '九月';
                    else if (App::isLocale('vi')) $res['month'] = ' T9';
                    else $res['month'] = 'Sep';
                    break;
                case '10':
                    if (App::isLocale('cn')) $res['month'] = '十月';
                    else if (App::isLocale('vi')) $res['month'] = ' T10';
                    else $res['month'] = 'Oct';
                    break;
                case '11':
                    if (App::isLocale('cn')) $res['month'] = '十一月';
                    else if (App::isLocale('vi')) $res['month'] = ' T11';
                    else $res['month'] = 'Nov';
                    break;
                case '12':
                    if (App::isLocale('cn')) $res['month'] = '十二月';
                    else if (App::isLocale('vi')) $res['month'] = ' T12';
                    else $res['month'] = 'Dec';
                    break;

                default:
                    $res['day'] = '01';
                    if (App::isLocale('cn')) $res['month'] = '一月';
                    else if (App::isLocale('vi')) $res['month'] = ' T1';
                    else $res['month'] = 'Jan';
                    break;
            }
        }


        return $res;
    }
}
if (!function_exists('convert_price_float')) {
    function convert_price_float($price, $decimals = 2, $currency = null)
    {
        if ($price == 0) {
            return $price;
        }
        $number = number_format($price, $decimals, '.', ',');
//        if ($currency == 'VND')
//        {
//            $number = explode(',', $number);
//            $decimal = isset($number[2]) ? ".$number[2]" : '';
//            $thousand = isset($number[1]) ? ",$number[1]" : '';
//            $number = "$number[0]$thousand$decimal";
//        }
        return $number;
    }
}

if (!function_exists('convert_price_float_vnd_not_show_d')) {
    function convert_price_float_vnd_not_show_d($price)
    {
        $total = 0;
        if ($price != 0) {
            $fmt = numfmt_create('vi_VN', NumberFormatter::CURRENCY);
            $priceVND = numfmt_format_currency($fmt, $price, 'VND');
            if (strlen($priceVND) > 12) {
                $price = str_split($priceVND, strlen($priceVND) - 5);
                $total = substr_replace($price[0], ' ,', -4, 1);
                return $total;
            }

            return str_replace('₫', '', $priceVND);
        }
        return $total;

    }
}

if (!function_exists('get_name_file_payment')) {
    function get_name_file_payment($name)
    {
        $fullName = explode('-', $name);
        $nameInvoice = (!empty($fullName[0])) ? $fullName[0] : '';
        return $nameInvoice;
    }
}
if (!function_exists('get_youtube_id_from_url')) {
    function get_youtube_id_from_url($url)
    {
        preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $url,
            $match
        );

        return $match[1];
    }
}
if (!function_exists('youtube_title')) {
    function youtube_title($id)
    {
        //        dd($id);
        // $id = 'YOUTUBE_ID';
        // returns a single line of JSON that contains the video title. Not a giant request.
        $videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" . $id . "&key=AIzaSyBpLwAKfQWLmvAcsZad8SEUcEYJNn3Auhc");
        // despite @ suppress, it will be false if it fails
        if ($videoTitle) {
            $json = json_decode($videoTitle, true);
            return $json['items'][0]['snippet']['title'];
        } else {
            return false;
        }
    }
}
if (!function_exists('youtube_image_medium')) {
    function youtube_image_medium($id)
    {
        //        dd($id);
        // $id = 'YOUTUBE_ID';
        // returns a single line of JSON that contains the video title. Not a giant request.
        $videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" . $id . "&key=AIzaSyBpLwAKfQWLmvAcsZad8SEUcEYJNn3Auhc");
        // despite @ suppress, it will be false if it fails
        if ($videoTitle) {
            $json = json_decode($videoTitle, true);
            return $json['items'][0]['snippet']['thumbnails']['medium']['url'];
        } else {
            return false;
        }
    }
}
if (!function_exists('convert_value_service_country')) {
    function convert_value_service_country($val)
    {
        $currency = '';
        if ($val == 'A') {
            $currency = 'AUD';
        } else if ($val == 'U') {
            $currency = 'USD';
        } else if ($val == 'N') {
            $currency = 'NZD';
        }
        return $currency;
    }
}
if (!function_exists('convert_date_to_db')) {
    function convert_date_to_db($date)
    {
        if ($date == '' || $date == null || $date == '0000-00-00') {
            return;
        }
        $date = str_replace('/', '-', $date);
        return date('Y-m-d', strtotime(trim($date)));
    }
}
if (!function_exists('convert_date_form_db')) {
    function convert_date_form_db($date)
    {
        if ($date == '' || $date == null || $date == '0000-00-00') {
            return;
        }
        $date = str_replace('-', '/', $date);
        return date('d/m/Y', strtotime(trim($date)));
    }
}
if (!function_exists('convert_id_to_name_person_in_charge')) {
    function convert_id_to_name_person_in_charge($admin, $person_id)
    {
        $data = '';
        if (empty($person_id)) {
            return $data;
        }

        $person_id = json_decode($person_id);
        if (is_array($person_id)) {
            $personIncharge = [];
            foreach ($person_id as $key => $value) {
                array_push($personIncharge, $admin[$value]);
            }

            $data = join(', ', $personIncharge);
            return $data;
        }

        return $admin[$person_id];

    }
}
if (!function_exists('convert_number_currency_to_db')) {
    function convert_number_currency_to_db($stringNumber)
    {
        if ($stringNumber == '' || $stringNumber == null) {
            return;
        }
        $stringNumber = str_replace(',', '', $stringNumber);
        return $stringNumber;
    }
}
if (!function_exists('dateRangePicker')) {
    function dateRangePicker($date)
    {
        if ($date == '' || $date == null) {
            return [now(), now()];
        }
        $range = explode(" to ", $date);
        $from = convert_date_to_db(trim($range[0]));
        $to = (!empty($range[1])) ? convert_date_to_db(trim($range[1])) : $from;
        return array($from . ' 00:00:00', $to . ' 23:59:59');
    }
}
if (!function_exists('getMonthYearInDateRange')) {
    function getMonthYearInDateRange($date)
    {
        if ($date == '' || $date == null) {
            return;
        }
        $interval = new DateInterval('P1M');
        $range = explode(" to ", $date);
        $startDate = convert_date_to_db(trim($range[0]));
        $endDate = (!empty($range[1])) ? convert_date_to_db(trim($range[1])) : $startDate;
        $periods = new DatePeriod(new DateTime($startDate), $interval, new DateTime($endDate));
        $arrayMonth = array_map(function ($periods) {
            return $periods->format('m/Y');
        }, iterator_to_array($periods));

        return ($arrayMonth);
    }
}
if (!function_exists('convertTwoDateInputToDateRange')) {
    function convertTwoDateInputToDateRange($start, $end)
    {
        if ($start == '' || $start == null && $end == '' || $end == null) {
            return;
        }
        $dateString = $start . ' to ' . $end;
        return $dateString;
    }
}

if (!function_exists('convertDateMonthMMToM')) {
    function convertDateMonthMMToM($monthYear)
    {
        if ($monthYear == '' || $monthYear == null) {
            return;
        }
        $range = explode("/", $monthYear);
        $month = $range[0];
        $year = $range[1];
        $date = $month . '/' . $year;
        return $date;
    }
}
if (!function_exists('getUnit')) {
    function getUnit($unit)
    {
        if (!empty($unit)) {
            return Config::get('myconfig.unit')[$unit];
        }
        return '';
    }
}

if (!function_exists('getCurrency')) {
    function getCurrency($currency)
    {
        if (!empty($currency)) {
            return Config::get('myconfig.currency')[$currency];
        }
        return '';
    }
}
if (!function_exists('getComStatusFlywire')) {
    function getComStatusFlywire($status)
    {
        if (!empty($status)) {
            return Config::get('myconfig.com_status')[$status];
        }
        return '';
    }
}
if (!function_exists('getQuarterNameNumber')) {
    function getQuarterNameNumber($value)
    {
        if (!empty($value)) {
            return Config::get('myconfig.quarter')[$value]['name'];
        }
        return '';
    }
}
if (!function_exists('convertNumberToRomanNumber')) {
    function convertNumberToRomanNumber($number)
    {
        if (!empty($number)) {
            $romanNumber = [
                1 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV'
            ];
            return !empty($romanNumber[$number]) ? $romanNumber[$number] : '';
        }
        return '';
    }
}
if (!function_exists('convertArrNullToEmptyValue')) {
    function convertArrNullToEmptyValue($queryArr)
    {
        $queryConvert = collect($queryArr)->map(function ($value) {
            if ($value == null) {
                $value = '';
            }
            return $value;
        })->toArray();
        return $queryConvert;
    }
}

if (!function_exists('convertDateRangeToMonth')) {
    function convertDateRangeToMonth($startDate, $endDate)
    {
        if (!empty($startDate) && !empty($endDate)) {
            $interval = new DateInterval('P1M');
            $periods = new DatePeriod(new DateTime($startDate), $interval, new DateTime($endDate));
            return iterator_to_array($periods);
        }
    }
}
if (!function_exists('getAgentName')) {
    function getAgentName($agent_id)
    {
        if (!empty($agent_id)) {
            $user = User::find($agent_id);
            return (!empty($user)) ? $user->name : '';
        }
        return '';
    }
}
if (!function_exists('getColorGoogle')) {
    function getColorGoogle($color_id)
    {
        if (!empty($color_id)) {
            $color = (!empty(Config::get('myconfig.color_event_google')[$color_id])) ? Config::get('myconfig.color_event_google')[$color_id] : '';
            return $color;
        }
        return '';
    }
}
if (!function_exists('getChildUser')) {
    function getChildUser($type)
    {
        $admin = Auth::user();
        $permissionSee = $admin->getAccessEmployee($type);
        $getAllAdminDepartment = Admin::where('department_id', $admin->department_id)->pluck('id');
        return collect([
            'getAllAdminDepartment' => $getAllAdminDepartment,
            'permissionSee' => $permissionSee,
            'admin' => $admin
        ]);
    }
}

if (!function_exists('getColorByDate')) {
    function getColorByDate($date)
    {
        $weekMap = [
            0 => 'SU',
            1 => 'MO',
            2 => 'TU',
            3 => 'WE',
            4 => 'TH',
            5 => 'FR',
            6 => 'SA',
        ];
        if (!empty($date)) {
            $color = (!empty($weekMap[$date])) ? $weekMap[$date] : '';
            return $color;
        }
        return '';
    }
}

if (!function_exists('get_price_insurrance')) {
    function get_price_insurrance($start, $end, $no_of_adults, $no_of_children)
    {
        $services = Service::where('dichvu_id', 2)->get([
            'id',
            'dichvu_id',
            'slug'
        ]);
        $cover = '';
        $sDay = array();
        $sDay = explode('/', $start);
        $eDay = array();
        $eDay = explode('/', $end);
        $numMonths = 0;
        $numDays = 0;
        $numdom1 = 0;
        $numdom2 = 0;
        $insurrance = [];
        if (sizeof($sDay) == 3 && sizeof($eDay) == 3) {
            $numdom1 = get_num_day_of_month($eDay[1], $eDay[2]);
            $numdom2 = get_num_day_of_month($eDay[1] - 1, $eDay[2]);
            $num_month_day = get_num_month_or_day_of_range($sDay, $eDay, $numdom1, $numdom2);
            $numMonths = ($num_month_day['num_month'] == 0) ? 1 : $num_month_day['num_month'];
            $startDate = Carbon::parse(convert_date_to_db($start));
            $endDate = Carbon::parse(convert_date_to_db($end));
            $numDays = $endDate->diffInDays($startDate);
            $price_all = '';
            $price_m = 0;
            $numdom3 = 1;
            $type = 1;
            //////////////////////////////////////////////////////////////////////////////////////////////
            if ($no_of_adults == 2 && $no_of_children > 0) {
                $cover = 'Family';
                $type = 3;
            } else if ($no_of_adults == 2 || ($no_of_children == 1 && $no_of_adults == 1)) {
                $cover = 'Couple';
                $type = 2;
            } else if ($no_of_adults == 1) {
                $cover = 'Single';
            }
            foreach ($services as $service) {
                if ($service->slug == 'allianz') {
                    $allianz = Allianz::where('type', $type)->where('num_days', $numDays)->first()->price;
                    $insurrance[$service->slug] = !empty($allianz) ? $allianz : 0;
                } elseif ($service->slug == 'medibank') {
                    if ($no_of_children == 1 && $no_of_adults == 1) {
                        $type = 3;
                    }
                    $medibank = Medibank::where('type', $type)->where('num_days', $numDays)->first()->price;
                    $insurrance[$service->slug] = !empty($medibank) ? $medibank : 0;
                } elseif ($service->slug == 'AHM') {
                    if ($no_of_children == 1 && $no_of_adults == 1) {
                        $type = 3;
                    }
                    $ahm = Ahm::where('type', $type)->where('num_days', $numDays)->first()->price;
                    $insurrance[$service->slug] = !empty($ahm) ? $ahm : 0;
                } elseif ($service->slug == 'nib') {
                    if ($no_of_children == 1 && $no_of_adults == 1) {
                        $type = 3;
                    }
                    $nib = Nib::where('type', $type)->where('num_days', $numDays)->first()->price;
                    $insurrance[$service->slug] = !empty($nib) ? $nib : 0;
                } elseif ($service->slug == 'bupa') {
                    $bupa = Price::where('status', 1)->where('type', $type)->where('service_id', $service->id)->where('num_month', $numMonths)->first();
                    $insurrance[$service->slug] = !empty($bupa) ? $bupa->price : 0;
                }
            }
            return $insurrance;
        }
    }
}

if (!function_exists('getSchoolFlywire')) {
    function getSchoolFlywire()
    {

//        //cache()->forget('school_api_flywire');
//        $schools = cache()->rememberForever('school_api_flywire',function(){
//            $cookie = getLoginFlywire();
//            $scCookie = $cookie['sc'];
//            $peer_session_id = $cookie['peer_session_id'];
//            $XSRF_TOKEN = $cookie['XSRF_TOKEN'];
//            $curl = curl_init();
//
//            curl_setopt_array($curl, [
//                CURLOPT_URL => 'https://agents.flywire.com/rest/payex/recipient',
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => '',
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => 'GET',
//                CURLOPT_HTTPHEADER => [
//                    'authority: agents.flywire.com',
//                    'pragma: no-cache',
//                    'cache-control: no-cache',
//                    'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
//                    'accept: application/json, text/plain, */*',
//                    'x-xsrf-token: TI0Sy983LCzaQitDknUnl6IGIOiE4P7vVX5l7Xqd6R7fk2wWYzGPm2WFS24UCMTifDSbpvwfl3PsH69GtIjDNCYY6H8NtmnqojZz',
//                    'sec-ch-ua-mobile: ?0',
//                    'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
//                    'sec-fetch-site: same-origin',
//                    'sec-fetch-mode: cors',
//                    'sec-fetch-dest: empty',
////                    'referer: https://agents.flywire.com/',
//                    'accept-language: en-US,en;q=0.9,vi;q=0.8',
//                    'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc='.$scCookie.'; XSRF-TOKEN='.$XSRF_TOKEN.'; loggedIn=true; peer_session_id='.$peer_session_id.'; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca'
//                ],
//            ]);
//
//            $response = curl_exec($curl);
//
//            curl_close($curl);
//
//            return json_decode($response);
//        });
//        $object1 = (object) [
//            'id' => 'CHS',
//            'name' => "Canada Homestay Network"
//        ];
//
//        $object2 = (object) [
//            'id' => 'OPP',
//            'name' => 'Central Okanagan Public Schools - Domestic'
//        ];
//
//        array_push($schools, $object1, $object2);
        $schools = config('schools');
        return collect($schools)->pluck('name', 'id');
    }
}

if (!function_exists('getLoginFlywire')) {
    function getLoginFlywire()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://agents.flywire.com/rest/authentication/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'authority: agents.flywire.com',
                'pragma: no-cache',
                'cache-control: no-cache',
                'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
                'accept: application/json, text/plain, */*',
                'authorization: Basic aW5mb0Bvc2hjc3R1ZGVudHMuY29tOjEyM0BBbm5hbGluaw==',
                'sec-ch-ua-mobile: ?0',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
                'content-type: application/json',
                'sec-fetch-site: same-origin',
                'sec-fetch-mode: cors',
                'sec-fetch-dest: empty',
                'referer: https://agents.flywire.com/',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=dd49fa4f-a2fb-494b-b937-df8aeda1cc57; loggedIn=true; sc=AFGFyij4d2mp6F20Cm9sHrkkjQtnmYAbXVM6p9UgxqaONC8QiCbpnzZxYwYN5csUj545Qs55Z6IS40QLyjq1eX59nN9zMbhD0ReQ; XSRF-TOKEN=C7r5nZER2Mpb0fCz2frzw9t4YBrYUoigIOB3WXTyWXwKPXin28qEtXwMZpJCIKnnc9CNbWLXD9GkB0aeH8Knuj6S7KDB9tCIYEpl; peer_session_id=4610209f-986c-4c8a-87f9-75ac10bdb085'
            ],
            CURLOPT_HEADER => 1
        ]);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        preg_match_all('/^Set-Cookie:\s*([^\r\n]*)/mi', $response, $ms);
        $cookies = array();
        foreach ($ms[1] as $m) {
            [$name, $value] = explode('=', $m, 2);
            $cookies[$name] = explode(';', $value);
        }
        $scCookie = $cookies['sc'][0];
        $peer_session_id = $cookies['peer_session_id'][0];
        $XSRF_TOKEN = $cookies['XSRF-TOKEN'][0];
        $cookie = [
            'sc' => $scCookie,
            'peer_session_id' => $peer_session_id,
            'XSRF_TOKEN' => $XSRF_TOKEN
        ];
        return $cookie;
    }
}
if (!function_exists('ExchangeToAUDForFlywire')) {
    function ExchangeToAUDForFlywire($items)
    {

        $getQuarterId = Carbon::parse($items->delivered_date)->quarter;
        $getYearQuarter = Carbon::parse($items->delivered_date)->format('Y');
        $getUnitProviderId = (!empty($items)) ? $items->amount_to_unit : '';
        $flywireComProvider = 8;
        $flywireComAgent = 9;
        $audUnit = 8;
        if ($getUnitProviderId == $audUnit) {
            $exchangeRateFlywireComProvider = new ExchangRate();
            $exchangeRateFlywireComProvider->unit_to_aud = 1;
        } else {
            $exchangeRateFlywireComProvider = ExchangRate::where('quarter_id', $getQuarterId)
                ->where('year', $getYearQuarter)
                ->where('unit', $getUnitProviderId)
                ->where('type', $flywireComProvider)
                ->first();
        }

        return (!empty($exchangeRateFlywireComProvider)) ? $exchangeRateFlywireComProvider->unit_to_aud : 0;
    }
}

if (!function_exists('ExchangeToVNDForFlywire')) {
    function ExchangeToVNDForFlywire($getQuarterId, $getYearQuarter)
    {
        $exchangeRateFlywireComAgent = ExchangRate::where('quarter_id', $getQuarterId)
            ->where('year', $getYearQuarter)
            ->where('type', 9)
            ->first();

        return (!empty($exchangeRateFlywireComAgent)) ? $exchangeRateFlywireComAgent->aud_to_vnd : 0;
    }
}

if (!function_exists('getQuarter')) {
    function getQuarter($flywire, $type = null)
    {
        $result = [];
        $quarter = [];
        $countDataTd = [];

        $quarter_1 = '';
        $quarter_2 = '';
        $quarter_3 = '';
        $quarter_4 = '';

        foreach ($flywire as $items) { // loop date and clear month year duplicate
            $getYearQuarter = Carbon::parse($items->delivered_date)->format('m/Y'); // get year quarter
            if (getMonthByMonthYearQuarter($getYearQuarter) < '04') {
                array_push($quarter, $getYearQuarter);
                $quarter = array_unique($quarter); // remove item dublicate

            } elseif (getMonthByMonthYearQuarter($getYearQuarter) >= '04' && getMonthByMonthYearQuarter($getYearQuarter) <= '06') {
                array_push($quarter, $getYearQuarter);
                $quarter = array_unique($quarter); // remove item dublicate

            } elseif (getMonthByMonthYearQuarter($getYearQuarter) >= '07' && getMonthByMonthYearQuarter($getYearQuarter) <= '09') {
                array_push($quarter, $getYearQuarter);
                $quarter = array_unique($quarter); // remove item dublicate

            } elseif (getMonthByMonthYearQuarter($getYearQuarter) >= '10' && getMonthByMonthYearQuarter($getYearQuarter) <= '12') {
                array_push($quarter, $getYearQuarter);
                $quarter = array_unique($quarter); // remove item dublicate
            }
//            sort($quarter, SORT_NATURAL | SORT_FLAG_CASE); // sort Desc
        }

        $sortNewQuarter = [];
        foreach ($quarter as $items) {
            if (substr($items, 3) == '2021') {
                array_push($sortNewQuarter, $items);
            }
        }
        sort($sortNewQuarter);

        $sortQuarter = [];
        foreach ($quarter as $items) {
            if (substr($items, 3) == '2020') {
                array_push($sortQuarter, $items);
            }
        }

        sort($sortQuarter);
        array_push($sortQuarter, $sortNewQuarter);
        $sortQuarter = array_flatten($sortQuarter);

        foreach ($sortQuarter as $items) {
            if (substr($items, 0, 2) == '01' || substr($items, 0, 2) == '02' || substr($items, 0, 2) == '03') {
                $a = substr($items, 3);
                $quarter_1 = "<td colspan=2 class='width-4 th_table_export_excel'><b>Quarter I / $a</b></td>";
                array_push($countDataTd, 1);
                $result[0] = $quarter_1;
            } elseif (substr($items, 0, 2) == '04' || substr($items, 0, 2) == '05' || substr($items, 0, 2) == '06') {
                $a = substr($items, 3);
                $quarter_2 = "<td colspan=2 class='width-5 th_table_export_excel'><b>Quarter II / $a</b></td>";
                array_push($countDataTd, 2);
                $result[1] = $quarter_2;


            } elseif (substr($items, 0, 2) == '07' || substr($items, 0, 2) == '08' || substr($items, 0, 2) == '09') {
                $a = substr($items, 3);
                $quarter_3 = "<td colspan=2 class='width-4 th_table_export_excel'><b>Quarter III / $a</b></td>";
                array_push($countDataTd, 3);
                $result[2] = $quarter_3;


            } elseif (substr($items, 0, 2) == '10' || substr($items, 0, 2) == '11' || substr($items, 0, 2) == '12') {
                $a = substr($items, 3);
                $quarter_4 = "<td colspan=2 class='width-4 th_table_export_excel'><b>Quarter IV / $a</b></td>";
                array_push($countDataTd, 4);
                $result[3] = $quarter_4;

            }
        }
        if ($type == 'dataQuarter') {
            return $countDataTd;
        }
        echo join(' ', $result);
    }
}


if (!function_exists('getQuarterDataReport')) {
    function getQuarterDataReport($flywire, $type = null)
    {
        $result = [];
        $quarter = [];
        $countDataTd = [];

        $quarter_1 = '';
        $quarter_2 = '';
        $quarter_3 = '';
        $quarter_4 = '';

        foreach ($flywire as $items) {
            $getYearQuarter = Carbon::parse($items->delivered_date)->format('m/Y'); // get year quarter
            if (substr($getYearQuarter, 0, 2) < '04') {
                array_push($quarter, $getYearQuarter);

            } elseif (getMonthByMonthYearQuarter($getYearQuarter) >= '04' && getMonthByMonthYearQuarter($getYearQuarter) <= '06') {
                array_push($quarter, $getYearQuarter);

            } elseif (getMonthByMonthYearQuarter($getYearQuarter) >= '07' && getMonthByMonthYearQuarter($getYearQuarter) <= '09') {
                array_push($quarter, $getYearQuarter);

            } elseif (getMonthByMonthYearQuarter($getYearQuarter) >= '10' && getMonthByMonthYearQuarter($getYearQuarter) <= '12') {
                array_push($quarter, $getYearQuarter);
            }
            $quarter = array_unique($quarter);
        }

        $sortNewQuarter = [];
        foreach ($quarter as $items) {
            if (substr($items, 3) == '2021') {
                array_push($sortNewQuarter, $items);
            }
        }
        sort($sortNewQuarter);

        $sortQuarter = [];
        foreach ($quarter as $items) {
            if (substr($items, 3) == '2020') {
                array_push($sortQuarter, $items);
            }
        }

        sort($sortQuarter);
        array_push($sortQuarter, $sortNewQuarter);
        $sortQuarter = array_flatten($sortQuarter);
        foreach ($sortQuarter as $items) {
            if (substr($items, 0, 2) == '01' || substr($items, 0, 2) == '02' || substr($items, 0, 2) == '03') {
                $a = substr($items, 3);
                $quarter_1 = '<td colspan=2 height=42  bgcolor="#EF4B88" style="
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: Times New Roman;
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;"><b><font face="Times New Roman" size=3 color="white">Quarter I / <br>' . $a . '</font></b></td>';
                array_push($countDataTd, 1);
                $result[0] = $quarter_1;

            } elseif (substr($items, 0, 2) == '04' || substr($items, 0, 2) == '05' || substr($items, 0, 2) == '06') {
                $a = substr($items, 3);
                $quarter_2 = '<td colspan=2 height=42 bgcolor="#EF4B88" style=";
                padding: 0px;
                mso-ignore: padding;
                color: white;
                font-size: 12.0pt;
                font-weight: 700;
                font-style: normal;
                text-decoration: none;
                font-family: Times New Roman;
                mso-generic-font-family: auto;
                mso-font-charset: 1;
                mso-number-format: General;
                text-align: center;
                vertical-align: middle;
                border-top: .5pt solid windowtext;
                border-right: none;
                border-bottom: .5pt solid windowtext;
                border-left: .5pt solid windowtext;
                mso-pattern: black none;
                white-space: normal;"><b><font face="Times New Roman" size=3 color="white">Quarter II / <br>' . $a . '</font></b></td>';
                array_push($countDataTd, 2);
                $result[1] = $quarter_2;


            } elseif (substr($items, 0, 2) == '07' || substr($items, 0, 2) == '08' || substr($items, 0, 2) == '09') {
                $a = substr($items, 3);
                $quarter_3 = '<td colspan=2 height=42  bgcolor="#EF4B88" style="height:54.4pt;
                padding: 0px;
                mso-ignore: padding;
                color: white;
                font-size: 12.0pt;
                font-weight: 700;
                font-style: normal;
                text-decoration: none;
                font-family: Times New Roman;
                mso-generic-font-family: auto;
                mso-font-charset: 1;
                mso-number-format: General;
                text-align: center;
                vertical-align: middle;
                border-top: .5pt solid windowtext;
                border-right: none;
                border-bottom: .5pt solid windowtext;
                border-left: .5pt solid windowtext;
                mso-pattern: black none;
                white-space: normal;"><b><font face="Times New Roman" size=3 color="white">Quarter III / <br>' . $a . '</font></b></td>';
                array_push($countDataTd, 3);
                $result[2] = $quarter_3;


            } elseif (substr($items, 0, 2) == '10' || substr($items, 0, 2) == '11' || substr($items, 0, 2) == '12') {
                $a = substr($items, 3);
                $quarter_4 = '<td colspan=2 height=42 bgcolor="#EF4B88" style="height:54.4pt;
                padding: 0px;
                mso-ignore: padding;
                color: white;
                font-size: 12.0pt;
                font-weight: 700;
                font-style: normal;
                text-decoration: none;
                font-family: Times New Roman;
                mso-generic-font-family: auto;
                mso-font-charset: 1;
                mso-number-format: General;
                text-align: center;
                vertical-align: middle;
                border-top: .5pt solid windowtext;
                border-right: none;
                border-bottom: .5pt solid windowtext;
                border-left: .5pt solid windowtext;
                mso-pattern: black none;
                white-space: normal;"><b><font face="Times New Roman" size=3 color="white">Quarter IV / <br>' . $a . '</font></b></td>';
                array_push($countDataTd, 4);
                $result[3] = $quarter_4;

            }
        }
        if ($type == 'dataQuarter') {
            return $countDataTd;
        }

        echo join(' ', $result);
    }
}

if (!function_exists('getMonthByMonthYearQuarter')) {
    function getMonthByMonthYearQuarter($item)
    {
        return substr($item, 0, 2);
    }
}

if (!function_exists('showDataReportForHTMLReport')) {
    function showDataReportForHTMLReportEn($countQuarter, $getQuarterId, $totalQuarter)
    {
        $countQuarter = array_unique($countQuarter);
        if (count($countQuarter) > 0) {

            foreach ($countQuarter as $quarter => $value) {

                if ($getQuarterId == $value) {
                    echo '<td colspan = 2 align=center class="width-5 td_table_export_excel" style="font-family: Times New Roman;" index=' . $quarter . ' data-total-quarter-' . $value . '="' . $totalQuarter . '"><span >' . convert_price_float($totalQuarter) . '</span ></td >';
                } else {
                    echo '<td colspan = 2  align=center class="width-5 td_table_export_excel" style="font-family: Times New Roman;" ><span ></span ></td >';
                }
            }
        } else {
            echo '<td colspan = 2  align=center class="width-5 td_table_export_excel" ><span ></span ></td >';
        }
    }
}

if (!function_exists('showDataReportForHTMLReport')) {
    function showDataReportForHTMLReport($countQuarter, $getQuarterId, $totalQuarter)
    {
        $countQuarter = array_unique($countQuarter);
        $totalQuarterAfterConvert = convert_price_float($totalQuarter, 0, 'VND');
        if (count($countQuarter) > 0) {
            foreach ($countQuarter as $quarter => $value) {
                if ($getQuarterId == $value) {
                    echo '<td colspan = 2 align=center class="width-5 td_table_export_excel" style="font-family: Times New Roman;" index=' . $quarter . ' data-total-quarter-' . $value . '="' . $totalQuarter . '"><span face="Times New Roman" style="font-size: 12.0pt;">' . $totalQuarterAfterConvert . '</span ></td >';
                } else {
                    echo '<td colspan = 2  align=center class="width-5 td_table_export_excel" style="font-family: Times New Roman;" ><span ></span ></td >';
                }
            }
        } else {
            echo '<td colspan = 2  align=center class="width-5 td_table_export_excel" style="font-family: Times New Roman;" ><span ></span ></td >';
        }
    }
}

if (!function_exists('getComm')) {
    function getComm($id, $provider_id, $initiated_date)
    {
        if ($id) {
            $comm = Admin\Commission::select('comm')
                ->where('user_id', $id)
                ->where('provider_id', $provider_id)
                ->where('validity_start_date', '<', $initiated_date)
                ->orderby('validity_start_date', 'desc')
                ->first();
            return ($comm) ? $comm->comm : 0;
        }
        return 0;
    }
}

if (!function_exists('decode_html')) {
    function decode_html($content, $break = false)
    {
        if ($break == 'array') {
            $ar = explode(',', $content);
            $length = count($ar);
            $content = '';
            for ($i = 0; $i < $length; $i++) {

                $content .= "<a
                            href=' " . config('admin.base_url') . 'tailieus/' . $ar[$i] . " '> $ar[$i]
                        </a>" . '</br>';

            }
//            $content = implode('</br>', $ar);
            echo html_entity_decode($content);
        }

        if ($break == 'customer') return html_entity_decode($content);

        if ($break == false) {
            echo html_entity_decode($content);
        }
    }
}

if (!function_exists('getDepartmentById')) {
    function getDepartmentById($id)
    {
        $value = '';
        $departments = config('myconfig.department');
        if ($id) {
            $value = array_get($departments, $id);
        }
        return $value;
    }
}

if (!function_exists('getStaffNameById')) {
    function getStaffNameById($id)
    {
        if ($id) {
            $admins = DB::table('admins')->select('admin_id')->where('id', $id)->first();
            return $admins->admin_id;
        }
        return '';
    }
}

if (!function_exists('getValueByIndexConfig')) {
    function getValueByIndexConfig($config, $index)
    {
        if (!empty($index) && $index != -1) {
            return array_get($config, $index);
        }
        return '';
    }
}

if (!function_exists('getKeyConfigByValue')) {
    function getKeyConfigByValue($config, $value)
    {
        try {
            if (!empty($value)) {
                $result = array_keys($config, $value);
                if (count($result) > 0) {
                    return $result[0];
                }
            }

            return "";
        } catch (\Exception $e) {
            echo $e->getMessage() . ' ===== ';
            echo $e->getLine() . ' ===== ';
            echo $e->getTrace() . ' ===== ';
            return;
        }

    }
}

if (!function_exists('setLabelStatus')) {
    function setLabelStatus($status_id)
    {
        if (is_int($status_id)) {
            if ($status_id == 1) {
                return 'potential';
            } elseif ($status_id == 2) {
                return 'touchbase';
            } elseif ($status_id == 3) {
                return 'signed_contract';

            } elseif ($status_id == 4) {
                return 'cooporating';
            } elseif ($status_id == 5) {
                return 'quiet';
            } elseif ($status_id == 6) {
                return 'inactive';
            } elseif ($status_id == 7) {
                return 'pending';
            } elseif ($status_id == 8) {
                return 'refused';
            }
        }
        return '';
    }
}

if (!function_exists('countFlStatus_zero')) {
    function countFlStatus_zero($type)
    {
        $result = DB::table('follows')->select(DB::raw('count(*) as zero'))
            ->where('follow_up_status', $type)
            ->get()[0];
        return "($result->zero)";
    }
}

if (!function_exists('countHotIssue')) {
    function countHotIssue()
    {
        $result = DB::table('follows')->select(DB::raw('count(*) as hot'))
            ->where('hot_issue', 1)
            ->get()[0];
        return "($result->hot)";
    }
}

if (!function_exists('setLabelFlUpStatus')) {
    function setLabelFlUpStatus($followUpStatus_id)
    {
        if (is_int($followUpStatus_id)) {
            if ($followUpStatus_id == 0) {
                return 'need_follow';
            } elseif ($followUpStatus_id == 1) {
                return 'urgent';
            } elseif ($followUpStatus_id == 2) {
                return 'stop_follow';

            } elseif ($followUpStatus_id == 3) {
                return 'done';
            }
        }
        return '';
    }
}

if (!function_exists('sortSettingsByOrder')) {
    function sortSettingsByOrder($configAgent)
    {
        $result = array();
        foreach ($configAgent as $key) {
            if ($key['isShow'] != true) continue;
            array_push($result, $key);
        }

        usort($result, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $result;
    }
}

if (!function_exists('getBank')) {
    function getBank($id = null)
    {
        if (!empty($id)) {
            $bank = Admin\Bank::select('id', 'name', 'code', 'account', 'brand', 'account_name', 'country')->where('id', $id)->first();
            return !empty($bank) ? $bank : '';
        }

        $banks = Admin\Bank::select('id', 'name', 'code', 'account', 'brand', 'account_name', 'country')->get();
        return $banks;
    }
}

if (!function_exists('getCoverByServiceAndPolicy')) {
    function getCoverByServiceAndPolicy($service, $policy)
    {
        $cover = Cover::getCover($service, $policy);

        return $cover;
    }
}

if (!function_exists('getHospitalByService')) {
    function getHospitalByService($service)
    {
        $hospital = Admin\HospitalAccess::where('service_id', $service)->get();
        return $hospital;
    }
}

if (!function_exists('getFileAttachById')) {
    function getFileAttachById($id)
    {
        $mkt = DB::table('marketing_material_lists')->select('file_attachment')->where('id', $id)->first();
        $findText = '[';
        $fileName = '';
        if ($findText == substr($mkt->file_attachment, 0, 1)) {
            $listFiles = json_decode($mkt->file_attachment, true);
            $lengthListFile = count($listFiles);
            for ($i = 0; $i < $lengthListFile; $i++) {
                $Tailieu = DB::table('tailieus')->select('link')->where('id', $listFiles[$i])->first();
                $fileName .= $Tailieu->link . ',';
            }
            return $fileName;
        }

        return $mkt->file_attachment;
    }
}


if (!function_exists('getCounsellorById')) {
    function getCounsellorById($id)
    {
        $counsellor = Person::select('name')->where('id', $id)->first();
        if (!empty($counsellor)) {
            return $counsellor->name;
        }
    }
}



