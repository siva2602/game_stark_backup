(function($) {
    'use strict';
 var allVals = []; 
 
      //delete app 
    $("body").on("click",".remove-app",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/apps/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });
    
    //delete quiz cat
    $("body").on("click",".remove-quizcat",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/quiz-cat/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });
    
    //remove pay transaction
    $("body").on("click",".remove-tranns",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/pay-transaction/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });

    // delete user
    $("body").on("click",".remove-user",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/users/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });

    // delete payment request
    $("body").on("click",".remove-paymentreq",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/request/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });

    // delete web
    $("body").on("click",".remove-web",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/websites/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });

     // delete web
     $("body").on("click",".remove-quiz",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/quiz/delete/'+id,
                        type: "get",
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                      });
                } else {
                    swal("The item is not deleted!");
                }
            });
    });


    // delete video
    $("body").on("click",".remove-video",function(){
    var current_object = $(this);
    var id = current_object.attr('data-id');
    swal({
            title: "Are you sure?",
            text: "Do you really want to delete this item?",
            icon: "warning",
            buttons: ["Cancel", "Delete Now"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/videos/delete/'+id,
                    type: "get",
                    success: function (data) {
                        if(data==1){
                        location.reload();
                        swal({
                            title: "Deleted",
                            text: "item has been deleted !",
                            icon: "success",
                        });
                    }
                    },
                    error: console.log("it did not work"),
                    });
            } else {
                swal("The item is not deleted!");
            }
        });
    });

    // delete redeem
    $("body").on("click",".remove-redeem",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/payment-options/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                } else {
                    swal("The item is not deleted!");
                }
            });
        });
        
   // delete redeem cat
    $("body").on("click",".remove-redeemcat",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'reward-cat/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                } else {
                    swal("The item is not deleted!");
                }
            });
        });

    // delete user transaction
    $("body").on("click",".delete-trans",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete all Transaction of Selected User?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/transaction/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                } else {
                    swal("The item is not deleted!");
                }
            });
        });

   // add faq dialog
   $("body").on("click",".create-faq",function(){
     $("#faqmodel").modal('show');
    });
    
    // add faq dialog
   $("body").on("click",".create-banner",function(){
     $("#bannermodel").modal('show');
    });
    
    // add faq dialog
   $("body").on("click",".create-coinstore",function(){
     $("#csmodel").modal('show');
    })
    
    //create quiz cat;
   $("body").on("click",".create-quizcat",function(){
     $("#quizcatmodel").modal('show');
    });
    
    // status
   $("body").on("click",".status",function(){
    var current_object = $(this);
    var id = current_object.attr('data-id');
    var ids = current_object.attr('id');
    console.log('status id '+id);
     $("#status").modal('show');
     $("#stid").val(id);
     if(ids==1){
        $("#exampleModalCenterLabel").val("UnBLOCK");
     }
     $("#st").val(ids);
    });
 
    // search user
   $("body").on("click",".search",function(){
    //   table = $('#search_table').DataTable();
    //     table.destroy();
        var current_object = $(this);
        var name= $('#name').val();
        var searchable = [];
        var selectable = []; 
        console.log("query->"+name)
        var dTable = $('#search_table').DataTable({
            destroy: true,
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
              processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: '/user/search/'+name,
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data:'profile', name: 'profile', searchable: false},
                {data:'name', name: 'name', searchable: true},
                {data:'email', name: 'email', searchable: true},
                {data:'balance', name: 'balance',searchable: true},
                {data:'country', name: 'country', searchable: true},
                {data:'ip', name: 'ip', searchable: true},
                {data:'status', name: 'status',searchable: false},
                {data:'inserted_at', name: 'inserted_at',searchable: false},
                {data:'action', name: 'action',searchable: false}

            ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Users',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Users',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Users',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Users',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Users',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ]
        });
     });
        
   $("body").on("click",".rewa",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        var ids = current_object.attr('id');
        console.log('status id new '+ids);
         $("#rewards").modal('show');
        //  $("#stids").vsa('id');
          $("#request_id").val(ids);

        });
        
   $("body").on("click",".sub_chk",function(){
          allVals=[];
       allVals = $(".table input:checkbox:checked").map(function(){
        return $(this).val();
    }).toArray();
    
        console.log('button clicked'+allVals);
    
     });
     
   $("body").on("click",".sub_chk_all",function(){
   $('input:checkbox').not(this).prop('checked', this.checked);
        allVals=[];
                $(".sub_chk:checked").each(function() {  
                    allVals.push($(this).attr('data-id'));
                });  
        console.log('select id is '+allVals);

        });
        
   $("body").on("click",".dropdown-item",function(){
        var current_object = $(this);
        var action = current_object.attr('id');
        var type=current_object.attr('data-id');
        console.log(action+type+allVals);
        var url;
        var msg;
        
        if(type=="apps"){ url='/apps/action';}
        else if(type=="game"){ url='/game/action';}
        else if(type=="quiz"){ url='/quiz/action';}
        else if(type=="redeem"){ url='/payment-options/action';}
        else if(type=="video"){ url='/videos/action';}
        else if(type=="web"){ url='/websites/action';}
        else if(type=="banner"){ url='/banner/action';}
        else if(type=="faq"){ url='/faq/action';}
        else if(type=="request"){ url='/request/action';}
        else if(type=="trans"){ url='/transaction/action';}
        else if(type=="cs"){ url='/coinstore/action';}
        else if(type=="offerwall"){ url='/offerwall/action';}
        
        if(action=="enable"){ msg="Update Succesfully !!"}
        else if(action=="disable"){ msg="Update Succesfully !!"}
        else if(action=="delete"){ msg="Delete Succesfully !!"}
        
        var join_selected_values = allVals.join(",");
        if(allVals==""){
            swal("Please Select at Least one Row !!");
        }else{
             swal({
                title: "Are you sure?",
                text: "Do you really want to Perform this action?",
                icon: "warning",
                buttons: ["Cancel", "Proceed"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data:{
                            id:join_selected_values,
                            type:type,
                            status:action
                        },
                        
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: msg,
                                text: "Action Performed!",
                                icon: "success",
                            });
                        }else{
                          swal({
                                title: "Error",
                                text: "Action Not Performed !!",
                                icon: "danger",
                            });   
                        }
                        },
                      });
                } else {
                    swal("Action Not Performed !!");
                }
            });
        }
       

    });
    
   $("body").on("click",".edit-faq",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: 'faq/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#faqupdate").modal('show');
                 $("#question").val(data['question']);
                 $("#answer").val(data['answer']);
                 $("#id").val(data['id']);
                 var selectedUser = data['type'];
                
                $('.form-field-update > option[value="'+ selectedUser +'"]').prop('selected', true);
                console.log(data);
            },
          });
     
    });
    
    $("body").on("click",".edit-quizcat",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: '/quiz-cat/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#quizcatsupdate").modal('show');
                 $("#cattitle").val(data['title']);
                 $("#catdesc").val(data['description']);
                 $("#quizcatid").val(id);
                 $("#caticon").val(data['icon']);

                // console.log(data);
                console.log("d"+data['id']);
            },
          });
     
    });
    
    $("body").on("click",".edit-coinstore",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: 'coinstore/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#csupdate").modal('show');
                 $("#package").val(data['title']);
                 $("#currency").val(data['currency']);
                 $("#coin").val(data['coin']);
                 $("#amount").val(data['amount']);
                 $("#country").val(data['country']);
                 $("#csid").val(data['id']);
                 
                console.log(data);
            },
          });
     
    });
    
   $("body").on("click",".edit-banner",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: 'banner/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#updatebanner").modal('show');
                 $("#link").val(data['link']);
                 $("#oldimage").val(data['banner']);
                 $("#bannerid").val(data['id']);
                 var selectedUser = data['onclick'];
                 var bannertyp = data['bannertype'];
                $('#type option[value="'+ selectedUser +'"]').attr("selected", "selected");
                $('#bannertype option[value="'+ bannertyp +'"]').attr("selected", "selected");
                console.log(data);
            },
          });
     
    });
    
    //update quiz cat
   $("body").on("click",".edit-banner",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: 'quiz-cat/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#quizcatsupdate").modal('show');
                 $("#cattitle").val(data['icon']);
                 $("#catdesc").val(data['description']);
                 $("#catid").val(data['id']);
                console.log(data);
            },
          });
     
    });
     
// delete banner
    $("body").on("click",".remove-banner",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/banner/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                } else {
                    swal("The item is not deleted!");
                }
            });
        });   
    
    
    $("body").on("click",".remove-game",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/game/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                        
                } else {
                    swal("The item is not deleted!");
                }
            });
        });   
   
  // add coin
   $("body").on("click",".add-coin",function(){
     $("#addcoins").modal('show');
      var current_object = $(this);
      var id = current_object.attr('data-id');
       $('#coinid').val(id);
    });
    
    // send noiti
   $("body").on("click",".send-noti",function(){
     $("#sendnoti").modal('show');
       var current_object = $(this);
      var id = current_object.attr('data-id');
      $('#notid').val(id);
    });
    
    
})(jQuery);