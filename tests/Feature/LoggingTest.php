<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // test 1 sesuai arahan ppt
        // Log::debug('Debug Log Tracked');
        // Log::emergency('Emergency Log Tracked');
        // Log::alert('Alert Log Tracked');
        // Log::error('Error Log Tracked');
        // Log::warning('Warning Log Tracked');
        // Log::notice('Notice Log Tracked');
        // Log::info('Info Log Tracked');
        // Log::critical('Critical Log Tracked');


        // // test 2 jika menggunakan Log::channel('filelog')
        Log::channel('filelog')->debug('Debug Log Tracked');
        Log::channel('filelog')->emergency('Emergency Log Tracked');
        Log::channel('filelog')->alert('Alert Log Tracked');
        Log::channel('filelog')->error('Error Log Tracked');
        Log::channel('filelog')->warning('Warning Log Tracked');
        Log::channel('filelog')->notice('Notice Log Tracked');
        Log::channel('filelog')->info('Info Log Tracked');
        Log::channel('filelog')->critical('Critical Log Tracked');

        $this->assertTrue(true);
    }
}
