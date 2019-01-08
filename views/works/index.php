<?php require 'views/layouts/main.php' ?>
<header>
    <div class="container">
        <h1>To Do List</h1>
    </div>
</header>

<section>
    <div class="container">
        <div class="left">
            <h2>Add new Item</h2>
            <form action="/works" method="post">
                <p>
                    <input type="text" name="name" placeholder="Name..." required="required">
                </p>
                <p>
                    <input type="text" name="starting_date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s') ?>">
                </p>
                <p>
                    <input type="text" name="ending_date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s') ?>">
                </p>
                <p>
                    <select name="status">
                        <?php foreach ($status as $key => $value) : ?>
                        <option value="<?php echo $key; ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <input class="btn info" type="submit" value="Submit">
                </p>
            </form>
        </div>

        <div class="right">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($works as $index => $work) : ?>
                    <tr>
                        <td><?php echo $index+1; ?></td>
                        <td><?php echo $work->name; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime($work->starting_date)); ?></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime($work->ending_date)); ?></td>
                        <td><?php echo $status[$work->status]; ?></td>
                        <td>
                            <a href="/works/edit?id=<?php echo $work->id; ?>" class="info"><strong>Edit</strong></a> | 
                            <a href="/works/delete?id=<?php echo $work->id; ?>" class="danger"><strong>Delete</strong></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2><a href="/works/calendar" class="info">Calendar Viewer</a></h2>
        </div>
    </div>
</section>

<?php require 'views/layouts/bottom.php' ?>