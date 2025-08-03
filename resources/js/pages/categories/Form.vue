<script setup lang="js">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { computed } from 'vue';



const breadcrumbs = [
    {
        title: 'Categories',
        href: '/categories',
    },
];

const category = computed(() => usePage().props?.category || {})

const form = useForm({
    name: category.value?.name || '',
    description: category.value?.description || '',
    id: category.value?.id || null,
});

const submit = () => {
    form.post(route('categories.store'), {
        onFinish: () => {
            alert('Category Saved Successfully!!!')
            router.visit('/categories ')
        } 
    });
};

</script>

<template>
    <Head title="Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg my-4">
                <div class="px-4 py-5 w-full md:max-w-lg">
                    <form @submit.prevent="submit" class="space-y-2">
                        <!-- <pre>{{ category }}</pre> -->
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="name"
                                v-model="form.name"
                                placeholder="category name..."
                            />
                            <InputError :message="form?.errors?.name" />
                        </div>
                    
                        <div class="grid gap-2">
                            <Label for="description">Description</Label>
                            <textarea
                                id="description"
                                required
                                :tabindex="1"
                                v-model="form.description"
                                rows="6"
                                class="block w-full pl-2 pr-10 py-2 text-base border border-gray-300 focus:outline-hidden sm:text-sm rounded-md capitalize"
                                placeholder="Description..."
                            ></textarea>
                            <InputError :message="form?.errors?.description" />
                        </div>

                        <div>
                            <Button type="submit" class="mt-4" :tabindex="4" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Submit
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
