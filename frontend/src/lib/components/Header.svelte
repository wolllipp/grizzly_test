<script>
  let navOpen = $state(false)
</script>

<header class='site-header'>
  <div class='site-header__content'>
    <a class='site-header__logo' href='/'>
      <img class='site-header__logo-image' src='/logos/logo.svg' alt='Enemer' />
    </a>

    <button class='site-header__burger' type='button' aria-label='Otwórz menu' onclick={() => navOpen = !navOpen}>
      <span class='site-header__burger-line' class:open={navOpen}></span>
      <span class='site-header__burger-line' class:open={navOpen}></span>
      <span class='site-header__burger-line' class:open={navOpen}></span>
    </button>

    <nav class='site-header__navigation' class:open={navOpen} aria-label='Główna nawigacja'>
      <a class='site-header__link' href='/about' onclick={() => navOpen = false}>O nas</a>
      <a class='site-header__link' href='/services' onclick={() => navOpen = false}>Usługi</a>
      <a class='site-header__link' href='/pricing' onclick={() => navOpen = false}>Cennik</a>
      <a class='site-header__link' href='/contact' onclick={() => navOpen = false}>Kontakt</a>
      <a class='site-header__link' href='/reviews' onclick={() => navOpen = false}>Opinie</a>
      <a class='site-header__link' href='/faq' onclick={() => navOpen = false}>Pytania i odpowiedzi</a>
    </nav>

    <div class='site-header__contacts'>
      <a class='site-header__phone' href='tel:+48690590089'>+48690590089</a>
      <a class='site-header__call-link' href='/call'>Zamów rozmowę</a>
    </div>

    <button class='site-header__language' type='button'>
      <span>PL</span>
      <img class='site-header__language-icon' src='/logos/down_icon.svg' alt='' />
    </button>
  </div>
</header>

<style>
  .site-header__content {
    align-items: center;
    box-sizing: border-box;
    display: flex;
    gap: 90px;
    margin-left: 0;
    padding: 12px 340px 12px 339px;
  }

  .site-header__logo {
    flex: 0 0 186px;
  }

  .site-header__logo-image {
    display: block;
    height: 42px;
    width: 186px;
  }

  .site-header__navigation {
    align-items: center;
    display: flex;
    font-family: var(--font-nav);
    font-size: 16px;
    font-weight: 400;
    gap: 43px;
    justify-content: center;
    line-height: 150%;
    white-space: nowrap;
    
  }

  .site-header__navigation a {
	  letter-spacing: 0.1px;
  }

  .site-header__link {
    color: var(--color-text);
    cursor: pointer;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .site-header__link:hover {
    color: var(--color-purple);
  }

  .site-header__contacts {
    display: flex;
    flex: 0 0 auto;
    flex-direction: column;
    font-family: var(--font-primary);
    gap: 5px;
    white-space: nowrap;
  }

  .site-header__phone,
  .site-header__call-link {
    color: var(--color-text);
    cursor: pointer;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .site-header__phone:hover,
  .site-header__call-link:hover {
    color: var(--color-purple);
  }

  .site-header__phone {
    font-family: var(--font-bold);
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.1px;
    line-height: 150%;
  }

  .site-header__call-link {
    font-family: var(--font-bold);
    font-size: 13px;
    font-weight: 400;
    line-height: 150%;
  }

  .site-header__language {
    align-items: center;
    background: transparent;
    border: 0;
    color: var(--color-text);
    cursor: pointer;
    display: flex;
    font-family: var(--font-primary);
    font-size: 13px;
    font-weight: 400;
    gap: 4px;
    line-height: 150%;
    padding: 0;
    white-space: nowrap;
    transition: color 0.2s ease;
  }

  .site-header__language:hover {
    color: var(--color-purple);
  }

  .site-header__language-icon {
    height: 16px;
    width: 16px;
  }

  .site-header__burger {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    width: 32px;
    height: 32px;
    padding: 0;
    border: 0;
    background: transparent;
    cursor: pointer;
    z-index: 10;
  }

  .site-header__burger-line {
    display: block;
    width: 100%;
    height: 2px;
    background: var(--color-text);
    border-radius: 1px;
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  .site-header__burger-line.open:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
  }

  .site-header__burger-line.open:nth-child(2) {
    opacity: 0;
  }

  .site-header__burger-line.open:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
  }

  @media (max-width: 1500px) {
    .site-header__content {
      gap: 32px;
    }

    .site-header__navigation {
      gap: 16px;
    }
  }

  @media (max-width: 900px) {
    .site-header__content {
      flex-wrap: wrap;
      padding: 12px 16px;
      gap: 16px;
    }

    .site-header__burger {
      display: flex;
    }

    .site-header__navigation {
      display: none;
      flex-direction: column;
      gap: 12px;
      order: 3;
      width: 100%;
      padding-top: 12px;
      border-top: 1px solid var(--color-gray-border);
    }

    .site-header__navigation.open {
      display: flex;
    }

    .site-header__contacts {
      margin-left: auto;
    }
  }
</style>
