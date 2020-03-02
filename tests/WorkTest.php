<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class WorkTest extends TestCase
{
    protected $viewPath;
    protected $appUrl;

    protected function setUp()
    {
        $this->viewPath = 'views/works/';
        $this->appUrl = 'http://todolist-php-mvc.local';
    }

    public function testCanBeAccessWorkIndex(): void
    {
        $this->assertFileExists( $this->viewPath . 'index.php' );
    }

    public function testCanBeAccessWorkCreate(): void
    {
        $this->assertFileExists( $this->viewPath . 'create.php' );
    }

    public function testCannotCreateWorkWithEmptyName(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            $this->appUrl . '/works/store',
            [
                'form_params' => [
                    'name' => ''
                ]
            ]
        );

        $this->assertFileExists( 'views/500.php' );
    }

    public function testCanCreateWork(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            $this->appUrl . '/works/store',
            [
                'form_params' => [
                    'name' => 'Work unit test',
                    'starting_date' => '2020/03/02',
                    'ending_date' => '2020/03/02',
                    'status' => 1
                ]
            ]
        );

        $this->assertFileExists( $this->viewPath . 'index.php' );
    }

    public function testCannotAccessUpdateWorkWithoutId(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $this->appUrl . '/works/edit?id=',
            []
        );

        $this->assertFileExists( 'views/404.php' );
    }

    public function testCannotPostUpdateWorkWithoutId(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            $this->appUrl . '/works/edit?id=',
            [
                'form_params' => [
                    'name' => 'Work unit test update',
                    'starting_date' => '2020/03/02',
                    'ending_date' => '2020/03/02',
                    'status' => 1
                ]
            ]
        );

        $this->assertFileExists( 'views/404.php' );
    }

    public function testCannotUpdateWorkWithoutName(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            $this->appUrl . '/works/edit?id=1',
            [
                'form_params' => [
                    'name' => ''
                ]
            ]
        );

        $this->assertFileExists( 'views/500.php' );
    }

    public function testCanUpdateWork(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            $this->appUrl . '/works/edit?id=1',
            [
                'form_params' => [
                    'name' => 'Work unit test update',
                    'starting_date' => '2020/03/02',
                    'ending_date' => '2020/03/02',
                    'status' => 1
                ]
            ]
        );

        $this->assertFileExists( $this->viewPath . 'index.php' );
    }

    public function testCannotDeleteWorkWithoutId(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $this->appUrl . '/works/delete?id=',
            []
        );

        $this->assertFileExists( 'views/404.php' );
    }

    public function testCanDeleteWork(): void
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $this->appUrl . '/works/delete?id=1',
            []
        );

        $this->assertFileExists( $this->viewPath . 'index.php' );
    }

    public function testCanBeAccessCalendarPage(): void
    {
        $this->assertFileExists( $this->viewPath . 'calendar.php' );
    }
}