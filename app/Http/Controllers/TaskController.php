<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Repositories\TaskRepository;
use App\Http\Resources\TaskListResource;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

/**
 * Class TasksController.
 *
 * @package namespace App\Http\Controllers;
 */
class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $repository;


    /**
     * TasksController constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * list
     *
     * @return json
     */
    public function index()
    {
        $tasks = $this->repository->all();
        $response = new TaskListResource($tasks);
        
        return response()->json([
            'details' => $response,
        ]);
    }

    /**
     * store
     *
     * @param TaskCreateRequest $request
     * @return json
     */
    public function store(TaskCreateRequest $request)
    {
        try {


            $task = $this->repository->create($request->all());

            $response = [
                'message' => 'Task created.',
                'data'    => $task->toArray(),
            ];


            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }



   /**
    * update
    *
    * @param TaskUpdateRequest $request
    * @return json
    */
    public function update(TaskUpdateRequest $request)
    {
        try {


            $task = $this->repository->update($request->all(), $request->id);

            $response = [
                'message' => 'Task updated.',
                'data'    => $task->toArray(),
            ];


            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * delete
     *
     * @param Request $request
     * @return json
     */
    public function destroy(Request $request)
    {
        $deleted = $this->repository->delete($request->id);

        return response()->json([
            'message' => 'Task deleted.',
            'deleted' => $deleted,
        ]);
    }
}
