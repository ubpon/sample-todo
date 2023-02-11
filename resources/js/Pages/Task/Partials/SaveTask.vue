<template>
    <div>
        <jet-button @click="saveTask" v-if="!isEdit">
            Create New
        </jet-button>

        <a href="#" @click.prevent="saveTask" class="text-indigo-600 hover:text-indigo-900" v-else>Edit</a>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="savingTask" @close="closeModal">
            <template #title>
                {{ isEdit ? "Update Task" : "Create Task" }}
            </template>

            <template #content>
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Task Description"
                                ref="description"
                                v-model="form.description"
                                @keyup.enter="save" />

                    <jet-input-error :message="form.errors.description" class="mt-2" />
                </div>

                <div class="mt-4">
                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-3/4"
                        v-model="form.category_id" >
                        <option value="" disabled selected>Select Category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>

                    <jet-input-error :message="form.errors.category_id" class="mt-2" />
                </div>

                <div class="mt-4" v-if="isEdit">
                    <label class="flex items-center">
                        <jet-checkbox v-model:checked="form.completed"/>
                        <span class="ml-2 text-sm text-gray-600">Completed</span>
                    </label>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="save" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>
<script>
import JetButton from '@/Jetstream/Button.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetCheckbox,
        JetSecondaryButton,
    },

    props: {
        categories: Array,
        isEdit: {
            default: false,
            type: Boolean
        },
        task: {
            type: Object,
            default: {
                description: '',
                category_id: '',
                completed: false,
            }
        }
    },

    data() {
        return {
            savingTask: false,

            form: this.$inertia.form(this.task)
        }
    },

    methods: {
        saveTask() {
            this.fetchCategories();
            this.savingTask = true;

            setTimeout(() => this.$refs.description.focus(), 250)
        },

        fetchCategories() {
            Inertia.reload({ only: ['categories'] })
        },

        save() {
            if (!this.isEdit) {
                this.form.post(route('tasks.store'), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        this.closeModal();
                        this.form.reset();
                    },
                })
            } else {
                this.form.put(route('tasks.update', this.form.id), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        this.closeModal();
                    },
                })
            }
        },

        closeModal() {
            this.savingTask = false
            this.form.clearErrors()
            this.form.reset()
        },
    },
}
</script>
