<!-- qr-code.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <script src="{{ asset('js/qr-code-styling.js') }}"></script>

</head>
<body>
    <div id="qr-code"></div>

    <script>
    // Đặt mã JavaScript trong hàm để đảm bảo nó được thực thi sau khi trang đã tải xong
    function initQRCode() {
        var qrData = @json($qrData); // Chú ý cách bạn truyền dữ liệu từ Laravel sang JavaScript

        // Khởi tạo đối tượng QRCodeStyling
        const qrCode = new QRCodeStyling({
            width: 300,
            height: 300,
            data: qrData, // Sử dụng dữ liệu từ biến qrData
            image: '{{ asset('img/th.jpg') }}', // Đường dẫn của hình ảnh bạn muốn chèn
            dotsOptions: {
                color: '#FF00FF', // Màu của các chấm trong mã QR
            },
            cornersSquareOptions: {
                color: '#0000FF', // Màu của các góc vuông
            },
        });

        // Render mã QR và hiển thị trên một phần tử HTML
        qrCode.append(document.getElementById('qr-code'));
    }

    // Gọi hàm initQRCode sau khi trang đã tải xong
    window.onload = function() {
        initQRCode();
    };
</script>

</body>
</html>
