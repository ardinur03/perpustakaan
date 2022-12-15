<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Action;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.index');
    }

    public function activityLog()
    {

        // ajax request for activity log using yajra datatables
        if (request()->ajax()) {
            // get data from activity log orderby desc 
            $dataActivities = Activity::select('*')->orderBy('id', 'desc')->get();
            $start = 1;
            return datatables()->of($dataActivities)
                ->addColumn('properties', function ($data) {
                    // create modal for properties
                    $modal = '<div class="modal fade" id="modal' . $data->id . '" tabindex="-1" role="dialog" aria-labelledby="modal' . $data->id . 'Label" aria-hidden="true">';
                    $modal .= '<div class="modal-dialog modal-lg" role="document">';
                    $modal .= '<div class="modal-content">';
                    $modal .= '<div class="modal-header">';
                    $modal .= '<h5 class="modal-title" id="modal' . $data->id . 'Label">Detail Properti Format Json</h5>';
                    $modal .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    $modal .= '<span aria-hidden="true">&times;</span>';
                    $modal .= '</button>';
                    $modal .= '</div>';
                    $modal .= '<div class="modal-body">';
                    $modal .= '<pre>';
                    $modal .= json_encode($data->properties, JSON_PRETTY_PRINT);
                    $modal .= '</pre>';
                    $modal .= '</div>';
                    $modal .= '<div class="modal-footer">';
                    $modal .= '<button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-arrow-left" aria-hidden="true"></i><span class="ml-2">Tutup</span></button>';
                    $modal .= '</div>';
                    $modal .= '</div>';
                    $modal .= '</div>';
                    $modal .= '</div>';

                    // create button for modal and set button center
                    $button = '<div class="text-center">';
                    $button .= '<button type="button" class="btn text-info btn-sm" data-toggle="modal" data-target="#modal' . $data->id . '">';
                    $button .= '<i class="fas fa-eye"></i>';
                    $button .= '</button>';
                    $button .= '</div>';

                    // return button and modal
                    return $button . $modal;
                })
                ->addColumn('created_at', function ($data) {
                    // convert created_at to indonesia time zone tanggal bulan tahun jam:menit:detik
                    return date('d F Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('no', function ($data) use (&$start) {
                    // create number for datatable
                    return $start++;
                })
                ->rawColumns(['properties'])
                ->make(true);
        }

        return view('superadmin.activitylog');
    }

    public function settings()
    {
        try {
            $user = Auth::user();
            return view('superadmin.settings', [
                'title' => 'Edit Profile',
                'admin' => $user,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('superadmin.dashboard')->with('error_message', 'Gagal membuka pengaturan');
        }
    }


    public function updateSettings(Request $request)
    {
        // validate request
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // update user        
        try {
            $user = Auth::user();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('superadmin.dashboard')->with('success_message', 'Berhasil mengubah pengaturan');
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'user akses' => auth()->user()->email
            ]);
            return redirect()->route('superadmin.dashboard')->with('error_message', 'Gagal mengubah pengaturan');
        }
    }
}
