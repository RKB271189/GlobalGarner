<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\ProductStoreRequest;
use App\Http\Requests\Web\User\ProductUpdateRequest;
use App\Models\Product\Methods\ProductInterface;
use App\Models\User\Methods\UserInterface;
use App\Tools\TaitMethods\TraitImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    use TraitImage;
    private $productRepo;
    private $userRepo;
    private $issucess = true;
    public function __construct(
        ProductInterface $productInterface,
        UserInterface $userInterface
    ) {
        $this->productRepo = $productInterface;
        $this->userRepo = $userInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guard('admin')->check()) {
            $product = $this->productRepo->getallproduct($this->issucess);
        } elseif (auth()->guard('vendor')->check()) {
            $product = $this->userRepo->getvendorproduct(Auth::guard('vendor')->id(), $this->issucess);
        } else {
            $this->issucess = false;
        }
        if (!$this->issucess) {
            return redirect()->back()->with('message', 'Something went wrong. Try again.');
        } else {            
            return view('User.Product.view-product', compact('product'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.Product.add-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $params = $request->except('_method', '_token');
            $params['vendor'] = Auth::guard('vendor')->id();
            $params['createdate'] = date('Y-m-d H:i:s');
            unset($params['image']);
            $product = $this->productRepo->saveproduct($params);
            if (count($product) == 0) {
                return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
            } else {
                $filename = 'product' . $product['id'];
                if (!$this->SaveProductDocument($request, $filename)) {
                    return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
                } else {
                    $data = [
                        'id' => $product['id'],
                        'image' => $filename
                    ];
                    $update = $this->productRepo->updateproduct($data);
                    if (!$update) {
                        return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
                    } else {
                        return redirect()->back()->with('message', 'Product saved successfully')->withInput($request->all());
                    }
                }
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
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
        $product = $this->productRepo->getproductbyid($id, $this->issucess);
        if (!$this->issucess) {
            return redirect()->back()->with('message', 'Something went wrong. Try again');
        }
        return view('User.Product.update-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $params = $request->except('_method', '_token');
            $params['vendor'] = Auth::guard('vendor')->id();
            $params['id'] = $id;
            unset($params['image']);
            $update = $this->productRepo->updateproduct($params);
            if (!$update) {
                return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
            } else {
                if (!$request->hasFile('image')) {
                    return redirect()->back()->with('message', 'Product saved successfully')->withInput($request->all());
                } else {
                    $filename = 'product' . $id;
                    if (!$this->SaveProductDocument($request, $filename)) {
                        return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
                    } else {
                        $data = [
                            'id' => $id,
                            'image' => $filename
                        ];
                        $update = $this->productRepo->updateproduct($data);
                        if (!$update) {
                            return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
                        } else {
                            return redirect()->back()->with('message', 'Product saved successfully')->withInput($request->all());
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('message', 'Something went wrong. Try again.')->withInput($request->all());
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
        //
    }
}
