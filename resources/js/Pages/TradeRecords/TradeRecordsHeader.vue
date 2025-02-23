<script setup>
import NavLink from '@/Components/atom/NavLink.vue';
</script>

<template >
    <header
        class="bg-white shadow"
    >
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                <!-- Navigation Links -->
                <div
                    class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex"
                >
                    <NavLink
                        :href="route('trade-records.show')"
                        :active="route().current('trade-records.show')"
                    >
                        Entries
                    </NavLink>
                    <NavLink
                        :href="route('trade-performance.show')"
                        :active="route().current('trade-performance.show')"
                    >
                        Trade Performance
                    </NavLink>
                </div>
            </h2>
        </div>
    </header>
    
</template>