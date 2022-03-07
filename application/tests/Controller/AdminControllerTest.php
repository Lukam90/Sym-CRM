<?php

namespace App\Tests\Controller;

class AdminControllerTest extends ControllerTest
{
    /** @test */
    public function admin_dashboard_should_display(): void
    {
        $this->isRouteOK("/dashboard");
    }
}
