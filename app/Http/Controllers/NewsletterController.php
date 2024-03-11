<?php

namespace App\Http\Controllers;

use App\Repositories\NewsletterRepository;
use Illuminate\Http\Request;
use DataTables;

class NewsletterController extends Controller
{
    protected $newsletterRepository;

    public function __construct(NewsletterRepository $newsletterRepository) {
        $this->newsletterRepository = $newsletterRepository;
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $newsletters = $this->newsletterRepository->getAll();
            $count = $this->newsletterRepository->getTableCount();
            $datatable = $count < 1 ? DataTables::of([]) : DataTables::of($newsletters);
            if ($count > 0) {
                $datatable->addIndexColumn();
            }

            return $datatable->make(true);
        }

        return view('back-end.newsletter.index');
    }
}
