<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Biên lai đặt cọc</title>
    <style>
        /* BẮT BUỘC SỬ DỤNG FONT DEJAVU SANS ĐỂ KHÔNG BỊ LỖI PHÔNG TIẾNG VIỆT */
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 14px; line-height: 1.6; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #dc2626; padding-bottom: 15px; margin-bottom: 30px; }
        .company-name { font-size: 22px; font-weight: bold; color: #dc2626; text-transform: uppercase; margin-bottom: 5px; }
        .receipt-title { font-size: 18px; font-weight: bold; text-transform: uppercase; margin-top: 15px; }
        .content { margin: 0 20px; }
        .row { margin-bottom: 12px; }
        .label { font-weight: bold; display: inline-block; width: 160px; color: #555; }
        .value { font-weight: bold; color: #000; }
        .amount-box { background-color: #fef2f2; border: 1px solid #fca5a5; padding: 15px; text-align: center; margin: 20px 0; border-radius: 5px; }
        .amount-text { font-size: 20px; font-weight: bold; color: #dc2626; }
        .footer { margin-top: 40px; font-size: 12px; color: #666; }
        
        /* Con dấu đỏ giả lập của kế toán */
        .stamp-container { text-align: right; margin-top: 20px; padding-right: 40px; }
        .stamp { display: inline-block; border: 3px solid #dc2626; color: #dc2626; padding: 10px 20px; font-weight: bold; font-size: 16px; text-transform: uppercase; border-radius: 5px; transform: rotate(-10deg); }
        .date { font-size: 12px; font-style: italic; font-weight: normal; margin-top: 5px; color: #333; }
    </style>
</head>
<body>

    <div class="header">
        <div class="company-name">HỆ THỐNG SHOWROOM TOYOTA VIỆT NAM</div>
        <div>Địa chỉ: Tòa nhà Toyota, Số 1 Phạm Hùng, Mỹ Đình, Hà Nội</div>
        <div>Hotline: 1900 1234 | Website: toyota.com.vn</div>
        <div class="receipt-title">BIÊN LAI XÁC NHẬN ĐẶT CỌC XE</div>
        <div style="font-size: 12px; color: #666; margin-top: 5px;">Mã giao dịch: TOYOTA-{{ time() }}-{{ $contact->id }}</div>
    </div>

    <div class="content">
        <p style="font-style: italic; margin-bottom: 20px;">Kế toán Showroom Toyota xin xác nhận đã nhận được khoản thanh toán đặt cọc từ khách hàng với thông tin chi tiết như sau:</p>

        <div class="row">
            <span class="label">Họ và tên khách hàng:</span>
            <span class="value" style="text-transform: uppercase;">{{ $contact->fullname }}</span>
        </div>
        <div class="row">
            <span class="label">Số điện thoại liên hệ:</span>
            <span class="value">{{ $contact->phone }}</span>
        </div>
        <div class="row">
            <span class="label">Email nhận thông báo:</span>
            <span class="value">{{ $contact->email }}</span>
        </div>
        <div class="row">
            <span class="label">Mẫu xe chốt đặt cọc:</span>
            <span class="value" style="color: #dc2626;">{{ $contact->final_car_model }}</span>
        </div>
        <div class="row">
            <span class="label">Phương thức thanh toán:</span>
            <span class="value">Chuyển khoản Ngân hàng (Đã đối soát)</span>
        </div>

        <div class="amount-box">
            <div style="font-size: 14px; color: #666; margin-bottom: 5px;">SỐ TIỀN ĐÃ NHẬN (5% GIÁ TRỊ XE)</div>
            <div class="amount-text">{{ number_format($contact->deposit_amount, 0, ',', '.') }} VNĐ</div>
        </div>

        <div class="stamp-container">
            <div style="text-align: center; display: inline-block;">
                <div class="date">Hà Nội, Ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}</div>
                <div style="margin-bottom: 10px;">ĐẠI DIỆN KẾ TOÁN</div>
                <div class="stamp">ĐÃ THU TIỀN</div>
            </div>
        </div>
        
        <div style="clear: both;"></div>

        <div class="footer">
            <p><strong>Ghi chú quan trọng:</strong></p>
            <p>- Biên lai này là chứng từ điện tử hợp lệ xác nhận quý khách đã giữ chỗ thành công dòng xe trên.</p>
            <p>- Chuyên viên bán hàng sẽ liên hệ với quý khách để sắp xếp lịch lên Showroom ký hợp đồng mua bán chính thức và hoàn tất các thủ tục còn lại.</p>
        </div>
    </div>

</body>
</html>