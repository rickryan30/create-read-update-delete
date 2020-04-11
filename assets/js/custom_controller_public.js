function register_user() {
  $(document).on("click", "#btn-register", function (e) {
    e.preventDefault();

    var fullname = $("#fullname").val();
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var confirm_password = $("#confirmPassword").val();

    if (password != confirm_password) {
      Swal({
        title: "Warning!",
        text: "Password and Confirm Password dint Match!",
        type: "warning",
        confirmButtonText: "OK",
        closeOnConfirm: false,
      });
    } else {
      if (email != "" && password != "" && fullname != "" &&  username != "" && confirm_password != "") {
        var fields = {
          register_user: "register_user",
          fullname: fullname,
          email: email,
          username: username,
          password: password,
          confirm_password: confirm_password,
        };

        jQuery.ajax({
          url: base_url + "controller/register",
          type: "POST",
          dataType: "JSON",
          data: fields,
          success: function (data) {
            if (data.success == true) {
              Swal({
                title: "Success!",
                text: "Login Successfully.",
                type: "success",
                confirmButtonText: "OK",
                closeOnConfirm: false,
              }).then((result) => {
                if (result.value) {
                  window.location.href = base_url + "login";
                }
              });
            } else {
              Swal({
                title: "Error!",
                text: "Email is Already Taken",
                type: "error",
                confirmButtonText: "OK",
                closeOnConfirm: false,
              }).then((result) => {
                if (result.value) {
                  // location.reload();
                }
              });
            }
          },
        });
      } else {
        Swal({
          title: "Warning!",
          text: "Please fill in the selected inputs.",
          type: "warning",
          confirmButtonText: "OK",
          closeOnConfirm: false,
        });
      }
    }
  });
}

/* select user */
function login_user(){
  $(document).on("click","#btn-login",function(e) { 
     e.preventDefault();

     var email = $("#email").val();
     var password = $("#password").val();

     if(email!="" && password!=""){

         var fields = {
             login_user:"login_user",
             email:email, 
             password:password
         };

         jQuery.ajax({
             url : base_url+"controller/login",
             type : "POST",
             dataType : "JSON",
             data : fields,
             success : function(data){
                 if(data.success == true){
                     Swal({ 
                         title: "Success!",
                         text: "Login Successfully.",
                         type: "success",
                         confirmButtonText: "OK",
                         closeOnConfirm: false
                     }).then((result) => {
                         if (result.value) {
                             window.location.href = base_url+"members";
                         }
                     })

                 }else{
                     Swal({
                         title: "Error!",
                         text: "Login Failed.",
                         type: "error",
                         confirmButtonText: "OK",
                         closeOnConfirm: false
                     }).then((result) => {
                         if (result.value) {
                             location.reload();
                         }
                     })
                 }
             }
         });

     }else{
         Swal({
             title: "Warning!",
             text: "Please fill in the selected inputs.",
             type: "warning",
             confirmButtonText: "OK",
             closeOnConfirm: false
         })
     }
 });
}

/* end of select user */

/* update user */
function update_user(){ 
  $(document).on("click","#btn-update",function(e) { 
     e.preventDefault();

     var fullname=$("#fullname").val();
     var email=$("#email").val();
     var username=$("#username").val();
     var password=$("#password").val();
     var uID=$("#uID").val();

     if(email!="" && password!="" && fullname!="" && username!=""){

         var fields = {
             update_user:"update_user",
             fullname: fullname,
             email: email,
             username: username,
             password: password,
             uID: uID,
         };

         jQuery.ajax({
             url : base_url+"controller/update",
             type : "POST",
             dataType : "JSON",
             data : fields,
             success : function(data){
                 if(data.success == true){
                     Swal({ 
                         title: "Success!",
                         text: "Updated Successfully.",
                         type: "success",
                         confirmButtonText: "OK",
                         closeOnConfirm: false
                     }).then((result) => {
                         if (result.value) {
                             window.location.href = base_url+"update";
                         }
                     })

                 }else{
                     Swal({
                         title: "Error!",
                         text: "Update Failed",
                         type: "error",
                         confirmButtonText: "OK",
                         closeOnConfirm: false
                     }).then((result) => {
                         if (result.value) {
                             location.reload();
                         }
                     })
                 }
             }
         });

     }else{
         Swal({
             title: "Warning!",
             text: "Please fill in the selected inputs.",
             type: "warning",
             confirmButtonText: "OK",
             closeOnConfirm: false
         })
     }
 });
}
/* end of update user */

/* change password */
function changed_password() {
  $(document).on("click", "#btn-change-password", function (e) {
    e.preventDefault();

    var password = $("#password").val();
    var newPassword = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();
    var uID=$("#uID").val();

    if (newPassword != confirmPassword) {
      Swal({
        title: "Warning!",
        text: "Password and Confirm Password dint Match!",
        type: "warning",
        confirmButtonText: "OK",
        closeOnConfirm: false,
      });
    } else {
      if (password != "" &&  newPassword != "" && confirmPassword != "") {
        var fields = {
          changed_password: "changed_password",
          password: password,
          newPassword: newPassword,
          confirmPassword: confirmPassword,
          uID: uID,
        };

        jQuery.ajax({
          url: base_url + "controller/change-password",
          type: "POST",
          dataType: "JSON",
          data: fields,
          success: function (data) {
            if (data.success == true) {
              Swal({
                title: "Success!",
                text: "Password Changed. You need to login again!",
                type: "success",
                confirmButtonText: "OK",
                closeOnConfirm: false,
              }).then((result) => {
                if (result.value) {
                  window.location.href = base_url + "logout";
                }
              });
            } else {
              Swal({
                title: "Error!",
                text: "Wrong Password",
                type: "error",
                confirmButtonText: "OK",
                closeOnConfirm: false,
              }).then((result) => {
                if (result.value) {
                  // location.reload();
                }
              });
            }
          },
        });
      } else {
        Swal({
          title: "Warning!",
          text: "Please fill in the selected inputs.",
          type: "warning",
          confirmButtonText: "OK",
          closeOnConfirm: false,
        });
      }
    }
  });
}
/* end of change password */

/* update user listing */
function update_user_listing(){ 
  $(document).on("click","#btn-listing",function(e) { 
     e.preventDefault();

     var user_id = $(this).attr("user-id");
     var fullname=$("#fullname_"+user_id).val();
     var email=$("#email_"+user_id).val();
     var username=$("#username_"+user_id).val();
     var status=$("#status_"+user_id).val();
     var uID=$("#uID_"+user_id).val();

     if(email!="" && fullname!="" && username!=""){

         var fields = {
             update_user_listing:"update_user_listing",
             fullname: fullname,
             email: email,
             username: username,
             status: status,
             uID: uID,
         }; 

         jQuery.ajax({
          url: base_url + "controller/user-listing",
             type : "POST",
             dataType : "JSON",
             data : fields,
             success : function(data){
                 if(data.success == true){
                     Swal({ 
                         title: "Success!",
                         text: "Updated Successfully.",
                         type: "success",
                         confirmButtonText: "OK",
                         closeOnConfirm: false
                     }).then((result) => {
                         if (result.value) {
                             window.location.href = base_url+"admin";
                         }
                     })

                 }else{
                     Swal({
                         title: "Error!",
                         text: "Update Failed",
                         type: "error",
                         confirmButtonText: "OK",
                         closeOnConfirm: false
                     }).then((result) => {
                         if (result.value) {
                             location.reload();
                         }
                     })
                 }
             }
         });

     }else{
         Swal({
             title: "Warning!",
             text: "Please fill in the selected inputs.",
             type: "warning",
             confirmButtonText: "OK",
             closeOnConfirm: false
         })
     }
 });
}
/* end of update user listing */

/* delete user listing */
function delete_user(){ 
  $(document).on("click",".btn-delete",function(e) { 
     e.preventDefault();

     var btnDelete=$(this).val();

     if(btnDelete!=""){

         var fields = {
             delete_user: "delete_user",
             btnDelete: btnDelete
         };

         Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
           if (result.value) {
                 jQuery.ajax({
                 url : base_url+"controller/user-delete",
                 type : "POST",
                 dataType : "JSON",
                 data : fields,
                 success : function(data){
                     Swal.fire({
                         title: "Deleted!",
                         text: "Your file has been deleted.",
                         type: "success",
                         timer: 3000
                     }).then((result) => {
                       window.location.href = base_url+"admin";
                     }) 
                 }, 
             });
           }
         })
          
     }else{
         Swal.fire({
             title: "Warning!",
             text: "Please fill in the selected inputs.",
             type: "warning",
             confirmButtonText: "OK",
             closeOnConfirm: false
         })
     }
 });
}
/* end of delete user listing */

jQuery(function () {
  register_user();
  login_user();
  update_user();
  changed_password();
  update_user_listing();
  delete_user();
});
