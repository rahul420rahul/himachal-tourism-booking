public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->path('admin')
        ->login()
        ->middleware([
            // Baaki middleware yahi rehne de
        ])
        ->auth(function ($user) {
            return $user->email === 'chamel@gmail.com';
        });
}
