<?php

namespace App\Controllers;
use App\App\App;
use App\Models\Work;

class WorkController
{
    protected $status;
    protected $table;

    public function __construct()
    {
        $work = new Work();
        $this->status = $work->status;
        $this->table = 'works';
    }

    public function index()
    {
        $works = App::get('DB')->selectAll($this->table, Work::class, 'order by id desc');
        $title = 'Works lists';
        $status = $this->status;


        $calendarItems = [];
        if (!empty($works)) {
            foreach ($works as $key => $work) {
                $tmp = [
                    'id' => $work->id,
                    'title' => $work->name,
                    'start' => $work->starting_date,
                    'end' => $work->ending_date
                ];
                array_push($calendarItems, $tmp);
            }
        }

        return view('works.index', compact('works', 'title', 'status', 'calendarItems'));
    }

    public function create()
    {
        session_start();
        if (isset($_SESSION['valid'])) {
            session_destroy();
        }

        $title = 'Works create';
        $status = $this->status;

        return view('works.create', compact('title', 'status'));
    }

    public function store()
    {
        session_start();

        $params = [
            'name'          => (empty($_POST['name'])) ? '' : trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date'   => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status'        => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status']))
        ];

        $valid = $this->validateWork($params);
        if (!$valid['status']) {
            $_SESSION['params'] = $params;
            $_SESSION['valid'] = $valid;

            return redirect('works/create');
        }

        try {
            App::get('DB')->insert($this->table, $params);
        }
        catch (Exception $e) {
            require "views/500.php";
        }

        session_destroy();

        return redirect('works');
    }

    public function edit()
    {
        session_start();

        if (!isset($_GET['id'])) {
            require "views/404.php";
            exit(0);
        }

        $id = trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (empty($work)) {
            require "views/404.php";
            exit(0);
        }

        $work = $work[0];
        $title = $work->name . ' | Works edit';
        $status = $this->status;

        return view('works.update', compact('work', 'title', 'status'));
    }

    public function update()
    {
        session_start();

        if (!isset($_GET['id'])) {
            require "views/404.php";
        }

        $id = trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (empty($work)) {

            require "views/404.php";
        }

        $params = [
            'name' => (empty($_POST['name']))?'':trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date']))?'':trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date']))?'':trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status']))?0:trim(strip_tags($_POST['status']))
        ];

        $valid = $this->validateWork($params);
        if (!$valid['status']) {
            $_SESSION['params'] = $params;
            $_SESSION['valid'] = $valid;

            return redirect('works/edit?id=' . $id);
        }

        try {
            App::get('DB')->update($this->table, $params, $id);
        }
        catch (Exception $e) {
            require "views/500.php";
        }

        session_destroy();

        return redirect('works');
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            require "views/404.php";
        }

        $id = trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (!empty($work)) {
            App::get('DB')->delete($this->table, $id);
        }

        return redirect('works');
    }

    protected function validateWork($params)
    {
        $res = ['status' => false, 'message' => ''];
        if (empty($params['name'])) {
            $res['message'] = 'The name of work is require!';

            return $res;
        }

        if (empty($params['starting_date']) || empty($params['ending_date'])) {
            $res['message'] = 'The time of work is require!';

            return $res;
        }

        if (!empty($params['starting_date']) > !empty($params['ending_date'])) {
            $res['message'] = 'Start date is in front of end date!';

            return $res;
        }

        $res = ['status' => true, 'message' => ''];
        return $res;
    }
}