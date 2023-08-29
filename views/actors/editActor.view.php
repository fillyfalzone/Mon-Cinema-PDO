
<?php ob_start(); ?>

<form method="POST" action="<?= URL ?>actors/edit_validation/" enctype="multipart/form-data" class="col-md-10 mx-auto">
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
            <input type="text" class="form-control" placeholder="<?= $actor->getFirstName() ?>" value="<?= $actor->getFirstName() ?>" name="firstname" required>
        </div>
    </div>
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
            <input type="text" class="form-control" placeholder="<?= $actor->getLastName() ?>" value="<?= $actor->getLastName() ?>" name="lastname" required>
        </div>
    </div>
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
            <label for="gender"> Select gender </label>
            <select name="gender" id="gender">
                <option value="">Select</option>
                <?php if( $actor->getGender() === "Male") : ?>
                <option value="Male" selected >Male</option>
                <option value="Female">Female</option>
                <?php else : ?>
                    <option value="Male">Male</option>
                <option value="Female" selected>Female</option>
                <?php  endif ; ?>
            </select>
        </div>
    </div> 
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
        <label for="birth_date" class="me-3">Birth Date:</label>
        <input type="date" id="birth_date" value="<?= $actor->getBirthDate() ?>" name="birth_date" min="1900-01-01" max="<?= date('Y-m-d') ?>" required>
        </div>
    </div> 
    <input type="hidden" name="id_person" value="<?= $actor->getIdPerson() ?>">

    <input type="hidden" name="id_actor" value="<?= $actor->getIdActor() ?>">

    <div class="row m-4">

        <button type="submit" class="btn btn-primary col-md-2 mx-auto d-block ">Validate</button>
    </div>
</form>



<?php 
    $content = ob_get_clean();
    $title = "Edit Actor";
    require_once "./views/template.php";
?>