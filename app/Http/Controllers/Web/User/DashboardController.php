<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Product\Methods\ProductInterface;
use App\Models\Rating\Methods\RatingInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $productRepo;
    private $ratingRepo;
    private $issuccess = true;
    public function __construct(
        ProductInterface $productInterface,
        RatingInterface $ratingInterface
    ) {
        $this->productRepo = $productInterface;
        $this->ratingRepo = $ratingInterface;
    }
    public function viewdash()
    {
        if (auth()->guard('admin')->check() || auth()->guard('vendor')->check()) {
            return view('User.dashboard');
        } else {
            $link = '';
            $list = [];
            $product = $this->productRepo->getproductforguest($this->issuccess, $link);
            if (!$this->issuccess) {
                return redirect()->back()->with('message', 'Something went wrong. Try again');
            } else {
                $val = '';
                if (count($product) > 0)
                    $list = $product['data'];
                return view('User.dashboard', compact('list', 'link', 'val'));
            }
        }
    }
    public function filterproduct(Request $request)
    {
        $params = $request->only('filter-product');
        $fomatedstring = $this->FormatDataToString($params);
        return redirect()->route('filter-product', ['data' => $fomatedstring]);
    }
    public function viewfilter($val)
    {
        if ($val == null || empty($val)) {
            $product = $this->productRepo->getproductforguest($this->issuccess, $link);
        } else {
            $search = str_replace('%7C', '|', $val);
            $search = str_replace('%20', ' ', $search);
            $data = $this->FormatStringToData($search);
            $val = $data['filter-product'];
            if ($val == '1') {
                $filter = 'createdate';
                $orderby = 'asc';
            } elseif ($val == '2') {
                $filter = 'createdate';
                $orderby = 'desc';
            } elseif ($val == '3') {
                $filter = 'price';
                $orderby = 'asc';
            } elseif ($val == '4') {
                $filter = 'price';
                $orderby = 'desc';
            }
            $product = $this->productRepo->getproductforguest($this->issuccess, $link, $filter, $orderby);
        }
        if (!$this->issuccess) {
            return redirect()->back()->with('message', 'Something went wrong. Try again');
        } else {
            if (count($product) > 0)
                $list = $product['data'];
            return view('User.dashboard', compact('list', 'link', 'val'));
        }
    }
    public function addrating(Request $request)
    {
        $params = $request->except('_method', '_token');
        $params['clientip'] = $request->ip();
        $save = $this->ratingRepo->saverating($params);
        if (!$save) {
            return redirect()->back()->with('message', 'Something went wrong. Try again');
        } else {
            return redirect()->back()->with('message', 'Thanks for the rating.');
        }
    }
}
