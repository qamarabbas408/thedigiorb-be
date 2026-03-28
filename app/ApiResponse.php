<?php

namespace App;

trait ApiResponse
{
    protected function success($data = null, string $message = null, int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error(string $message, int $code = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    protected function paginated($paginator)
    {
        return response()->json([
            'success' => true,
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
        ]);
    }

    protected function created($data = null, string $message = 'Created successfully')
    {
        return $this->success($data, $message, 201);
    }

    protected function updated($data = null, string $message = 'Updated successfully')
    {
        return $this->success($data, $message, 200);
    }

    protected function deleted(string $message = 'Deleted successfully')
    {
        return $this->success(null, $message, 200);
    }

    protected function notFound(string $resource = 'Resource')
    {
        return $this->error("$resource not found", 404);
    }

    protected function validationError($errors)
    {
        return $this->error('Validation failed', 422, $errors);
    }
}
