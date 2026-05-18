<!DOCTYPE html>
<html>
<head>
    <title>Có khách hàng mới liên hệ</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #eb0a1e;">Hệ thống Showroom Toyota</h2>
    <p>Bạn vừa nhận được một yêu cầu tư vấn / lái thử từ khách hàng. Dưới đây là thông tin chi tiết:</p>
    
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;">
        <tr>
            <th style="background-color: #f4f4f4; text-align: left; width: 150px;">Họ và tên:</th>
            <td>{{ $contactData['fullname'] }}</td>
        </tr>
        <tr>
            <th style="background-color: #f4f4f4; text-align: left;">Số điện thoại:</th>
            <td><strong style="color: #eb0a1e;">{{ $contactData['phone'] }}</strong></td>
        </tr>
        <tr>
            <th style="background-color: #f4f4f4; text-align: left;">Dòng xe quan tâm:</th>
            <td>{{ $contactData['car_model'] }}</td>
        </tr>
        <tr>
            <th style="background-color: #f4f4f4; text-align: left;">Ghi chú:</th>
            <td>{{ $contactData['message'] ?? 'Không có ghi chú' }}</td>
        </tr>
    </table>
    
    <p style="margin-top: 20px;">Vui lòng liên hệ lại với khách hàng trong thời gian sớm nhất!</p>
</body>
</html>