Prepare
- PHP 7.4.33
- Composer version 2.5.3
- Node v12.22.9
- NPM 8.5.1
- [Ngrok](https://ngrok.com/)
- [Midtrans](https://midtrans.com/)

Step For Integrate For Your Device
- register midtrans
- register ngrok
- git clone https://github.com/alpardfm/Ecommerce-Bonsai.git
- create databases 'bonsai_web'
- setting name database in .env
- setting key midtrans in .env
- php artisan migrate
- php artisan db:seed
- php artisan serve
- add auth token ngrok
- run ngrok (online your project from local use ngrok for receive callback from midtrans)

Default Login Admin
- Email : admin@gmail.com
- Password : admin123123
