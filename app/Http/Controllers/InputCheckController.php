<?php

namespace App\Http\Controllers;

use App\Interfaces\CheckInputRepositoryInterface;
use App\Services\CheckInputService;
use Illuminate\Http\Request;

class InputCheckController extends Controller
{

    private $checkInputService;

    public function __construct(CheckInputService $checkInputSerivice)
    {
        $this->checkInputService = $checkInputSerivice;
    }

    public function index() {
        return view('pages.check.index');
    }

    public function process(Request $request) {
        return view('pages.check.result', [
            "data" => $this->checkInputService->selectionChar($request->input1,$request->input2)
        ]);
    }
}
