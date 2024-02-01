<header class="site-navbar site-navbar-target" role="banner">
  <div class="container">
      <div class="row align-items-center position-relative">
          <div class="col-3">
              <div class="site-logo">
                  <a href="{{ route('frontend.home') }}"><strong>CarRental</strong></a>
              </div>
          </div>

          <div class="col-9 text-right">
              <span class="d-inline-block d-lg-none">
                  <a href="#" class="site-menu-toggle js-menu-toggle py-5 ">
                      <span class="icon-menu h3 text-black"></span>
                  </a>
              </span>

              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                  <ul class="site-menu main-menu js-clone-nav ml-auto">
                      <li class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                          <a href="{{ route('frontend.home') }}" class="nav-link">Home</a>
                      </li>
                      <li class="{{ request()->routeIs('frontend.listing') ? 'active' : '' }}">
                          <a href="{{ route('frontend.listing') }}" class="nav-link">Listing</a>
                      </li>
                      <li class="{{ request()->routeIs('frontend.testimonials') ? 'active' : '' }}">
                          <a href="{{ route('frontend.testimonials') }}" class="nav-link">Testimonials</a>
                      </li>
                      <li class="{{ request()->routeIs('frontend.blog') ? 'active' : '' }}">
                          <a href="{{ route('frontend.blog') }}" class="nav-link">Blog</a>
                      </li>
                      <li class="{{ request()->routeIs('frontend.about') ? 'active' : '' }}">
                          <a href="{{ route('frontend.about') }}" class="nav-link">About</a>
                      </li>
                      <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                          <a href="{{ route('frontend.contact') }}" class="nav-link">Contact</a>
                      </li>
                  </ul>
              </nav>
          </div>
      </div>
  </div>
</header>
@yield('hero-part')
<style>
  li.active a {
   
    color: #007bff !important;
    font-weight: bold
}
</style>