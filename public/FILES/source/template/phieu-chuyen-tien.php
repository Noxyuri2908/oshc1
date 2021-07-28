<style type="text/css">
    <!--
    table { vertical-align: top; }
    tr    { vertical-align: top; }
    td    { vertical-align: top; }
    h1,h2{margin: 0;}
    p{margin: 1px 0px; color: #222; font-size: 14px}

    table#table-2,#table-2 td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    #table-2 td {
        padding: 10px 15px;
    }

    #table-2 td.value{
        text-align: center;
    }

    #table-2{
        width: 100% !important;
    }
    #table-2 th{
        border-bottom: 1px solid black;
    }

    -->
</style>
<page backcolor="#fff" backimgx="center" backimgy="bottom" backimgw="100%" backtop="42px" backleft="68px" backright="16px" backbottom="42px" footer="page" style=" font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 45%; text-align: center;">
                <img style="width: 60%;" src="<?php echo QH_EC_AGENT_MODEL_PATH . '/pdf/'; ?>logo-annalink.jpg" alt="Logo"><br>
            </td>
            <td style="width: 55%; text-align: left;">
                <p style="font-size: 16px; margin-bottom: 2px;"><b>CÔNG TY CỔ PHẦN ANNALINK</b></p>
                <p>VP  HCM: 65 Nam Kỳ Khởi Nghĩa, HCM</p>
                <p>	<span style="margin-left: 45px">Tel:</span> <span style="margin-left: 20px">	(+84) 8 66 84 8006</span></p>
                <p>VP Hà Nội: P2004, 27 Trần Duy Hưng, Trung Hoà, Cầu Giấy</p>
                <p>	<span style="margin-left: 45px">Tel:</span> <span style="margin-left: 20px">	(+84) 4 6253 3025</span></p>
                <p>Email: info@annalink.com</p>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <div class="content" style="text-align: center;">
        <h1>PHIẾU ĐỀ NGHỊ CHUYỂN TIỀN</h1>
        <p>(Dùng trong trường hợp học sinh nhờ chuyển phí dịch vụ du học).</p>
    </div>
    <p style="text-align: right;padding: 10px;">Đơn vị: AUD</p>
    <table id="table-2" cellspacing="0" style="width: 100%; font-size: 14px">
        <tr>
            <th style="width: 25%;"></th><th style="width: 25%;"></th><th style="width: 25%;"></th><th style="width: 25%;"></th>
        </tr>
        <tr>
            <td colspan='2'>Họ và tên người đề nghị:</td>
        </tr>

        <tr>
            <td colspan='2'>Nội dung chuyển tiền:</td> <td colspan='2' class="value"><b>Chuyển tiền theo invoice số</b></td>
        </tr>

        <tr>
            <td colspan='2'>Thời gian</td><td class="value"><?php echo $_SESSION['qh_ec_agent_data']['meta_service']['visa_start']; ?></td><td class="value"><?php echo $_SESSION['qh_ec_agent_data']['meta_service']['visa_end']; ?></td>
        </tr>

        <tr>
            <td colspan='2'>Phí OSHC</td><td colspan='2' class="value"> <?php echo $_SESSION['qh_ec_agent_service']['price']; ?></td>
        </tr>

        <tr>
            <?php $ship = 0.00; ?>
            <td colspan='2'>Phí dịch vụ chuyển tiền:</td>	<td colspan='2' class="value"><?php echo $ship . ''; ?></td>
        </tr>

        <tr>
            <td colspan='2'>TỔNG SỐ TIỀN PHẢI THU:</td>	<td colspan='2' class="value"><?php echo ($_SESSION['qh_ec_agent_service']['price'] + $ship) . ''; ?></td>
        </tr>
    </table>
    <br />
    <br />
    <div id="more-imf">
        <p>Chứng từ kèm theo: Offer Letter, Giấy ủy quyền, Hộ chiếu (copy).</p><br />

        <p><b><u>THÔNG TIN CHUYỂN KHOẢN:</u></b></p>			<br />

        <p>TÊN TÀI KHOẢN:		Trần Thị Hà Phương.		</p>		<br />

        <p>SỐ TÀI KHOẢN:		<b>007 100 544 9042</b>	</p>		<br />

        <p>NGÂN HÀNG:		Vietcombank Chi nhánh Phú Nhuận.	</p>			<br />

        <p>VUI LÒNG GHI RÕ NỘI DUNG CHUYỂN TIỀN KHI THỰC HIỆN VIỆC THANH TOÁN.		</p>	<br />

        <p><b>* Lưu ý: Khách hàng thanh toán bằng VND, số tiền tính theo tỷ giá bán AUD/VND của Hội sở Vietcombank tại thời điểm thanh toán (http://www.vietcombank.com.vn/ExchangeRates/).	</b></p>

        <br />	<br />
        <p style="text-align: right; margin-right: 150px">				NGƯỜI ĐỀ NGHỊ.			</p>

    </div>
</page>
