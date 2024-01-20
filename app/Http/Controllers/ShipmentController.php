<?php

namespace App\Http\Controllers;
use App\Models\Shipment;
use App\Models\JournalEntities;
use App\Http\Requests\ShipmentRequest;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::all();
        return view('shipments.index', ['shipments' => $shipments]);
    }

    public function show($id){
        $shipment=Shipment::findOrFail($id);;
        return view("shipments.show",["shipment"=>$shipment]);
    }

    public function create(){
        return view("shipments.create");
    }

    public function store(ShipmentRequest $shipmentRequest)
    {
        $validatedData = $shipmentRequest->validated();

        if ($shipmentRequest->hasFile("image")) {
            $image = $shipmentRequest->file("image");
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path("images/shipments"), $image_name);
            $validatedData['image'] = $image_name;
        }

        $shipment = Shipment::create($validatedData);

        if ($shipment->status == 'Done') {
            $this->createEntities($shipment);
        }

        $shipments = Shipment::all();
        return view("shipments.index", ['shipments' => $shipments]);
    }

    public function getPrice($weight){
        if($weight<10){
            return 10;
        }else if($weight<25){
            return 100;
        }else{
            return 300;
        }
    }
    public function setStatus($id,$status){
        $shipment=Shipment::findOrFail($id);
        $user = Auth::user();
        $shipment->updated_by=$user->name;
        if ($status!='Done'){
            $shipment->status=$status;
            $shipment->save();
        }else {
            $shipment->status = 'Done';
            $shipment->save();
            $this->createEntities($shipment);
        }
        return $shipment;
    }
    public function createEntities($shipment){
        $debitCash=new JournalEntities();
        $debitCash->amount=(100*$shipment->price)/100;
        $debitCash->type='Debit Cash';
        $debitCash->shipment=$shipment->id;
        $debitCash->save();

        $creditRevenue=new JournalEntities();
        $creditRevenue->amount=(20*$shipment->price)/100;
        $creditRevenue->type='Credit Revenue';
        $creditRevenue->shipment=$shipment->id;
        $creditRevenue->save();

        $creditPayable=new JournalEntities();
        $creditPayable->amount=(80*$shipment->price)/100;
        $creditPayable->type='Credit Payable';
        $creditPayable->shipment=$shipment->id;
        $creditPayable->save();
    }
}
