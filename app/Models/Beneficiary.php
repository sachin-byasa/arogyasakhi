<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model{
    protected $table = 'beneficiaries';

    // protected $with = ['BeneficiaryClosure'];
    // protected $with = ['BeneficiaryType'];
    // protected $with = ['BeneficiaryStatus'];
    // protected $with = ['BeneficiaryVisit'];

    // protected $with = ['BeneficiaryClosure', 'BeneficiaryType', 'BeneficiaryStatus','BeneficiaryVisit'];

    public function BeneficiaryClosure()
    {
        return $this->hasone('App\Models\BeneficiaryClosure','closure_status');
    }

    public function BeneficiaryType()
    {
        return $this->hasone('App\Models\BeneficiaryType','beneficiary_type');
    }
    
    public function BeneficiaryStatus()
    {
        return $this->hasone('App\Models\BeneficiaryStatus','beneficiary_status', 'beneficiary_status');
    }
    
    public function BeneficiaryVisit()
    {
        return $this->belongstoMany('App\Models\BeneficiaryVisit','beneficiary_visit');
    }


}
