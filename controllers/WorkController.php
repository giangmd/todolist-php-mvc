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
        $works = App::get('DB')->selectAll($this->table, Work::class);
        $title = 'Works';
        $status = $this->status;

        return view('works.index', compact('works', 'title', 'status'));
    }

    public function create()
    {
        $title = 'Create new Work';
        $status = $this->status;

        return view('works.create', compact('title', 'status'));
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            require "views/404.php";
        }

        $id = (int) trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (empty($work)) {
            require "views/404.php";
        }

        $work = $work[0];
        $title = 'Update Work';
        $status = $this->status;

        return view('works.update', compact('work', 'title', 'status'));
    }

    public function store()
    {
        $inputData = [
            'name' => (empty($_POST['name']))?'':trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date']))?'':trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date']))?'':trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status']))?0:trim(strip_tags($_POST['status']))
        ];

        if (empty($inputData['name'])) {
            require "views/500.php";
        }

        try {
            App::get('DB')->insert($this->table, $inputData);
        }
        catch (Exception $e) {
            require "views/500.php";
        }

        return redirect('works');
    }

    public function update()
    {
        if (!isset($_GET['id'])) {
            require "views/404.php";
        }

        $id = (int) trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (empty($work)) {
            require "views/404.php";
        }

        $inputData = [
            'name' => (empty($_POST['name']))?'':trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date']))?'':trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date']))?'':trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status']))?0:trim(strip_tags($_POST['status']))
        ];

        if (empty($inputData['name'])) {
            require "views/500.php";
        }

        try {
            App::get('DB')->update($this->table, $inputData, $id);
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

        $id = (int) trim(strip_tags($_GET['id']));

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