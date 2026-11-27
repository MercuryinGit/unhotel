<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
<style>
    :root {
        --hotel-navy: #103f55;
        --hotel-coral: #e8523b;
        --hotel-muted: #748895;
    }

    .auth-page {
        display: grid;
        min-height: 100vh;
        grid-template-columns: minmax(0, 1fr) minmax(420px, .82fr);
        background: #f7f9fa;
    }

    .auth-visual {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        justify-content: space-between;
        padding: clamp(2rem, 5vw, 4.5rem);
        background: linear-gradient(180deg, rgb(8 39 54 / 22%), rgb(8 39 54 / 88%)), url('/assets/image/image.png') center / cover;
        color: #fff;
    }

    .auth-brand {
        color: #fff;
        font-size: 1.15rem;
        font-weight: 800;
        text-decoration: none;
    }

    .auth-visual-copy {
        max-width: 580px;
    }

    .auth-visual-copy h2 {
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 800;
        letter-spacing: -.05em;
    }

    .auth-form-side {
        display: grid;
        align-items: center;
        justify-items: center;
        padding: 2rem;
    }

    .auth-form-wrap {
        width: min(100%, 430px);
    }

    .auth-form-wrap h1 {
        color: var(--hotel-navy);
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -.04em;
    }

    .auth-form-wrap .form-label {
        color: #34566a;
        font-size: .88rem;
        font-weight: 700;
    }

    .auth-form-wrap .form-control {
        min-height: 2.9rem;
        border-color: #d7e2e8;
        border-radius: .6rem;
    }

    .auth-form-wrap .form-control:focus {
        border-color: #e97861;
        box-shadow: 0 0 0 .2rem rgb(232 82 59 / 12%);
    }

    .auth-submit {
        border-color: var(--hotel-coral);
        background: var(--hotel-coral);
        color: #fff;
        font-weight: 700;
    }

    .auth-submit:hover {
        border-color: #cf412d;
        background: #cf412d;
        color: #fff;
    }

    .auth-muted { color: var(--hotel-muted); }
    .auth-home-link { color: var(--hotel-navy); font-size: .9rem; font-weight: 700; text-decoration: none; }
    .auth-home-link:hover { color: var(--hotel-coral); }

    @media (max-width: 767.98px) {
        .auth-page { display: block; min-height: 100vh; }
        .auth-visual { display: none; }
        .auth-form-side { min-height: 100vh; padding: 1.25rem; }
    }
</style>
