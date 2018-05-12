<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\EventModel;
use DB;
use File;

class EventController extends Controller {
    
	public function index_event() {
		return view('backend.event');
	}

    public function show_event() {
        $events = EventModel::all();
        return Datatables::of($events)
        ->editColumn('start_event', function ($model) {
            $start = date('d F Y', strtotime($model->start_event));
            return $start;
        })
        ->editColumn('end_event', function ($model) {
            $end = date('d F Y', strtotime($model->end_event));
            return $end;
        })
        ->editColumn('created_date', function ($model) {
            $created = date('d F Y H:i:s', strtotime($model->created_date));
            return $created;
        })
        ->editColumn('updated_date', function ($model) {
            $updated = $model->updated_date;
            if($updated != null){
              $updated = date('d F Y H:i:s', strtotime($updated));
            } else {
              $updated = '-';
            }
            return $updated;
        })
        ->editColumn('event_file', function ($model) {
            if(!empty($model->event_file)) {
              $event_file = asset('storage/'.$model->event_file);
            } else {
              $event_file = asset('storage/no-image-available.png');
            }

            return '<img src="'.$event_file.'" alt="'.$model->title.'" class="img_medium"/>';
        })
        ->editColumn('description', function ($model) {
            $description = str_limit($model->description, 55, ' ...');
            return $description;
        })
        ->addColumn('action', function ($model) {
            $action = '
                <a href="#" class="edit_data" data-id="'.$model->id.'"><i class="md-icon material-icons">&#xE254;</i></a>
                <a onclick="delete_data('.$model->id.')" href="#"><i class="md-icon material-icons">&#xE16C;</i>
                </a>
            ';
            return $action;
        })
        ->rawColumns(['action','event_file'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_event($event_id) {
        $event = EventModel::findOrFail($event_id);
        $output = array(
            'title'     =>  $event->title,
            'start_event'     =>  str_replace('-', '.', date('d.m.Y',strtotime($event->start_event))),
            'end_event'     =>  str_replace('-', '.', date('d.m.Y',strtotime($event->end_event))),
            'description'     =>  $event->description,
            'event_file'     =>  $event->event_file,
        );
        echo json_encode($output);
    }

	public function save_event() {
		DB::beginTransaction();
		$this->validate(request(), [
            'title' => 'required|max:120|min:3',
            'description' => 'required|min:10',
            'start_event' => 'required|date',
            'end_event' => 'required|date',
        ]);
	
		$event_file = request('event_file');
        if($event_file){
    		$event_file = $event_file->storeAs('file_event', $event_file->getClientOriginalName());
    		request()->event_file->move(public_path('storage/file_event'), $event_file);
        }

    	EventModel::create([
    		'title' => request('title'),
    		'description' => request('description'),
    		'start_event' => date("Y-m-d",strtotime(request('start_event'))),
    		'end_event' => date("Y-m-d",strtotime(request('end_event'))),
            'event_file' => $event_file,
    	]);

        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Event Berhasil Ditambahkan']);
	}

	public function delete_event(){
		DB::beginTransaction();
		try {
            $event = EventModel::findOrFail(request('id'));
            $file_to_delete = public_path('storage/').$event->event_file;
	        File::delete($file_to_delete); // For delete from folder  
	        $event->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Event Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function delete_file_event($id){
		try {
            $event = EventModel::findOrFail($id);
            //hapus file nya dulu
            $file_to_delete = public_path('storage/').$event->event_file;
	        File::delete($file_to_delete); // For delete from folder
	        //lalu update table
	        DB::table('event_news')->where('id', $event->id)->update(['event_file' => '']);
            return response()->json(['status' => 'success','msg' => 'Data Gambar Event Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_event() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'title' => 'required|max:120|min:3',
            'description' => 'required|min:10',
            'start_event' => 'required|date',
            'end_event' => 'required|date',
        ]);

    	if(request('event_file') == NULL){
            $event = EventModel::findOrFail(request('id'));
            $event->title = request('title');
            $event->description = request('description');
            $event->start_event = date("Y-m-d",strtotime(request('start_event')));
            $event->end_event = date("Y-m-d",strtotime(request('end_event')));
            $event->save();

        } else {

            $event_file = request('event_file');
    		$event_file = $event_file->storeAs('file_event', $event_file->getClientOriginalName());
    		request()->event_file->move(public_path('storage/file_event'), $event_file);

            $event = EventModel::findOrFail(request('id'));
            $event->title = request('title');
            $event->description = request('description');
            $event->start_event = date("Y-m-d",strtotime(request('start_event')));
            $event->end_event = date("Y-m-d",strtotime(request('end_event')));
            $event->event_file = $event_file;
            $event->save();
        }
        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Event Berhasil Diperbaharui']);
    }
}
