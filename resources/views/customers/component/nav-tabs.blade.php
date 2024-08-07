<ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabsecondary" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'home' ? 'active' : '' }}" id="top-home-secondary" data-bs-toggle="tab" href="#top-homesecondary" role="tab" aria-controls="top-home" aria-selected="true"><i class="pt-2 pe-2" data-feather="users"></i>Profile</a>
        <div class="material-border"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'profile' ? 'active' : '' }}" id="profile-top-secondary" data-bs-toggle="tab" href="#top-profilesecondary" role="tab" aria-controls="top-profilesecondary" aria-selected="false">
            <i class="pt-2 pe-2" data-feather="list"></i>Tagihan
        </a>
        <div class="material-border"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'contact' ? 'active' : '' }}" id="contact-top-secondary" data-bs-toggle="tab" href="#top-contactsecondary" role="tab" aria-controls="top-contactsecondary" aria-selected="false">
            <i class="pt-2 pe-2" data-feather="file-text"></i>Lacak Resi
        </a>
        <div class="material-border"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'invoice' ? 'active' : '' }}" id="invoice-top-secondary" data-bs-toggle="tab" href="#top-invoicesecondary" role="tab" aria-controls="top-invoicesecondary" aria-selected="false">
            <i class="pt-2 pe-2" data-feather="file-text"></i>Invoice
        </a>
        <div class="material-border"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab == 'invoice' ? 'active' : '' }}" id="point-top-secondary" data-bs-toggle="tab" href="#top-pointsecondary" role="tab" aria-controls="top-invoicesecondary" aria-selected="false">
            <i class="pt-2 pe-2" data-feather="info"></i>Point
        </a>
        <div class="material-border"></div>
    </li>
</ul>