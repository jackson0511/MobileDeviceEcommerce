<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#data_profile").html('');
        $("#profile").click(function(){
            $("#loading").show();
            var id=$(this).attr("data-id");
            $.ajax({
                method: "POST",
                url: 'admin/profile',
                data: {
                    id:id,
                },
                success: function (data) {
                    if(data!=null) {
                        $("#data_profile").html(data);
                        $("#modal_profile").modal('show');

                        $("#changepass").on('change',function () {
                            if($(this).is(":checked")){
                                $(".password").removeAttr('disabled')
                            }else{
                                $(".password").attr('disabled','')
                            }
                        });
                        $("#modal_profile").on('click','.save-profile',function () {
                            var dataForm = $("#form-profile").serialize();
                            $.ajax({
                                url: "admin/profile-save",
                                type: 'POST',
                                data:dataForm,
                            }).done(function (response) {
                                response=JSON.parse(response);
                                   if (response.result){
                                       alert(response.message);
                                       $("#modal_profile").modal('hide');
                                   }else{
                                       alert(response.message);
                                   }
                            }).fail(function() {
                               alert('Lỗi')
                            });
                        });
                    }
                    setTimeout(function() {
                        $("#loading").hide();
                    }, 500);
                }
            });
        });
    });
</script>
