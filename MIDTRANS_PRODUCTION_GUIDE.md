# 📋 Panduan Lengkap Midtrans Production Setup

## 🎯 Overview
Dokumentasi ini menjelaskan cara mengatur Midtrans dari sandbox ke production mode dengan aman dan mudah.

## 🔧 Konfigurasi Saat Ini (Sandbox Mode)

### File Konfigurasi: `config/midtrans.php`
```php
<?php
return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'Mid-server-8hEYF1IVzpkT2VU2satq2r5o'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'Mid-client-ughTgkx6m733ZUOl'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false), // ← SANDBOX MODE
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G388833137'),
];
```

### Environment Variables (.env)
```env
# Midtrans Configuration (SANDBOX MODE)
MIDTRANS_SERVER_KEY=Mid-server-8hEYF1IVzpkT2VU2satq2r5o
MIDTRANS_CLIENT_KEY=Mid-client-ughTgkx6m733ZUOl
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
MIDTRANS_MERCHANT_ID=G388833137
```

## 🚀 Cara Mengubah ke Production Mode

### Langkah 1: Daftar Akun Midtrans Production
1. Kunjungi [Midtrans Dashboard](https://dashboard.midtrans.com/)
2. Login dengan akun Anda
3. Klik **"Go Live"** atau **"Request Production"**
4. Isi form permohonan production:
   - **Business Information**: Nama bisnis, alamat, dll
   - **Bank Account**: Rekening bank untuk settlement
   - **Documentation**: Upload dokumen legal (SIUP, NPWP, dll)
   - **Website Information**: URL website, deskripsi bisnis

### Langkah 2: Dapatkan Production Keys
Setelah disetujui, Anda akan mendapat:
- **Server Key Production**: `Mid-server-xxxxxxxxxxxxxxxx`
- **Client Key Production**: `Mid-client-xxxxxxxxxxxxxxxx`
- **Merchant ID Production**: `Gxxxxxxxxx`

### Langkah 3: Update Environment Variables
```env
# Midtrans Configuration (PRODUCTION MODE)
MIDTRANS_SERVER_KEY=Mid-server-YOUR_PRODUCTION_SERVER_KEY
MIDTRANS_CLIENT_KEY=Mid-client-YOUR_PRODUCTION_CLIENT_KEY
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
MIDTRANS_MERCHANT_ID=YOUR_PRODUCTION_MERCHANT_ID
```

### Langkah 4: Update Konfigurasi
File `config/midtrans.php` akan otomatis menggunakan environment variables.

## 🔄 Cara Beralih Antara Sandbox dan Production

### Metode 1: Environment Variables (Recommended)
```bash
# Untuk Sandbox
MIDTRANS_IS_PRODUCTION=false

# Untuk Production
MIDTRANS_IS_PRODUCTION=true
```

### Metode 2: Manual Override
```php
// Di controller atau service
Config::$isProduction = true; // Production
Config::$isProduction = false; // Sandbox
```

## 🛡️ Keamanan dan Best Practices

### 1. Jangan Hardcode Keys
❌ **SALAH:**
```php
Config::$serverKey = 'Mid-server-xxxxxxxxx';
```

✅ **BENAR:**
```php
Config::$serverKey = config('midtrans.server_key');
```

### 2. Gunakan Environment Variables
```env
# .env (Jangan commit ke Git)
MIDTRANS_SERVER_KEY=your_secret_key_here
MIDTRANS_CLIENT_KEY=your_client_key_here
```

### 3. Validasi Signature
```php
// Selalu validasi signature dari Midtrans
$expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . config('midtrans.server_key'));
if ($signatureKey !== $expectedSignature) {
    // Reject notification
}
```

## 🧪 Testing Production Mode

### 1. Test Cards Production
```
# Visa
4111111111111111

# Mastercard
5555555555554444

# BCA Virtual Account
1234567890

# Mandiri Virtual Account
8888888888888888
```

### 2. Test Amounts
- **Minimum**: Rp 10,000
- **Maximum**: Sesuai limit merchant
- **Test dengan berbagai nominal**

## 📊 Monitoring dan Logging

### 1. Log Configuration
```php
// Di MidtransService.php
Log::info('Payment created', [
    'order_id' => $payment->transaction_id,
    'amount' => $payment->amount,
    'mode' => config('midtrans.is_production') ? 'production' : 'sandbox'
]);
```

### 2. Error Handling
```php
try {
    $snapToken = Snap::getSnapToken($params);
} catch (\Exception $e) {
    Log::error('Midtrans Error: ' . $e->getMessage(), [
        'order_id' => $payment->transaction_id,
        'mode' => config('midtrans.is_production') ? 'production' : 'sandbox'
    ]);
    throw new \Exception('Payment creation failed');
}
```

## 🔍 Troubleshooting

### Error: "Invalid server key"
- ✅ Pastikan server key benar
- ✅ Pastikan environment variable ter-load
- ✅ Clear config cache: `php artisan config:clear`

### Error: "Transaction not found"
- ✅ Pastikan order_id unik
- ✅ Pastikan menggunakan production keys di production
- ✅ Check Midtrans dashboard untuk status

### Error: "Invalid signature"
- ✅ Pastikan server key sama dengan yang digunakan Midtrans
- ✅ Pastikan urutan parameter signature benar
- ✅ Check encoding (UTF-8)

## 📱 Frontend Integration

### 1. Update Client Key
```javascript
// Di frontend
window.midtransClientKey = '{{ config("midtrans.client_key") }}';
```

### 2. Environment Detection
```javascript
// Deteksi mode
const isProduction = {{ config('midtrans.is_production') ? 'true' : 'false' }};
console.log('Midtrans Mode:', isProduction ? 'Production' : 'Sandbox');
```

## 🚨 Checklist Sebelum Go Live

### Pre-Production Checklist
- [ ] ✅ Server key production sudah benar
- [ ] ✅ Client key production sudah benar
- [ ] ✅ Merchant ID production sudah benar
- [ ] ✅ Environment variable `MIDTRANS_IS_PRODUCTION=true`
- [ ] ✅ Test dengan kartu test production
- [ ] ✅ Webhook URL sudah benar
- [ ] ✅ Error handling sudah lengkap
- [ ] ✅ Logging sudah aktif
- [ ] ✅ Backup sandbox configuration

### Post-Production Checklist
- [ ] ✅ Monitor transaksi pertama
- [ ] ✅ Check webhook notifications
- [ ] ✅ Verify settlement ke rekening
- [ ] ✅ Test berbagai payment methods
- [ ] ✅ Monitor error logs

## 🔄 Rollback Plan

### Jika Ada Masalah di Production
1. **Quick Fix**: Ubah `MIDTRANS_IS_PRODUCTION=false` di .env
2. **Restart**: `php artisan config:clear && php artisan cache:clear`
3. **Verify**: Test dengan sandbox mode
4. **Debug**: Check logs untuk error
5. **Fix**: Perbaiki masalah
6. **Re-deploy**: Kembali ke production

## 📞 Support dan Kontak

### Midtrans Support
- **Email**: support@midtrans.com
- **Phone**: +62 21 5080 8888
- **Documentation**: https://docs.midtrans.com/

### Internal Support
- **Developer**: [Your Name]
- **Email**: [Your Email]
- **Phone**: [Your Phone]

## 📝 Changelog

| Version | Date | Changes |
|---------|------|---------|
| 1.0.0 | 2024-01-01 | Initial sandbox configuration |
| 1.1.0 | 2024-01-01 | Added production guide |
| 1.2.0 | 2024-01-01 | Added troubleshooting section |

---

## ⚠️ PENTING!

**JANGAN PERNAH:**
- ❌ Commit production keys ke Git
- ❌ Hardcode keys di source code
- ❌ Skip signature validation
- ❌ Deploy tanpa testing
- ❌ Lupa backup sandbox config

**SELALU:**
- ✅ Gunakan environment variables
- ✅ Validasi signature
- ✅ Test thoroughly
- ✅ Monitor logs
- ✅ Keep sandbox config as backup
