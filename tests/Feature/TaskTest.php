<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_save_task()
    {
        $response = $this->postJson('api/task/save-task', [
            'name' => 'abcd',
            'status' => 'completed'
        ]);
        $this->assertDatabaseHas('tasks', ['name' => 'abcd']);
    }

    public function test_get_task_list()
    {
        Task::create([
            'name' => 'testing',
            'status' => 'pending'
        ]);
        $response = $this->getJson('api/task/get-tasks');
        $this->assertEquals(1, count($response->json()));

        $response->assertJsonStructure(['details' => [
            '*' => [
                'id',
                'name',
                'status'
            ]
        ]]);
    }
    
    public function test_delete_task_list()
    {
        $response = Task::create([
            'name' => 'testing',
            'status' => 'pending'
        ]);
 
        $this->postJson('api/task/delete-task', ['id' =>  $response->id]);

        $this->assertDatabaseMissing('tasks', ['id' => $response->id]);
    }
}
