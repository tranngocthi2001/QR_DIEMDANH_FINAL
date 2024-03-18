<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scan QR</title>
</head>
<body>
<h1>Quản lý Tham Dự</h1>
<div id="qr-reader" style="width:500px"></div>
<div id="qr-reader-results"></div>
<div id="scanned-items"></div>

<button id="submit-attendance" style="margin-top: 20px;">Submit Attendance</button>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
    var scannedUsers = []; // Danh sách để lưu trữ người dùng đã quét

    function onScanSuccess(decodedText) {
        const decodedData = JSON.parse(decodedText);
        scannedUsers.push(decodedData); // Thêm người dùng vào danh sách
        
        // Cập nhật UI
        const item = document.createElement('div');
        item.textContent = `Scanned: ${decodedData.name}`;
        document.getElementById('scanned-items').appendChild(item);
        alert(`Quét thành công: ${decodedData.name}`);
    }
    

    var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    document.getElementById('submit-attendance').addEventListener('click', function() {
        if (scannedUsers.length === 0) {
            alert('No scanned data to submit.');
            return;
        }
        
        fetch('{{ route('admin.events.processQR') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                event_id: "{{ $event->id }}",
                scanned_users: scannedUsers
            })
        })
        .then(response => response.json())
        .then(data => {
            alert('Attendance submitted successfully.');
            
            // Xử lý sau khi gửi thành công, ví dụ: làm trống danh sách
            scannedUsers = []; // Đặt lại danh sách
            document.getElementById('scanned-items').innerHTML = ''; // Làm trống UI
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
</body>
</html>
