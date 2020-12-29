<template>
<div>
<div id="register-modal" class="modal fade bg--gray" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content ">
                <div class="modal-header">
               <div class="modal-title"><img width="100" height="100" :src="logo"  /></div>
                 <span class="bold text-large "><button type="button" class="close" id="login_modal" data-dismiss="modal"><i class="fas fa-times"></i></button></span>
                </div>
                <div class="modal-body">
                    <div class="login-box-body">
                        <div class="text-center"> 
                            <h2>Register</h2>
                            <!-- <a href="/login/facebook" class="btn btn-facebook btn-round">
                                <i class="fab fa-facebook-f"></i> Sign in with Facebook 
                            </a> -->
                        </div>
                        <form method="POST" @submit.prevent="submit" class="login_form" action="#">
                             
                            <!--<p class="large">Great to have you back!</p>-->
                            <div class="row  billing-fields__field-wrapper">
                                <span  v-if="errors.general">
                                    <strong  class="text-danger">{{ formatError(errors.general) }}</strong>
                                </span>
                                <p class="form-field-wrapper p-2 col-6">
                                    <label for="first_name">First name</label>
                                    <input 
                                        v-model="form.first_name"  
                                        id="first_name" type="text" 
                                        class="form-control  required"
                                        name="first_name"
                                        @input="removeError($event)"  
                                        @blur="vInput($event)"  
                                        :class="{'has-danger': errors.first_name}"
                                        value="">
                                        <span  v-if="errors.first_name">
                                            <strong  class="text-danger">{{ formatError(errors.first_name) }}</strong>
                                        </span>
                                </p>
                                <p class="form-field-wrapper  p-2 col-6">
                                    <label for="username">Last name</label>
                                    <input 
                                        v-model="form.last_name"  
                                        id="last_name" type="text" 
                                        class="form-control required" 
                                        name="last_name" 
                                        @input="removeError($event)"  
                                        @blur="vInput($event)"  
                                        :class="{'has-danger': errors.last_name}"
                                        value="" >
                                        <span  v-if="errors.last_name">
                                            <strong  class="text-danger">{{ formatError(errors.last_name) }}</strong>
                                        </span>
                                </p>

                                <div class="clearfix"></div>

                                <p class="form-field-wrapper p-2 col-6">
                                    <label for="username">Email address</label>
                                    <input 
                                            v-model="form.email" 
                                            id="email" 
                                            type="email"
                                            class="form-control required" 
                                            name="email" 
                                            @input="removeError($event)"  
                                            @blur="vInput($event)"  
                                            :class="{'has-danger': errors.email}"
                                            value="">
                                            <span  v-if="errors.email">
                                                <strong  class="text-danger">{{ formatError(errors.email) }}</strong>
                                            </span>
                                </p>
                                <p class="form-field-wrapper  p-2  col-6">
                                    <label for="username">Phone number</label>
                                    <input 
                                            v-model="form.phone_number"  
                                            id="phone_number" 
                                            type="text" 
                                            class="form-control required" 
                                            name="phone_number" 
                                            @input="removeError($event)"  
                                            @blur="vInput($event)"  
                                            :class="{'has-danger': errors.phone_number}"
                                            value="" >
                                            <span  v-if="errors.phone_number">
                                                <strong  class="text-danger">{{ formatError(errors.phone_number) }}</strong>
                                            </span>
                                </p>
                                <div class="clearfix"></div>

                                <p class="form-field-wrapper p-2 col-6">
                                    <label for="password">Password</label>
                                    <input 
                                             v-model="form.password"  
                                            id="password" 
                                            type="password" 
                                            class="form-control required" 
                                            @input="removeError($event)"  
                                            @blur="vInput($event)"  
                                            :class="{'has-danger': errors.password}"
                                            value="" >
                                            <span  v-if="errors.password">
                                                <strong  class="text-danger">{{ formatError(errors.password) }}</strong>
                                            </span>
                                </p>

                                <p class="form-field-wrapper p-2 col-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input 
                                            v-model="form.password_confirmation"  
                                            id="password_confirmation" 
                                            type="password"
                                            class="form-control required"
                                            name="password_confirmation" 
                                            @input="removeError($event)"  
                                            @blur="vInput($event)"  
                                            :class="{'has-danger': errors.password_confirmation}"
                                            value="" >
                                            <span  v-if="errors.password_confirmation">
                                                <strong  class="text-danger">{{ formatError(errors.password_confirmation) }}</strong>
                                            </span>
                                </p>

                                <div class="clearfix"></div>
                                <p class="form-field-wrapper col-6 lost_password">
                                    Already have an account? <a data-toggle="modal" data-dismiss="modal"  class="color--primary bold" data-target="#login-modal" href="#"> Login </a>      
                                </p>
                                <p class="form-field-wrapper p-2 col-6 text-right">
                                    <button type="submit"  id="login_form_button" data-loading="Loading" class="btn bold btn--lg btn--primary" name="login" value="Log in">
                                        <span  v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Sign up
                                    </button>
                                </p>
                               
                            </div>
                        </form>
                    </div>         
                </div> 
                <div class="modal-footer">
                </div>     
        </div>
    </div><!--modal-content-->

</div><!--modal-dialog-->
</div>

<!--loginModal--> 
</template>
<script>
import { mapGetters, mapActions } from 'vuex'


export default {
    data(){
        return {
            loading:false,
            errorsBag:[],
            form: {
                email: '',
                password: '', 
                first_name: null,
                last_name: null,
                password_confirmation: null,
                phone_number: null
            }
        }
    },
    computed:{
        ...mapGetters({
            errors: 'errors'
        }),
        logo(){
            return '/images/logo/'+this.$root.settings.store_logo
        }
    },
    mounted(){
      // this.$store.commit('setFormErrors', null)
      console.log(true)
    },
    methods:{
        ...mapActions({
            register:'register',
            validateForm: 'validateForm',
            clearErrors: 'clearErrors',
            checkInput: 'checkInput'
        }),
        formatError(error){
            return Array.isArray(error) ? error[0] : error
        },
        removeError(e){
            let input = document.querySelectorAll('.required');
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
            if ( Object.keys(this.errors).length !== 0 ){
                this.error = "Please check for errors"
                return false;
            }
            this.loading = true
            this.register({
                context:this,
            })
        }
    }
    
}
</script>