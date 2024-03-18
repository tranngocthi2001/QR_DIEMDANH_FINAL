<!DOCTYPE html>
<html>
<head>
    <title>Show QR</title>
    
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

</head>
<body>
<div id="qrcode"></div>

<script type="text/javascript">
    var qrData = @json($qrData); // Chú ý cách bạn truyền dữ liệu từ Laravel sang JavaScript
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: qrData,
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
</script>
dàdsfdsfsda
</body>
</html>
