<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('categories.edit', $row->id) . '" class="btn btn-sm text-primary"><i class="fas fa-pen"></i></a>';
                    $btn = $btn . ' <a href="' . route('categories.show', $row->id) . '" class="btn btn-sm text-warning"><i class="fas fa-eye"></i></a>';
                    $btn = $btn . ' <a href="' . route('categories.destroy', $row->id) . '" class="btn btn-sm text-danger"  onclick="notificationBeforeDelete(event, this)"><i class="fas fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'categories.create',
            [
                'title' => 'Create Category'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);
        try {
            Category::create([
                'category_name' => $request->category_name
            ]);

            return redirect()->route('categories.index')->with('success_message', 'Kategori berhasil Ditambahkan.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
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
        $data = [
            'title' => 'Detail Category',
            'category' => Category::findOrFail($id)
        ];
        return view('categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = \App\Models\Category::find($id);
            return view(
                'categories.edit',
                [
                    'title' => 'Edit Category',
                    'category' => $data
                ]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
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
        $request->validate([
            'category_name' => 'required'
        ]);
        try {
            Category::find($id)->update([
                'category_name' => $request->category_name
            ]);

            return redirect()->route('categories.index')->with('success_message', 'Kategori berhasil Diubah.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
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
            $category = Category::find($id);

            // cek apakah category berada pada table book
            $book = \App\Models\Book::where('category_id', $id)->first();
            if ($book) {
                return redirect()->back()->with('error_message', 'Kategori tidak dapat dihapus karena masih digunakan.');
            }

            $category->delete();

            return redirect()->back()->with('success_message', 'Kategori berhasil Dihapus.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('home');
        }
    }
}
