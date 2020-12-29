

searchVisible = 0;
transparent = true;

function resetFile (input) { 
    var $el = $('input#'+input).wrap('<form id="clearfiles"></form>');
    document.getElementById("clearfiles").reset();
    $('input#'+input).unwrap();     
}   

$(document).ready(function(){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            /*  Activate the tooltips      */
            $('[rel="tooltip"]').tooltip();
            //refactor later ,giving me issues
            $.validator.addMethod("oneormorecheckedstyles", function(value, element) {
               return $('.input_styles:checked').length> 0;
            }, "Atleast 1 must be selected");
            
            $.validator.addMethod("checkTag", function(value, element) {
                return document.querySelectorAll('span.tag').length>0;
             }, "Enter your tags,Please seprate by commas");
             
            $.validator.addMethod("oneormorecheckedmediums", function(value, element) {
               return $('.input_mediums:checked').length> 0;
            }, "Atleast 1 must be selected");

            $.validator.addMethod("oneormorecheckedmaterials", function(value, element) {
               return $('.input_materials:checked').length> 0;
            }, "Atleast 1 must be selected");

            // Code for the Validator
            var $validator = $('.wizard-card form ').validate({
        		  rules: {
        		    title: {
        		      required: true,
        		      minlength: 3
                    },
                    
                    main_image: {
                     required: true,
                     // accept: "image/*",
                     // extension: "jpeg|png|jpg|gif"
                    },

                    packaging:"required",
        		    description: {
        		      required: true,
        		      minlength: 15
        		    },
                    address_id: {
                      required: true,

                    },
        		    subject: {
        		      required: true,
        		    },
                    category: {
                      required: true,
                    },
                    tag: {
                      required: true,
                    },                      
                    'nstyles[]': {required:true},
                    'nmediums[]': {
                      required: true,
                    },
                    'nmaterials[]': {
                      required: true,
                    },
                    height :{
                        required: true,
                        maxlength: 10,
                        number: true  
                    },
                    width: {
                        required: true,
                        maxlength: 10,
                        number: true
                    },
                    inches: {
                        required: true,
                        maxlength: 10,
                        number: true
                    },
                    weight: {
                        required: true,
                        maxlength: 10,
                        number: true
                    },
                    price: {
                        required: true,
                        maxlength: 10,
                        number: true
                    },
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    postcode:{
                        required: true,

                    },
                     
               
                },
                submitHandler: function(form) {
                   $(".text-danger").remove();
                    form.submit();
                },
            });
            

           


            // Wizard Initialization
          	$('.wizard-card').bootstrapWizard({
                'tabClass': 'nav nav-pills',
                'nextSelector': '.btn-next',
                'previousSelector': '.btn-previous',

                onNext: function(tab, navigation, index) {
                	var $valid = $('.wizard-card form').valid();
                	if(!$valid) {
                		$validator.focusInvalid();
                		return false;
                	}
                },

                onInit : function(tab, navigation, index){
                  //check number of tabs and fill the entire row
                  var $total = navigation.find('li').length;
                  $width = 100/$total;
                  navigation.find('li').css('width',$width + '%');

                },

                onTabClick : function(tab, navigation, index){

                    var $valid = $('.wizard-card form').valid();

                    if(!$valid){
                        return false;
                    } else{
                        return true;
                    }

                },

                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;

                    var $wizard = navigation.closest('.wizard-card');

                    // If it's the last tab then hide the last button and show the finish instead
                    if($current >= $total) {
                        $($wizard).find('.btn-next').hide();
                        $($wizard).find('.btn-finish').show();
                    } else {
                        $($wizard).find('.btn-next').show();
                        $($wizard).find('.btn-finish').hide();
                    }

                    //update progress
                    var move_distance = 100 / $total;
                    move_distance = move_distance * (index) + move_distance / 2;

                    $wizard.find($('.progress-bar')).css({width: move_distance + '%'});
                    //e.relatedTarget // previous tab

                    $wizard.find($('.wizard-card .nav-pills li.active a .icon-circle')).addClass('checked');

                }
	            });




                // Prepare the preview for profile picture
                $("#wizard-picture").change(function(){
                    readURL(this);
                });

                $('[data-toggle="wizard-radio"]').click(function(){
                    wizard = $(this).closest('.wizard-card');
                    wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                    $(this).addClass('active');
                    $(wizard).find('[type="radio"]').removeAttr('checked');
                    $(this).find('[type="radio"]').attr('checked','true');
                });

                $('[data-toggle="wizard-checkbox"]').click(function(){
                    if( $(this).hasClass('active')){
                        $(this).removeClass('active');
                        $(this).find('[type="checkbox"]').removeAttr('checked');
                    } else {
                        $(this).addClass('active');
                        $(this).find('[type="checkbox"]').attr('checked','true');
                    }
                });

                $('.set-full-height').css('height', 'auto');


                var activateFileExplorer = $("a.activate-file-m");
                var activateAdditionalFile = $("a.activate-file-a");
                var main_file = $("input#main_image");
                var add_file = $("input#additional_images");
                var deleteImage = $("a.delete_image");

                deleteImage.on('click',function(e){
                    e.preventDefault();
                    var self = $(this);
                    var image_path = self.parent().parent().find("input#stored_image");
                    var d = {'image_path':image_path.val()};
                    $.ajax({
                        url: '/admin/delete/image',
                        type: 'POST',
                        data: d,
                        beforeSend: function(){
                           self.parent().parent().find('img#stored_image').remove();
                           self.parent().append('<img id="image_loader" src="/images/ajax-loader.gif" class="upload_spinner">'); 
                        },
                        success: function (response) {
                           self.parent().append('<img id="image_loader" src="/images/ajax-loader.gif" class="upload_spinner">').addClass('hide'); 
                           self.parent().parent().find('div.upload-text').removeClass('hide');
                           image_path.val('');
                           resetFile('main_image');
                        },
                        
                    });

                });

                activateFileExplorer.on('click',function(e){
                    e.preventDefault();
                    var self = $(this);
                    self.parent().parent().find("input#main_image").click();
                });
                activateAdditionalFile.on('click',function(e){
                    e.preventDefault();
                    var self = $(this);
                    self.parent().parent().find("input#additional_images").click();
                });

                main_file.on('change',function(e){
                    e.preventDefault()
                    var formData = new FormData();
                    var ins = this.files;
                    var self =$(this);
                    for (var x = 0; x < ins.length; x++) {
                        if (!ins[x].type.match('image.*')) {
                            //showError ("error-zone2",300,"The File Is Not Supported");
                            resetFile('files');
                            proceed = false;
                            return false;
                        }    
                        if ( ins[x].size > 10000000 ) {      
                            //showError ("error-zone2",300,"The file is Too Big");
                             //clear the file input of any unwanted file
                            resetFile('files'); 
                            proceed = false;
                            return;
                        }
                        formData.append('file', ins[x]);
                    }
                        
                    $.ajax({
                        url: '/admin/upload/image',
                        type: 'POST',
                        data: formData,
                        beforeSend: function(){
                           $(document).find("label#main_image-error").remove();
                           self.parent().find('div.upload-text').addClass('hide');
                           self.parent().find('img#stored_image').remove();
                           self.parent().append('<img id="image_loader" src="/assets/images/ajax-loader.gif" class="upload_spinner">');
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                           data = $.trim(data.path);
                           self.parent().find('img.upload_spinner').remove();
                           self.parent().append('<img id="stored_image"  class="img-thumnail" src="/'+data+'" alt="">'); 
                           self.parent().find('div.remove_image').removeClass('hide'); 
                           self.parent().find("input#stored_image").val(data); 
                        },
                        
                    });
                    //return false;
                });

                add_file.on('change',function(e){
                   // e.preventDefault()
                    var formData = new FormData();
                    var ins = this.files;
                    var self =$(this);
                    for (var x = 0; x < ins.length; x++) {
                        if (!ins[x].type.match('image.*')) {
                            showError ("error-zone2",300,"The File Is Not Supported");
                            resetFile('files');
                            proceed = false;
                            return false;
                        }    
                        if ( ins[x].size > 10000000 ) {      
                            showError ("error-zone2",300,"The file is Too Big");
                             //clear the file input of any unwanted file
                            resetFile('files'); 
                            proceed = false;
                            return;
                        
                        }
                        formData.append('files', ins[x]);
                    }
                       
                    //self.parent().append('<img id="uploadloaded_image" src="/images/ajax-loader.gif" alt="">');
                    $.ajax({
                        url: '/admin/upload/additional/images',
                        type: 'POST',
                        data: formData,
                        beforeSend: function(){
                           self.parent().find('div.upload-text').addClass('hide');
                           self.parent().find('img#stored_image').remove();
                           self.parent().append('<img id="image_loader" src="/assets/images/ajax-loader.gif" class="upload_spinner">');

                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                           data = $.trim(data.path);
                           self.parent().find('img.upload_spinner').remove();
                           self.parent().append('<img id="stored_image"  class="img-thumnail" src="/'+data+'" alt="">'); 
                           self.parent().find('div.remove_image').removeClass('hide'); 
                           self.parent().find("input#stored_image").val(data); 
                        },
                        
                    });
                    //return false;
                }); 


                $(document).on('click','.use_address',function(e){
                    e.preventDefault();
                    var self = $(this);
                    var id   = self.children('input').data('id');
                    self.parentsUntil('table').find('input#address_id').val(id);
                    $('.use_address').removeClass('active');
                    self.addClass('active');
                });

                // $("form#art-modal-address-form").submit(function(e){
                // });

        });

        $(document).on('click','button#enter-new-address',function(){
               $("form#modal-address-form").attr('action','/address/create');
        });

        $(document).on('click',"a.art-delete-address",function(e){
   
            e.preventDefault();

            $('.alert, .text-danger').remove();

            var self = $(this);

            var id = self.data('id'),data={'id': id,'art_address': 1};

            $.ajax({
                url: '/address/delete/'+id,
                data:data,
                type: 'post',
                beforeSend: function() {
                    //$('#add-new-address').button('loading');
                },
                complete: function() {
                    //$('#add-new-address').button('reset');
                },
                success: function(response) {
                    $("#stored_address").html('').append(response);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    if(xhr.responseText) { 
                        for (i in xhr.responseJSON) {     
                            $('#address-error').html('<div class="text-danger">' + xhr.responseJSON[i] + '</div>');
                        }    

                    }
                }
            });


       });
        $(document).on('click','button#art-enter-new-address',function(){
         $("form#modal-address-form").attr('action','/address/create');
       }); 

        $(document).on('click',"a.art-edit-address",function(e){
           
            e.preventDefault();

            var self = $(this);
            var parent = self.parent().parent();

            var firstname = parent.find('td#address-details').find('span#firstname').data('firstname');
            var lastname = parent.find('td#address-details').find('span#last_name').data('lastname');
            var address  = parent.find('td#address-details').find('span#address').data('address');
            var city    = parent.find('td#address-details').find('span#city').data('city');
            var postcode = parent.find('td#address-details').find('span#postcode').data('postcode');
            var country = parent.find('td#address-details').find('span#country').data('country');
            var state = parent.find('td#address-details').find('span#state').data('state');
            var id = self.data('id');

            $('form#art-modal-address-form input#first_name').val(firstname);
            $('form#art-modal-address-form input#last_name').val(lastname);
            $('form#art-modal-address-form input#address').val(address);
            $('form#art-modal-address-form input#city').val(city);
            $('form#art-modal-address-form input#postcode').val(postcode);
            $('form#art-modal-address-form input#state').val(state);
            $('form#art-modal-address-form input#country').val(country);
            $("form#art-modal-address-form option[value='"+country+"']").attr('selected','selected');
            $("form#art-modal-address-form input#address_id").val(id);

            $("form#art-modal-address-form").attr('action','/address/edit/'+id)
            $("#addressModal").modal('show');

        });

        $('#addressModal').on('hidden.bs.modal', function () {
            $('form#art-modal-address-form')[0].reset();
        })
        
        

        



         //Function to show image before upload

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
