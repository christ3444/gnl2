<?php

namespace App\Http\Controllers;

use App\Repositories\BonusRepository;
use Illuminate\Http\Request;
use App\Repositories\MarkRepository;
use App\Repositories\RecordingTransactionRepository;
use App\Repositories\UserRepository;
use DataTables;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    protected $markRepository, $recordingTransactionRepository, $userRepository, $bonusRepository;

    public function __construct(
        MarkRepository $markRepository, UserRepository $userRepository,
        RecordingTransactionRepository $recordingTransactionRepository,
        BonusRepository $bonusRepository
    )
    {
        $this->markRepository = $markRepository;
        $this->recordingTransactionRepository = $recordingTransactionRepository;
        $this->userRepository = $userRepository;
        $this->bonusRepository = $bonusRepository;
        $this->middleware('admin', ['only' => ['getMarks']]);
    }

    public function getRecordingTransactions(Request $request)
    {
        $payer_id = Auth::id();
        $admin = $this->userRepository->getRole($payer_id) === config('util.roles.admin')['role'];
        if ($request->ajax()) {
            $count = $this->recordingTransactionRepository->getTableCount();
            $recording_transactions =  $admin ? $this->recordingTransactionRepository->getAllByJoin() : $this->recordingTransactionRepository->getAllOfUserAsPayerByJoin($payer_id);
            $datatable = $count < 1 ? DataTables::of([]) : DataTables::of($recording_transactions);
            if ($count > 0) {
                $datatable->addIndexColumn();
            }
            return $datatable->make(true);
        }
        
        return view('back-end.recording-transaction.index', compact('admin'));
    }

    public function getMarks(Request $request)
    {
        if ($request->ajax()) {
            $marks = $this->markRepository->getAllByJoin();
            $count = $this->markRepository->getTableCount();
            $datatable = $count < 1 ? DataTables::of([]) : DataTables::of($marks);
            if ($count > 0) {
                $datatable->addIndexColumn();
            }

            return $datatable->make(true);
        }

        return view('back-end.mark.index');
    }

    public function getBonuses(Request $request)
    {
        if ($request->ajax()) {
            $bonuses = $this->bonusRepository->getForBeneficiary(Auth::id());
            $count = $this->bonusRepository->getForBeneficiaryCount(Auth::id());
            $datatable = $count < 1 ? DataTables::of([]) : DataTables::of($bonuses);
            if ($count > 0) {
                $datatable->addIndexColumn();
            }

            return $datatable->make(true);
        }

        return view('back-end.bonuses.index');
    }

}
