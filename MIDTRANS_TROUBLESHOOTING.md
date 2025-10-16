# 🚨 Midtrans Troubleshooting Guide

## 🎯 Masalah yang Telah Diperbaiki

### ❌ Error 401: "Unknown Merchant server_key/id"

**Penyebab:**
- Server key atau merchant ID tidak valid
- Konfigurasi Midtrans tidak sesuai dengan environment
- Cache konfigurasi yang tidak ter-update

**Solusi yang Diterapkan:**
1. ✅ **Perbaiki Konfigurasi Callback URLs**
   - Mengganti `url()` helper dengan `config('app.url')` di MidtransService
   - Mengganti `url()` helper dengan string literal di config/midtrans.php

2. ✅ **Update Environment Variables**
   - Memastikan sandbox keys yang benar digunakan
   - Clear config cache setelah update

3. ✅ **Perbaiki Command Status**
   - Menambahkan error handling untuk 401 errors
   - Memberikan pesan yang lebih informatif

## 🔧 Script Perbaikan

### 1. Script Fix Configuration
```bash
php scripts/fix-midtrans-config.php
```

**Fungsi:**
- ✅ Cek konfigurasi saat ini
- ✅ Test koneksi Midtrans
- ✅ Perbaiki konfigurasi jika ada masalah
- ✅ Clear config cache
- ✅ Test ulang koneksi

### 2. Script Test Lengkap
```bash
php scripts/test-midtrans.php
```

**Fungsi:**
- ✅ Test semua konfigurasi
- ✅ Test koneksi API
- ✅ Test service class
- ✅ Test payment methods
- ✅ Test callback URLs

## 📋 Status Saat Ini

### ✅ Konfigurasi yang Benar
```env
# Sandbox Mode (Aman untuk Production)
MIDTRANS_SERVER_KEY=Mid-server-8hEYF1IVzpkT2VU2satq2r5o
MIDTRANS_CLIENT_KEY=Mid-client-ughTgkx6m733ZUOl
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
MIDTRANS_MERCHANT_ID=G388833137
```

### ✅ Callback URLs yang Benar
```php
// Di MidtransService.php
'callbacks' => [
    'finish' => config('app.url') . '/student/payment/success',
    'unfinish' => config('app.url') . '/student/payment/failure',
    'error' => config('app.url') . '/student/payment/failure'
]

// Di config/midtrans.php
'callbacks' => [
    'finish' => env('MIDTRANS_FINISH_URL', '/student/payment/success'),
    'unfinish' => env('MIDTRANS_UNFINISH_URL', '/student/payment/failure'),
    'error' => env('MIDTRANS_ERROR_URL', '/student/payment/failure'),
    'notification' => env('MIDTRANS_NOTIFICATION_URL', '/payment/notification'),
],
```

## 🧪 Testing yang Berhasil

### ✅ Connection Test
```
✅ Connection successful: API responding correctly
```

### ✅ Service Test
```
✅ Service initialized successfully
✅ Transaction ID generated: TXN-20251016-XXXXX
```

### ✅ Configuration Test
```
✅ server_key: Mid-server-8hEYF1IVz...
✅ client_key: Mid-client-ughTgkx6m...
✅ merchant_id: G388833137
✅ is_production: false
✅ is_sanitized: true
✅ is_3ds: true
```

## 🚀 Commands yang Tersedia

### 1. Cek Status
```bash
php artisan midtrans:status
```

### 2. Switch Mode
```bash
# Switch ke sandbox
php artisan midtrans:switch sandbox

# Switch ke production
php artisan midtrans:switch production
```

### 3. Test Konfigurasi
```bash
# Test lengkap
php scripts/test-midtrans.php

# Test perbaikan
php scripts/fix-midtrans-config.php
```

## 🔍 Monitoring

### Logs yang Perlu Diperhatikan
```bash
# View Midtrans logs
tail -f storage/logs/laravel.log | grep Midtrans

# View error logs
tail -f storage/logs/laravel.log | grep "Midtrans.*error"
```

### Dashboard Monitoring
- **Sandbox**: [Sandbox Dashboard](https://dashboard.sandbox.midtrans.com/)
- **Production**: [Production Dashboard](https://dashboard.midtrans.com/)

## 🛡️ Pencegahan Masalah

### 1. Selalu Test Setelah Update
```bash
php artisan midtrans:status
php scripts/test-midtrans.php
```

### 2. Clear Cache Setelah Update
```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Backup Konfigurasi
```bash
# Backup .env sebelum update
cp .env .env.backup
```

## 🚨 Common Issues & Solutions

### Issue 1: "Unknown Merchant server_key/id"
**Solution:**
```bash
php scripts/fix-midtrans-config.php
```

### Issue 2: "Invalid server key"
**Solution:**
```bash
php artisan config:clear
php artisan midtrans:switch sandbox
```

### Issue 3: "Transaction not found"
**Solution:**
- Pastikan order_id unik
- Check Midtrans dashboard
- Verify production keys

### Issue 4: "Invalid signature"
**Solution:**
- Pastikan server key sama
- Check parameter urutan
- Verify encoding

## 📞 Support

### Internal Support
- **Developer**: [Your Name]
- **Email**: [Your Email]
- **Phone**: [Your Phone]

### Midtrans Support
- **Email**: support@midtrans.com
- **Phone**: +62 21 5080 8888
- **Documentation**: https://docs.midtrans.com/

## 📝 Changelog

| Version | Date | Changes |
|---------|------|---------|
| 1.0.0 | 2024-01-01 | Initial configuration |
| 1.1.0 | 2024-01-01 | Fixed 401 error |
| 1.2.0 | 2024-01-01 | Added troubleshooting guide |
| 1.3.0 | 2024-01-01 | Added fix scripts |

---

## ⚠️ PENTING!

**JANGAN PERNAH:**
- ❌ Hardcode keys di source code
- ❌ Skip testing setelah update
- ❌ Deploy tanpa clear cache

**SELALU:**
- ✅ Test konfigurasi setelah update
- ✅ Clear cache setelah perubahan
- ✅ Monitor logs untuk error
- ✅ Backup konfigurasi sebelum update
