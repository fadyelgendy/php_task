<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?= $_SESSION['_token']; ?>">
    <div class="form-container">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" placeholder="First Name" id="first_name" name="first_name" required>
            <?php if (isset($_SESSION['First Name'])): ?>
                <div class="err"><?= $_SESSION['First Name']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" placeholder="Last Name" id="last_name" name="last_name" required>
            <?php if (isset($_SESSION['Last Name'])): ?>
                <div class="err"><?= $_SESSION['Last Name']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="image">Image [2MB Max.]</label>
            <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/jpg">
            <div id="image_err" class="err"></div>
            <?php if (isset($_SESSION['image'])): ?>
                <div class="err"><?= $_SESSION['image']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="button">
            Save
        </button>
    </div>
</form>