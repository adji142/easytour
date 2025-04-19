<template>
    <section class="section_padding">
        <div class="container">
            <h3>Edit Profile</h3>

            <form @submit.prevent="updateProfile">
                <div class="form-group mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control" v-model="form.name" required>
                </div>

                <div class="form-group mb-3">
                    <label>No. Telepon</label>
                    <input type="text" class="form-control" v-model="form.phone">
                </div>

                <div class="form-group mb-3">
                    <label>Foto Profil</label>
                    <input type="file" class="form-control" @change="handlePhotoUpload">
                    <div v-if="form.photo" class="mt-2">
                        <img :src="form.photo" alt="Preview" style="max-width: 200px;">
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Simpan
                </button>
            </form>
        </div>
    </section>
</template>

<script>
import Swal from 'sweetalert2';
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            form: {
                name: this.user.name,
                phone: this.user.phone ?? '',
                photo: this.user.image ?? ''
            },
            loading: false,
        };
    },
    methods: {
        handlePhotoUpload(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = (e) => {
                this.form.photo = e.target.result; // base64
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        },
        updateProfile() {
            this.loading = true;

            this.$inertia.post('/saveprofile', this.form, {
                onFinish: () => this.loading = false,
                onSuccess: () => {
                    this.$toast.success("Profile updated!");
                },
                onError: (errors) => {
                    this.$toast.error("Error : " + errors);
                }
            });
        }
    }
}
</script>
