<?php require 'views/layouts/main.php' ?>
<header>
    <div class="container">
        <h1>To Do List</h1>
    </div>
</header>

<section>
    <div class="container">
        <form action="" method="post">
            <p>
                <input type="text" name="name" placeholder="Name..." required="required" value="<?php echo $work->name; ?>">
            </p>
            <p>
                <input type="text" name="starting_date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s', strtotime($work->starting_date)); ?>">
            </p>
            <p>
                <input type="text" name="ending_date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s', strtotime($work->ending_date)); ?>">
            </p>
            <p>
                <select name="status">
                    <?php foreach ($status as $key => $value) : ?>
                    <?php $selected = ($work->status==$key)?'selected="selected"':''; ?>
                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>>
                        <?php echo $value ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <input class="btn info" type="submit" value="Update">
            </p>
        </form>
    </div>
</section>

<?php require 'views/layouts/bottom.php' ?>