<template>
    <div class="flex">
        <jet-button @click="saveCategory" v-if="!isEdit">
            Create New
        </jet-button>
        <a href="#" @click.prevent="saveCategory" class="text-indigo-600 hover:text-indigo-900" v-else>Edit</a>

        <jet-dialog-modal :show="savingCategory" @close="closeModal">
            <template #title>
                {{ isEdit ? "Update Category" : "Create Category" }}
            </template>

            <template #content>
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Category Name"
                                ref="name"
                                v-model="form.name"
                                @keyup.enter="save" />

                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <jet-checkbox v-model:checked="form.active"/>
                        <span class="ml-2 text-sm text-gray-600">Active</span>
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

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
        JetCheckbox,
    },

    props: {
        isEdit: {
            type: Boolean,
            default: false
        },
        category: {
            type: Object,
            default: {
                name: '',
                active: false,
            }
        }
    },

    data() {
        return {
            savingCategory: false,

            form: this.$inertia.form(this.category)
        }
    },

     methods: {
        saveCategory() {
            this.savingCategory = true;

            setTimeout(() => this.$refs.name.focus(), 250)
        },

        save() {
            if (!this.isEdit) {
                this.form.post(route('categories.store'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.name.focus(),
                    onFinish: () => this.form.reset(),
                })
            } else {
                this.form.put(route('categories.update', this.form.id), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.name.focus(),
                    onFinish: () => this.form.reset(),
                })
            }
        },

        closeModal() {
            this.savingCategory = false

            this.form.reset()
        },
    },
}
</script>
