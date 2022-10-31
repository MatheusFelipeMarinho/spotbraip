<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbstractController extends Controller
{
    protected $with = [];
    protected $service;
    protected $requestValidate;
    protected $requestValidateUpdate;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this
        ->service
        ->getAll($request->all(), $this->with)
        ->toArray();

        return $this->ok($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($this->requestValidate) {
                $requestValidate =  app($this->requestValidate);
                $request->validate($requestValidate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $response = $this->service->save($request->all());
            DB::commit();
        } catch (\Exception | ValidationException $e) {
            DB::rollBack();

            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }

            if ($e instanceof \Exception) {
                return $this->error($e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->ok($this->service->find($id, $this->with));
        } catch (\Throwable $th) {
            if ($e instanceof \Exception) {
                return $this->error($e->getMessage());
            }
            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (!empty($this->requestValidateUpdate)) {
                $requestValidateUpdate = app($this->requestValidateUpdate);
                $request->validate($requestValidateUpdate->rules());
            }
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }

        try {
            DB::beginTransaction();
            $response = $this->service->update($id, $request->all());
            DB::commit();
            return $this->success($this->messageSuccessDefault);
        } catch (\Exception | ValidationException $e) {
            DB::rollBack();

            if ($e instanceof ValidationException) {
                return $this->error($this->messageErrorDefault, $e->errors());
            }

            if ($e instanceof \Exception) {
                return $this->error($e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->success($this->messageSuccessDefault);
        } catch (\Exception $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
	 * @param null $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function preRequisite($id = null)
	{
		$preRequisite = $this->service->preRequisite($id);
		return $this->ok(compact('preRequisite'));
	}


	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function toSelect()
	{
		return $this->ok($this->service->toSelect());
	}


}
