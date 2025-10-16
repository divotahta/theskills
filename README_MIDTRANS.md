# 💳 Midtrans Payment Integration Guide

## 🎯 Overview
Panduan lengkap untuk mengatur dan menggunakan Midtrans payment gateway di aplikasi TheSkills.

## 📋 Status Saat Ini
- ✅ **Mode**: Sandbox (Aman untuk development)
- ✅ **Status**: Berfungsi dengan baik
- ✅ **Konfigurasi**: Lengkap dan siap production

## 🚀 Quick Start

### 1. Cek Status Midtrans
```bash
php artisan midtrans:status
```

### 2. Switch ke Production (Ketika Siap)
```bash
php artisan midtrans:switch production
```

### 3. Kembali ke Sandbox
```bash
php artisan midtrans:switch sandbox
```

## 🔧 Konfigurasi

### File Utama
- `config/midtrans.php` - Konfigurasi utama
- `.env` - Environment variables
- `app/Services/MidtransService.php` - Service class

### Environment Variables
```env
# Sandbox Mode (Current)
MIDTRANS_SERVER_KEY=Mid-server-8hEYF1IVzpkT2VU2satq2r5o
MIDTRANS_CLIENT_KEY=Mid-client-ughTgkx6m733ZUOl
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
MIDTRANS_MERCHANT_ID=G388833137
```

## 🛠️ Commands

### Artisan Commands
```bash
# Cek status konfigurasi
php artisan midtrans:status

# Switch ke sandbox
php artisan midtrans:switch sandbox

# Switch ke production
php artisan midtrans:switch production
```

### Script Commands
```bash
# Menggunakan script PHP
php scripts/midtrans-switch.php sandbox
php scripts/midtrans-switch.php production
```

## 🔄 Switching Modes

### Sandbox → Production
1. **Daftar Production Account**
   - Kunjungi [Midtrans Dashboard](https://dashboard.midtrans.com/)
   - Klik "Go Live" atau "Request Production"
   - Isi form dan upload dokumen

2. **Dapatkan Production Keys**
   - Server Key: `Mid-server-xxxxxxxxx`
   - Client Key: `Mid-client-xxxxxxxxx`
   - Merchant ID: `Gxxxxxxxxx`

3. **Update Environment**
   ```bash
   php artisan midtrans:switch production
   ```

4. **Update Production Keys**
   ```env
   MIDTRANS_SERVER_KEY=Mid-server-YOUR_PRODUCTION_KEY
   MIDTRANS_CLIENT_KEY=Mid-client-YOUR_PRODUCTION_KEY
   MIDTRANS_MERCHANT_ID=YOUR_PRODUCTION_MERCHANT_ID
   ```

5. **Test Thoroughly**
   - Test dengan kartu test production
   - Verify webhook notifications
   - Check settlement

### Production → Sandbox
```bash
php artisan midtrans:switch sandbox
```

## 🧪 Testing

### Sandbox Test Cards
```
Visa: 4111111111111111
Mastercard: 5555555555554444
BCA VA: 1234567890
Mandiri VA: 8888888888888888
```

### Production Test Cards
```
Visa: 4111111111111111
Mastercard: 5555555555554444
BCA VA: 1234567890
Mandiri VA: 8888888888888888
```

## 🔍 Monitoring

### Logs
```bash
# View Midtrans logs
tail -f storage/logs/laravel.log | grep Midtrans

# View specific log level
tail -f storage/logs/laravel.log | grep "Midtrans.*error"
```

### Dashboard
- **Sandbox**: [Sandbox Dashboard](https://dashboard.sandbox.midtrans.com/)
- **Production**: [Production Dashboard](https://dashboard.midtrans.com/)

## 🚨 Troubleshooting

### Common Issues

#### 1. "Invalid server key"
```bash
# Check current config
php artisan midtrans:status

# Clear config cache
php artisan config:clear

# Restart web server
sudo systemctl restart nginx
```

#### 2. "Transaction not found"
- ✅ Pastikan order_id unik
- ✅ Check Midtrans dashboard
- ✅ Verify production keys

#### 3. "Invalid signature"
- ✅ Pastikan server key sama
- ✅ Check parameter urutan
- ✅ Verify encoding

### Debug Mode
```php
// Enable debug logging
Log::debug('Midtrans Debug', [
    'server_key' => config('midtrans.server_key'),
    'is_production' => config('midtrans.is_production'),
    'merchant_id' => config('midtrans.merchant_id'),
]);
```

## 📱 Frontend Integration

### JavaScript
```javascript
// Get client key from backend
window.midtransClientKey = '{{ config("midtrans.client_key") }}';

// Check mode
const isProduction = {{ config('midtrans.is_production') ? 'true' : 'false' }};
console.log('Midtrans Mode:', isProduction ? 'Production' : 'Sandbox');
```

### Blade Template
```blade
<script src="https://app.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
```

## 🔐 Security

### Best Practices
- ✅ Jangan hardcode keys
- ✅ Gunakan environment variables
- ✅ Validasi signature
- ✅ Log semua transaksi
- ✅ Monitor error logs

### Production Checklist
- [ ] ✅ Production keys sudah benar
- [ ] ✅ Environment variables set
- [ ] ✅ Webhook URLs benar
- [ ] ✅ SSL certificate valid
- [ ] ✅ Error handling lengkap
- [ ] ✅ Logging aktif
- [ ] ✅ Backup sandbox config

## 📞 Support

### Midtrans Support
- **Email**: support@midtrans.com
- **Phone**: +62 21 5080 8888
- **Documentation**: https://docs.midtrans.com/

### Internal Support
- **Developer**: [Your Name]
- **Email**: [Your Email]
- **Phone**: [Your Phone]

## 📚 Documentation Files

- `MIDTRANS_PRODUCTION_GUIDE.md` - Panduan lengkap production
- `MIDTRANS_ENV_EXAMPLE.txt` - Contoh environment variables
- `config/midtrans.php` - Konfigurasi utama
- `app/Services/MidtransService.php` - Service class
- `app/Console/Commands/MidtransSwitchCommand.php` - Switch command
- `app/Console/Commands/MidtransStatusCommand.php` - Status command

## 🔄 Changelog

| Version | Date | Changes |
|---------|------|---------|
| 1.0.0 | 2024-01-01 | Initial sandbox setup |
| 1.1.0 | 2024-01-01 | Added production guide |
| 1.2.0 | 2024-01-01 | Added Artisan commands |
| 1.3.0 | 2024-01-01 | Added monitoring tools |

---

## ⚠️ PENTING!

**JANGAN PERNAH:**
- ❌ Commit production keys ke Git
- ❌ Hardcode keys di source code
- ❌ Skip signature validation
- ❌ Deploy tanpa testing

**SELALU:**
- ✅ Gunakan environment variables
- ✅ Validasi signature
- ✅ Test thoroughly
- ✅ Monitor logs
- ✅ Keep sandbox config as backup
