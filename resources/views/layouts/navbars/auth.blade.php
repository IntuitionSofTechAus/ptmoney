<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-texts logo-normal">
            {{ Auth::user()->name }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
          @if (\Auth::user()->role == 1)
           <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
           <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('payment.list', 'payment') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Payment List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('procesing.list', 'processing') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Processing List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('transferring', 'transferring') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Transferring List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('completed.list', 'completedlist') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Completed List') }}</p>
                </a>
            </li>
             <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('exchange.rate', 'exchange') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Set Exchange Rate') }}</p>
                </a>
            </li>
             <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('member.list', 'member') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Member List') }}</p>
                </a>
            </li>
             <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="#">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Add New Transaction') }}</p>
                </a>
            </li>

          @endif
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Profile') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                      <!--   <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('aplication-form') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Application-form') }}</p>
                </a>
            </li>
            
        </ul>
    </div>
</div>
