<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <div class="row">
                    <div class="col">
                        <h2 class="card-text"><?php if (empty($data['id'])){ echo "Add New Person"; } else { echo "Edit ".$data['name']; } ?></h2>
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT ;?>/people" class="btn btn-light pull-right"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    
                </div>
                <p class="card-text">Please enter your username and password</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="<?php echo URLROOT ; if (empty($data['id'])){ echo "/People/add"; } else { echo "/People/edit/".$data['id']; } ?>"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name<sub>*</sub></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['name_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname<sub>*</sub></label>
                        <input type="text" name="surname" class="form-control form-control-lg <?php echo (!empty($data['surname_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['surname'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['surname_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="idnr">ID Nr<sub>*</sub></label>
                        <input type="text" name="idnr" class="form-control form-control-lg <?php echo (!empty($data['idnr_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['idnr'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['idnr_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="cellnr">Cell Nr<sub>*</sub></label>
                        <input type="text" name="cellnr" class="form-control form-control-lg <?php echo (!empty($data['cellnr_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['cellnr'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['cellnr_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Birth date<sub>*</sub></label>
                        <input type="date" name="birthdate" class="form-control form-control-lg <?php echo (!empty($data['birth_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['birthdate'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['birth_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="language">Language<sub>*</sub></label>
                        <select class="js-example-basic-single" name="language" style="width: 50%" required>
                            <option value="Afrikaans" <?php if($data['language']=="Afrikaans") echo 'selected="selected"'; ?>>Afrikaans</option>
                            <option value="English"<?php if($data['language']=="English") echo 'selected="selected"'; ?>>English</option>
                            <option value="Zulu"<?php if($data['language']=="Zulu") echo 'selected="selected"'; ?>>Zulu</option>
                            <option value="Xhosa"<?php if($data['language']=="Xhosa") echo 'selected="selected"'; ?>>Xhosa</option>
                            <option value="Sotho"<?php if($data['language']=="Sotho") echo 'selected="selected"'; ?>>Sotho</option>
                            <option value="French"<?php if($data['language']=="French") echo 'selected="selected"'; ?>>French</option>
                            <option value="Dutch"<?php if($data['language']=="Dutch") echo 'selected="selected"'; ?>>Dutch</option>
                            <option value="Indian"<?php if($data['language']=="Indian") echo 'selected="selected"'; ?>>Indian</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['lang_err'] ;?> </span>
                    </div>
                    <script>

                        $(document).ready(function() {
                            $('.js-example-basic-single').select2();
                        });
                    </script>
                    <div class="form-group">
                        <label for="interest">Interests<sub>*</sub></label>

                        <select class="js-example-basic-single" multiple="multiple" name="interest[]" style="width: 50%" required>

                        <?php foreach ($data['interest[]'] as $key =>$value) : ?>

                            <option selected="selected" value=<?php echo $value .">".$value; ?></option>

                        <?php endforeach ;?>
                            <option value="Cricket" >Cricket</option>
                            <option value="Rugby">Rugby</option>
                            <option value="Soccer">Soccer</option>
                            <option value="Work">Work</option>
                            <option value="PHP">PHP</option>
                            <option value="MySQL">MySQL</option>
                            <option value="Doom 3">Doom 3</option>

                        </select>

                        <span class="invalid-feedback"><?php echo $data['int_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block pull-left" value="<?php if (empty($data['id'])){ echo "Add New Person"; } else { echo "Edit Person"; } ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>