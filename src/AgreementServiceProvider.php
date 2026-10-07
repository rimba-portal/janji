<?php

declare(strict_types=1);

namespace Rimba\Agreement;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\Factory;
use Rimba\Base\Services\BitesServiceProvider;
use Rimba\Translate\Enums\Language;

class AgreementServiceProvider extends BitesServiceProvider
{
    protected string $viewsPath = __DIR__.'/../resources/views';

    protected string $iconsPath = __DIR__.'/../resources/svg';

    protected function bootPackage(): void
    {
        $languages = Language::googleTranslateLanguages();
        FilamentView::registerRenderHook(
            PanelsRenderHook::USER_MENU_AFTER,
            fn (): Factory|\Illuminate\Contracts\View\View => view('bites::language-switch')
        );
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIMPLE_PAGE_END,
            fn (): Factory|\Illuminate\Contracts\View\View => view('bites::language-switch')
        );
        FilamentView::registerRenderHook(
            PanelsRenderHook::FOOTER,
            fn (): string => <<<HTML
            <script>
                window.googleTranslateElementInit = function () {
                    new google.translate.TranslateElement({
                        pageLanguage: 'en',
                        layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
                        autoDisplay: false,
                        includedLanguages: '{$languages}'
                    }, 'google_translate_element');
                };
                window.triggerGoogleTranslate = function (langCode) {
                    const select = document.querySelector('.goog-te-combo');
                    if (! select) {
                        console.log('Google Translate select not found');
                        return;
                    }
                    select.value = langCode;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                };
            </script>
            <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            HTML
        );

    }

    protected function registerPackage(): void
    {
        //
    }
}
