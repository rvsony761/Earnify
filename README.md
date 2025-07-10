# Earnify Platform - Withdrawal System README

Earnify is a Laravel-based web application that allows users to register, log in, and earn rewards through a referral system. It features separate dashboards for both users and admins, ensuring a secure and role-specific experience.

---

## 🚀 Features

* 🔐 **User Authentication** (Register/Login)
* 🧑‍💼 **Admin and User Role Management**
* 💸 **Referral System:**

  * Users get a unique referral link.
  * When a new user registers using this link, the parent user earns ₹100.
  * Admin earns ₹100 on every referral.
* 📊 **User Dashboard:**

  * Displays referral link, total referrals, and total earnings.
* 🛠️ **Admin Dashboard:**

  * Shows total users, top users, new users, and other useful insights.
* 💰 **Withdrawal System:**

  * Users can request withdrawals.
  * Admin can approve or reject requests.
  * Earnings are adjusted upon approval.
* 📨 **Email Notifications:**

  * Admin receives email notifications for new withdrawal requests.
  * Users receive status updates on their withdrawal requests.
* 📈 **Investment System:**

  * Users can invest money and earn returns.
  * Upto 10-level parent referral system where each parent earns decreasing percentages:

    * Level 1: 10%
    * Level 2: 9%
    * Level 3: 8%
    * Level 4: 7%
    * Level 5: 6%
    * Level 6: 5%
    * Level 7: 4%
    * Level 8: 3%
    * Level 9: 2%
    * Level 10: 1%

---

## 🛠️ Tech Stack

* **PHP**
* **Laravel Framework**
* **Tailwind CSS**
* **JavaScript**
* **MySQL Database**

---

## ⚙️ Installation

1. **Clone the repository:**

```bash
git clone https://github.com/yourusername/earnify-platform.git
cd earnify-platform
```

2. **Install dependencies:**

```bash
composer install
```

3. **Environment setup:**

* Create a `.env` file by copying `.env.example`

```bash
cp .env.example .env
```

* Update the following in `.env`:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

4. **Generate application key:**

```bash
php artisan key:generate
```

5. **Run migrations (if needed):**

```bash
php artisan migrate
```

6. **Start the application:**

```bash
php artisan serve
```

Your Laravel application will be available at `http://localhost:8000`

---

## 👤 Author

**Rohit Verma**

---

## 📄 License

This project is licensed under the MIT License.

---

Feel free to contribute or raise issues to help improve this project!
