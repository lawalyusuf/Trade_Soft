<template>
    <div class="login-register-form">
        <form action="#" @submit.prevent="onSubmit">
            <div class="form-group">
                <label class="mb-1">Country</label>
                <div class="position-relative icon-form-control">
                    <multiselect
                    v-model="form.country"
                    track-by="Name"
                    label="Name"
                    @input="getBank"
                    :options="countries">
                    </multiselect>
                    <has-error :form="form" field="country"></has-error>
                </div>
            </div>

            <div class="form-group">
                <label class="mb-1">Bank</label>
                <div class="position-relative icon-form-control">
                    <multiselect
                    v-model="form.bank"
                    track-by="Name"
                    label="Name"
                    :options="banks">
                    </multiselect>
                    <has-error :form="form" field="bank"></has-error>
                </div>
            </div>

            <div class="form-group">
                <label class="mb-1">Recipients account number</label>
                <div class="position-relative icon-form-control">
                    <input type="number" class="form-control" :class="{'is-invaild': form.errors.has('country')}" v-model="form.account_number">
                    <has-error :form="form" field="account_number"></has-error>
                </div>
            </div>

            <div class="form-group">
                <label class="mb-1">Recipients account name</label>
                <div class="position-relative icon-form-control">
                    <input type="text" class="form-control" :class="{'is-invaild': form.errors.has('country')}" v-model="form.account_name">
                    <has-error :form="form" field="account_name"></has-error>
                </div>
            </div>


            <b-button type="submit" variant="primary" class="btn btn-primary btn-block " v-if="!dis" disabled><b-spinner small></b-spinner></b-button>
            <button class="btn btn-primary btn-block " v-else type="submit"> Add Recipient </button>
            <div class="py-3 d-flex align-item-center">
            </div>
        </form>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    export default {
        components: {
            Multiselect,
        },
        props:{
            user: [String]
        },
        data(){
            return{
                err: false,
                dis: true,
                countries: [],
                banks: [],
                form: new Form({
                    country: '',
                    bank: '',
                    account_number: '',
                    account_name: '',
                    bank:'',
                    ddd: '',
                })
            }
        },

        methods:{
            getBank(){
                this.banks = [];
                this.form.bank = [];
                axios.get('/banks/', {params:{
                    country: this.form.country.Code
                }})
                .then((response) => {
                    this.banks = response.data.banks
                })
            },
            onSubmit(){
                this.dis = false;
                this.form.ddd = this.user;
                this.form.post('/addRecipient')
                .then(()=>{
                    this.$Progress.finish();
                    this.dis = true
                    swal.fire(
                        'success!',
                        this.form.account_name+' has be added to your recipient list',
                        'success'
                    ).then(() =>{
                        window.location = '/recipient'
                    });

                })
                .catch(()=>{
                    this.dis = true
                    this.err = true;
                    this.$Progress.fail();
                    swal.fire(
                        'Error!',
                        this.form.account_name+' cannot be added to your recipient list',
                        'error'
                    )
                })
            }

        },
        created(){
            axios.get('/countries')
            .then((response) => {
                this.countries = response.data.countries
            })
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
