<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Pager from '@/components/Pager.vue';


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
                <pre>{{ articles }}</pre>

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

                <!-- <div class='flex items-center justify-center'>
                    <div class="flex justify-center items-center space-x-4">
                        <div v-if="articles?.prev_page_url" class="border rounded-md bg-gray-100 px-2 py-1 text-3xl leading-6 text-slate-400 transition hover:bg-gray-200 hover:text-slate-500 cursor-pointer shadow-sm">
                            <Link :href="articles?.prev_page_url">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </Link>
                        </div>
                        <div class="text-slate-500">
                            <span class="font-bold text-lg">{{ `${articles?.current_page} ` }}</span>
                            <span>{{ ` / ${articles?.last_page}` }}</span>
                            
                        </div>
                        <div v-if="articles?.next_page_url" class="border rounded-md bg-gray-100 px-2 py-1 text-3xl leading-6 text-slate-400 transition hover:bg-gray-200 hover:text-slate-500 cursor-pointer shadow-sm">
                            <Link :href="articles?.next_page_url">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div> -->
                <div>
                    <Pager :item="articles" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
