
searchVisible = 0;
transparent = true;

function resetFile (input) { 
    var $el = $('input#'+input).wrap('<form id="clearfiles"></form>');
    document.getElementById("clearfiles").reset();
    $('input#'+input).unwrap();     
}   

$().ready(function(){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

var row = 0;
s = {
    checkFullPageBackgroundImage: function(){
        $page = $('.full-page');
        image_src = $page.data('image');
        if(image_src !== undefined){
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
            $page.append(image_container);
        }
    },
    initFormExtendedDatetimepickers: function(){
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }

         });

         $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
         });

         $('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
         });
    },

    initMaterialWizard: function(){
        // Code for the Validator
        var $validator = $('.wizard-card form').validate({
    		rules: {
    		    product_imag: {
                    required: true,
                },
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
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('.wizard-card');
                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                $('.wizard-card .wizard-navigation').append($moving_div);
                refreshAnimation($wizard, index);
                $('.moving-tab').css('transition','transform 0s');
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

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function(){
                    $('.moving-tab').text(button_text);
                }, 150);

                var checkbox = $('.footer-checkbox');

                if( !index == 0 ){
                    $(checkbox).css({
                        'opacity':'0',
                        'visibility':'hidden',
                        'position':'absolute'
                    });
                } else {
                    $(checkbox).css({
                        'opacity':'1',
                        'visibility':'visible'
                    });
                }

                refreshAnimation($wizard, index);
            },
          });

          function refreshAnimation($wizard, index){
            $total = $wizard.find('.nav li').length;
            $li_width = 100/$total;

            total_steps = $wizard.find('.nav li').length;
            move_distance = $wizard.width() / total_steps;
            index_temp = index;
            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;

            if(mobile_device){
                move_distance = $wizard.width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $wizard.find('.nav li').css('width',$li_width + '%');

            step_width = move_distance;
            move_distance = move_distance * index_temp;

            $current = index + 1;

            if($current == 1 || (mobile_device == true && (index % 2 == 0) )){
                move_distance -= 8;
            } else if($current == total_steps || (mobile_device == true && (index % 2 == 1))){
                move_distance += 8;
            }

            if(mobile_device){
                vertical_level = parseInt(index / 2);
                vertical_level = vertical_level * 38;
            }

            $wizard.find('.moving-tab').css('width', step_width);
            $('.moving-tab').css({
                'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
            });
        }
          
	}

}


var Img = {


    loadImage: function(){
    },
    deleteImage: function(opts ={}){
        let fileName,activator,parent;
        $(document).on('click',opts.activator,function(e){
            e.preventDefault()
            activator = $(this);
            parent = activator.parents('.uploadloaded_image');
            opts.inputFile
            var $el =  opts.inputFile.wrap('<form id="clearfiles"></form>');
            document.getElementById("clearfiles").reset();
            opts.inputFile.unwrap();

            let params = { 
                            'image_url': parent.find("input.stored_image").val(),
                            'image_id': activator.data('id'),
                            'delete': true
                        }
            $.ajax({
                url: opts.url,
                type: 'POST',
                data: params,
                beforeSend: function(){
                    $(document).find("label#main_image-error").remove();
                    parent.find('div.upload-text').addClass('hide');
                    parent.find('img#stored_image').addClass('hide');
                    parent.find('div.remove_image').addClass('hide'); 
                    parent.append('<img id="image_loader" src="/images/loaders/ajax-loader.gif" class="upload_spinner">');
                },
                success: function (data) {
                    parent.find('img.upload_spinner').remove();
                    parent.find('div.upload-text').removeClass('hide');
                    parent.find('img#stored_image').remove();
                    parent.find("input.stored_image").val(''); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    parent.find('img.upload_spinner').remove();
                    //parent.find('div.upload-text').removeClass('hide');
                    parent.find('img#stored_image').removeClass('hide');
                    parent.find('div.remove_image').removeClass('hide'); 
                } 
                
            });
        })

    },
    initUploadImage: function(opts ={}){
        let fileName,activator,parent;

        if ( opts.inputFile !== null) {

            opts.inputFile.on('change',function(e){
                parent  = $(this).parents('.uploadloaded_image');
                var image_url =parent.find("input.file_upload_input").val();
                var image_id = parent.find("input.stored_image_id").val();
                //Disable the submit button 
                var formData = new FormData();
                var ins  = this.files;
                var self = $(this);
                for (var x = 0; x < ins.length; x++) {
                    if (!ins[x].type.match('image.*') ) {
                        resetFile(opts.inputfile); 
                        proceed = false;
                        return false;
                    }    
                    if ( ins[x].size > 10000000 ) {      
                        resetFile(inputfile); 
                        proceed = false;
                        return;
                    }
                    formData.append('file', ins[x]);
                    formData.append('file_name',fileName);
                    formData.append('image_url',image_url)
                    formData.append('image_id',image_id);
                }

                $.ajax({
                    url: opts.url,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(xhr){
                       // opts.inputFile.attr('disabled',true)
                        //$(opts.activator).addClass('uploading')
                        $(document).find("label#main_image-error").remove();
                        parent.find('div.upload-text').addClass('hide');
                        parent.find('img#stored_image').remove();
                        parent.find('div.remove_image').addClass('hide'); 
                        parent.append('<img id="image_loader" src="/images/loaders/ajax-loader.gif" class="upload_spinner">');
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    complete: function(){
                        //opts.inputFile.attr('disabled',false)
                       // $(opts.activator).removeClass('uploading')
                    },
                    success: function (data) {
                        let path = $.trim(data.path);
                        console.log(data)
                        parent.find('img.upload_spinner').remove();
                        parent.append('<img id="stored_image"  class="img-thumnail" src="'+path+'" alt="">'); 
                        parent.find('div.remove_image').removeClass('hide'); 
                        parent.find("input.stored_image").val(path); 
                        parent.find("a.stored_image").val(path); 

                        localStorage.setItem('first_image',path)
                        let image = localStorage.getItem('first_image')
                        parent.find("input.stored_image").val(path); 
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        parent.find('img.upload_spinner').remove();
                        parent.find('div.upload-text').removeClass('hide');
                    } 
                    
                });
                //return false;
            });
        }
 
    },
	
}


