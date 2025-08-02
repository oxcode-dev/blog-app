<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Articles',
        href: '/articles',
    },
];

const articles = computed(() => usePage().props?.articles || {})
const articlesData = computed(() => usePage().props?.articles?.data || [])

</script>

<template>
    <Head title="Articles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="relative min-h-[100vh] rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">

                <div>
                    <table class="min-w-full bg-white shadow-md rounded-xl">
                        <thead>
                            <tr class="bg-blue-gray-100 text-gray-700 border-b">
                            <th class="py-3 px-4 text-left">Stock Name</th>
                            <th class="py-3 px-4 text-left">Price</th>
                            <th class="py-3 px-4 text-left">Quantity</th>
                            <th class="py-3 px-4 text-left">Total</th>
                            <th class="py-3 px-4 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-blue-gray-900">
                            <tr class="border-b border-blue-gray-200">
                            <td class="py-3 px-4">Company A</td>
                            <td class="py-3 px-4">$50.25</td>
                            <td class="py-3 px-4">100</td>
                            <td class="py-3 px-4">$5025.00</td>
                            <td class="py-3 px-4">
                                <a href="#" class="font-medium text-blue-600 hover:text-blue-800">Edit</a>
                            </td>
                            </tr>
                            
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
