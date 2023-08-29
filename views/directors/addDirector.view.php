<?php ob_start(); ?>

<form method="POST" action="<?= URL ?>directors/validate/" enctype="multipart/form-data" class="col-md-10 mx-auto">
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
            <input type="text" class="form-control" placeholder="FirstName" aria-label="FirstName" name="firstname" required>
        </div>
    </div>
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
            <input type="text" class="form-control" placeholder="LastName" aria-label="LastName" name="lastname" required>
        </div>
    </div>
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
            <label for="gender"> Select gender </label>
            <select name="gender" id="gender">
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div> 
    <div class="row m-4">
        <div class="col-md-5 mx-auto">
        <label for="birth_date" class="me-3">Birth Date:</label>
        <input type="date" id="birth_date" name="birth_date" min="1900-01-01" max="<?= date('Y-m-d') ?>" required>
        </div>
    </div> 

    <div class="row m-4">
        <button type="submit" class="btn btn-primary col-md-2 mx-auto d-block ">Validate</button>
    </div>
</form>

    
<?php
    $content = ob_get_clean();
    $title = "Add a Director ";
    require_once "./views/template.php";
?>