Application setup:

- git clone <repository-url>
- cd <project folder>
- git checkout develop
- create .env in project root, add: DB_USERNAME, DB_PASSWORD, MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS
- composer install
- sail up -d
- sail npm install
- sail artisan key:generate
- sail artisan storage:link
- sail artisan migrate
- sail artisan db:seed RolesAndPermissionsSeeder
- sail artisan db:seed UserSeeder
- sail npm run dev

optional to create mock data:
- sail artisan db:seed CompanySeeder
- sail artisan db:seed EmployeeSeeder

assuming alias for "./vendor/bin/sail" is set to "sail"
