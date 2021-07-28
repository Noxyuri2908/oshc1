<?php

use Illuminate\Database\Seeder;

class TemplateInvoiceManagersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('template_invoice_managers')->delete();
        
        \DB::table('template_invoice_managers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => NULL,
                'template_name' => '1',
                'extended_properties' => NULL,
                'created_at' => '2021-01-13 21:33:28',
                'updated_at' => '2021-01-13 22:58:31',
                'company_address' => 'Company Namee',
                'logo' => 'Logo',
                'company_name' => 'Company Namee',
                'content' => '<p>Note: If you hold a student dependent visa, you must be insured under the same policy as the main student visa holder. You are only eligible to hold a single OSHC policy if you are the primary visa holder.</p>

<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL: <a href="info@oshcglobal.com">info@oshcglobal.com</a>.</p>

<p><strong>Please make payment by direct deposit to the following account:</strong></p>

<p>Account Name: OSHC GLOBAL</p>

<p>BSB: 012 260</p>

<p>Account Number: 412479564</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>Swift code: ANZBAU3M</p>

<p>We require all international transfers to us to be made with the OUR instruction and please make sure that the Invoice Number has been used as yourpayment reference.</p>

<p>Please bring your Passport and Offer letter when making payments at bank.</p>',
                'company_website' => NULL,
                'company_phone' => NULL,
                'company_email' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => NULL,
                'template_name' => '2',
                'extended_properties' => NULL,
                'created_at' => '2021-01-14 15:25:45',
                'updated_at' => '2021-01-14 15:25:45',
                'company_address' => 'VP HCM: P. 702 Block A Tòa nhà Charmington La Pointe, 181 Cao Thắng, P.12, Q.10, HCM',
                'logo' => NULL,
                'company_name' => 'OSHC global',
            'content' => '<p>Chứng từ k&egrave;m theo: Offer Letter, Giấy ủy quyền, Hộ chiếu (copy).</p>

<p><strong>Th&ocirc;ng tin chuyển khoản (chọn 1 trong 2):</strong></p>

<table cellspacing="0">
<tbody>
<tr>
<td>T&ecirc;n t&agrave;i khoản</td>
<td>:C&ocirc;ng ty Cổ Phần Annalink</td>
</tr>
<tr>
<td>Ng&acirc;n h&agrave;ng</td>
<td>:TMCP S&agrave;i G&ograve;n (SCB) &ndash; Chi nh&aacute;nh Bến Th&agrave;nh</td>
</tr>
<tr>
<td>Số t&agrave;i khoản</td>
<td>:1600 1096 3903 0003</td>
</tr>
<tr>
<td>Hoặc</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Ng&acirc;n h&agrave;ng</td>
<td>:TMCP Xuất Nhập Khẩu (Eximbank)-Chi nh&aacute;nh HCM</td>
</tr>
<tr>
<td>Số t&agrave;i khoản</td>
<td>:2112 1485 1225 376</td>
</tr>
</tbody>
</table>

<p><br />
&nbsp;</p>

<p><span style="color:#3498db"><span style="line-height:1">Lưu &yacute;: nhập nội dung chuyển tiền v&agrave;o chi tiết thanh to&aacute;n, tỷ gi&aacute; giao dịch &aacute;p dụng theo tỷ gi&aacute; b&aacute;n của Ng&acirc;n h&agrave;ng Eximbank tại thời điểm thanh to&aacute;n</span></span></p>

<p><span style="color:#3498db"><span style="line-height:1">Li&ecirc;n lạc với ch&uacute;ng t&ocirc;i để tham gia c&aacute;c dịch vụ kh&aacute;c:</span></span></p>

<p>&nbsp;</p>

<p><strong>Li&ecirc;n lạc với ch&uacute;ng t&ocirc;i để tham gia c&aacute;c dịch vụ kh&aacute;c:</strong></p>

<p>&nbsp;</p>

<p>. Nhận qu&agrave; tặng Sim Vodafone sử dụng tại &Uacute;c trước ng&agrave;y bay</p>

<p>. Nh&agrave; ở: Homestay (nh&agrave; ở với chủ)</p>

<p>. Dịch vụ gi&aacute;m hộ nếu bạn dưới 18 tuổi</p>

<p>. Chuyển tiền quốc tế với mức ph&iacute; ưu đ&atilde;i</p>',
                'company_website' => 'Email: info@annalink.com',
            'company_phone' => '|Tel: (+84) 28 3821 7005',
                'company_email' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => NULL,
                'template_name' => '3',
                'extended_properties' => NULL,
                'created_at' => '2021-01-14 15:27:57',
                'updated_at' => '2021-01-14 15:27:57',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => NULL,
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => NULL,
                'template_name' => '4',
                'extended_properties' => NULL,
                'created_at' => '2021-01-14 15:28:25',
                'updated_at' => '2021-01-14 15:28:25',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => NULL,
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'name' => NULL,
                'template_name' => '5',
                'extended_properties' => NULL,
                'created_at' => '2021-01-14 15:28:49',
                'updated_at' => '2021-01-14 15:28:49',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => NULL,
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'name' => NULL,
                'template_name' => '6',
                'extended_properties' => NULL,
                'created_at' => '2021-01-14 15:29:07',
                'updated_at' => '2021-01-15 20:51:10',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p><span style="font-size:11px">Thank you for choosing Annalink OSHCstudents. This amount of payment has been received successfully.</span></p>

<p><span style="font-size:11px">Sincerely</span></p>

<p><span style="font-size:11px"><img alt="" height="118" src="http://oschabc.test/images/ee420406b20f4951101e.jpg" width="300" /></span></p>

<p><span style="font-size:11px"><strong>Pls contact us to register other services:</strong></span></p>

<p>&nbsp;</p>

<p><span style="font-size:11px">For students and visitors who using OSHCstudents services:</span></p>

<p><span style="font-size:11px">- Accommodation: Homestay, VIP Homestay, Homeshare.</span></p>

<p><span style="font-size:11px">- Guardian service if you are under 18 years old.</span></p>

<p><span style="font-size:11px">- Money transfer including tuition or other payments on www.edupayaustralia.com.au.</span></p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'name' => NULL,
                'template_name' => '7',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 20:55:40',
                'updated_at' => '2021-01-15 20:56:01',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL:&nbsp;<a href="mailto:%20info@oshcstudents.com">info@oshcstudents.com</a></p>

<p><strong>Transfer Fund within Australia</strong></p>

<p><br />
&nbsp;</p>

<p>Account Name: OSHC GLOBAL</p>

<p>&nbsp;</p>

<p>BSB: 012 260</p>

<p>&nbsp;</p>

<p>Account Number: 412479564</p>

<p>&nbsp;</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>&nbsp;</p>

<p>Swift code: ANZBAU3M</p>

<p>&nbsp;</p>

<p>We require all international transfers to us to be made with the OUR instruction.</p>

<p><br />
&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => NULL,
                'template_name' => '8',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:02:39',
                'updated_at' => '2021-01-15 21:02:51',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL:&nbsp;<a href="mailto:%20info@oshcstudents.com">info@oshcstudents.com</a></p>

<p><strong>Transfer Fund within Australia</strong></p>

<p><br />
&nbsp;</p>

<p>Account Name: OSHC GLOBAL</p>

<p>&nbsp;</p>

<p>BSB: 012 260</p>

<p>&nbsp;</p>

<p>Account Number: 412479564</p>

<p>&nbsp;</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>&nbsp;</p>

<p>Swift code: ANZBAU3M</p>

<p>&nbsp;</p>

<p>We require all international transfers to us to be made with the OUR instruction.</p>

<p><br />
&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => NULL,
                'template_name' => '9',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:03:55',
                'updated_at' => '2021-01-15 21:04:07',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL:&nbsp;<a href="mailto:%20info@oshcstudents.com">info@oshcstudents.com</a></p>

<p><strong>Transfer Fund within Australia</strong></p>

<p><br />
&nbsp;</p>

<p>Account Name: OSHC GLOBAL</p>

<p>&nbsp;</p>

<p>BSB: 012 260</p>

<p>&nbsp;</p>

<p>Account Number: 412479564</p>

<p>&nbsp;</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>&nbsp;</p>

<p>Swift code: ANZBAU3M</p>

<p>&nbsp;</p>

<p>We require all international transfers to us to be made with the OUR instruction.</p>

<p><br />
&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => NULL,
                'template_name' => '10',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:06:27',
                'updated_at' => '2021-01-15 21:06:47',
                'company_address' => 'Company Name Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL:&nbsp;<a href="mailto:%20info@oshcstudents.com">info@oshcstudents.com</a></p>

<p><strong>Transfer Fund within Australia</strong></p>

<p><br />
&nbsp;</p>

<p>Account Name: OSHC GLOBAL</p>

<p>&nbsp;</p>

<p>BSB: 012 260</p>

<p>&nbsp;</p>

<p>Account Number: 412479564</p>

<p>&nbsp;</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>&nbsp;</p>

<p>Swift code: ANZBAU3M</p>

<p>&nbsp;</p>

<p>We require all international transfers to us to be made with the OUR instruction.</p>

<p><br />
&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>

<p>&nbsp;</p>

<p><strong>Pls contact us to register other services:</strong></p>

<p>&nbsp;</p>

<p>For students and visitors who using OSHCstudents services: Free Vodafone Sim activated before departing, available for use once arriving in</p>

<p>Australia and selling at $30 for Vodafone recharge $40 value.</p>

<p>- Accommodation: Homestay, VIP Homestay, Homeshare.</p>

<p>- Guardian service if you are under 18 years old.</p>

<p>- Money transfer including tuition or other payments on www.edupayaustralia.com.au.</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Logo Company Phone',
                'company_email' => 'Company Email',
            ),
            10 => 
            array (
                'id' => 12,
                'name' => NULL,
                'template_name' => '11',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:08:20',
                'updated_at' => '2021-01-15 21:08:34',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
            'content' => '<p><strong>For specific enquiries regarding this invoice contact: (+84) 28 3821 7005 or +84 24 6253 3025 or email: info@annalink.com</strong></p>

<p>&nbsp;</p>

<p><strong>Electronic Fund Transfer Details</strong></p>

<table cellspacing="0">
<tbody>
<tr>
<td>Account Name</td>
<td>:Tran Thi Ha Phuong</td>
</tr>
<tr>
<td>Account Number</td>
<td>:2211 1484 9276 571</td>
</tr>
<tr>
<td>Bank</td>
<td>:EXIMBANK, SAI GON BRANCH</td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>

<p>The exchange rate applied is Selling rate (Rs.) of Eximbank at the current time</p>

<p>&nbsp;</p>

<p><strong>Pls contact us to register the other services:</strong></p>

<p>&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>

<p>. Accommodation: Homestay, VIP Homestay, Sharestay, Apartment</p>

<p>. Accommodation: Homestay, VIP Homestay, Sharestay, Apartment</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            11 => 
            array (
                'id' => 13,
                'name' => NULL,
                'template_name' => '12',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:08:54',
                'updated_at' => '2021-01-15 21:09:10',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
            'content' => '<p><strong>For specific enquiries regarding this invoice contact: (+84) 28 3821 7005 or +84 24 6253 3025 or email: info@annalink.com</strong></p>

<p>&nbsp;</p>

<p><strong>Electronic Fund Transfer Details</strong></p>

<table cellspacing="0">
<tbody>
<tr>
<td>Account Name</td>
<td>:Tran Thi Ha Phuong</td>
</tr>
<tr>
<td>Account Number</td>
<td>:2211 1484 9276 571</td>
</tr>
<tr>
<td>Bank</td>
<td>:EXIMBANK, SAI GON BRANCH</td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>

<p>The exchange rate applied is Selling rate (Rs.) of Eximbank at the current time</p>

<p>&nbsp;</p>

<p><strong>Pls contact us to register the other services:</strong></p>

<p>&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>

<p>. Accommodation: Homestay, VIP Homestay, Sharestay, Apartment</p>

<p>. Accommodation: Homestay, VIP Homestay, Sharestay, Apartment</p>

<p>&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>

<p>The exchange rate applied is Selling rate (Rs.) of Eximbank at the current time</p>

<p>&nbsp;</p>

<p><strong>Note:</strong></p>

<p>&nbsp;</p>

<p>Cancellation and Refund Conditions:</p>

<p>To be eligible for a full refund, the request for cancellation must be received prior to the effective date. Cancellation requests received after the effective</p>

<p>date will be subject to the following conditions:</p>

<p>1. A $25 cancellation fee will apply</p>

<p>2. Only premium for unused whole-months of the plan will be refunded</p>

<p>3. Only members who have no claims are eligible for premium refund</p>

<p>4. After 60 days, no refunds are granted</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            12 => 
            array (
                'id' => 14,
                'name' => NULL,
                'template_name' => '13',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:16:02',
                'updated_at' => '2021-01-15 21:17:08',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL:&nbsp;<a href="mailto:%20info@oshcstudents.com">info@oshcstudents.com</a></p>

<p><strong>Transfer Fund within Australia</strong></p>

<p><br />
&nbsp;</p>

<p>Account Name: OSHC GLOBAL</p>

<p>&nbsp;</p>

<p>BSB: 012 260</p>

<p>&nbsp;</p>

<p>Account Number: 412479564</p>

<p>&nbsp;</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>&nbsp;</p>

<p>Swift code: ANZBAU3M</p>

<p>&nbsp;</p>

<p>We require all international transfers to us to be made with the OUR instruction.</p>

<p><br />
&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            13 => 
            array (
                'id' => 15,
                'name' => NULL,
                'template_name' => '14',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:17:53',
                'updated_at' => '2021-01-15 21:18:11',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
                'content' => '<p>FOR SPECIFIC ENQUIRIES REGARDING THIS INVOICE CONTACT: +61 451 299 866 OR EMAIL:&nbsp;<a href="mailto:%20info@oshcstudents.com">info@oshcstudents.com</a></p>

<p><strong>Transfer Fund within Australia</strong></p>

<p><br />
&nbsp;</p>

<p>Account Name: OSHC GLOBAL</p>

<p>&nbsp;</p>

<p>BSB: 012 260</p>

<p>&nbsp;</p>

<p>Account Number: 412479564</p>

<p>&nbsp;</p>

<p>Bank: ANZ Bank, Australia.</p>

<p>&nbsp;</p>

<p>Swift code: ANZBAU3M</p>

<p>&nbsp;</p>

<p>We require all international transfers to us to be made with the OUR instruction.</p>

<p><br />
&nbsp;</p>

<p>Please make sure that the Invoice No is added in your payment details.</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
            14 => 
            array (
                'id' => 16,
                'name' => NULL,
                'template_name' => '15',
                'extended_properties' => NULL,
                'created_at' => '2021-01-15 21:18:59',
                'updated_at' => '2021-01-15 21:19:16',
                'company_address' => 'Company Address',
                'logo' => 'Logo',
                'company_name' => 'Company Name',
            'content' => '<p>Chứng từ k&egrave;m theo: Offer Letter, Giấy ủy quyền, Hộ chiếu (copy).</p>

<p><strong>Th&ocirc;ng tin chuyển khoản (chọn 1 trong 2):</strong></p>

<table cellspacing="0">
<tbody>
<tr>
<td>T&ecirc;n t&agrave;i khoản</td>
<td>: Trần Thị H&agrave; Phương</td>
</tr>
<tr>
<td>Ng&acirc;n h&agrave;ng</td>
<td>: Vietcombank Chi Nh&aacute;nh HCM</td>
</tr>
<tr>
<td>Số t&agrave;i khoản</td>
<td>: 007 100 544 9042</td>
</tr>
<tr>
<td colspan="2"><strong>Tỷ gi&aacute;: &Aacute;p dụng tỷ gi&aacute; B&aacute;n của ng&acirc;n h&agrave;ng Vietcombank tại thời điểm thanh to&aacute;n</strong></td>
</tr>
</tbody>
</table>

<p><br />
&nbsp;</p>

<p>Lưu &yacute;: nhập nội dung chuyển tiền v&agrave;o chi tiết thanh to&aacute;n, tỷ gi&aacute; giao dịch &aacute;p dụng theo tỷ gi&aacute; b&aacute;n của Ng&acirc;n h&agrave;ng Eximbank tại thời điểm thanh to&aacute;n</p>

<p>&nbsp;</p>

<p><strong>Li&ecirc;n lạc với ch&uacute;ng t&ocirc;i để tham gia c&aacute;c dịch vụ kh&aacute;c:</strong></p>

<p>&nbsp;</p>

<p>. Nhận qu&agrave; tặng Sim Vodafone sử dụng tại &Uacute;c trước ng&agrave;y bay</p>

<p>. Nh&agrave; ở: Homestay (nh&agrave; ở với chủ)</p>

<p>. Dịch vụ gi&aacute;m hộ nếu bạn dưới 18 tuổi</p>

<p>. Chuyển tiền quốc tế với mức ph&iacute; ưu đ&atilde;i</p>',
                'company_website' => 'Company Website',
                'company_phone' => 'Company Phone',
                'company_email' => 'Company Email',
            ),
        ));
        
        
    }
}