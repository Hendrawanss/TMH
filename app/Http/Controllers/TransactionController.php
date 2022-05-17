<?php

namespace App\Http\Controllers;

use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\MenuRepositoryInterfaces;
use App\Interfaces\TransactionRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private TransactionRepositoryInterfaces $transactionRepository;
    private MenuRepositoryInterfaces $menuRepository;
    private CustomerRepositoryInterface $customerRepository;

    private $menus = array();

    public function __construct(
        TransactionRepositoryInterfaces $transactionRepository,
        MenuRepositoryInterfaces $menuRepository,
        CustomerRepositoryInterface $customerRepository,
        )
    {
        $this->transactionRepository = $transactionRepository;
        $this->menuRepository = $menuRepository;
        $this->customerRepository = $customerRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.order.index' , [
            'transactions' => $this->transactionRepository->getAllTransactions()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.order.create', [
            'menus' => $this->menuRepository->getAllMenus(),
            'customers' => $this->customerRepository->getAllCustomers(),
        ]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $this->transactionRepository->createTransaction($user->id,json_decode($request->menu, true));
        
        return redirect()->route('order.index')->with('success','Add data successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.order.edit', [
            "transaction" => $this->transactionRepository->getDetailTransaction($id),
        ]);
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
        foreach($request->barang as $menu)
        {
            if($menu["total_item"] == 0)
            {
                return redirect()->back()->withErrors(['message' => 'Item total must higher then zero']);
            }
        }
        $this->transactionRepository->updateTransaction($id, $request->barang);
        
        return redirect()->route('order.index')->with('success','Update data successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->transactionRepository->deleteTransaction($id);

        return redirect()->route('order.index')->with('success','Delete data successfully!');
    }

    public function confirmation(Request $request)
    {
        $validated = $request->validate([
            'customer' => "required",
        ]);

        if(!array_key_exists('id',$request->barang))
        {
            return redirect()->back()->withErrors(['message' => 'Item must be choosed']);
        }

        foreach($request->barang["id"] as $menu)
        {
            if($request->barang["total_item"][$menu] == 0)
            {
                return redirect()->back()->withErrors(['message' => 'Item total must higher then zero']);
            }
            $this->menus["menu"][] = [
                'menu_id' => $menu,
                'menu' => $this->menuRepository->getDetailMenu($menu), 
                'total_item' => $request->barang["total_item"][$menu]
            ];
        }

        return view('pages.order.confirmation', [
            'menus' => $this->transactionRepository->calculatePrice($request->customer, $this->menus),
            'customer' => $this->customerRepository->getDetailCustomer($request->customer),
        ]);
    }
}
