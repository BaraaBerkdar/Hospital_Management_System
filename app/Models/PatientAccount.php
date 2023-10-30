<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;
     protected $guarded=[];

    public function hasInvoice(){
        return $this->belongsTo('App\Models\Single_invoice','invoice_id');

    }
    public function hasReceipt(){
        return $this->belongsTo('App\Models\ReceiptAccount','receipt_id');

    }
    public function hasPyment(){
        return $this->belongsTo('App\Models\PaymentAccount','Payment_id');
    }

    public function hasGroupInvoice(){
        return $this->belongsTo('App\Models\group_invoice','group_invoice_id');
    }
}
