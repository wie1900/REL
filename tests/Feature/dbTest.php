<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\DB;

class dbTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testTCN()
    {
        $controller = new BalanceController();

        $customers = 7;
        $contractors = 13;
        $years_count = 5;

        $revs_count = DB::table('docs')
            ->where('doctype_id',1)
            ->count();

        // $this->assertEquals($customers, $controller->total()->customers,'Liczba customersow.');
        // $this->assertEquals($contractors, $controller->total()->contractors,'Liczba contractorsow.');
        // $this->assertEquals($years_count, count($controller->total()->years),'Liczba lat');
        // $this->assertEquals(2008, $controller->total()->bil[0]->y,'Rok w pierwszym rekordzie total.');

        $odczyt = count($controller->total()->bil);

        // liczba zlecen
        $this->assertEquals($years_count, $odczyt,"Liczba lat ({$years_count}) a liczba rekordow total ({$odczyt}).");



    }

}
