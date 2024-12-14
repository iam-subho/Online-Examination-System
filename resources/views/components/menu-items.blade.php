<div>
    <x-menu title="">
        <x-menu-item label="Dashboard" icon="home" link="{{ route('admin.dashboard') }}"/>
        <x-menu-item label="Edit" icon="pencil-square"/>
        <x-menu-item label="Duplicate" icon="document-duplicate"/>

        <x-separator/>
        <x-menu-item label="Archive" icon="archive-box" badge="25" badge-end/>
        <x-menu-item label="Move" icon="arrow-right-circle"/>

        <x-separator title="Exam"/>
        <x-menu-item label="Category" icon="building-library" link="{{ route('admin.exam-category') }}" />
        <x-menu-item label="Questions" icon="building-library" link="{{ route('admin.question-bank') }}" />

        <x-separator title="Setup"/>
        <x-menu-item label="State" icon="building-library" link="{{ route('admin.states-management') }}" />
        <x-menu-item label="District" icon="building-storefront" link="{{ route('admin.district-management') }}"/>
        <x-menu-item label="School Board" icon="building-office-2"/>
        <x-menu-item label="School" icon="academic-cap"/>
        <x-menu-item label="System Settings" icon="building-office-2"/>

    </x-menu>

</div>
