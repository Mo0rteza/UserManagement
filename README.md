## پروژه مدیریت کاربران

برای کار با پروژه ابتدا باید فایل migrate را اجرا کنید، با دستور زیر
```
php artisan migrate
```
سپس با دستور زیر تعدادی داده که به صورت دستی در UserSeeder نوشته شده است در جدول کاربران اضافه می شود.
```
php artisan db:seed --class=UserSeeder
```

 یا با اجرای دستور زیر10 تا رکورد به صورت رندوم  توسط factory ایجاد می شود.

```
php artisan db:seed
```

با استفاده از الگوی ریپازیتوری ، کار با دیتابیس و جدول کاربران به عهده UserRepository.php می باشد که در پوشه `Repositories` در مسیر `/app/http/Repositories` قرار دارد. و UserController وظیفه کنترل درخواست ها و پاسخ ها را به عهده دارد.

برای جداسازی منطق بیزنس برای کاربران، میتوانست  برای آن سرویسی در نظر گرفت ولی چون پروژه کوچک بود از این کار چشم پوشی کردم.


برای کار با API یک سرویس در نظر گرفته شد در پوشه Services  در مسیر `/app/http/Services` به نام CountryService. در این فایل درخواست  به API ارسال می شود و لیست کشورها و ارز ها گرفته می شود.

روت ها در فایل api.php در پوشه routes قرار دارد.

### Endpoints  

```
GET /api/users => گرفت لیست کاربران

POST /api/users => ایجاد یک کاربر

header:
accept = application/json

payload:
name= مرتضی حسینی
email= h.morteza011@gmail.com
country= Iran
currency= IRR

PUT /api/users/{id}  آپدیت اطلاعات کاربر

payload:
name= مرتضی حسینی
email= h.morteza011@gmail.com
country= United States
currency= USD

DELETE /api/users/{id} حذف یک کاربر


GET /api/countries  گرفتن لیست کشورها

GET /api/users/filter?country=Iran  فیلتر کاربران بر اساس کشور


GET /api/users/filter?currency=USD فیلتر کاربران بر اساس ارز

GET /api/users/filter?country=Iran&currency=IRR فیلتر کاربران بر اساس کشور و ارز

GET /api/users/filter?sort=name&direction=asc  مرتب سازی کاربران براساس نام و به صورت صعودی

sort = name || email || country || currency

direction = asc || desc

GET /api/users/filter?country=Iran&currency=IRR&sort=name&direction=desc  فیلتر کاربران براساس کشور و ارز و مرتب سازی بر اساس نام به صورت نزولی

```

با دستور زیر میتوان تست را اجرا کرد. تست ها در فایل UserRepositoryTest نوشته شده اند که در مسیر `/tests/Unit` می توانید آن را مشاهده کنید.
```
php artisan test --filter=UserRepositoryTest
```
