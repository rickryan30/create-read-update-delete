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
      if (
        email != "" &&
        password != "" &&
        fullname != "" &&
        username != "" &&
        confirm_password != ""
      ) {
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

jQuery(function () {
  register_user();
  login_user();
  update_user();
});
