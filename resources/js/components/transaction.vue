<template>
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <h4 class="card-title">Select a recipient</h4><br>
                        <div class="login-register-form d-block">
                            <form action="#">
                                <div class="form-group">
                                    <label class="mb-1">Choose a recipient</label>
                                    <div class="position-relative icon-form-control">
                                        <multiselect
                                        v-model="selected"
                                        track-by="account_name"
                                        label="account_name"
                                        placeholder="Choose a recipient"
                                        :options="recipients">
                                        </multiselect>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="mt-3" v-if="selected != null">
                        <h4 class="card-title">Selected a recipient</h4>
                        <div class="row p-0">
                            <div class="col-md-6">
                                <p class="mb-2">Account Number: <span class="text-primary">{{ selected.account_number }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Account Name: <span class="text-primary">{{ selected.account_name }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Country: <span class="text-primary">{{ selected.country.name }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Bank: <span class="text-primary">{{ selected.bank.Name }}</span></p>
                            </div>
                             <div class="col-md-6">
                                <p class="mb-2">Currency: <span class="text-primary">{{ selected.country.currency }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Country Code: <span class="text-primary">{{ selected.bank.CountryCode }}</span></p>
                            </div>
                        </div>
                    </div>


                <div class="py-2 d-flex justify-content-center mt-2">
                    <a class="btn btn-sm btn-primary font-size-14 text-center" href="/recipient">
                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">Add new recipient</span>
                    </a>
                </div>
            </div>

            </div>
        </div>

        <div class="col-xl-7" v-if="selected != null">
        <!-- <div class="col-xl-7"> -->
            <send-calculator :user="user" :recipient="selected" :key="selected.id"></send-calculator>
        </div>
    </div>

</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    components: {
        Multiselect,
    },
    props:{
        user: [Object],
        recipients: [Array]
    },
    data() {
        return {
            showSelected: false,
            selected: null
        }
    },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
