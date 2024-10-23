<ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabsecondary" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'home' ? 'active' : '' }}" id="top-home-secondary" data-bs-toggle="tab" href="#top-homesecondary" role="tab" aria-controls="top-home" aria-selected="true"><i class="pt-2 pe-2" data-feather="list"></i>Pengiriman</a>
        <div class="material-border"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'profile' ? 'active' : '' }}" id="profile-top-secondary" data-bs-toggle="tab" href="#top-profilesecondary" role="tab" aria-controls="top-profilesecondary" aria-selected="false">
            <i class="pt-2 pe-2" data-feather="trending-up"></i>Pemasukan
        </a>
        <div class="material-border"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'contact' ? 'active' : '' }}" id="contact-top-secondary" data-bs-toggle="tab" href="#top-contactsecondary" role="tab" aria-controls="top-contactsecondary" aria-selected="false">
            <i class="pt-2 pe-2" data-feather="trending-down"></i>Pengeluaran
        </a>
        <div class="material-border"></div>
    </li>
</ul>