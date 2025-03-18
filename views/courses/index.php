<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="text" name="search" class="form-control" id="floatingInput" onkeyup="getListCourse(this.value.replace(/[^a-zA-Z0-9]/g, ''));">
                <label for="floatingInput"><i class='fas fa-search'></i> Rechercher un véhicule:</label>
            </div>
        </div>
    </div>
    <?php
        //inclusion du tableau
        require (ROOT.'views/courses/indexAjax.php');
    ?>
</div>
