<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    @include('partials.navbar')
    @if(Auth::user() and \Request::route()->uri() != 'client/examinations/{examinations}' && Auth::user()->isStaff())
        @include('partials.sidebar')
    @endif

</nav>
