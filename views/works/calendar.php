<?php require 'views/layouts/main.php' ?>
<?php
    $events = [];
    if (!empty($works)) {
        foreach ($works as $key => $work) {
            $tmp = [
                'id' => $work->id,
                'title' => $work->name,
                'start' => $work->starting_date,
                'end' => $work->ending_date
            ];
            array_push($events, $tmp);
        }
    }
?>

<link href='../../public/assets/css/fullcalendar.min.css' rel='stylesheet' />
<link href='../../public/assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<script src='../../public/assets/lib/moment.min.js'></script>
<script src='../../public/assets/lib/jquery.min.js'></script>
<script src='../../public/assets/js/fullcalendar.min.js'></script>

<script>

  $(document).ready(function() {

    var events = <?php echo json_encode($events); ?>;

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: "<?php echo date('Y-m-d') ?>",
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: events
    });

  });

</script>



<header>
    <div class="container">
        <h1>To Do List</h1>
    </div>
</header>

<section>
    <div class="container">
        <div id='calendar'></div>
    </div>
    <div class="container">
        <h2><a href="/works" class="info">Lists Viewer</a></h2>
    </div>
</section>

<?php require 'views/layouts/bottom.php' ?>