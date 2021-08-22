<template>
    <div class="card">
        <b-overlay :show="loadingInit" rounded="sm" spinner-type="grow" spinner-variant="primary">
            <div class="card-body">
                <h4 class="card-title mb-4">Send Money to {{ recipient.account_name }}</h4>
                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group add-border">
                                <label class="mb-1">SELECT YOUR COUNTRY?</label>
                                <div class="position-relative icon-form-control">
                                    <multiselect
                                    v-model="form.fromCountry"
                                    track-by="Name"
                                    label="Name"
                                    @input="getRate"
                                    placeholder="Choose your Country"
                                    :options="fromCountries">
                                    </multiselect>
                                    <has-error :form="form" field="country"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group add-border">
                                <label class="mb-1">RECIPIENTS COUNTRY?</label>
                                <h4 class="text-uppercase">{{ recipient.country.name }}</h4>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group add-border">
                                <label class="mb-1 text-center">IF YOU SEND</label>
                                <div class="position-relative icon-form-control">
                                    <input type="number" @input="cal" class="form-control" :class="{'is-invaild': form.errors.has('amount')}" v-model="form.amount">
                                    <has-error :form="form" field="amount"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group add-border">
                                <label class="mb-1 text-center">RECEPIENT WILL RECEIVE</label>
                                <div class="position-relative icon-form-control">
                                    <input type="number" readonly class="form-control" v-model="rAmount">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="row mx-0 py-3 add-border">
                                <div class="col-md-4">
                                    <h5 class="text-center tr-f">Transfer Rate</h5>
                                    <h5 class="text-center tr-n"><currency :amount="rate" :sign="form.toCountry ? form.toCountry.currencies.Symbol : ''"></currency></h5>

                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-center tr-f">Transfer fee</h5>
                                    <h5 class="text-center tr-n"><currency :amount="fee" :sign="form.fromCountry ? form.fromCountry.currencies.Symbol : '' "></currency></h5>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-center tr-f">Total Cost</h5>
                                    <h5 class="text-center tr-n"><currency :amount="form.total" :sign="form.fromCountry ? form.fromCountry.currencies.Symbol : ''"></currency></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <b-button type="submit" variant="primary" class="btn btn-primary btn-block mt-5" v-if="!dis" disabled><b-spinner small></b-spinner></b-button>
                    <button class="btn btn-primary btn-block mt-5" v-else type="submit"> Send Money </button>
                </form>

            </div>
        </b-overlay>
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
        recipient: [Object]
    },
    data() {
        return {
            rate: 0,
            loadingInit: true,
            dis: true,
            fee: 0.5,
            rAmount: '',
            fromCountries : [],
            form: new Form({
                fromCountry: '',
                toCountry: '',
                amount: 20,
                total: 0,
                recipient: ''
            })
        }

    },
    methods: {
        submit(){
            swal.fire({
                title: 'Send Money?',
                text: "Confirm you want to send money to " +this.recipient.account_name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#353535',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.value) {
                    this.dis = false;
                    this.loadingInit = true;
                    this.form.ddd = this.user;
                    this.form.recipient = this.recipient;
                    this.form.post('/addTransaction')
                    .then(()=>{
                        this.dis = true
                        this.loadingInit = false;

                        swal.fire(
                            'success!',
                            'Transaction was initiated, process to payment',
                            'success'
                        ).then(() =>{
                            window.location = '/transaction/status'
                        });

                    })
                    .catch(()=>{
                        this.dis = true
                        this.err = true;
                        this.loadingInit = false;
                        swal.fire(
                            'Error!',
                            'Transaction Failed, try again later',
                            'error'
                        )
                    })
                }

            })

        },
        loadInit(){
            axios.get('/countries/from')
            .then((response) => {
                this.fromCountries = response.data.countries
            });

            axios.get('/countries/get/code', {params:{
                country: this.recipient.country.code
            }})
            .then((response) => {
                this.form.toCountry = response.data.country
            })
            .then(() =>{
                axios.get('/countries/from/init')
                .then((response) => {
                    this.form.fromCountry = response.data.country;
                })
                .then(() =>{
                    this.getRate();
                    this.loadingInit = false;
                });
            })

        },
        getRate(){
            axios.get('/rate', {params:{
                fromCurrency: this.form.fromCountry.Currency,
                toCurrency: this.form.toCountry.Currency,
            }}).then((response) => {
                this.rate = response.data.rate.rate;
                this.cal();
            })
        },
        cal(){
            this.rAmount = this.rate * this.form.amount;
            this.am();

        },
        am(){
            this.form.total = this.form.amount;
        }

    },

    created(){
        this.loadInit();


    }
}
</script>
<style scoped>
.add-border {
    border: 1px solid #dfdfdf;
    padding: 10px 10px;
    border-radius: 5px;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


