<div class="py-5 bg-gray-100">
    <div class="flex flex-wrap justify-center gap-4 px-4 md:flex-nowrap">

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="State"
            heading1="Total"
            :val1="$state"
            :footershow="false" />


        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="District"
            heading1="Total"
            :val1="$district"
            :footershow="false" />

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="School"
            heading1="Total"
            :val1="$school"
            :footershow="false" />
    </div>

    <x-separator />

    <div class="flex flex-wrap justify-center gap-4 px-4 md:flex-nowrap mt-2">

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="Student"
            heading1="Total"
            :val1="140"
            :footershow="false" />

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="Exam"
            heading1="Total"
            :val1="150"
            :footershow="false" />

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="Competition"
            heading1="Total"
            :val1="160"
            :footershow="false" />


    </div>

    <x-separator />

    <div class="flex flex-wrap justify-center gap-4 px-4 md:flex-nowrap mt-2">

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="Question"
            heading1="Total"
            :val1="170"
            :footershow="false" />

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="Revenue"
            heading1="Total"
            :val1="180"
            :footershow="false" />

        <x-admin-dashboard-card
            class="w-full md:w-1/3 max-w-md bg-white shadow-lg rounded-lg p-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-2xl"
            title="Question"
            heading1="Total"
            :val1="190"
            :footershow="false" />


    </div>
</div>
