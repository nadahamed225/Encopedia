<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\JournalEntities;
use App\Http\Requests\ShipmentRequest;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::all();
        return view('shipments.index', ['shipments' => $shipments]);
    }

    public function show($id){
        $shipment=Shipment::where('id',$id)->first();
        return view("shipments.show",["shipment"=>$shipment]);
    }

    public function create(){
        return view("shipments.create");
    }

//    public function store(ShipmentRequest $shipmentRequest){
//        $validatedData=$shipmentRequest->request;
//        if($shipmentRequest->hasFile("image"))
//        {
//            $image = $shipmentRequest->file("image");
//            $image_name = "images/shipments/".time().'.'.$image->extension();
//            $image->move(public_path("images/shipments"), $image_name);
//            $validatedData->image=$image;
//        }
//        $shipment=Shipment::create($validatedData->all());
//        if($shipment->status=='Done') {
//            $this->createEntities($shipment);
//        }
//        $shipments = Shipment::all();
//        return view("shipments.index",['shipments' => $shipments]);
//    }

    public function store(ShipmentRequest $shipmentRequest)
    {
        $validatedData = $shipmentRequest->validated(); // Use validated() method to get validated data

        if ($shipmentRequest->hasFile("image")) {
            $image = $shipmentRequest->file("image");
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path("images/shipments"), $image_name);
            $validatedData['image'] = $image_name; // Save the image path to the database
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
    public function setStatus($id){
        $shipment=Shipment::where('id',$id)->first();
        $shipment->status='Done';
        $shipment->save();
        $this->createEntities($shipment);
        return $shipment;
    }
    public function createEntities($shipment){
        $entity=new JournalEntities();
        $entity->amount=(100*$shipment->price)/100;
        $entity->type='Debit Cash';
        $entity->shipment=$shipment->id;
        $entity->save();

        $entity=new JournalEntities();
        $entity->amount=(20*$shipment->price)/100;
        $entity->type='Credit Revenue';
        $entity->shipment=$shipment->id;
        $entity->save();

        $entity=new JournalEntities();
        $entity->amount=(80*$shipment->price)/100;
        $entity->type='Credit Payable';
        $entity->shipment=$shipment->id;
        $entity->save();
    }
}
