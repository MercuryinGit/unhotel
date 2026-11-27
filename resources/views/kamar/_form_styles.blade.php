<style>
    .kamar-page {
        min-height: calc(100vh - 76px);
        background: #f3f7fa;
        color: #17384b;
    }

    .kamar-back-link {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        margin-bottom: 1.5rem;
        color: #31596d;
        font-size: .9rem;
        font-weight: 600;
        text-decoration: none;
    }

    .kamar-back-link:hover {
        color: #e8523b;
    }

    .kamar-eyebrow,
    .kamar-info-label {
        margin-bottom: .4rem;
        color: #638093;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .kamar-title {
        margin-bottom: .35rem;
        color: #123b52;
        font-size: clamp(1.7rem, 3vw, 2.2rem);
        font-weight: 700;
    }

    .kamar-subtitle {
        color: #718797;
    }

    .kamar-tag {
        flex: 0 0 auto;
        padding: .5rem .85rem;
        border: 1px solid #dce7ed;
        border-radius: 999px;
        background: #fff;
        color: #31596d;
        font-size: .8rem;
        font-weight: 700;
    }

    .kamar-panel {
        overflow: hidden;
        border: 1px solid #e1e9ee;
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 12px 32px rgb(22 57 77 / 7%);
    }

    .kamar-panel-heading {
        display: flex;
        align-items: center;
        gap: .85rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e9eff3;
    }

    .kamar-step {
        display: grid;
        width: 2.5rem;
        height: 2.5rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: .75rem;
        background: #e9f2f6;
        color: #17445c;
        font-size: .8rem;
        font-weight: 700;
    }

    .kamar-panel-title {
        margin: 0;
        color: #17384b;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .kamar-panel-caption {
        margin: .2rem 0 0;
        color: #8093a0;
        font-size: .85rem;
    }

    .kamar-fields {
        padding: 1.5rem;
    }

    .kamar-fields .form-label {
        color: #34566a;
        font-size: .88rem;
        font-weight: 600;
    }

    .kamar-fields .form-control,
    .kamar-fields .form-select {
        min-height: 2.8rem;
        border-color: #d7e2e8;
        border-radius: .55rem;
        color: #17384b;
    }

    .kamar-fields textarea.form-control {
        min-height: auto;
    }

    .kamar-fields .form-control:focus,
    .kamar-fields .form-select:focus {
        border-color: #e97861;
        box-shadow: 0 0 0 .2rem rgb(232 82 59 / 12%);
    }

    .kamar-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: .75rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid #e9eff3;
        background: #f9fbfc;
    }

    .kamar-submit {
        border-color: #e8523b;
        background: #e8523b;
        color: #fff;
        font-weight: 700;
    }

    .kamar-submit:hover,
    .kamar-submit:focus {
        border-color: #d8432e;
        background: #d8432e;
        color: #fff;
    }

    .kamar-info-panel {
        padding: 1.5rem;
        border: 1px solid #dce7ed;
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 12px 32px rgb(22 57 77 / 5%);
    }

    .kamar-info-panel h2 {
        margin: .35rem 0 .6rem;
        color: #17384b;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .kamar-info-panel p {
        margin-bottom: 0;
        color: #718797;
        font-size: .9rem;
        line-height: 1.65;
    }

    .kamar-info-number {
        display: block;
        margin: 1rem 0;
        padding: .8rem 1rem;
        border-left: 3px solid #e8523b;
        border-radius: .35rem;
        background: #fff4f1;
        color: #b53c2b;
        font-size: 1.15rem;
        font-weight: 700;
    }

    @media (max-width: 575.98px) {
        .kamar-panel-heading,
        .kamar-fields {
            padding: 1rem;
        }

        .kamar-form-actions {
            padding: 1rem;
        }
    }
</style>
