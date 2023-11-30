<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;

# Models
use App\Models\Entity;
use App\Models\Pr;
use App\Models\Po;
use App\Models\Project;
use App\Models\Budget;
use App\Models\DeptBudget;

# Enums
use App\Enum\EntityEnum;
use App\Enum\AuthStatusEnum;
# Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# Notifications
# Mails
# Packages
# Seeded
use DB;
use Str;
use File;
use Illuminate\Support\Facades\Response;

# Exceptions
# Events

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Attachment::class);

        $this->authorize('viewAny', Activity::class);

        $attachments = Attachment::query();
        if (request('term')) {
            $attachments->where('entity', 'Like', '%' . Str::upper(request('term')) . '%');
        }
        $attachments = $attachments->orderBy('id', 'DESC')->paginate(50);
        return view('attachments.index', compact('attachments'))->with('i', (request()->input('page', 1) - 1) * 50);


        //$attachments = Attachment::latest()->orderBy('id', 'desc')->paginate(25);
        //return view('attachments.index',compact('attachments'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment)
    {
        $this->authorize('view', $attachment);

        switch ($attachment->entity) {
            case EntityEnum::BUDGET->value:
                return redirect()->route('budgets.show', $attachment->article_id);
                break;
            case EntityEnum::DEPTBUDGET->value:
                return redirect()->route('dept-budgets.show', $attachment->article_id);
                break;
            case EntityEnum::PR->value:
                return redirect()->route('prs.show', $attachment->article_id);
                break;
            case EntityEnum::PO->value:
                return redirect()->route('pos.show', $attachment->article_id);
                break;
            case EntityEnum::PROJECT->value:
                return redirect()->route('projects.show', $attachment->article_id);
                break;
            case EntityEnum::RECEIPT->value:
                return redirect()->route('receipts.show', $attachment->article_id);
                break;
            case EntityEnum::PAYMENT->value:
                return redirect()->route('payments.show', $attachment->article_id);
                break;
            default:
                return redirect()->route('attachments.index');
                // Success
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {

        switch ($attachment->entity) {
            case EntityEnum::BUDGET->value:
                $budget = Budget::where('id', $attachment->article_id)->get()->firstOrFail();
                if ($budget->freeze) {
                    return redirect()->back()->with('error', 'Attachment can not be deleted from freeze Budget!');
                } else {
                    EventLog::event('Budget', $budget->id, 'detach', 'id', $attachment->id);
                    $attachment->delete();
                    return redirect()->back()->with('success', 'Attachment deleted!');
                }
                break;
            case EntityEnum::DEPTBUDGET->value:
                $deptBudget = DeptBudget::where('id', $attachment->article_id)->get()->firstOrFail();
                if ($deptBudget->freeze) {
                    return redirect()->back()->with('error', 'Attachment can not be deleted from freeze Budget!');
                } else {
                    EventLog::event('DeptBudget', $deptBudget->id, 'detach', 'id', $attachment->id);
                    $attachment->delete();
                    return redirect()->back()->with('success', 'Attachment deleted!');
                }
                break;
            case EntityEnum::PR->value:
                $pr = Pr::where('id', $attachment->article_id)->get()->firstOrFail();
                if ($pr->auth_status->value <> AuthStatusEnum::DRAFT->value) {
                    return redirect()->back()->with('error', 'Attachment can be deleted only from DRAFT documents!');
                } else {
                    EventLog::event('Pr', $pr->id, 'detach', 'id', $attachment->id);
                    $attachment->delete();
                    return redirect()->back()->with('success', 'Attachment deleted!');
                }
                break;
            case EntityEnum::PO->value:
                $po = PO::where('id', $attachment->article_id)->get()->firstOrFail();
                if ($po->auth_status->value <> AuthStatusEnum::DRAFT->value) {
                    return redirect()->back()->with('error', 'Attachment can be deleted only from DRAFT documents!');
                } else {
                    EventLog::event('Po', $po->id, 'detach', 'id', $attachment->id);
                    $attachment->delete();
                    return redirect()->back()->with('success', 'Attachment deleted!');
                }

                return redirect()->route('pos.show', $attachment->article_id);
                break;
            case EntityEnum::PROJECT->value:
                $project = Project::where('id', $attachment->article_id)->get()->firstOrFail();
                if ($project->closed) {
                    return redirect()->back()->with('error', 'Attachment can not be deleted from closed project!');
                } else {
                    EventLog::event('Project', $project->id, 'detach', 'id', $attachment->id);
                    $attachment->delete();
                    return redirect()->back()->with('success', 'Attachment deleted!');
                }
                break;
            case EntityEnum::RECEIPT->value:
                return redirect()->route('receipts.show', $attachment->article_id);
                break;
            case EntityEnum::PAYMENT->value:
                return redirect()->route('payments.show', $attachment->article_id);
                break;
            default:
                return redirect()->route('attachments.index');
                // Success
        }


        if ($pr->auth_status->value <> AuthStatusEnum::DRAFT->value) {
            return redirect()->route('prs.show', $pr->id)->with('error', 'Only DRAFT Purchase Requisition can be deleted!');
        }

        // Write to Log
        EventLog::event('Pr', $pr->id, 'delete', 'id', $pr->id);
        // delete from prl
        DB::table('prls')->where('pr_id', $pr->id)->delete();
        $pr->delete();




        $attachment->delete();
        return redirect()->back()->with(['success' => 'File Deleted successfully.']);
    }

    public function download($filename)
    {
        // TODO simplify
        // get entity -> subdir from filename
        $att = Attachment::where('file_name', $filename)->first();
        $entity = Entity::where('entity', $att->entity)->first();
        $subdir = $entity->subdir;


        //shown as: http://geda.localhost:8000/image/4.jpg
        //$path = storage_path('uploads/' . $filename);
        //$path = storage_path('app/private/pr/'. $filename);
        //$path = storage_path('app/private/adv/'. $filename);
        $path = storage_path('app/private/'.$subdir.'/'. $filename);
        //Log::debug('path1= '. $path);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    /**
     * Export selected column to csv format
     */
    public function export()
    {
        $this->authorize('export', Activity::class);
        //$data = Uom::all()->toArray();
        $data = DB::select('SELECT a.id, a.entity, a.article_id, u.name, a.org_file_name, upload_date
            FROM attachments a, users u
            WHERE a.owner_id = u.id
            ');

        $dataArray = json_decode(json_encode($data), true);

        // export to CSV
        return Export::csv('attachments', $dataArray);
    }
}
