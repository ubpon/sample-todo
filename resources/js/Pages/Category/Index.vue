<template>
    <app-layout title="Categories">
        <template #header>
            <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
                Categories
                <save-category />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <list-category :categories="categories" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ListCategory from './Partials/ListCategory.vue'
    import SaveCategory from './Partials/SaveCategory.vue'

    export default defineComponent({
        components: {
            AppLayout,
            ListCategory,
            SaveCategory
        },
        props: {
            categories: Array
        }
    })
</script>
