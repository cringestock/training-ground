<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация — Finman</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0f766e;
      --primary-dark: #0d9488;
      --primary-light: #14b8a6;
      --bg: #f8fafc;
      --surface: #ffffff;
      --text: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --error: #ef4444;
      --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.07), 0 2px 4px -2px rgb(0 0 0 / 0.05);
      --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.08), 0 8px 10px -6px rgb(0 0 0 / 0.05);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      -webkit-font-smoothing: antialiased;
    }

    /* ========== Left panel (branding) ========== */
    .auth-side {
      flex: 1;
      background: linear-gradient(160deg, #0f766e 0%, #0d9488 50%, #134e4a 100%);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 2.5rem 3rem;
      position: relative;
      overflow: hidden;
    }

    .auth-side::before {
      content: '';
      position: absolute;
      top: -30%;
      right: -20%;
      width: 500px;
      height: 500px;
      background: rgba(255, 255, 255, 0.06);
      border-radius: 50%;
    }

    .auth-side::after {
      content: '';
      position: absolute;
      bottom: -20%;
      left: -10%;
      width: 350px;
      height: 350px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
    }

    .side-logo {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      font-weight: 700;
      font-size: 1.4rem;
      text-decoration: none;
      color: white;
      position: relative;
      z-index: 1;
    }

    .side-logo-icon {
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      backdrop-filter: blur(4px);
    }

    .side-content {
      position: relative;
      z-index: 1;
      max-width: 380px;
    }

    .side-content h2 {
      font-size: 2rem;
      font-weight: 700;
      line-height: 1.25;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
    }

    .side-content p {
      opacity: 0.85;
      font-size: 1.05rem;
      line-height: 1.6;
    }

    .side-features {
      margin-top: 2.5rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .side-feature {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 0.95rem;
      opacity: 0.9;
    }

    .side-feature span {
      width: 28px;
      height: 28px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      flex-shrink: 0;
    }

    .side-footer {
      position: relative;
      z-index: 1;
      font-size: 0.85rem;
      opacity: 0.7;
    }

    /* ========== Right panel (form) ========== */
    .auth-main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1.5rem;
    }

    .auth-card {
      width: 100%;
      max-width: 400px;
    }

    .auth-card h1 {
      font-size: 1.75rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      margin-bottom: 0.4rem;
    }

    .auth-card > p {
      color: var(--text-muted);
      margin-bottom: 2rem;
      font-size: 0.95rem;
    }

    .auth-card > p a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }

    .auth-card > p a:hover {
      text-decoration: underline;
    }

    /* Form */
    .form-group {
      margin-bottom: 1.15rem;
    }

    .form-group label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      margin-bottom: 0.4rem;
      color: var(--text);
    }

    .form-group input {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-size: 0.95rem;
      font-family: inherit;
      background: var(--surface);
      color: var(--text);
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    .form-group input::placeholder {
      color: #94a3b8;
    }

    .form-group input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
    }

    .form-group input.error {
      border-color: var(--error);
    }

    .form-error {
      font-size: 0.8rem;
      color: var(--error);
      margin-top: 0.35rem;
      display: none;
    }

    .form-group.has-error .form-error {
      display: block;
    }

    .form-hint {
      font-size: 0.8rem;
      color: var(--text-muted);
      margin-top: 0.35rem;
    }

    .checkbox {
      display: flex;
      align-items: flex-start;
      gap: 0.6rem;
      font-size: 0.875rem;
      color: var(--text-muted);
      cursor: pointer;
      user-select: none;
      margin-bottom: 1.5rem;
      line-height: 1.45;
    }

    .checkbox input {
      width: 16px;
      height: 16px;
      margin-top: 2px;
      accent-color: var(--primary);
      cursor: pointer;
      flex-shrink: 0;
    }

    .checkbox a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }

    .checkbox a:hover {
      text-decoration: underline;
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      width: 100%;
      padding: 0.9rem 1.4rem;
      border-radius: 10px;
      font-weight: 600;
      font-size: 1rem;
      font-family: inherit;
      text-decoration: none;
      transition: all 0.2s;
      cursor: pointer;
      border: none;
    }

    .btn-primary {
      background: var(--primary);
      color: white;
      box-shadow: 0 1px 2px rgb(15 118 110 / 0.3);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgb(15 118 110 / 0.25);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    .divider {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 1.75rem 0;
      color: var(--text-muted);
      font-size: 0.85rem;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    .btn-outline {
      background: var(--surface);
      color: var(--text);
      border: 1.5px solid var(--border);
    }

    .btn-outline:hover {
      border-color: #cbd5e1;
      background: var(--bg);
    }

    .btn-outline svg {
      width: 18px;
      height: 18px;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      margin-top: 2rem;
      font-size: 0.9rem;
      color: var(--text-muted);
      text-decoration: none;
      transition: color 0.2s;
    }

    .back-link:hover {
      color: var(--primary);
    }

    /* ========== Responsive ========== */
    @media (max-width: 900px) {
      body {
        flex-direction: column;
      }

      .auth-side {
        padding: 1.5rem 1.5rem 2rem;
        min-height: auto;
      }

      .side-content {
        display: none;
      }

      .side-footer {
        display: none;
      }

      .auth-main {
        padding: 2.5rem 1.5rem 3rem;
      }
    }
  </style>
</head>
<body>

  <!-- Left branding panel -->
  <aside class="auth-side">
    <a href="index.php" class="side-logo">
      <div class="side-logo-icon">₽</div>
      Finman
    </a>

    <div class="side-content">
      <h2>Начните контролировать финансы сегодня</h2>
      <p>Создайте аккаунт и получите 14 дней бесплатного доступа ко всем возможностям.</p>

      <div class="side-features">
        <div class="side-feature">
          <span>✓</span>
          Учёт доходов и расходов
        </div>
        <div class="side-feature">
          <span>✓</span>
          Автоматические отчёты
        </div>
        <div class="side-feature">
          <span>✓</span>
          Без привязки карты
        </div>
      </div>
    </div>

    <div class="side-footer">
      © 2026 Finman
    </div>
  </aside>

  <!-- Right form panel -->
  <main class="auth-main">
    <div class="auth-card">
      <h1>Создать аккаунт</h1>
      <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>

      <form action="auth.php" method="post" id="registerForm">
        <div class="form-group">
          <label for="name">Имя</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Иван Иванов"
            required
            autocomplete="name"
            minlength="2"
          >
          <div class="form-error">Введите имя (минимум 2 символа)</div>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="you@example.com"
            required
            autocomplete="email"
          >
          <div class="form-error">Введите корректный email</div>
        </div>

        <div class="form-group">
          <label for="password">Пароль</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            required
            autocomplete="new-password"
            minlength="8"
          >
          <div class="form-hint">Минимум 8 символов</div>
          <div class="form-error">Пароль должен быть не короче 8 символов</div>
        </div>

        <div class="form-group">
          <label for="password_confirm">Повторите пароль</label>
          <input
            type="password"
            id="password_confirm"
            name="password_confirm"
            placeholder="••••••••"
            required
            autocomplete="new-password"
            minlength="8"
          >
          <div class="form-error">Пароли не совпадают</div>
        </div>

        <label class="checkbox">
          <input type="checkbox" name="terms" id="terms" required>
          <span>Я соглашаюсь с <a href="#">условиями использования</a> и <a href="#">политикой конфиденциальности</a></span>
        </label>

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
      </form>

      <div class="divider">или</div>

      <button type="button" class="btn btn-outline">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
          <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
          <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
          <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
        </svg>
        Зарегистрироваться через Google
      </button>

      <a href="index.html" class="back-link">
        ← На главную
      </a>
    </div>
  </main>

  <!-- <script>
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('name');
      const email = document.getElementById('email');
      const password = document.getElementById('password');
      const passwordConfirm = document.getElementById('password_confirm');
      const terms = document.getElementById('terms');
      let valid = true;

      // Сброс ошибок
      document.querySelectorAll('.form-group').forEach(g => g.classList.remove('has-error'));

      if (!name.value || name.value.trim().length < 2) {
        name.closest('.form-group').classList.add('has-error');
        valid = false;
      }

      if (!email.value || !email.validity.valid) {
        email.closest('.form-group').classList.add('has-error');
        valid = false;
      }

      if (!password.value || password.value.length < 8) {
        password.closest('.form-group').classList.add('has-error');
        valid = false;
      }

      if (password.value !== passwordConfirm.value) {
        passwordConfirm.closest('.form-group').classList.add('has-error');
        valid = false;
      }

      if (!terms.checked) {
        valid = false;
        alert('Необходимо согласиться с условиями использования');
      }

      if (valid) {
        // Здесь будет отправка на сервер
        alert('Аккаунт готов к созданию!\nИмя: ' + name.value + '\nEmail: ' + email.value);
        // form.submit();
      }
    });
  </script> -->

</body>
</html>