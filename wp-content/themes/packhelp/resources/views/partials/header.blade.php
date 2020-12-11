<header class="banner">
  <div class="container">
    <div class="title-bar" data-responsive-toggle="mainNavigation" data-hide-for="medium">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-toggle="mainNavigation"></button>
        <div class="title-bar-title">Menu</div>
      </div>
      <div class="title-bar-right">
        <img src="https://placehold.it/130x38&text=LOGO" alt="company logo">
      </div>
    </div>
    <div class="top-bar" id="mainNavigation">
        <nav class="top-bar-left">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation menu vertical medium-horizontal', 'menu_class' => 'nav']) !!}
          @endif
        </nav>
    </div>
  </div>
</header>
