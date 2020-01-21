<?php require 'views/layouts/main.php' ?>

<?php require 'views/layouts/header.php' ?>

<section>
    <div class="container">
        <div class="content">
            <?php if (isset($_SESSION['valid']) && !empty($_SESSION['valid']['message'])) : ?>
                <div class="alert alert-primary" role="alert"><?php echo $_SESSION['valid']['message'] ?></div>
            <?php endif; ?>

            <form action="" method="post" class="">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Name..." required="required" class="form-control" value="<?php echo $work->name; ?>">
                </div>

                <div class="form-group">
                    <input type="text" name="starting_date" id="starting-date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:m:i', strtotime($work->starting_date)); ?>" class="form-control">
                </div>

                <div class="form-group">
                    <input type="text" name="ending_date" id="ending-date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:m:i', strtotime($work->ending_date)); ?>" class="form-control">
                </div>

                <div class="form-group">
                    <select name="status" class="form-control">
                        <?php foreach ($status as $key => $value) : ?>
                            <?php $selected = ($work->status == $key) ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>>
                                <?php echo $value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Submit">
                </div>
            </form>

        </div>
    </div>
</section>

<?php require 'views/layouts/bottom.php' ?>