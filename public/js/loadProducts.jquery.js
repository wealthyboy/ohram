
(function($,){

  $.fn.loadProducts = function(opt){
      var settings;

        settings = $.extend({
            'html':'jquery-html',
            'target':'jquery-target',
            'form':'jQuery-form',
            'filter_url':'jquery_filter_url',
            'form_data':'jquery-form-data',
            'load_more':'jquery_load_more',
            'load_more_url':'jquery_load_more_url',
            'loggedInStatus':'jquery_loggedinstatus',
            'no_of_products':'jquery-no-of-products',
            'total_no_of_products':'jquery_no_of_products',
            'form_sort_by':'jquery-sort-by-form-data',
            'overlay': 'jquery-overlay'
           
        },opt);
       
        contents = function (obj,clear_html) {
          // var body = $("html, body");
          // body.stop().animate({scrollTop:200}, 1000, 'swing', function() { });
          $(settings.overlay).addClass("d-none") 
          if(obj.empty){
            $(this.container.selector).append('<img class="no_product_found" src="/images/empty_product.svg">','<p class="text-center">No Result Found!!!</p>'); 
            $('span.show-items-count').text('');
        } 
        try {
           var json= JSON.parse(obj);
        } catch (exception) {
           var json = null;
        }
      
        if (json) {
           var url = json.next_page_url;
           var data = json.data;
          //  settings.total_no_of_products =json.total;
          //  showNoOfProducts(data,json);
        } else  { 
           var data =  obj.data;
            url = obj.next_page_url ;
          //  settings.total_no_of_products =obj.total;
          //  showNoOfProducts(data,obj);
        }

          if (obj.next_page_url){
            $('.load_more').removeClass('d-none').attr('href',obj.next_page_url);
          } else{
            $('.load_more').addClass('d-none');
          }

          displayHtml(data,clear_html);
        }

    
    //filter search
     

    
     showNoOfProducts = function(data,obj){
        if(data != undefined){
          $('.show-items-count').text('Showing items 1 to '+obj.to+' of ' + obj.total +  ' total'); 
        }      
     }

      displayHtml = function (data,clear_html=false){  
        let col  = null; 
        let html = ''; 
        for (var i in data ) {
              col = data[i].category_attributes >= 1 ? 'col-md-3' : 'col-md-4';
              name = typeof data[i].name != null  ? data[i].name :  data[i].product_name
              html  +='<div  class="col-6   '+ col +'">'
              html +='<div class="product-default inner-quickview inner-icon">'
              html +='<figure>'
              html +='<a href="'+ data[i].link +'">'
              html +='<img src="'+ data[i].image_to_show_m +'" alt="'+ data[i].name +'" /></a>'
              html +='<div class="btn-icon-group">'    
              html +='</div>'
              html +='</figure>'
              html +='<div class="product-details">'
              html +='<div class="">'
              if(data[i].product.colors.length){
                html +='<div  class="justify-content-start d-flex mb-1">'

                  for(c in data[i].product.colors){
                    html +='<div  style="border:1px solid #222; height: 12px; width: 12px; border-radius: 50%; background-color: '+ data[i].product.colors[c].color_code +';" class="mr-1"></div>'
                  }
                  html +='</div>'

              }
              if(data[i].brand_name){
                html +='<div  class="product-brand bold">'+ data[i].brand_name +'</div>'
              }
              
              html +='<div class="d-lg-flex d-xl-flex color--primary">'
              html +='<div class="text-left  mr-5"><a href="'+ data[i].link +'">'+ name +'</a></div>'
              html +='<div class="text-right">'
                if(data[i].default_discounted_price){
                  html +='<span class="old-price bold text-danger"> '+data[i].currency+''+data[i].converted_price +' </span>'
                  html +='<span class="product-price bold ">'+ data[i].currency+''+data[i].default_discounted_price +' </span>'
                }else{
                  html +='<span class="product-price bold ">'+ data[i].currency+''+data[i].converted_price +' </span>'
                }
              html +='</div></div></div></div></div> </div> </div>'
          }
          if (clear_html){
            $("#"+settings.target).html('').append(html);  
            return     
          } else {
            $('#load-products .col-6:last').after(html);return
          }

      }


      function filter(form,url) { 
        $(settings.overlay).removeClass("d-none") 
        $.ajax({
            url : url,
            type: 'get',
        }).done(function (json) {
            contents(json.products,true);
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    
      }
     
      
      loadMore = function (url,data=null) {

         $.ajax({
             url:url,
             data:data,
             type:'get',
             beforeSend : function( xhr ) {
             }
         }).done(function (json) {
            contents(json.products,false)          
            $(".spinner-grow-md").addClass('d-none')
        }).fail(function () {
             alert('Something went wrong.');
         });
       }

      buildUrl = function () {
        let sort_by = settings.form_sort_by.serializeArray().shift()
        const qs = [];

        if (sort_by.value !== ''){
          qs.push(sort_by.name +'='+sort_by.value)
        }
        settings.form.serializeArray().forEach(element => {
          qs.push(element.name +'='+element.value)
        });
        window.history.pushState({}, '', '?' + qs.join('&'));
      }

    
      $(document).ready(function() {

            settings.form.click(function(){
              buildUrl()
              filter(settings.form_data,window.location); 
            });

            $(document).on('click', ".load_more" , function(e){
               e.preventDefault();
               $(document).find(".spinner-grow-md").removeClass('d-none')
               var href = $(this).attr('href');
               window.history.pushState({}, '', href);
               loadMore(href,data=null);
            });

            settings.form_sort_by.change(function(){
              const url = new URL(window.location);
              let arr = settings.form_sort_by.serializeArray().shift()
              url.searchParams.set(arr.name, arr.value);
              window.history.pushState({}, '', url);
              filter(settings.form_sort_by,window.location); 
            })
           
      
         //})
       });

       
       return this;

  }//$.fn
 
})(jQuery);