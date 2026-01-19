# نظام إدارة التوصيل - RocketApp 2

## نظرة عامة

**RocketApp 2** هو نظام إدارة توصيل احترافي ومتكامل مبني على **Laravel 11** و **Tailwind CSS**. يوفر النظام لوحات تحكم منفصلة للمسؤولين والموظفين مع واجهات مستخدم حديثة وسهلة الاستخدام.

## الميزات الرئيسية

### 1. نظام المصادقة والتفويض
- تسجيل دخول آمن باستخدام Laravel Breeze
- نظام الأدوار (Admin / Employee)
- Middleware للتحقق من الصلاحيات
- إدارة المستخدمين المتقدمة

### 2. لوحات التحكم المتخصصة
- **لوحة تحكم المسؤول**: إحصائيات شاملة، إدارة المستخدمين، إدارة جميع الموارد
- **لوحة تحكم الموظف**: عرض الطلبات، إدارة محدودة، تقارير شخصية

### 3. إدارة الطلبات
- إنشاء وتعديل وحذف الطلبات
- تتبع حالة الطلب (معلق، مكتمل، ملغى)
- سجل تاريخي لتغييرات الحالة
- البحث والتصفية المتقدمة

### 4. إدارة العملاء والسائقين
- قاعدة بيانات شاملة للعملاء
- إدارة مناديب التوصيل
- ربط الطلبات بالسائقين

### 5. إدارة المحافظات والمناطق
- تنظيم جغرافي متقدم
- ربط العملاء بالمناطق
- إدارة أنواع الطلبات

### 6. سجل النشاط
- تتبع جميع العمليات في النظام
- سجل شامل للتغييرات
- تقارير تفصيلية

### 7. واجهة برمجية (API)
- RESTful API للطلبات
- إحصائيات الطلبات عبر API
- البحث والتصفية عبر API

## المتطلبات

- PHP 8.2 أو أعلى
- Composer
- Node.js و npm
- SQLite أو MySQL

## التثبيت

### 1. استنساخ المستودع
```bash
git clone https://github.com/ziate/rocketapp2.git
cd rocketapp2
```

### 2. تثبيت التبعيات
```bash
composer install
npm install
```

### 3. إعداد البيئة
```bash
cp .env.example .env
php artisan key:generate
```

### 4. إنشاء قاعدة البيانات
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### 5. بناء الأصول الأمامية
```bash
npm run build
```

### 6. تشغيل الخادم
```bash
php artisan serve
```

سيكون التطبيق متاحاً على `http://localhost:8000`

## بيانات الاختبار الافتراضية

### حساب المسؤول
- **البريد الإلكتروني**: admin@rocket.com
- **كلمة المرور**: password

### حساب الموظف
- **البريد الإلكتروني**: employee@rocket.com
- **كلمة المرور**: password

## هيكل المشروع

```
rocketapp2/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminDashboardController.php
│   │   │   ├── EmployeeDashboardController.php
│   │   │   ├── UserManagementController.php
│   │   │   └── Api/OrderApiController.php
│   │   ├── Middleware/
│   │   │   └── CheckRole.php
│   │   └── Requests/
│   │       └── StoreOrderRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Order.php
│   │   ├── Customer.php
│   │   └── ...
│   └── Services/
│       └── OrderService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       ├── employee/
│       ├── layouts/
│       └── partials/
├── routes/
│   ├── web.php
│   └── api.php
└── public/
```

## المسارات الرئيسية

### مسارات الويب
- `/` - الصفحة الرئيسية (إعادة توجيه حسب الدور)
- `/admin/dashboard` - لوحة تحكم المسؤول
- `/employee/dashboard` - لوحة تحكم الموظف
- `/users` - إدارة المستخدمين
- `/orders` - إدارة الطلبات
- `/customers` - إدارة العملاء
- `/delivery-drivers` - إدارة السائقين
- `/login` - تسجيل الدخول
- `/register` - إنشاء حساب

### مسارات API
- `GET /api/orders` - قائمة الطلبات
- `POST /api/orders` - إنشاء طلب جديد
- `GET /api/orders/{id}` - عرض طلب محدد
- `PUT /api/orders/{id}` - تحديث طلب
- `DELETE /api/orders/{id}` - حذف طلب
- `GET /api/orders/status/{status}` - الطلبات حسب الحالة
- `GET /api/orders/search?q=query` - البحث عن الطلبات
- `GET /api/orders-statistics` - إحصائيات الطلبات

## الأدوار والصلاحيات

### دور المسؤول (Admin)
- إنشاء وتعديل وحذف المستخدمين
- إدارة جميع الطلبات والعملاء والسائقين
- عرض سجل النشاط الكامل
- الوصول إلى جميع الإحصائيات

### دور الموظف (Employee)
- عرض الطلبات الحالية
- إنشاء وتعديل الطلبات (محدود)
- عرض بيانات العملاء
- عرض سجل النشاط الخاص به

## التطوير والاختبار

### تشغيل الخادم في وضع التطوير
```bash
npm run dev
```

### بناء الأصول للإنتاج
```bash
npm run build
```

### تشغيل الاختبارات
```bash
php artisan test
```

## قاعدة البيانات

### الجداول الرئيسية
- `users` - المستخدمون
- `orders` - الطلبات
- `customers` - العملاء
- `delivery_drivers` - مناديب التوصيل
- `governorates` - المحافظات
- `areas` - المناطق
- `order_types` - أنواع الطلبات
- `activity_logs` - سجل النشاط
- `order_status_histories` - سجل تغييرات حالة الطلبات

## التقنيات المستخدمة

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: SQLite / MySQL
- **Authentication**: Laravel Breeze
- **Build Tool**: Vite
- **API**: RESTful API

## الملفات المهمة

- `app/Http/Middleware/CheckRole.php` - Middleware للتحقق من الأدوار
- `app/Services/OrderService.php` - Service layer للطلبات
- `resources/views/layouts/app.blade.php` - التخطيط الرئيسي
- `resources/views/admin/dashboard.blade.php` - لوحة تحكم المسؤول
- `resources/views/employee/dashboard.blade.php` - لوحة تحكم الموظف

## الإعدادات والتخصيص

### تغيير قاعدة البيانات
عدّل ملف `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rocketapp2
DB_USERNAME=root
DB_PASSWORD=
```

### تغيير الإعدادات الأخرى
- `config/app.php` - إعدادات التطبيق
- `config/auth.php` - إعدادات المصادقة
- `config/database.php` - إعدادات قاعدة البيانات

## الأمان

- تفعيل CSRF Protection
- استخدام Laravel's built-in security features
- تشفير كلمات المرور باستخدام bcrypt
- التحقق من الصلاحيات على جميع المسارات المحمية

## الدعم والمساهمة

للإبلاغ عن الأخطاء أو المساهمة في المشروع، يرجى فتح issue أو pull request على GitHub.

## الترخيص

هذا المشروع مرخص تحت رخصة MIT.

## التحديثات الأخيرة

### الإصدار 2.0 (الحالي)
- إضافة نظام الأدوار (Admin/Employee)
- لوحات تحكم منفصلة لكل دور
- واجهة برمجية (API) كاملة
- تحديث التصميم بالكامل
- تحسينات الأمان والأداء
- سجل تاريخي لتغييرات الطلبات

---

**آخر تحديث**: 19 يناير 2026
