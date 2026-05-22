<div style="font-family: Arial, sans-serif; max-w: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px;">
    <h2 style="color: #dc2626; text-transform: uppercase; text-align: center;">Toyota Việt Nam</h2>
    <p>Xin chào <strong>{{ $contact->fullname }}</strong>,</p>
    <p>Cảm ơn bạn đã quan tâm và nhận tư vấn về dòng xe <strong>{{ $contact->car_model }}</strong> từ chuyên viên của chúng tôi.</p>
    
    <div style="background-color: #f9fafb; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <p style="margin: 0; color: #4b5563;">Để giữ chỗ và nhận các ưu đãi đặc quyền từ Showroom, quý khách vui lòng hoàn tất thủ tục đặt cọc (5% giá trị xe) theo đường link bảo mật dưới đây:</p>
    </div>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('deposit.form', $contact->deposit_token) }}" style="background-color: #dc2626; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; text-transform: uppercase;">
            Tiến hành Đặt cọc ngay
        </a>
    </div>

    <p style="font-size: 12px; color: #9ca3af;">Lưu ý: Đường link này chứa mã bảo mật dùng một lần. Vui lòng không chia sẻ cho người khác.</p>
    <p>Trân trọng,<br><strong>Ban Giám Đốc Showroom Toyota</strong></p>
</div>