<template>
    <div class="">

            <div  v-if="showBillingAddressForm" id="stored_address"  class="billing-fields__field-wrapper ">
                <form  @submit.prevent="submit" method="POST" class=""> 
                    <div class="row reduce-gutters" id="add-new-address-form" data-action="/address/create">
                        <p class="form-group reduce-gutters col-lg-6">
                            <label for="first_name">First Name</label>
                            <input  :class="{'has-danger': errors.first_name}"  id="firstname" 
                            v-model="form.first_name" 
                            @input="removeError($event)"  
                            @blur="vInput($event)" 
                            type="text" class="form-control required" 
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
                                class="form-control required"
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
                                type="text" class="form-control required" 
                                name="address" 
                            >
                            <span   v-if="errors.address">
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
                                class="form-control required" 
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
                            <select @change="getState"  v-model="form.country_id"  name="country_id" id="shipping_country"   class="form-control required" autocomplete="country" tabindex="-1" aria-hidden="true">
                                <option value="" selected="selected">Select a country…</option>
                                <option :value="country.id" v-for="country in locations" :key="country.id">{{ country.name }}</option>
                            </select>
                            <span  class="" role="" v-if="errors.country_id">
                                <strong  class="text-capitalize text-danger"> Please select your country</strong>
                            </span>
                        </p>
                        <p class="form-group reduce-gutters col-sm-6">
                            <label for="state_id" class="">State/Region &nbsp;<abbr class="required " title="required">*</abbr></label>
                            <select   v-model="form.state_id"  name="state_id" id="state_id" class="form-control required">
                                <option value="" >Select a state</option>
                                <option :value="state.id" v-for="(state,index) in states" :key="state.id" :selected="[index ? 'selected': '']">{{ state.name }}</option>
                            </select>
                            <span  class="text-danger" role="" v-if="errors.state_id">
                                <strong   class="text-danger"> Please select your state</strong>
                            </span>
                        </p>

                        <p class="form-group reduce-gutters text-right col-lg-12 ">
                            <button v-if="!billing_address" type="submit" class="btn btn-sm btn-primary" name="checkout_place_order" id="place_order" value="Place order" data-value="Place Order">
                                <span  v-if="submiting" class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                                Save & Continue
                            </button>
                            <p v-if="billing_address" class="form-group col-6 col-md-6 text-left">
                                <button type="submit" class="btn btn-sm btn-primary"  value="Submit">
                                    <span  v-if="submiting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Save 
                                </button>
                            </p>
                            <p v-if="billing_address" class="form-group col-6  col-md-6 text-right">
                                <a @click.prevent="cancelForm"  class="cancel-form bold color--primary pull-right" href="#">Cancel</a>
                            </p>

                        </p>
                    </div>
                </form>
            </div>

            <div v-if="null !== billing_address && !showBillingAddressForm"  class="address_details mt-1">
                <ul class="mb-1">
                    <li>
                        <div class="shipping-info border border-gray pr-3 pt-2 pl-3">
                            <div class="shipping-address-info">
                                <div  id="">{{ billing_address.first_name }} {{ billing_address.last_name }}  </div>
                                <div> {{ billing_address.address }} {{ billing_address.address2}} </div>
                                <div> {{ billing_address.city }}, {{ billing_address.postcode }}</div>
                                <div> {{ billing_address.state}}, {{ billing_address.country }} </div>
                                <div v-if="!billing_address.same_as_billing" class="mt-2 mb-2">
                                    <a  @click.prevent="editAddress(billing_address.id)" data-placement="left"  href="#" class="ml-0 mr-4 color--primary bg--gray l-f1  p-3 border "> 
                                        <i class="fa fa-edit"></i> Edit
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
                is_billing: true
            }
        }
    },
    computed:{
        ...mapGetters({
            billing_address: "billing_address",
            errors: 'errors',
            locations: "locations",
            showBillingAddressForm: 'showBillingAddressForm',
            default_address:"default_address",
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
            //loop through all countries and pluck out their states
            this.locations.forEach(element => {
                if (value == element.id) {
                   state.push(element.states)  
                }
            });
            this.states = state[0]
        },
       
        formatError(error){
            return Array.isArray(error) ? error[0] : error
        },
        removeError(e){
            let input = document.querySelectorAll('.required');
            if (e.target.name == 'country_id'){
                this.form.state = ''
                this.states = this.country_states[e.target.value]
            }
            if (typeof input !== 'undefined'){
                this.clearErrors({  context:this, input:input })
            }
        },
        vInput(e){
            let input = document.querySelectorAll('.required');
            if (typeof input !== 'undefined') {
                this.checkInput({ context: this, email: this.form.email, input:e })
            }
        },  
        submit: function(){
            let input = document.querySelectorAll('.required');
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
                }).then((response) =>{
                    this.showBillingAddressForm =false
                    this.submiting = false  
                })
                return
            } else {
                this.createAddress({ form: this.form, context: this })
            }   
        },
       
        cancelForm: function(){
            this.$store.commit('setShowBillingAddressForm', false)
            this.edit = false
        },
      
        editAddress: function(index){
            let address = this.billing_address
            this.form.first_name = address.first_name
            this.form.last_name = address.last_name
            this.form.address = address.address
            this.form.city = address.city
            this.form.postal_code = address.postcode
            this.form.country_id = address.country_id
            let state = []
            let ship_prices = []
            this.getState(address.country_id)
            this.form.state_id = address.state_id
            this.edit = true
            this.address_id = address.id
            this.$store.commit('setShowBillingAddressForm', true)
        },
        
    }
}

</script>

