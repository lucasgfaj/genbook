<?php

namespace Tests\Unit\Models\Staff;

use App\Models\Staff;
use App\Models\User;
use Tests\TestCase;

class StaffTest extends TestCase
{
    private Staff $staff;
    private User $user;
    private Staff $staff2;
    private User $user2;

    public function setUp(): void
    {
        parent::setUp();

        $this->user2 = new User([
            'full_name' => 'Staff 1',
            'email' => 'fulano@example.com',
        ]);
        $this->user2->save();
        
        $this->staff = new Staff([
            'user_id' => $this->user2->id,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'admin' => true,
            'employee_id' => '654321',
            'hire_date' => date('Y-m-d'),
        ]);
        $this->staff->save();
    
        $this->user2 = new User([
            'full_name' => 'Staff 2',
            'email' => 'fulano1@example.com',
        ]);
        $this->user2->save();

        $this->staff2 = new Staff([
            'user_id' => $this->user2->id,
            'admin' => false, 
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'employee_id' => '789012',
            'hire_date' => date('Y-m-d'),
        ]);
        $this->staff2->save();
    }

    public function test_should_create_new_staff(): void
    {
        $this->assertCount(2,Staff::all());
    }

    public function test_all_should_return_all_staff(): void
    {
        $this->staff2->save();

        $staffs[] = $this->staff->id;
        $staffs[] = $this->staff2->id;

        $all = array_map(fn($staff) => $staff->id,Staff::all());

        $this->assertCount(2, $all);
        $this->assertEquals($staffs, $all);
    }

    public function test_destroy_should_remove_the_staff(): void
    {
        $this->staff->destroy();
        $this->assertCount(1,Staff::all());
    }

    public function test_set_id(): void
    {
        $this->staff->id = 10;
        $this->assertEquals(10, $this->staff->id);
    }


    public function test_errors_should_return_errors(): void
    {
        $staff = new Staff();

        $this->assertFalse($staff->isValid());
        $this->assertFalse($staff->save());
        $this->assertTrue($staff->hasErrors());        
    }


    public function test_find_by_id_should_return_the_staff(): void
    {
        $this->assertEquals($this->staff->id,Staff::findById($this->staff->id)->id);
    }

    public function test_find_by_id_should_return_null(): void
    {
        $this->assertNull(Staff::findById(3));
    }

    public function test_find_by_user_id_should_return_the_staff(): void
    {
        $this->assertEquals($this->staff->id,Staff::findByUserId($this->staff->user_id)->id);
    }

    public function test_find_by_user_id_should_return_null(): void
    {
        $this->assertNull(Staff::findByUserId(3));
    }
}
    