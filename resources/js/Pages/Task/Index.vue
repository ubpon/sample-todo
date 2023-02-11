<template>
    <app-layout title="Tasks">
        <template #header>
            <h2 class="flex justify-between font-semibold text-xl text-gray-800 leading-tight">
                Tasks
                <save-task :categories="categories" />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <list-task :tasks="tasks" :categories="categories" />
            </div>
        </div>
    </app-layout>
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import SaveTask from './Partials/SaveTask.vue'
import ListTask from './Partials/ListTask.vue'

export default defineComponent({
    components: {
        AppLayout,
        SaveTask,
        ListTask,
    },

    props: {
        categories: Array,
        tasks: Array,
    },
})
</script>

