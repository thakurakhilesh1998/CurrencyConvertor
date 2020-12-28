<?php
if (isset($_POST['uploaddocuments'])) {
    $file1 = $_FILES['doc1']['name'];
    $file2 = $_FILES['doc2']['name'];
    $file3 = $_FILES['doc3']['name'];
    if ($file1 != null && $file2 != null && $file3 != null) {
        $email=$_SESSION['user']['u_email'];
        mkdir("../documents/".$email);
        $target_dir = "../documents/".$email."/";
        $doc_1_file = $target_dir . basename($file1);
        $doc_2_file = $target_dir . basename($file2);
        $doc_3_file = $target_dir . basename($file3);
        if (move_uploaded_file($_FILES['doc1']['tmp_name'], $doc_1_file) && move_uploaded_file($_FILES['doc2']['tmp_name'], $doc_2_file) && move_uploaded_file($_FILES['doc3']['tmp_name'], $doc_3_file)) {
            require("../CurrencyExchange.php");
            $uploaddoc = new CurrencyExchange();
            $id = $_SESSION['user']['u_id'];
            $isupdate = $uploaddoc->uploadDocs($doc_1_file, $doc_2_file, $doc_3_file, $id);
            if ($isupdate) {
                echo "<div class='alert alert-success my-2'>File uploaded Successfully!!</div>";
            } else {
                echo "<div class='alert alert-danger my-2'>Failed to upload documents!!</div>";
            }
        } else {
            echo "<div class='alert alert-danger my-2'>Failed to upload documents!!</div>";
        }
    }
}
?>

<?php
if (isset($_SESSION['user'])) {
    $userData = $_SESSION['user'];
}
$doc1 = $userData['u_doc1'];
$doc2 = $userData['u_doc2'];
$doc3 = $userData['u_doc3'];
if ($doc1 == null || $doc2 == null || $doc3 == null) : ?>
    <h3 class="text-center">Upload Docments</h3>
    <form class="w-75 border p-3" style="margin: 0 auto;" method="POST" action="" id="upload" enctype="multipart/form-data">
        <span class="">All Fields are required</span>
        <div class="form-group mt-2">
            <label for="form1">Govt Issued ID* (Max Size allowed is 3mb)</label>
            <input type="file" accept="application/pdf,image/png,image/jpeg,image/jpg" class="form-control" id="doc1" name="doc1">
            <span id="doc1_error" class="error_msg"></span>
        </div>
        <div class="form-group">
            <label for="form1">Back of Govt Issued ID* (Max Size allowed is 3mb)</label>
            <input type="file" accept="application/pdf,image/png,image/jpeg,image/jpg" class="form-control" id="doc2" name="doc2">
            <span id="doc2_error" class="error_msg"></span>
        </div>
        <div class="form-group">
            <label for="form1">Proof of Address* (Max Size allowed is 3mb)</label>
            <input type="file" accept="application/pdf,image/png,image/jpeg,image/jpg" class="form-control" id="doc3" name="doc3">
            <span id="doc3_error" class="error_msg"></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Upload Documents" class="btn btn-success" name="uploaddocuments">
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
    </script>
    <script>
        $(document).ready(function() {
            let doc1_error = false;
            let doc2_error = false;
            let doc3_error = false;
            $('#doc1').change(function() {
                checkDoc1();
            });
            $('#doc2').change(function() {
                checkDoc2();
            });
            $('#doc3').change(function() {
                checkDoc3();
            });

            function checkDoc1() {
                if ($('#doc1')[0].files[0] !== undefined) {
                    $('#doc1_error').hide()
                    var ext = $('#doc1').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf']) == -1) {
                        $('#doc1_error').html("This image extension is not allowed")
                        $('#doc1_error').show();
                        doc1_error = true;
                    }
                    let size = ($('#doc1')[0].files[0].size / 1024 / 1024).toFixed(2)
                    if (size > 3) {
                        $('#doc1_error').html("File you select has size more than 3MB!! Select other file")
                        $('#doc1_error').show();
                        doc1_error = true;
                    }

                } else {
                    $('#doc1_error').html("This field can not be empty")
                    $('#doc1_error').show();
                    doc1_error = true;
                }
            }

            function checkDoc2() {
                if ($('#doc2')[0].files[0] !== undefined) {
                    $('#doc2_error').hide()
                    var ext = $('#doc2').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf']) == -1) {
                        $('#doc2_error').html("This image extension is not allowed")
                        $('#doc2_error').show();
                        doc2_error = true;
                    }
                    let size = ($('#doc2')[0].files[0].size / 1024 / 1024).toFixed(2)
                    if (size > 3) {
                        $('#doc2_error').html("File you select has size more than 3MB!! Select other file")
                        $('#doc2_error').show();
                        doc2_error = true;
                    }

                } else {
                    $('#doc2_error').html("This field can not be empty")
                    $('#doc2_error').show();
                    doc2_error = true;
                }
            }

            function checkDoc3() {
                if ($('#doc3')[0].files.length !== 0) {
                    $('#doc3_error').hide()
                    var ext = $('#doc3').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf']) == -1) {
                        $('#doc3_error').html("This image extension is not allowed")
                        $('#doc3_error').show();
                        doc3_error = true;
                    }
                    let size = ($('#doc3')[0].files[0].size / 1024 / 1024).toFixed(2)
                    if (size > 3) {
                        $('#doc3_error').html("File you select has size more than 3MB!! Select other file")
                        $('#doc3_error').show();
                        doc3_error = true;
                    }
                } else {
                    $('#doc3_error').html("This field can not be empty")
                    $('#doc3_error').show();
                    doc3_error = true;
                }
            }

            $('#upload').submit(function() {
                doc1_error = false;
                doc2_error = false;
                doc3_error = false;
                checkDoc1();
                checkDoc2();
                checkDoc3();
                if (doc1_error == false && doc2_error == false && doc3_error == false) {
                    alert("success")
                    return true;
                } else {

                    alert("Someting went wrong check all fields!!")
                    return false;
                }
            });
        });
    </script>
<?php else : ?>
    <table class="table table-bordered table-responsive mt-4" style="width: fit-content; margin:0 auto">
        <thead class="text-center">
            <tr>
                <th>Govt. Issued Id</th>
                <th>Back of Govt Issued Id</th>
                <th>Address Proof</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td>
                    <a href='<?php echo $_SESSION['user']['u_doc1']; ?>' target="_blank">View</a><br><button id="firstdoc" class="btn btn-success my-2">Update</button>
                    <div id="update_form_doc1">
                        <form id="doc1f" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group mt-2">
                                <label for="form1">Govt Issued ID* (Max Size allowed is 3mb)</label>
                                <input type="file" accept="application/pdf,image/png,image/jpeg,image/jpg" class="form-control" id="doc1" name="doc1">
                                <span id="doc1_error" class="error_msg"></span>
                                <input type="submit" value="Upload" id="upload1" name="doc1u" class="btn btn-success my-2 form-control">
                            </div>
                        </form>
                    </div>

                    <?php 
                        if(isset($_POST['doc1u']))
                        {
                            $id=$_SESSION['user']['u_id'];
                            $file1u = $_FILES['doc1']['name'];
                            if($file1u!=null)
                            {
                                $email=$_SESSION['user']['u_email'];
                                $target_dir = "../documents/".$email."/";
                                $doc_file1_u=$target_dir.basename($file1u);
                                if(move_uploaded_file($_FILES['doc1']['tmp_name'],$doc_file1_u))
                                {
                                    require("../CurrencyExchange.php");
                                    $u1=new CurrencyExchange();
                                    $check=$u1->updateDoc($doc_file1_u,$id,"u_doc1");
                                    if($check)
                                    {
                                        echo "<div class='alert alert-success my-2'>File Updated Successfully!!</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='alert alert-danger my-2'>Failed to Update documents!!</div>";
                                    }

                                }
                                else
                                {
                                    echo "<div class='alert alert-danger my-2'>Failed to Update documents!!</div>";
                                }
                            }
                        }
                    ?>
                </td>
                <td><a href='<?php echo $_SESSION['user']['u_doc2'] ?>' target="_blank">View</a><br><button id="seconddoc" class="btn btn-success my-2">Update</button>
                    <div id="update_form_doc2">
                        <form id="doc2f" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group mt-2">
                                <label for="form1">Back of Govt Issued ID* (Max Size allowed is 3mb)</label>
                                <input type="file" accept="application/pdf,image/png,image/jpeg,image/jpg" class="form-control" id="doc2" name="doc2">
                                <span id="doc2_error" class="error_msg"></span>
                                <input type="submit" value="Upload" id="upload2" name="doc2u" class="btn btn-success my-2 form-control">
                            </div>
                        </form>
                    </div>
                    <?php 
                        if(isset($_POST['doc2u']))
                        {
                            $id=$_SESSION['user']['u_id'];
                            $file1u = $_FILES['doc2']['name'];
                            if($file1u!=null)
                            {
                                $email=$_SESSION['user']['u_email'];
                                $target_dir = "../documents/".$email."/";
                                $doc_file1_u=$target_dir.basename($file1u);
                                if(move_uploaded_file($_FILES['doc2']['tmp_name'],$doc_file1_u))
                                {
                                    require("../CurrencyExchange.php");
                                    $u1=new CurrencyExchange();
                                    $check=$u1->updateDoc($doc_file1_u,$id,"u_doc2");
                                    if($check)
                                    {
                                        echo "<div class='alert alert-success my-2'>File Updated Successfully!!</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='alert alert-danger my-2'>Failed to Update documents!!</div>";
                                    }

                                }
                                else
                                {
                                    echo "<div class='alert alert-danger my-2'>Failed to Update documents!!</div>";
                                }
                            }
                        }
                    ?>
                </td>
                <td><a href='<?php echo $_SESSION['user']['u_doc3'] ?>' target="_blank">View</a><br><button id="thirddoc" class="btn btn-success my-2">Update</button>
                    <div id="update_form_doc3">
                        <form id="doc3f" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group mt-2">
                                <label for="form1">Proof of Address* (Max Size allowed is 3mb)</label>
                                <input type="file" accept="application/pdf,image/png,image/jpeg,image/jpg" class="form-control" id="doc3" name="doc3">
                                <span id="doc3_error" class="error_msg"></span>
                                <input type="submit" value="Upload" id="upload3" name="doc3u" class="btn btn-success my-2 form-control">
                            </div>
                        </form>
                    </div>
                    <?php 
                        if(isset($_POST['doc3u']))
                        {
                            $id=$_SESSION['user']['u_id'];
                            $file1u = $_FILES['doc3']['name'];
                            if($file1u!=null)
                            {
                                $email=$_SESSION['user']['u_email'];
                                $target_dir = "../documents/".$email."/";
                                $doc_file1_u=$target_dir.basename($file1u);
                                if(move_uploaded_file($_FILES['doc3']['tmp_name'],$doc_file1_u))
                                {
                                    require("../CurrencyExchange.php");
                                    $u1=new CurrencyExchange();
                                    $check=$u1->updateDoc($doc_file1_u,$id,"u_doc3");
                                    if($check)
                                    {
                                        echo "<div class='alert alert-success my-2'>File Updated Successfully!!</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='alert alert-danger my-2'>Failed to Update documents!!</div>";
                                    }

                                }
                                else
                                {
                                    echo "<div class='alert alert-danger my-2'>Failed to Update documents!!</div>";
                                }
                            }
                        }
                    ?> 
                </td>
            </tr>
        </tbody>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#update_form_doc1').hide();
            $('#update_form_doc2').hide();
            $('#update_form_doc3').hide();
            let doc1 = 0;
            let doc2 = 0;
            let doc3 = 0;

            $('#firstdoc').click(function() {
                if (doc1 === 0) {
                    $('#update_form_doc1').show();
                    doc1 = 1;
                } else {
                    $('#update_form_doc1').hide();
                    doc1 = 0;
                }

            });
            $('#seconddoc').click(function() {
                if (doc2 === 0) {
                    $('#update_form_doc2').show();
                    doc2 = 1;
                } else {
                    $('#update_form_doc2').hide();
                    doc2 = 0;
                }

            });
            $('#thirddoc').click(function() {
                if (doc3 == 0) {
                    $('#update_form_doc3').show();
                    doc3 = 1;
                } else {
                    doc3 = 0;
                    $('#update_form_doc3').hide();
                }

            })

            let doc1u=false;
            let doc2u=false;
            let doc3u=false;
            $('#doc1').change(function() {
               checkDoc1U(); 
            });
            $('#doc2').change(function() {
               checkDoc2U(); 
            });
            $('#doc3').change(function() {
               checkDoc3U(); 
            });

            function  checkDoc1U() {
                if ($('#doc1')[0].files.length !== 0) {
                    $('#doc1_error').hide()
                    var ext = $('#doc1').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf']) == -1) {
                        $('#doc1_error').html("This image extension is not allowed")
                        $('#doc1_error').show();
                        doc1u = true;
                    }
                    let size = ($('#doc1')[0].files[0].size / 1024 / 1024).toFixed(2)
                    if (size > 3) {
                        $('#doc1_error').html("File you select has size more than 3MB!! Select other file")
                        $('#doc1_error').show();
                        doc1u = true;
                    }
                } else {
                    $('#doc1_error').html("This field can not be empty")
                    $('#doc1_error').show();
                    doc1u = true;
                }
            }

            function  checkDoc2U() {
                if ($('#doc2')[0].files.length !== 0) {
                    $('#doc2_error').hide()
                    var ext = $('#doc2').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf']) == -1) {
                        $('#doc2_error').html("This image extension is not allowed")
                        $('#doc2_error').show();
                        doc2u = true;
                    }
                    let size = ($('#doc2')[0].files[0].size / 1024 / 1024).toFixed(2)
                    if (size > 3) {
                        $('#doc2_error').html("File you select has size more than 3MB!! Select other file")
                        $('#doc2_error').show();
                        doc2u = true;
                    }
                } else {
                    $('#doc2_error').html("This field can not be empty")
                    $('#doc2_error').show();
                    doc2u = true;
                }
            }

            function  checkDoc3U() {
                if ($('#doc3')[0].files.length !== 0) {
                    $('#doc3_error').hide()
                    var ext = $('#doc3').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf']) == -1) {
                        $('#doc3_error').html("This image extension is not allowed")
                        $('#doc3_error').show();
                        doc3u = true;
                    }
                    let size = ($('#doc3')[0].files[0].size / 1024 / 1024).toFixed(2)
                    if (size > 3) {
                        $('#doc3_error').html("File you select has size more than 3MB!! Select other file")
                        $('#doc3_error').show();
                        doc3u = true;
                    }
                } else {
                    $('#doc3_error').html("This field can not be empty")
                    $('#doc3_error').show();
                    doc3u = true;
                }
            }

            $('#doc1f').submit(function () {
                doc1u=false;
                checkDoc1U();
                if(doc1u===false)    
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });

            $('#doc2f').submit(function () {
                doc2u=false;
                checkDoc2U();
                if(doc2u===false)    
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });

            $('#doc3f').submit(function () {
                doc3u=false;
                checkDoc3U();
                if(doc3u===false)    
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });
            
        });
    </script>
<?php endif; ?>