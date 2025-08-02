<template>
    <div class='flex items-center justify-center'>
        <div class="flex justify-center items-center space-x-4">
            <div v-if="item?.prev_page_url" class="border rounded-md bg-gray-100 px-2 py-1 text-3xl leading-6 text-slate-400 transition hover:bg-gray-200 hover:text-slate-500 cursor-pointer shadow-sm">
                <Link :href="item?.prev_page_url">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </Link>
            </div>
            <div class="text-slate-500">
                <span class="font-bold text-lg">{{ `${item?.current_page} ` }}</span>
                <span>{{ ` / ${item?.last_page}` }}</span>
                
            </div>
            <div v-if="item?.next_page_url" class="border rounded-md bg-gray-100 px-2 py-1 text-3xl leading-6 text-slate-400 transition hover:bg-gray-200 hover:text-slate-500 cursor-pointer shadow-sm">
                <Link :href="item?.next_page_url">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </Link>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    item: {
        type: Object,
        default: () => {}
    }
})
</script>