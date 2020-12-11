<footer>
  <div class="grid-x callout">

    <div class="small-12 medium-6 cell">
      @if (has_nav_menu('footer_navigation'))
        {!! wp_nav_menu(['theme_location' => 'footer_navigation menu vertical medium-horizontal', 'menu_class' => 'nav menu']) !!}
      @endif
    </div>

    <div class="small-12 medium-6 cell">
      <ul class="menu align-right">
        <li class="menu-text">Copyright © 2020 Hello World Company</li>
      </ul>
    </div>
  </div>
</footer>
