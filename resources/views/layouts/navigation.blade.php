
<nav class="menu">
    <!-- sidebar -->

    <!-- Primary Navigation Menu -->
    <div class="navigation">
        <div>
            <button class="btn fs-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                <i class="bi bi-list"></i>
            </button>

            <!-- Settings Dropdown -->
            <div class="d-flex align-items-center">
                <x-dropdown align="right" width="72">
                    <x-slot name="trigger">
                        <button class="btn dropdown-toggle d-flex align-items-center" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link
                            class="dropdown-item border-bottom border-secondary d-flex justify-content-center"
                            :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item" >
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                class="text-decoration-none text-black d-flex justify-content-center"
                                onclick="event.preventDefault();this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
