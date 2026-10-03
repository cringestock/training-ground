<!DOCTYPE html> 
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finman — Онлайн финансовый учёт</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0f766e;
      --primary-dark: #0d9488;
      --primary-light: #14b8a6;
      --accent: #f59e0b;
      --bg: #f8fafc;
      --surface: #ffffff;
      --text: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
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
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    /* ========== Header ========== */
    .header {
      position: sticky;
      top: 0;
      z-index: 100;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border);
    }

    .header-inner {
      max-width: 1120px;
      margin: 0 auto;
      padding: 1rem 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      font-weight: 700;
      font-size: 1.35rem;
      color: var(--text);
      text-decoration: none;
    }

    .logo-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.1rem;
    }

    .nav {
      display: flex;
      align-items: center;
      gap: 2rem;
    }

    .nav a {
      color: var(--text-muted);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
      transition: color 0.2s;
    }

    .nav a:hover {
      color: var(--primary);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.7rem 1.4rem;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.95rem;
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

    .btn-outline {
      background: transparent;
      color: var(--text);
      border: 1.5px solid var(--border);
    }

    .btn-outline:hover {
      border-color: var(--primary);
      color: var(--primary);
      background: rgba(15, 118, 110, 0.04);
    }

    .btn-lg {
      padding: 0.95rem 1.8rem;
      font-size: 1.05rem;
      border-radius: 12px;
    }

    /* ========== Hero ========== */
    .hero {
      max-width: 1120px;
      margin: 0 auto;
      padding: 5rem 1.5rem 4rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .hero-content h1 {
      font-size: 3.2rem;
      font-weight: 700;
      line-height: 1.15;
      letter-spacing: -0.03em;
      margin-bottom: 1.25rem;
    }

    .hero-content h1 span {
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-content p {
      font-size: 1.15rem;
      color: var(--text-muted);
      margin-bottom: 2rem;
      max-width: 480px;
    }

    .hero-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .hero-stats {
      display: flex;
      gap: 2.5rem;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid var(--border);
    }

    .stat strong {
      display: block;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text);
    }

    .stat span {
      font-size: 0.875rem;
      color: var(--text-muted);
    }

    /* Hero visual */
    .hero-visual {
      position: relative;
    }

    .dashboard-preview {
      background: var(--surface);
      border-radius: 20px;
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border);
      overflow: hidden;
      transform: perspective(1000px) rotateY(-6deg) rotateX(2deg);
      transition: transform 0.4s ease;
    }

    .dashboard-preview:hover {
      transform: perspective(1000px) rotateY(-2deg) rotateX(0deg);
    }

    .dash-header {
      background: #0f172a;
      padding: 0.9rem 1.2rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .dash-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
    }

    .dash-dot.red { background: #ef4444; }
    .dash-dot.yellow { background: #eab308; }
    .dash-dot.green { background: #22c55e; }

    .dash-body {
      padding: 1.5rem;
    }

    .dash-cards {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-bottom: 1.25rem;
    }

    .dash-card {
      background: var(--bg);
      border-radius: 12px;
      padding: 1rem;
      border: 1px solid var(--border);
    }

    .dash-card .label {
      font-size: 0.75rem;
      color: var(--text-muted);
      margin-bottom: 0.3rem;
    }

    .dash-card .value {
      font-size: 1.25rem;
      font-weight: 700;
    }

    .dash-card.income .value { color: var(--primary); }
    .dash-card.expense .value { color: #ef4444; }

    .chart-placeholder {
      height: 120px;
      background: linear-gradient(180deg, rgba(15, 118, 110, 0.12) 0%, transparent 100%);
      border-radius: 10px;
      position: relative;
      overflow: hidden;
    }

    .chart-placeholder::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 60%;
      background: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 80 Q50 20 100 50 T200 40 T300 60 T400 30' fill='none' stroke='%230f766e' stroke-width='3'/%3E%3C/svg%3E") no-repeat center;
      background-size: cover;
    }

    /* ========== Features ========== */
    .features {
      max-width: 1120px;
      margin: 0 auto;
      padding: 4rem 1.5rem 5rem;
    }

    .section-title {
      text-align: center;
      margin-bottom: 3rem;
    }

    .section-title h2 {
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      margin-bottom: 0.75rem;
    }

    .section-title p {
      color: var(--text-muted);
      font-size: 1.1rem;
      max-width: 520px;
      margin: 0 auto;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    .feature-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 1.75rem;
      transition: all 0.25s;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-color: transparent;
    }

    .feature-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: rgba(15, 118, 110, 0.1);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      margin-bottom: 1.25rem;
    }

    .feature-card h3 {
      font-size: 1.15rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .feature-card p {
      color: var(--text-muted);
      font-size: 0.95rem;
    }

    /* ========== CTA Banner ========== */
    .cta {
      max-width: 1120px;
      margin: 0 auto 5rem;
      padding: 0 1.5rem;
    }

    .cta-inner {
      background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
      border-radius: 24px;
      padding: 3.5rem 3rem;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .cta-inner::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 400px;
      height: 400px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
    }

    .cta-inner h2 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.75rem;
      position: relative;
    }

    .cta-inner p {
      opacity: 0.9;
      margin-bottom: 2rem;
      font-size: 1.1rem;
      position: relative;
    }

    .cta .btn-primary {
      background: white;
      color: var(--primary);
      position: relative;
    }

    .cta .btn-primary:hover {
      background: #f0fdfa;
      transform: translateY(-2px);
    }

    /* ========== Footer ========== */
    .footer {
      border-top: 1px solid var(--border);
      padding: 2.5rem 1.5rem;
      text-align: center;
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    .footer a {
      color: var(--primary);
      text-decoration: none;
    }

    /* ========== Responsive ========== */
    @media (max-width: 900px) {
      .hero {
        grid-template-columns: 1fr;
        gap: 3rem;
        padding-top: 3rem;
      }

      .hero-content h1 {
        font-size: 2.4rem;
      }

      .hero-visual {
        order: -1;
        max-width: 420px;
        margin: 0 auto;
      }

      .dashboard-preview {
        transform: none;
      }

      .features-grid {
        grid-template-columns: 1fr;
      }

      .nav {
        display: none;
      }
    }

    @media (max-width: 600px) {
      .hero-content h1 {
        font-size: 2rem;
      }

      .hero-stats {
        gap: 1.5rem;
      }

      .cta-inner {
        padding: 2.5rem 1.5rem;
      }

      .cta-inner h2 {
        font-size: 1.6rem;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="header-inner">
      <a href="/" class="logo">
        <div class="logo-icon">₽</div>
        Finman
      </a>
      <nav class="nav">
        <a href="#features">Возможности</a>
        <a href="#">Тарифы</a>
        <a href="#">Блог</a>
        <a href="signin.php" class="btn btn-outline">Войти</a>
        <a href="signup.php" class="btn btn-primary">Начать бесплатно</a>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>Финансовый учёт<br>без хаоса в <span>таблицах</span></h1>
      <p>
        Finman помогает контролировать доходы, расходы и налоги 
        в одном месте. Простой интерфейс, автоматические отчёты 
        и полная прозрачность ваших финансов.
      </p>
      <div class="hero-actions">
        <a href="signin.php" class="btn btn-primary btn-lg">Попробовать бесплатно</a>
        <a href="#features" class="btn btn-outline btn-lg">Узнать больше</a>
      </div>
      <div class="hero-stats">
        <div class="stat">
          <strong>12 400+</strong>
          <span>пользователей</span>
        </div>
        <div class="stat">
          <strong>₽2.1 млрд</strong>
          <span>учтено операций</span>
        </div>
        <div class="stat">
          <strong>4.9 ★</strong>
          <span>средняя оценка</span>
        </div>
      </div>
    </div>

    <div class="hero-visual">
      <div class="dashboard-preview">
        <div class="dash-header">
          <div class="dash-dot red"></div>
          <div class="dash-dot yellow"></div>
          <div class="dash-dot green"></div>
        </div>
        <div class="dash-body">
          <div class="dash-cards">
            <div class="dash-card income">
              <div class="label">Доходы · июль</div>
              <div class="value">₽ 248 500</div>
            </div>
            <div class="dash-card expense">
              <div class="label">Расходы · июль</div>
              <div class="value">₽ 94 320</div>
            </div>
          </div>
          <div class="chart-placeholder"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section class="features" id="features">
    <div class="section-title">
      <h2>Всё, что нужно для учёта</h2>
      <p>От личных финансов до малого бизнеса — Finman закрывает основные задачи</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">📊</div>
        <h3>Учёт доходов и расходов</h3>
        <p>Добавляйте операции в пару кликов. Категории, теги и фильтры помогают быстро находить нужное.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">📈</div>
        <h3>Наглядные отчёты</h3>
        <p>Графики и сводки за любой период. Видите, куда уходят деньги и как растёт прибыль.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🧾</div>
        <h3>Налоги и документы</h3>
        <p>Учёт для ИП и самозанятых. Подготовка данных для декларации без лишней суеты.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🔔</div>
        <h3>Напоминания и цели</h3>
        <p>Ставьте финансовые цели и получайте уведомления о важных платежах и лимитах.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🔒</div>
        <h3>Безопасность данных</h3>
        <p>Шифрование, двухфакторная аутентификация и резервные копии — ваши данные под защитой.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">📱</div>
        <h3>Доступ с любого устройства</h3>
        <p>Работайте с компьютера, планшета или телефона. Все данные синхронизируются в реальном времени.</p>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="cta-inner">
      <h2>Начните вести финансы уже сегодня</h2>
      <p>Бесплатный период 14 дней. Без привязки карты.</p>
      <a href="#" class="btn btn-primary btn-lg">Создать аккаунт</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>© 2026 Finman. Все права защищены. · <a href="#">Политика конфиденциальности</a> · <a href="#">Условия использования</a></p>
  </footer>

</body>
</html>