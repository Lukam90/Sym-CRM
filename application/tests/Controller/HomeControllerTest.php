<?php

namespace App\Tests\Controller;

class HomeControllerTest extends ControllerTest
{
    /** @test */
    public function home_login_page_should_display(): void
    {
        $this->isRouteOK("/");
    }
}
