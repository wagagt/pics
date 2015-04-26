$( document ).ready(function() {
 
    // ************ Modal : change info on modal, title, user, product_id.
    $('[data-toggle="modal"]').on('click',
        function(e) {

            var article = $(this);

            /* ***********  If click on Approve or Deny Button*/
            var typeModal = '';
            typeModal = (article.data("target") == "#modalApprove") ? "Approve" : "Deny";
            $('#modal'+typeModal+'-article-title').html(article.data("title"));
            $('#modal'+typeModal+'-article-user').html(article.data("user"));
            $('#modal'+typeModal+' input[name=product_id]').val(article.data("id"));
            
            /* ***********  If click on ' Ver mas información ' */

            if (article.data("target") == "#modalInfo"){
                //getFullData(article.data("id"));
                getFullData(article.data("id"));
            }
        });

function startSwiper() {
  // Start Swiper
  var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    slidesPerView: 4, // variable if want responsive! 
    paginationClickable: true,
  });
}

// ************ Modal : change info on modal, title, user, product_id.
    function getFullData(id) {
            $.ajax({
                    type: "GET",
                    url: '/product/'+id,
                    dataType:'json',
                    data: ({ product_id: id }),
                    success: function (result) {
                        
                        // Fill Product and User Info
                        $.each(result.product[0] , function(key, value){    // result.product[0] = product
                          switch(key){
                            case "picture":
                              html ="<img src='"+value+"''>" ;
                              value=html;
                            break;
                            case "user_active":
                            case "product_active":
                              html=(value)?'<i class="fa fa-check-circle"></i>' : '<i class="fa fa-times-circle"></i>' ;
                              value=html;
                            break;
                          }

                          if( $('#modalInfo-article-'+key).length ) {
                            $('#modalInfo-article-'+key).html(value);
                          }

                        });

                        // Fill Product Logs
                        $("#logTable > tbody").html('');
                        $.each(result.product_log , function(key, value){    // result.product[2] = product_logs
                          $("#logTable > tbody").append("<tr>"+
                                                        "<td>"+value['product_log_created_at']+"</td>"+
                                                        "<td>"+value['action']+"</td>"+
                                                        "<td>"+value['reason_name']+"</td>"+
                                                        "<td>"+value['log_comment']+"</td>"+
                                                        "</tr>");
                        });

                        // Swiper Image Slider
                        $(".swiper-wrapper").html('');
                        $.each(result.images , function(k, v){    // result.product[2] = product_logs
                          $(".swiper-wrapper").append('<div class="swiper-slide"><img width="300" height="200" src="'+v['filename']+'"></div>');
                        });

                        //product_active
                        setTimeout( function() {
                          startSwiper();
                        }, 250);

                        return true;
                    },
                    error: function (xhr, status) {
                      switch (status) {
                           case 404:
                           alert('File not found');
                           break;
                           case 500:
                           alert('Server error');
                           break;
                           case 0:
                           alert('Request aborted');
                           break;
                           default:
                           alert('Unknown error ' + status);
                        } 
                    }
           });

        };

    // ************ Button Approve: Format Approve-form data to ajax function
    $('#btn-approve').on('click',
        function (event){
            product_id  =   $('#modalApprove input[name=product_id]').val();
            comment     =   $('#modalApprove    [name=comment]').val();
            formData    = {   
                product_id: product_id,
                comment: comment,
                status : 2,
            reason_id : 1, // use Approve default id
        };

        $.ajax({
                type: 'POST',
                url: '/product',
                data: formData,
                success: function (msg) {
                    $('#result-'+product_id).attr('class','result approved');
                    $('#modalApprove').modal('toggle');
                    return true;
                },
                error: function (xhr, status) {
                  switch (status) {
                       case 404:
                       alert('File not found');
                       break;
                       case 500:
                       alert('Server error');
                       break;
                       case 0:
                       alert('Request aborted');
                       break;
                       default:
                       alert('Unknown error ' + status);
                    } 
                }
       });
    });

    // ************ ButtonDeny:  Format Deny-form data to ajax function
    $("#btn-deny").on('click',
        function (event){
            product_id  =   $('#modalDeny input[name=product_id]').val();
            comment     =   $('#modalDeny textarea[name=comment]').val();
            reason_id   =   $('#modalDeny select[name=reason]').val();

        // validate data
        if (comment.length < 15 || reason_id === "0") {
            $('#validate-message-error').attr('class','alert alert-danger');
            return false;
        }

        // set data to deny product
        formData    = {   
            product_id: product_id,
            comment: comment,
            status : 0,
            reason_id : reason_id
        };

        $.ajax({
            type: 'POST',
            url: '/product',
            data: formData,
            success: function (msg) {
                $('#validate-message-error').attr('class','alert alert-danger hide');
                $('#modalDeny').modal('toggle');
                $('#result-'+product_id).attr('class','result denied');
                return true;
            },
            error: function (xhr, status) {
                switch (status) {
                   case 404:
                   alert('File not found');
                   break;
                   case 500:
                   alert('Server error');
                   break;
                   case 0:
                   alert('Request aborted');
                   break;
                   default:
                   alert('Unknown error ' + status);
               } 
           }
       });
    });

    // ************ Modal Deny: dropbox change text
    $('#modalDeny select[name=reason]').on('change', 
        function(event){
            var select = $(this);
            text =  select.find('option:selected').data("text");
            $('#modalDeny textarea[name=comment]').val(text);
            if ($('#modalDeny input[name=product_id]').val() != "0" ){
                $('#validate-message-error').attr('class','alert alert-danger hide');
            }
        });

    // ************ Modal Deny: Clear error messages on close
    $('#modalDeny').on('hidden.bs.modal', function () {
    // clean error messages
        $('#validate-message-error').attr('class','alert alert-danger hide');
    })

    // Function to send Form.
    function sendForm(formData){
        readytoajax=0;
    };
});

// ************ JQuery plugin:  caption effect on over.
$(window).load(function(){
    // ************ JQuery plugin:  Activate all hcaptions
    $('.hcaption').hcaptions({
        effect: "slide",
        direction: "top",
        speed: "300"
    });


// ************ JQuery plugin:  Set Approve or Deny Overlap div
    var panelType = $('#panel_type').val();
        $('div[id^="result"]').each(function () {
            $(this).addClass(panelType);
        });

    

});
