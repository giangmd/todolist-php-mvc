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

        return view('works.index', compact('works', 'title', 'status'));
    }

    public function create()
    {
        $title = 'Create new Work';
        $status = $this->status;

        return view('works.create', compact('title', 'status'));
    }

    public function store()
    {
        $params = [
            'name'          => (empty($_POST['name'])) ? '' : trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date'   => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status'        => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status']))
        ];

        if (empty($params['name'])) {
            return redirect('works/create');
        }

        try {
            App::get('DB')->insert($this->table, $params);
        }
        catch (Exception $e) {
            require "views/500.php";
        }

        return redirect('works');
    }

    public function edit()
    {
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

        $params = [
            'name' => (empty($_POST['name']))?'':trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date']))?'':trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date']))?'':trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status']))?0:trim(strip_tags($_POST['status']))
        ];

        if (empty($params['name'])) {
            require "views/500.php";
            exit(0);
        }

        try {
            App::get('DB')->update($this->table, $params, $id);
        }
        catch (Exception $e) {
            require "views/500.php";
        }

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

    public function calendar()
    {
        $works = App::get('DB')->selectAll($this->table, Work::class);
        $title = 'Calendar';
        return view('works.calendar', compact('title', 'works'));
    }
}