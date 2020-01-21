<?php require 'views/layouts/main.php' ?>

<?php require 'views/layouts/header.php' ?>

<section>
    <div class="container">
        <div class="content">
            <?php if (isset($_SESSION['valid']) && !empty($_SESSION['valid']['message'])) : ?>
            <div class="alert alert-primary" role="alert"><?php echo $_SESSION['valid']['message'] ?></div>
            <?php endif; ?>

            <form action="/works/store" method="post" class="">
                <div class="form-group">
                    <input type="text" placeholder="Name..."
                           name="name"
                           class="form-control"
                           id="name"
                           required="required"
                           value="<?php (isset($_SESSION['params']) && !empty($_SESSION['params']['name'])) ? $_SESSION['params']['name'] : ''; ?>">
                </div>

                <div class="form-group">
                    <input type="text" placeholder="YYYY-MM-DD"
                           name="starting_date"
                           class="form-control"
                           id="starting-date"
                           value="<?php (isset($_SESSION['params']) && !empty($_SESSION['params']['starting_date'])) ? date('Y-m-d H:m:i', strtotime($_SESSION['params']['starting_date'])) : date('Y-m-d H:m:i') ?>">
                </div>

                <div class="form-group">
                    <input type="text" placeholder="YYYY-MM-DD"
                           name="ending_date"
                           class="form-control"
                           id="ending-date"
                           value="<?php (isset($_SESSION['params']) && !empty($_SESSION['params']['ending_date'])) ? date('Y-m-d H:m:i', strtotime($_SESSION['params']['ending_date'])) : date('Y-m-d H:m:i') ?>">
                </div>

                <div class="form-group">
                    <select name="status" class="form-control">
                        <?php foreach ($status as $key => $value) : ?>
                            <option value="<?php echo $key; ?>"><?php echo $value ?></option>
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