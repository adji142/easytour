<template>
    <li>
        <a href="#!" @click="modalToggle" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-sign-out-alt"></i>Logout
        </a>
    </li>

    <div ref="modal" class="modal fade" :class="{ show: active, 'd-block': active }" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body logout_modal_content">
                    <div class="btn_modal_closed">
                        <button type="button" data-bs-dismiss="modal" @click="modalToggle" aria-label="Close"><i
                                class="fas fa-times"></i></button>
                    </div>
                    <h3>
                        Are you sure? <br>
                        you want to log out.
                    </h3>
                    <div class="logout_approve_button">
                        <button data-bs-dismiss="modal" class="btn btn_theme btn_md">Yes Confirm</button>
                        <button data-bs-dismiss="modal" class="btn btn_border btn_md" @click="modalToggle">No
                            Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: "LogoutBtn",
    data() {
        return {
            active: false,
        }
    },
    methods: {
        modalToggle() {
            const body = document.querySelector("body")
            this.active = !this.active
            this.active ? body.classList.add("modal-open") : body.classList.remove("modal-open")
        },
    },
};
</script>