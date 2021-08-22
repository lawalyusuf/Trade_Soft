<template>
    <div class="card">
        <b-overlay :show="loadingInit" rounded="sm" spinner-type="grow" spinner-variant="primary">
            <div class="card-body">
                <h4 class="card-title mb-4">Send Money</h4>
                <form @submit.prevent="cal">
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
                                <label class="mb-1">SELECT YOUR RECIPIENTS COUNTRY?</label>
                                <div class="position-relative icon-form-control">
                                    <multiselect
                                    v-model="form.toCountry"
                                    track-by="Name"
                                    label="Name"
                                    @input="getRate"
                                    placeholder="Choose recipients Country"
                                    :options="toCountries">
                                    </multiselect>
                                    <has-error :form="form" field="country"></has-error>
                                </div>
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
                    <button class="btn btn-primary btn-block mt-5" v-else type="submit"> Calculate </button>
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
            toCountries : [],
            fromCountries : [],
            form: new Form({
                fromCountry: '',
                toCountry: '',
                amount: 20,
                total: 0,
            })
        }

    },
    methods: {
        loadInit(){
            axios.get('/countries/from')
            .then((response) => {
                this.fromCountries = response.data.countries
            });

            axios.get('/countries/to')
            .then((response) => {
                this.toCountries = response.data.countries
            });


            axios.get('/countries/to/init')
            .then((response) => {
                this.form.toCountry = response.data.country
            })
            .then(() =>{
                axios.get('/countries/from/init')
                .then((response) => {
                    this.form.fromCountry = response.data.country
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


