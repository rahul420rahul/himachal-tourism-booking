<!-- Desktop Header - Hidden on Mobile -->
<div class="hidden lg:block">
    @include('partials.header-desktop')
</div>

<!-- Mobile Header - Hidden on Desktop -->
<div class="lg:hidden">
    @include('partials.header-mobile')
</div>
