<template>
    <div>
        <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" @click="show">
            View Details
        </button>
        <div class="modal fade" :id="recipient.id" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transaction-detailModalLabel">Recipient Details</h5>
                        <button type="button" class="btn-close" @click="hide" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-0">
                            <div class="col-md-6">
                                <p class="mb-2">Account Number: <span class="text-primary">{{ recipient.account_number }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Account Name: <span class="text-primary">{{ recipient.account_name }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Country: <span class="text-primary">{{ recipient.country.name }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Bank: <span class="text-primary">{{ recipient.bank.Name }}</span></p>
                            </div>
                             <div class="col-md-6">
                                <p class="mb-2">Currency: <span class="text-primary">{{ recipient.country.currency }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">Country Code: <span class="text-primary">{{ recipient.bank.CountryCode }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <b-button type="submit" variant="primary" class="btn btn-danger" v-if="!dis" disabled><b-spinner small></b-spinner> Removing</b-button>
                        <button type="submit" class="btn btn-danger" v-else @click="remove">Remove</button>
                        <button type="button" class="btn btn-secondary" @click="hide">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props:{
            recipient: [Object]
        },

        data(){
            return{
                err: false,
                dis: true,
                form: new Form({
                    id: '',
                })
            }
        },

        methods:{
            remove(){
                this.dis = false;
                this.form.id = this.recipient.id
                this.form.post('/removeRecipient')
                .then(()=>{
                    this.$Progress.finish();
                    this.dis = true
                    swal.fire(
                        'success!',
                        this.recipient.account_name+' has be remove to your recipient list',
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
                        this.recipient.account_name+' cannot be remove to your recipient list',
                        'error'
                    )
                })
            },
            show(){
                $('#'+this.recipient.id).modal('show');
            },
            hide(){
                $('#'+this.recipient.id).modal('hide');
            }
        }

    }
</script>
