<?php require 'views/layouts/main.php' ?>

<?php require 'views/layouts/header.php' ?>

<section>
    <div class="container">
        <div class="content">

            <div class="handle">
                <div class="row">
                    <div class="col-6">
                        <a href="/works/create" class="btn btn-success">Create new work</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-info view-state" data-type="lists">Lists</a>
                        <a href="#" class="btn btn-warning view-state" data-type="calendar">Calendar</a>
                    </div>
                </div>
            </div>

            <?php if (isset($message)) : ?>
            <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>

            <div class="box-view box-lists show">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Name</th>
                            <th width="190px">Starting Date</th>
                            <th width="190px">Ending Date</th>
                            <th width="100px">Status</th>
                            <th width="170px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($works as $index => $work) : ?>
                        <tr>
                            <td><?php echo $index+1; ?></td>
                            <td><?php echo $work->name; ?></td>
                            <td><?php echo date('Y-m-d H:m:i', strtotime($work->starting_date)); ?></td>
                            <td><?php echo date('Y-m-d H:m:i', strtotime($work->ending_date)); ?></td>
                            <td><?php echo $status[$work->status]; ?></td>
                            <td>
                                <a href="/works/edit?id=<?php echo $work->id; ?>" class="btn btn-info"><strong>Edit</strong></a>
                                <a href="/works/delete?id=<?php echo $work->id; ?>" class="btn btn-danger delete-work"><strong>Delete</strong></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="box-view box-calendar">
                <div id='calendar'></div>
            </div>

        </div>
    </div>
</section>

<?php require 'views/layouts/bottom.php' ?>