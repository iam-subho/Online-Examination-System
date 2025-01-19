<div>
    <x-menu title="">
        <x-menu-item label="Dashboard" icon="home" link="{{ route('admin.dashboard') }}"/>
        <x-menu-item label="Candidate" icon="user" link="{{ route('admin.candidate') }}"/>



        <x-separator title="Exam"/>
        <x-menu-item label="Category" icon="building-library" link="{{ route('admin.exam-category') }}" />
        <x-menu-item label="Exams" icon="building-library" link="{{ route('admin.exam-management') }}" />
        <x-menu-item label="Questions" icon="building-library" link="{{ route('admin.question-bank') }}" />

        <x-separator title="Setup"/>
        <x-menu-item label="State" icon="building-library" link="{{ route('admin.states-management') }}" />
        <x-menu-item label="District" icon="building-storefront" link="{{ route('admin.district-management') }}"/>
        <x-menu-item label="School Board" icon="building-office-2"/>
        <x-menu-item label="School" icon="academic-cap"/>
        <x-menu-item label="System Settings" icon="building-office-2"/>

    </x-menu>

</div>
