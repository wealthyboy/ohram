<template>
    <div class="">
            <div v-if="showForm"  id="stored_address"  class="billing-fields__field-wrapper ">
                <form  @submit.prevent="submit" method="POST" class=""> 
                    <div class="row reduce-gutters" id="add-new-address-form" data-action="/address/create">
                        <p class="form-group reduce-gutters col-lg-6">
                            <label for="first_name">First Name</label>
                            <input  :class="{'has-danger': errors.first_name}"  id="firstname" 
                            v-model="form.first_name" 
                            @input="removeError($event)"  
                            @blur="vInput($event)" 
                            type="text" class="form-control ship-required" 
                            name="first_name"
                            >
                            <span class="help-block error  text-danger text-sm-left" v-if="errors.first_name">
                                <strong   class="text-danger">{{ formatError(errors.first_name) }}</strong>
                            </span>
                        </p>
                        <p class="form-group reduce-gutters col-lg-6">
                            <label for="last_name">Last Name</label>
                            <input id="lastname"
                                v-model="form.last_name"  
                                :class="{'has-danger': errors.first_name}"   
                                type="text"
                                @input="removeError($event)"  
                                @blur="vInput($event)"  
                                class="form-control ship-required"
                                name="last_name" 
                            >
                            <span class="help-block error  text-danger text-sm-left" v-if="errors.last_name">
                                <strong   class="text-danger">{{ formatError(errors.last_name) }}</strong>
                            </span>
                        </p>
                        <p class="form-group reduce-gutters col-md-12">
                            <label for="address">Address</label>
                            <input id="address" 
                                v-model="form.address"
                                @input="removeError($event)"  
                                @blur="vInput($event)"  
                                :class="{'has-danger': errors.address}"   
                                type="text" class="form-control ship-required" 
                                name="address" 
                            >
                            <span 
                                v-if="errors.address"
                            >
                                <span   class="text-danger bold help-block">{{ formatError(errors.address) }}</span>
                            </span>
                        </p>
                        <p class="form-group reduce-gutters col-lg-12">
                            <label for="address_2">Address 2</label>
                            <input id="address_2"  v-model="form.address_2"  type="text" class="form-control" name="address_2"  autofocus autocomplete="off">
                        </p>
                        <p class="form-group  reduce-gutters col-lg-6">
                            <label for="locality">City</label>
                            <input id="locality" 
                                v-model="form.city" 
                                @input="removeError($event)"  
                                @blur="vInput($event)"  
                                :class="{'has-danger': errors.city}"  
                                type="text" 
                                class="form-control ship-required" 
                                name="city"
                            >
                            <span  v-if="errors.city">
                                <strong  class="text-danger">{{ formatError(errors.city) }}</strong>
                            </span>
                        </p>
                        <p class="form-group  reduce-gutters col-lg-6">
                            <label for="postal_code">Postcode</label>
                            <input id="postal_code" 
                                v-model="form.postal_code" 
                                type="text" class="form-control"
                                name="postal_code"
                            >
                        </p>
                        <p class="form-group reduce-gutters  col-sm-6">
                            <label for="shipping_country">Country &nbsp;<abbr class="required" title="required">*</abbr></label>
                            <select @change="getState"  v-model="form.country_id"  name="country_id" id="shipping_country"   class="form-control ship-required" autocomplete="country" tabindex="-1" aria-hidden="true">
                                <option value="" selected="selected">Select a country…</option>
                                <option :value="country.id" v-for="country in locations" :key="country.id">{{ country.name }}</option>
                            </select>
                            <span  class="" role="" v-if="errors.country_id">
                                <strong  class="text-capitalize text-danger"> Please select your country</strong>
                            </span>
                        </p>
                        <p class="form-group reduce-gutters col-sm-6">
                            <label for="state_id" class="">State/Region &nbsp;<abbr class="required " title="required">*</abbr></label>
                            <select @change="getShipping"  v-model="form.state_id"  name="state_id" id="state_id" class="form-control ship-required">
                                <option value="" >Select a state</option>
                                <option :value="state.id" v-for="(state,index) in states" :key="state.id" :selected="[index ? 'selected': '']">{{ state.name }}</option>
                            </select>
                            <span  class="text-danger" role="" v-if="errors.state_id">
                                <strong   class="text-danger"> Please select your state</strong>
                            </span>
                        </p>

                        <div class="form-check my-3 ml-2">
                            <input class="form-check-input" type="checkbox" id="sameAsBilling" v-model="form.sameAsBilling" >
                            <label class="form-check-label ml-2 pointer" for="sameAsBilling">
                            Same as billing address
                            </label>
                        </div>

                        <p class="form-group reduce-gutters text-right col-lg-12 ">
                            <button v-if="!addresses.length" type="submit" class="btn btn-sm btn-primary" name="checkout_place_order" id="place_order" value="Place order" data-value="Place Order">
                                <span  v-if="submiting" class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                                Save & Continue
                            </button>
                            <p v-if="addresses.length" class="form-group col-6 col-md-6 text-left">
                                <button type="submit" class="btn btn-sm btn-primary mr-1"  value="Submit">
                                    <span  v-if="submiting" class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                                    Save 
                                </button>
                            </p>
                            <p v-if="addresses.length" class="form-group col-6  col-md-6 text-right">
                                <a @click.prevent="cancelForm"  class="cancel-form bold color--primary pull-right" href="#">Cancel</a>
                            </p>

                        </p>
                    </div>
                </form>
            </div>


            <div v-if="addresses.length && !showForm"  class="address_details mt-1">
                <a href="#" class="btn btn--primary btn-round btn-lg btn-block mb-1 bold"  @click.prevent="addNewAddress" id="enter-new-address"> + Add Address  </a>
                <ul class="mb-1">
                    <li   
                        :class="[{ 'mb-1': addresses.length > 1 }]"
                        v-for="(location, index) in addresses" :key="location.id">
                        <div class="shipping-info border border-gray pr-3 pt-2 pl-3">
                            <div class="shipping-address-info">
                                <div  id="">{{ location.first_name }} {{ location.last_name }} </div>
                                <div> {{ location.address }} {{ location.address2}} </div>
                                <div> {{ location.city }}, {{ location.postcode }}</div>
                                <div> {{ location.state}}, {{ location.country }} </div>
                                <div class="mt-2 mb-2">
                                    <a  @click.prevent="editAddress(index)" data-placement="left"  href="#" class="ml-0 mr-4 color--primary bg--gray l-f1  p-3 border "> 
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a  @click.prevent="makeDefault($event,location.id)"  :id="location.id"  data-placement="left"  href="#" class="mr-4 l-f1  bg--gray   p-3 color--primary ml-4   make-default"> 
                                        <i  class="fa fa-plus"></i> 
                                        <span  v-if="location.is_active >= 1"> 
                                        Default 
                                        </span>
                                        <span  v-else>
                                            <span v-if="id == location.id" class='spinner-border spinner-border-lg' role='status' aria-hidden='true'></span>
                                            Use this address
                                        </span> 
                                    </a>
                                    <a  @click.prevent="removeAddress($event,location.id)"  :id="location.id" data-placement="left"  href="#" class="color--primary p-3  bg--gray  l-f1  ml-4"> <i class="fa fa-trash"></i>
                                        <span v-if="delete_id == location.id" class='spinner-border spinner-border-lg' role='status' aria-hidden='true'></span>
                                        Delete
                                    </a>
                                </div>
                            </div>           
                        </div>
                    </li>
                </ul>
            </div>
        
    </div>
</template>
<script>

import axios from 'axios'
import { mapActions, mapGetters } from 'vuex'
import ErrorMessage from '../messages/components/Error'


export default{
    props:{
        currency:String,
    },
    components:{
        ErrorMessage,
    },
    data(){
        return {
            hideForm: true,
            states: [],
            shipping_companies: [],
            country_states: [],
            submitStatus: null,
            state:'',
            id:null,
            delete_id:null,
            errorsBag:[],
            submiting:false,
            address_id: '',
            error:null,
            form: {
                first_name: '',
                last_name: '',
                address: '',
                address_2:'',
                city:'',
                postal_code:'',
                country_id:"",
                state_id:'',
                sameAsBilling: false,
                is_billing: false
            }
        }
    },
    computed:{
        ...mapGetters({
            locations: "locations",
            shipping:  "shipping",
            addresses: "addresses",
            default_shipping:"default_shipping",
            errors: 'errors',
            showForm: 'showForm',
            showBillingAddressForm: 'showBillingAddressForm',
        })
    },
    created(){
        this.state = document.getElementById('state_id');
    },
    methods:{
        ...mapActions({
            createAddress:   "createAddress",
            updateAddresses:   "updateAddresses",
            updateLocations: "updateLocations",
            deleteAddress:   "deleteAddress",
            getAddresses: "getAddresses",
            validateForm: 'validateForm',
            clearErrors: 'clearErrors',
            checkInput: 'checkInput'
        }),
        getState: function(evt) {
            let value = typeof evt.target !== 'undefined' ? evt.target.value : evt;
            let input = document.querySelectorAll('.required');
            this.clearErrors({  context:this, input:input })
            let state = []
            this.locations.forEach(element => {
                if (value == element.id) {
                   state.push(element.states)  
                }
            });
            this.states = state[0]
        },
        getShipping: function(e) {
            let value = e.target.value;
            let shipping = this.shipping[value]
            this.$store.commit('setDefaultShipping',shipping)
            let input = document.querySelectorAll('.ship-required');
            this.clearErrors({  context:this, input:input })
        },
        formatError(error){
            return Array.isArray(error) ? error[0] : error
        },
        removeError(e){
            let input = document.querySelectorAll('.ship-required');
            if (e.target.name == 'country_id'){
                this.form.state = ''
                this.states = this.country_states[e.target.value]
            }
            if (typeof input !== 'undefined'){
                this.clearErrors({  context:this, input:input })
            }
        },
        vInput(e){
            let input = document.querySelectorAll('.ship-required');
            if (typeof input !== 'undefined') {
                this.checkInput({ context: this, email: this.form.email, input:e })
            }
        },  
        submit: function(){
            let input = document.querySelectorAll('.ship-required');
            this.validateForm({ context:this, input:input })
            this.errorsBag = this.errors
            if ( Object.keys(this.errorsBag).length !== 0 ){
                this.error = "Please check for errors"
                return false;
            }
            this.submiting = true
            if(this.edit){
                this.updateAddresses({
                    form:this.form,
                    id: this.address_id,
                    context: this
                }).then((response) => {
                    this.$store.commit('setShowForm' , false)                 
                    if(response.data.meta.billing_address){
                        this.$store.commit('setShowBillingAddressForm', false)
                        this.submiting = false  
                        return;
                    }

                    if(!response.data.meta.billing_address){
                        this.$store.commit('setShowBillingAddressForm', true)
                        this.submiting = false  
                        return;
                    }
                })
                return
            } else {
                this.createAddress({ form: this.form, context: this })
            }   
        },
        addNewAddress: function(){
            this.edit =false
            this.$store.commit('setShowForm' , this.showForm = !this.showForm)
        },
        cancelForm: function(){
            this.$store.commit('setShowForm' , this.showForm = !this.showForm)
            this.edit = false
        },
        editAddress: function(index){
            let address = this.addresses[index]
            this.form.first_name = address.first_name
            this.form.last_name  =  address.last_name
            this.form.address  = address.address
            this.form.city = address.city
            this.form.postal_code = address.postcode
            this.form.country_id = address.country_id
            this.form.sameAsBilling = address.is_billing === 1 ? true:false;
            let state = []
            let ship_prices = []
            this.getState(address.country_id)
            this.form.state_id = address.state_id
            this.edit = true
            this.address_id = address.id
            this.$store.commit('setShowForm' , true)
        },
        removeAddress: function(e,id){
            this.submiting = true  
            this.delete_id =  id
            this.deleteAddress({
               id:id,
               context: this
            }).then(() => {
                this.submiting = false  
            })
        },
        makeDefault: function(evt,id){
            this.id =  id
            axios.get('/api/addresses/active/'+ id).then((response) => {
                this.$store.dispatch('setADl',response)
                this.submiting = false
            }).catch(() =>{})
        }
        
    }
}

</script>

<style scoped>

.pointer {cursor: pointer;}
.form-check-input {
    position: absolute;
    margin-top: 0.5rem;
    margin-left: -1.25rem;
}

</style>
