<?php
namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var ExceptionHandler */
    protected $oldExceptionHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    /**
     * Disables exception handling
     *
     * @return void
     */
    protected function disableExceptionHandling(): void
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}

            /**
             * @param \Illuminate\Http\Request $request
             * @param \Exception $e
             * @return \Illuminate\Http\Response|void
             * @throws \Exception
             */
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * Enables exception handling
     *
     * @return $this
     */
    protected function withExceptionHandling(): TestCase
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
}
