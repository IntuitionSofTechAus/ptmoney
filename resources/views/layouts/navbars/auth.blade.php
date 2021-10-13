<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                @php $profile =  Auth::user()->profile; @endphp
                  @if($profile && File::exists(public_path($profile)))
                 <img src="{{ asset($profile) }}">
               <p>{{ asset('paper/img/user/'.$profile) }}</p>
                 @else
                 <img src="{{ asset('paper') }}/img/user.png">
                 @endif
            </div>
        </a>
        <a href="#" class="simple-texts logo-normal">
            {{ Auth::user()->name }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
          @if (\Auth::user()->role == 1)
           <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
         <!--   <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('payment.list') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Payment List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('procesing.list') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Processing List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('transferring') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Transferring List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="{{ route('completed.list') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Completed List') }}</p>
                </a>
            </li> -->
            <li class="{{ request()->segment(2) == 'member' ? 'active' : '' }}">
                <a href="{{ route('member.list') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Member List') }}</p>
                </a>
            </li>
             <li class="{{ request()->segment(2) == 'users-list' ? 'active' : '' }}">
                <a href="{{ route('users.list') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Users List') }}</p>
                </a>
            </li>
            <li class="{{ request()->segment(2) == 'exchange-rate' ? 'active' : '' }}">
                <a href="{{ route('exchange.rate') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Exchange Rate') }}</p>
                </a>
            </li>
             <!-- <li class="{{ $elementActive == 'payment' ? 'active' : '' }}">
                <a href="#">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Add New Transaction') }}</p>
                </a>
            </li> -->
        @else
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('user') }}">
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
             @if(App\Models\Member::where('user_id',Auth::user()->id)->count() > 0 )
            @if(App\Models\Member::where('user_id',Auth::user()->id)->first()->approval == 1)
            <li class="{{ request()->segment(2) == 'beneficiary' ? 'active' : '' }}">
                <a href="{{ route('beneficiary.list') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Beneficiary List') }}</p>
                </a>
            </li>
            @endif
            @endif
            <li class="{{ request()->segment(2) == 'aplication-form' ? 'active' : '' }}">
                <a href="{{ route('aplication-form') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Application-form') }}</p>
                </a>
            </li>           
            @endif
        </ul>
    </div>
</div>
