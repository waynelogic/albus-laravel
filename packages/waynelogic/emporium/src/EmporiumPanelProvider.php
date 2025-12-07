<?php namespace Waynelogic\Emporium;

// Filament
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Waynelogic\Emporium\Filament\Pages\Dashboard;
use Waynelogic\Emporium\Filament\Pages\EmporiumSettingPage;
use Waynelogic\Emporium\Filament\Pages\Login;
use Waynelogic\Emporium\Filament\Pages\Register;
use Waynelogic\FilamentCms\Filament\Pages\Settings;
use Waynelogic\FilamentCms\FilamentCmsPlugin;

// Laravel

// Waynelogic

class EmporiumPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('emporium')
            ->path('emporium')
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->brandLogo(fn () => view('emporium::emporium-logo'))
            ->discoverResources(in: __DIR__ . '/Filament/Resources', for: 'Waynelogic\Emporium\Filament\Resources')
            ->navigationItems([
                NavigationItem::make('Админ панель')
                    ->icon(Heroicon::OutlinedHome)
                    ->url('/admin')
            ])
            ->pages([
                Dashboard::class,
                EmporiumSettingPage::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authGuard('admin')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(new FilamentCmsPlugin());
    }
}
